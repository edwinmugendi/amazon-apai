<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use Edwinmugendi\Amazon\Apai;

$apai = new Apai();
//Set configs
$apai->setConfig('ApiKey', 'XXXX');
$apai->setConfig('ApiSecret', 'XXXX');
$apai->setConfig('AssociativeTag', 'XXXX');
$apai->setConfig('EndPoint', 'webservices.amazon.de');

//Set parameters
$apai->setParam('CartId', '23312123');
$apai->setParam('HMAC', '[URL-encoded HMAC]'); //Check the documentation on how to generate this: http://docs.aws.amazon.com/AWSECommerceService/latest/DG/CartAdd.html
$apai->setParam('Item.1.OfferListingId', '');
$apai->setParam('Item.1.Quantity', '');

$verbose = true; //Print url sent to Amazon and the results from Amazon

$response = $apai->cartAdd($verbose);

//Response
var_dump($response);

if ($response['status']) {
    $item_lookup_xml = new \SimpleXMLElement($response['response']);
} else {
    echo $response['response'];
}//E# if else statement