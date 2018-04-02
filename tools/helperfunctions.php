<?php


function formatTimestamp($format, $utimestamp = null)
{
   if (is_null($utimestamp)) {
       $utimestamp = microtime(true);
   }

   $timestamp = floor($utimestamp);
   $milliseconds = round(($utimestamp - $timestamp) * 1000);

   return date(preg_replace('`(?<!\\\\)u`', sprintf("%03u", $milliseconds), $format), $timestamp);
}

function formatMemorySize($size)
{
    if($size==0) return '0 b';
    
    $unit=array('b','kb','mb','gb','tb','pb');
    try{
            return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
    }
    catch(Exception $e){
            return "Exception : size = $size. Exception ". $e->getMessage();
    }
}

function truncateWithThreeDots($text, $nbrOfChars){
    if(($nbrOfChars > 3) and (strlen($text) > $nbrOfChars)){
        $text = substr($text,0,$nbrOfChars-3).'...';
    }
    return $text;
}


/** 
* Converts bytes into human readable file size. 
* 
* @param string $bytes 
* @return string human readable file size (2,87 Мб)
* @author Mogilev Arseny 
*/ 
function fileSizeConvert($bytes)
{
    $result = null;
    $bytes = floatval($bytes);
    $arBytes = array(
        0 => array(
            "UNIT" => "TB",
            "VALUE" => pow(1024, 4)
        ),
        1 => array(
            "UNIT" => "GB",
            "VALUE" => pow(1024, 3)
        ),
        2 => array(
            "UNIT" => "MB",
            "VALUE" => pow(1024, 2)
        ),
        3 => array(
            "UNIT" => "KB",
            "VALUE" => 1024
        ),
        4 => array(
            "UNIT" => "B",
            "VALUE" => 1
        ),
    );

    foreach($arBytes as $arItem)
    {
        if($bytes >= $arItem["VALUE"])
        {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
            break;
        }
    }
    return $result;
}

function encryptToHex($plainText, $method = 'AES-256-CBC'){
    $key = "4734KeurRT.4B&$!"; // cf parameters.php
    $iv_size = openssl_cipher_iv_length ( $method );
    $iv = openssl_random_pseudo_bytes ($iv_size);
    $ciphertext = openssl_encrypt($plainText,  $method, $key, OPENSSL_RAW_DATA, $iv);
    $encValue = $iv.$ciphertext;
    return bin2hex($encValue);
}


function getEnvironment(){
       
    //$manager = new Propel\Common\Config\ConfigurationManager($_SERVER["DOCUMENT_ROOT"].'/CorpBuyingService/conf/propel.yaml');
    $manager = new Propel\Common\Config\ConfigurationManager(__DIR__.'/../conf/propel.yaml');
    
    $version = strtoupper($manager->getConfigProperty('general.version'));
    $versionParts = explode('-',$version);
    if(count($versionParts) < 2)
        throw New Exception("Unable to determine environment from version in the config.yaml file. Please make sure it ends with -PROD or -DEV. Actual version = ".$version);
    return $versionParts[count($versionParts)-1];
}
function isEnvironmentDevelopment(){
    return getEnvironment() == "DEV";
}
function isEnvironmentProduction(){
    return getEnvironment() == "PROD";
}

function getDBAdapterType(){
    $manager = new Propel\Common\Config\ConfigurationManager(__DIR__.'/../conf/propel.yaml');
    $adapter = strtoupper($manager->getConfigProperty('database.connections.arbitragetrader.adapter'));
    return $adapter;
}
function isDBAdapterMSSQL(){
    return getDBAdapterType() == 'MSSQL';
}
function isDBAdapterMYSQL(){
    return getDBAdapterType() == 'MYSQL';
}
function isDBAdapterPGSQL(){
    return getDBAdapterType() == 'PGSQL';
}

function stripStringOfSpecialChars($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
