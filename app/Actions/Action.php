<?php

namespace App\Actions;

abstract class Action {
    public abstract function handler(...$args);

    public static function run(...$args): mixed
    {
        return app(abstract: static::class)->handler(...$args);
    }
}
