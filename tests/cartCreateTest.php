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
$apai->setParam('Item.1.ASIN', '[ASIN]');
$apai->setParam('Item.1.Quantity', '2');
$apai->setParam('Item.2.ASIN', '[ASIN]');
$apai->setParam('Item.2.Quantity', '2');
$apai->setParam('Item.3.ASIN', '[ASIN]');
$apai->setParam('Item.3.Quantity', '2');

$verbose = true; //Print url sent to Amazon and the results from Amazon

$response = $apai->cartCreate($verbose);

//Response
var_dump($response);

if ($response['status']) {
    $item_lookup_xml = new \SimpleXMLElement($response['response']);
} else {
    echo $response['response'];
}//E# if else statement