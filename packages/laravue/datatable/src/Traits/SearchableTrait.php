<?php

namespace Laravue\Datatable\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

trait SearchableTrait
{
    protected $search_bindings = [];

    public function scopeSearching(Builder $q, $searchValue, $threshold = null, $entireText = false, $entireTextOnly = false)
    {
        if ($searchValue === false) {
            return $q;
        }

        $query = clone $q;
        $query->select($this->getTable() . '.*')->makeJoins();

        list($search, $words) = $this->preg_match_filter($searchValue);

        $this->search_bindings = [];

        list($selects, $relevance_count) = $this->getSelects($words, $search, $entireText, $entireTextOnly);

        $this->addSelectsToQuery($query, $selects);
        $this->filterQueryWithRelevance($query, $selects, $threshold, $relevance_count);
        $this->makeGroupBy($query);
        $this->mergeQueries($query, $q);
        return $query;
    }

    public function scopeMakeJoins(Builder $query)
    {
        foreach ($this->getJoins() as $table => $keys) {
            $query->leftJoin($table, function ($join) use ($keys) {
                $join->on($keys[0], '=', $keys[1]);
                if (array_key_exists(2, $keys) && array_key_exists(3, $keys)) {
                    $join->whereRaw($keys[2] . ' = "' . $keys[3] . '"');
                }
            });
        }
    }

    /**
     * Puts all the select clauses to the main query.
     *
     * @param Builder $query
     * @param array $selects
     */
    protected function addSelectsToQuery(Builder $query, array $selects)
    {
        if (!empty($selects)) {
            $query->selectRaw('max(' . implode(' + ', $selects) . ') as ' . $this->getRelevanceField(), $this->search_bindings);
        }
    }

    /**
     * Adds the relevance filter to the query.
     *
     * @param Builder $query
     * @param array $selects
     * @param $threshold
     * @param float $relevance_count
     */
    protected function filterQueryWithRelevance(Builder $query, array $selects, $threshold, $relevance_count)
    {
        if (is_null($threshold)) {
            $relevance_count = $relevance_count / count($this->getColumns());
        }

        if (!empty($selects)) {
            $comparator = $this->isMysqlDatabase() ? $this->getRelevanceField() : implode(' + ', $selects);

            $relevance_count = number_format($relevance_count, 2, '.', '');

            if ($this->isMysqlDatabase()) {
                $bindings = [];
            } else {
                $bindings = $this->search_bindings;
            }
            $query->havingRaw("$comparator >= $relevance_count", $bindings);
            $query->orderBy($this->getRelevanceField(), 'desc');
        }
        // add bindings to postgres
    }

    /**
     * Makes the query not repeat the results.
     *
     * @param Builder $query
     */
    protected function makeGroupBy(Builder $query)
    {
        if ($groupBy = $this->getGroupBy()) {
            $query->groupBy($groupBy);
        } else {
            if ($this->isSqlsrvDatabase()) {
                $columns = $this->getTableColumns();
            } else {
                $columns = $this->getTable() . '.' . $this->primaryKey;
            }

            $query->groupBy($columns);

            $joins = array_keys(($this->getJoins()));

            foreach ($this->getColumns() as $column => $relevance) {
                array_map(function ($join) use ($column, $query) {
                    if (Str::contains($column, $join)) {
                        $query->groupBy($column);
                    }
                }, $joins);
            }
        }
    }

    /**
     * Merge our cloned query builder with the original one.
     *
     * @param Builder $clone
     * @param Builder $original
     */
    protected function mergeQueries(Builder $clone, Builder $original)
    {
        $tableName = DB::connection($this->connection)->getTablePrefix() . $this->getTable();
        if ($this->isPostgresqlDatabase()) {
            $original->from(DB::connection($this->connection)->raw("({$clone->toSql()}) as {$tableName}"));
        } else {
            $original->from(DB::connection($this->connection)->raw("({$clone->toSql()}) as `{$tableName}`"));
        }

        // First create a new array merging bindings
        $mergedBindings = array_merge_recursive(
            $clone->getBindings(),
            $original->getBindings()
        );

        // Then apply bindings WITHOUT global scopes which are already included. If not, there is a strange behaviour
        // with some scope's bindings remaning
        $original->withoutGlobalScopes()->setBindings($mergedBindings);
    }

    /**
     * get table with columns.
     * @return array|mixed
     */
    public function getJoins()
    {
        if (isset($this->dataTableColumns['joins'])) {
            return Arr::get($this->dataTableColumns, 'joins', []);
        } else {
            $joins = [];
            $localTable = $this->getTable();
            $singularLocalTable = Str::singular($localTable);
            $relations = array_keys(Arr::except($this->dataTableColumns, $singularLocalTable, []));
            foreach ($relations as $relation) {
                $joins = array_merge($joins, [Str::plural($relation) => [Str::plural($relation) . '.' . $singularLocalTable . '_id', $localTable . '.id']]);
            }
            return $joins;
        }
    }

    /**
     * filter on search value.
     * @param $searchValue
     * @return array
     */
    private function preg_match_filter($searchValue): array
    {
        $search = mb_strtolower(trim($searchValue));
        preg_match_all('/(?:")((?:\\\\.|[^\\\\"])*)(?:")|(\S+)/', $search, $matches);
        $words = $matches[1];
        for ($i = 2; $i < count($matches); $i++) {
            $words = array_filter($words) + $matches[$i];
        }
        return array($search, $words);
    }

