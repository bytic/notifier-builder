<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Utility;

/**
 * Class PathsHelpers.
 */
class PathsHelpers
{

    /**
     * @param $path
     * @return string
     */
    public static function config($path = null): string
    {
        return static::basePath() . '/config' . $path;
    }

    public static function basePath(): string
    {
        return dirname(__DIR__, 2);
    }

    /**
     * @param $path
     * @return string
     */
    public static function migrations($path = null): string
    {
        return static::basePath() . '/migrations' . $path;
    }

    /**
     * @param $path
     * @return string
     */
    public static function resources($path = null): string
    {
        return static::basePath() . '/resources' . $path;
    }
}
