<?php

namespace Tests;

use Controller\captcha;
use PHPUnit\Framework\TestCase;

class cacheTest extends TestCase
{
    /**
     * @return [type]
     */
    public function testCacheValue (){
        
        $cache = new \Controller\Cache(dirname(__DIR__)  . '/src/cache');
        $cache->set();
        $this->assertEquals($cache->get() , $cache->explodes()[1]);
    }


    public function testCacheDelete (){
        
        $cache = new \Controller\Cache(dirname(__DIR__)  . '/src/cache');
        $cache->set();
        $delete = $cache->delete();
        if ($delete === true) {
            $this->assertIsBool($delete, "Le fichier a été supprimer avec succès");
        }
        
    }
}