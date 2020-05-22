<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

trait Locationable {

	/**
	 * @param Builder $query
	 * @param float   $latitude Latitude
	 * @param float   $longitude Longitude
	 *
	 * @return Builder
	 */
	public function scopeDistance( $query , $latitude , $longitude ) {
		$latName = $this->getQualifiedLatitudeColumn();
		$lngName = $this->getQualifiedLongitudeColumn();

		$query->select( "*"
			, DB::raw( "ROUND(6371 * acos(cos(radians(" . $latitude . "))
        * cos(radians(" . $latName . ")) * cos(radians(" . $lngName . ") - radians(" . $longitude . "))
        + sin(radians(" . $latitude . "))
        * sin(radians(" . $latName . "))),2) AS distance" ) );

		return $query;
	}

	public function scopeHavingDistance( $query , $operation , $distance ) {
		return $query->having( 'distance' , $operation , $distance );
	}

	public function scopeHavingAround( $query , $inner_radius , $outer_radius ) {
		return $query->havingRaw( 'distance BETWEEN ? AND ?' , [ $inner_radius , $outer_radius ] );
	}

	public function scopeOrderByDistance( $query , $dir = 'ASC' ) {
		return $query->orderBy( 'distance' , $dir );
	}

	protected function getQualifiedLatitudeColumn() {
		return $this->getTable() . '.' . $this->getLatitudeColumn();
	}

	protected function getQualifiedLongitudeColumn() {
		return $this->getTable() . '.' . $this->getLongitudeColumn();
	}

	public function getLatitudeColumn() {
		return defined( 'static::LATITUDE' ) ? static::LATITUDE : 'lat';
	}

	public function getLongitudeColumn() {
		return defined( 'static::LONGITUDE' ) ? static::LONGITUDE : 'lng';
	}

	protected function runPaginationCountQuery( $columns = [ '*' ] ) {
		if ( $this->havings ) {
			$query = $this->cloneWithout( [ 'orders' , 'limit' , 'offset' ] )
			              ->cloneWithoutBindings( [ 'order' ] );

			// We don't need simple columns, only specials
			// like subselects which is why we're using
			// havings after all.
			foreach ( $query->columns as $key => $value ) {
				if ( is_string( $value ) ) {
					unset( $query->columns[ $key ] );
				}
			}

			$countQuery = DB::table( DB::raw( '(' . $query->toSql() . ') as x' ) )->mergeBindings( $query );

			// Using a aggregate here won't work when
			// groups are present because the
			// getCountForPagination() is
			// checking for it.
			if ( ! $this->groups ) {
				$countQuery->setAggregate( 'count' , $this->withoutSelectAliases( $columns ) );
			}

			return $countQuery->get()->all();
		}

		return $this->cloneWithout( [ 'columns' , 'orders' , 'limit' , 'offset' ] )
		            ->cloneWithoutBindings( [ 'select' , 'order' ] )
		            ->setAggregate( 'count' , $this->withoutSelectAliases( $columns ) )
		            ->get()->all();
	}
}
