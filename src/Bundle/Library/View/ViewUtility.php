<?php

namespace ByTIC\NotifierBuilder\Bundle\Library\View;

/**
 *
 */
class ViewUtility
{
    public const NAME = 'PayticPayments';

    public static function registerViewPathsAdmin($view): void
    {
        self::registerViewPaths($view, 'admin');
    }

    public static function registerViewPaths($view, $module = null): void
    {
        $path = realpath(__DIR__ . '/../../../../resources/views/' . $module);
        $view->addPath($path);
        $view->addPath($path, self::NAME);
    }
}
