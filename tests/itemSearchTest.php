<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use Edwinmugendi\Amazon\Apai;

$apai = new Apai();
//Set configs
$apai->setConfig('ApiKey', 'AKIAJJWWS3SKYX44LSIA');
$apai->setConfig('ApiSecret', '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');
$apai->setConfig('AssociativeTag', 'shopcons02-21');
$apai->setConfig('EndPoint', 'webservices.amazon.de');

//Set parameters
$apai->setParam('SearchIndex', 'All');
$apai->setParam('ResponseGroup', 'Offers');
$apai->setParam('Keywords', 'hp laptop');

$verbose = true; //Print url sent to Amazon and the results from Amazon

$response = $apai->itemSearch($verbose);

//XML from 
var_dump($response);

$item_lookup_xml = new \SimpleXMLElement($response);
