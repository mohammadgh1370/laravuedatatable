<?php

namespace Laravue\Datatable\Traits;

use Illuminate\Support\Str;

trait LaraVueDatatableTrait
{
    use SearchableTrait;

    public function scopeEloquentQuery($query, $orderBy, $orderByDir, $searchValue = '')
    {
        $orderBy = $orderBy ?? 'id';
        $orderByDir = $orderByDir ?? 'asc';

        $query = $query->searching($searchValue);
        $this->ordering($query, $orderBy, $orderByDir);
        return $query;
    }

    public function ordering($query, $orderBy, $orderByDir)
    {
        if (isset($orderBy) && !empty($orderBy)) {
            $explodeOrderByWithDot = explode('.', $orderBy);
            $table = sizeof($explodeOrderByWithDot) > 1 ? $explodeOrderByWithDot[0] : Str::singular($this->getTable());
            $column = sizeof($explodeOrderByWithDot) > 1 ? $explodeOrderByWithDot[1] : $orderBy;
            $accessorColumn = $this->dataTableColumns[$table][$column]['accessor'] ?? [$column];
            foreach ($accessorColumn as $col) {
                $query->orderBy($col, $orderByDir);
            }
        } else {
            $defaultOrderBy = config('laravel-vue-datatables.default_order_by');
            $defaultOrderBy = is_null($defaultOrderBy) ? 'id' : $defaultOrderBy;
            $query->orderBy($this->getTable() . ".$defaultOrderBy", $orderByDir);
        }
        return $query;
    }
}
