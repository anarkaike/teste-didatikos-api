<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class CityNameScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder
            ->join(table: 'cities', first: 'cities.id', operator: '=', second: $model->getTable() . '.city_id')
            ->select(
                $model->getTable() . '.*',
                'cities.name as city_name'
            );
    }
}
