<?php
/**
 * 
 * Description : load tools
 * Author : louche
 * Date : 2015Äê4ÔÂ28ÈÕ
 */

include __DIR__ . "/../../ok_vendor/Autoloader.php";
$autoloader = new Autoloader();
$autoloader->addNamespace("TestHelper", __DIR__ . "/../../ok_vendor/TestHelper");
$autoloader->addNamespace("OK", __DIR__ . "/../../ok_vendor/OK/");
$autoloader->addNamespace("Openapi", __DIR__ . "/../../ok_openapi_gw/shared/");
$autoloader->register();