    /**
     * @param $entireText
     * @param $entireTextOnly
     * @param $words
     * @param $search
     * @return array
     */
    private function getSelects($words, $search, $entireText, $entireTextOnly): array
    {
        $selects = [];
        $relevance_count = 0;
        foreach ($this->getColumns() as $column => $relevance) {
            $relevance_count += $relevance;
            if (!$entireTextOnly) {
                $queries = $this->getSearchQueriesForColumn($column, $relevance, $words);
            } else {
                $queries = [];
            }
            if (($entireText === true && count($words) > 1) || $entireTextOnly === true) {
                $queries[] = $this->getSearchQuery($column, $relevance, [$search], 50, '', '');
                $queries[] = $this->getSearchQuery($column, $relevance, [$search], 30, '%', '%');
            }
            foreach ($queries as $select) {
                if (!empty($select)) {
                    $selects[] = $select;
                }
            }
        }
        return array($selects, $relevance_count);
    }

    /**
     * Returns the search columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $tableWithColumns = $this->getDataTableWithColumns();
        if (sizeof($tableWithColumns)) {
            $driver = $this->getDatabaseDriver();
            $prefix = Config::get("database.connections.$driver.prefix");
            $columns = [];
            foreach ($tableWithColumns as $table => $tableColumns) {
                foreach ($tableColumns as $column => $options) {
                    if ($options['searchable'])
                        if (isset($options['accessor'])) {
                            foreach ($options['accessor'] as $col) {
                                $columns[$prefix . Str::plural($table) . '.' . $col] = $options['priority'];
                            }
                        } else
                            $columns[$prefix . Str::plural($table) . '.' . $column] = $options['priority'];
                }
            }
            return $columns;
        } else {
            return preg_filter('/^/', $this->getTable() . '.', Schema::getColumnListing($this->getTable()));
        }
    }

    /**
     * Returns database driver Ex: mysql, pgsql, sqlite.
     *
     * @return array
     */
    protected function getDatabaseDriver()
    {
        $key = $this->connection ?: Config::get('database.default');
        return Config::get('database.connections.' . $key . '.driver');
    }

    /**
     * Returns the search queries for the specified column.
     *
     * @param string $column
     * @param float $relevance
     * @param array $words
     * @return array
     */
    protected function getSearchQueriesForColumn($column, $relevance, array $words)
    {
        return [
            $this->getSearchQuery($column, $relevance, $words, 15),
            $this->getSearchQuery($column, $relevance, $words, 5, '', '%'),
            $this->getSearchQuery($column, $relevance, $words, 1, '%', '%')
        ];
    }

    /**
     * Returns the sql string for the given parameters.
     *
     * @param string $column
     * @param string $relevance
     * @param array $words
     * @param float $relevance_multiplier
     * @param string $pre_word
     * @param string $post_word
     * @return string
     */
    protected function getSearchQuery($column, $relevance, array $words, $relevance_multiplier, $pre_word = '', $post_word = '')
    {
        $like_comparator = $this->isPostgresqlDatabase() ? 'ILIKE' : 'LIKE';
        $cases = [];

        foreach ($words as $word) {
            $cases[] = $this->getCaseCompare($column, $like_comparator, $relevance * $relevance_multiplier);
            $this->search_bindings[] = $pre_word . $word . $post_word;
        }

        return implode(' + ', $cases);
    }

    /**
     * Check if used database is PostgreSQL.
     *
     * @return bool
     */
    private function isPostgresqlDatabase()
    {
        return $this->getDatabaseDriver() == 'pgsql';
    }

    /**
     * Check if used database is MySQL.
     *
     * @return bool
     */
    private function isMysqlDatabase()
    {
        return $this->getDatabaseDriver() == 'mysql';
    }

    /**
     * Check if used database is SQLSRV.
     *
     * @return bool
     */
    protected function isSqlsrvDatabase()
    {
        return $this->getDatabaseDriver() == 'sqlsrv';
    }

    /**
     * Returns the comparison string.
     *
     * @param string $column
     * @param string $compare
     * @param float $relevance
     * @return string
     */
    protected function getCaseCompare($column, $compare, $relevance)
    {
        if ($this->isPostgresqlDatabase()) {
            $field = "LOWER(" . $column . ") " . $compare . " ?";
            return '(case when ' . $field . ' then ' . $relevance . ' else 0 end)';
        }

        $column = str_replace('.', '`.`', $column);
        $field = "LOWER(`" . $column . "`) " . $compare . " ?";
        return '(case when ' . $field . ' then ' . $relevance . ' else 0 end)';
    }

    /**
     * Returns the relevance field name, alias of ratio column in the query.
     *
     * @return string
     */
    protected function getRelevanceField()
    {
        if ($this->relevanceField ?? false) {
            return $this->relevanceField;
        }

        // If property $this->relevanceField is not setted, return the default
        return 'relevance';
    }

    /**
     * Returns whether or not to keep duplicates.
     *
     * @return array
     */
    protected function getGroupBy()
    {
        if (array_key_exists('groupBy', $this->dataTableColumns)) {
            return $this->dataTableColumns['groupBy'];
        }

        return false;
    }

    /**
     * Returns the table columns.
     *
     * @return array
     */
    public function getTableColumns()
    {
        return $this->dataTableColumns['table_columns'];
    }

    /**
     * @return array
     */
    protected function getDataTableWithColumns(): array
    {
        return Arr::except($this->dataTableColumns, 'joins', []);
    }
}