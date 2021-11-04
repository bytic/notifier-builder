<?php

namespace ByTIC\NotifierBuilder\Utility;

use ByTIC\MediaLibrary\Models\MediaProperties\MediaProperties;
use ByTIC\MediaLibrary\Models\MediaRecords\MediaRecords;
use ByTIC\Payments\Models\PurchaseSessions\PurchaseSessionsTrait;
use Nip\Records\Locator\ModelLocator;
use Nip\Records\RecordManager;

/**
 * Class NotifierBuilderModels
 * @package ByTIC\NotifierBuilder\Utility
 */
class NotifierBuilderModels
{
    protected static $purchaseModel = 'purchases';
    protected static $purchaseSessionsModel = 'purchase-sessions';

    protected static $models = [];

    /**
     * @return RecordManager
     */
    public static function purchases()
    {
        return static::getModels('purchases', 'purchases');
    }

    /**
     * @return PurchaseSessionsTrait
     */
    public static function sessions()
    {
        return static::getModels('purchasesSessions', 'purchase-sessions');
    }

    /**
     * @param string $type
     * @param string $default
     * @return mixed|\Nip\Records\AbstractModels\RecordManager
     */
    protected static function getModels($type, $default)
    {
        if (!isset(static::$models[$type])) {
            $modelManager = static::getConfigVar($type, $default);
            return static::$models[$type] = ModelLocator::get($modelManager);
        }

        return static::$models[$type];
    }

    /**
     * @param string $type
     * @param null|string $default
     * @return string
     */
    protected static function getConfigVar($type, $default = null)
    {
        if (!function_exists('config')) {
            return $default;
        }
        $varName = 'payments.models.' . $type;
        $config = config();
        if ($config->has($varName)) {
            return $config->get($varName);
        }
        return $default;
    }
}
