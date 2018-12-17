<?php

namespace yiiunit;

use mikk150\authclient\statestorage\CacheStateStorage;
use yii\caching\ArrayCache;

class CacheStateStorageTest extends TestCase
{
    public function testSettingValueToCache()
    {
        $cache = new ArrayCache();

        $stateStorage = new CacheStateStorage([
            'cache' => $cache
        ]);

        $stateStorage->set('testkey', 'testvalue');

        $this->assertEquals('testvalue', $cache->get([CacheStateStorage::class, 'testkey']));
    }

    public function testGettingValueFromCache()
    {
        $cache = new ArrayCache();

        $cache->set([CacheStateStorage::class, 'testkey'], 'testvalue');

        $stateStorage = new CacheStateStorage([
            'cache' => $cache
        ]);

        $this->assertEquals('testvalue', $stateStorage->get('testkey'));
    }

    public function testRemovingValueFromCache()
    {
        $cache = new ArrayCache();

        $cache->set([CacheStateStorage::class, 'testkey'], 'testvalue');

        $stateStorage = new CacheStateStorage([
            'cache' => $cache
        ]);

        $stateStorage->remove('testkey');

        $this->assertFalse($stateStorage->get('testkey'));
    }
}
