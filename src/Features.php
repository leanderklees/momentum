<?php

namespace Leanderklees\Momentum;
use Illuminate\Support\Facades\Config;


class Features
{
    /**
     * Determine if the given feature is enabled.
     *
     * @param  string  $feature
     * @return bool
     */
    public static function enabled(string $feature)
    {
        return config( 'momentum.' . $feature . '.enabled' );
    }
}
