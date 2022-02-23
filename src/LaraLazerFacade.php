<?php

namespace Zeevx\LaraLazer;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Zeevx\LaraLazer\Skeleton\SkeletonClass
 */
class LaraLazerFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'lara-lazer';
    }
}
