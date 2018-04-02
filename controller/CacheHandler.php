<?php


/*
 * Attention : the cache can be used for Propel objects as well. However the cache depends on the serialization of the object,
 * which by default is implemented using __sleep. For Propel objects, this __sleep first clears all references to associated objects.
 * There are thus by default not serialized and stored to cache. If you want them to be stored, you can do this by implementing the 
 * Serializable Interface, such as is done in Ticker.php by json encoding. Mind however that this method loses info on the 
 * persistence of the object (i.e. all objects after restoring from case are 'new', even though they might exist in the database). 
 * To restore also this, another method should be used.
 * 
 * 
 * For the moment uses Redis server
 * Windows : https://chocolatey.org/packages/redis-64
 * 1. install chocolatey with command in powershell as admin : Set-ExecutionPolicy Bypass -Scope Process -Force; iex ((New-Object System.Net.WebClient).DownloadString('https://chocolatey.org/install.ps1'))
 * 2. install redis with command : choco install redis-64
 * 3. start redis with command : redis-server
 * Linux : todo (yum install probably)
 */

use Propel\Runtime\Propel;
use Cache\Adapter\Predis\PredisCachePool;
use Predis\Client;
use Cache\Adapter\Common\CacheItem;

class CacheHandler{
    private static $syncEvents = array();
    private static $cache;
    
    private static function getCache() : PredisCachePool{
        if(!isset(self::$cache)){
            $client = new Client();
            $pool = new Cache\Adapter\Predis\PredisCachePool($client);
            self::$cache = $pool;
        }
        return self::$cache;
    }
    
    private static function getSafeCacheKey($key) : string{
        $cache = self::getCache();
        $pregisSpecialChars = '|[\{\}\(\)/\\\@\:]|';
        return preg_replace($pregisSpecialChars, '-', $key);
    }
    
    public static function getSemaphore($key){
        // exclusive control
	//$semaphore_key = crc32($key);		// unique integer key for this semaphore (Rush fan!)        
        //$semaphore = new Semaphore($semaphore_key);
        $semaphore = new SyncMutex($key);
        try{
            //$semaphore->acquire();
            //$waitSecs = -1; // infinite
            $waitSecs = 0; // 0 secs, just try and return
            self::getLogger()->addInfo('trying to get semaphore '.$key);
            if(!$semaphore->lock($waitSecs)){
                self::getLogger()->addInfo('failed to lock semaphore '.$key);
                return false;
            }
            
            self::getLogger()->addInfo('gotten semaphore '.$key);
            return $semaphore;
        }
        catch(Exception $e){
            self::getLogger()->addError("Failed to get semaphore $key with exception ".$e->getMessage());
            throw $e;
        }      
        
    }
    
    public static function releaseSemaphore(SyncMutex $semaphore){
        // release exclusive control	
	try{
            //$semaphore->release();
            $unlockAll = true;
            $semaphore->unlock($unlockAll);
            self::getLogger()->addInfo('released semaphore');
        }
        catch(Exception $e){
            self::getLogger()->addError("Failed to release semaphore ");
            throw $e;
        }
    }

    public static function getSyncEvent(String $key){
        if(!isset(self::$syncEvents[$key])){
            //self::$syncEvents[$key] = new SyncEvent($key,true);
            self::$syncEvents[$key] = new SyncEvent("blabla".$key,true);
        }
        return self::$syncEvents[$key];
    }
    
    public static function isInCache($cacheKey){
        return self::getCache()->hasItem(self::getSafeCacheKey($cacheKey));
    }
    
    public static function getFromCache($cacheKey){
       $res = self::getCache()->getItem(self::getSafeCacheKey($cacheKey))->get();
       //$res = apcu_fetch($cacheKey);
       if($res !== false) {
           self::getLogger()->addInfo('ExchangeAdapter - fetched items from cache using '.$cacheKey.' cache key');
           return $res;
       }
       else{
           self::getLogger()->addInfo('ExchangeAdapter - did not find data in cache using '.$cacheKey.' cache key');
           return null;
       }
    }
    
    public static function addToCache($data,$cacheKey,$timeToLiveSecs=4){
       //apcu_add($cacheKey, $data,$timeToLiveSecs);
        //self::getCache()->set(self::getSafeCacheKey($cacheKey), $data, $timeToLiveSecs*1000); // ttl is in millisecs in predis
        self::getCache()->set(self::getSafeCacheKey($cacheKey), $data, $timeToLiveSecs); // ttl is in millisecs in predis
        self::getLogger()->addInfo('ExchangeAdapter - saved data to cache '.$cacheKey);
    }
    
    public static function clearCache(){
        self::getCache()->clear();
    }
    
    private static function getLogger(){
        return Propel::getServiceContainer()->getLogger();
    }
}