<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class BrandNameScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        $builder
            ->join(table: 'brands', first: 'brands.id', operator: '=', second: $model->getTable() . '.brand_id')
            ->select(
                $model->getTable() . '.*',
                'brands.name as brand_name'
            );
    }
}
