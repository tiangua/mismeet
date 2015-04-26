<?php
/**
 * 
 * Description : 
 * Author : louche
 * Date : 2015Äê4ÔÂ26ÈÕ
 */

use OK\PhalconEnhance\Constant\BuiltinKey;
use OK\PhalconEnhance\Constant\BuiltinServiceName;
use MisMeet\Lib\Constant\ServiceName;
use Phalcon\Cache\Frontend\Data as CacheFrontend;
use Phalcon\Cache\Backend\File as CacheBackend;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

return [
    [
        ServiceName::DB_MISMEET,
        function() {
            $config = include __DIR__ . "/db.php";
            $connection = new DbAdapter([
                BuiltinKey::DB_HOST     => $config[BuiltinKey::DB_HOST],
                BuiltinKey::DB_USERNAME => $config[BuiltinKey::DB_USERNAME],
                BuiltinKey::DB_PASSWORD => $config[BuiltinKey::DB_PASSWORD],
                BuiltinKey::DB_NAME     => $config[BuiltinKey::DB_NAME]
            ]);
            return $connection;
        }
    ],
    [
        BuiltinServiceName::MODELS_CACHE,
        function() {
            $config = include __DIR__ . "/dir.php";
            $frontCache = new CacheFrontend([
                BuiltinKey::CACHE_LIFETIME => 86400,
            ]);
            return new CacheBackend($frontCache, [
                BuiltinKey::CACHE_DIR => $config[BuiltinKey::CACHE_DIR]
            ]);
        }
    ]
];