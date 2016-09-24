<h1>Amazon Product Advertising API wrapper</h1>
<p>This library wraps the following functions of Amazon's Product Advertising API</p>
1. <a href="http://docs.aws.amazon.com/AWSECommerceService/latest/DG/ItemSearch.html">ItemSearch</a><br>
2. <a href="http://docs.aws.amazon.com/AWSECommerceService/latest/DG/BrowseNodeLookup.html">BrowseNodeLookup</a><br>
3. <a href="http://docs.aws.amazon.com/AWSECommerceService/latest/DG/ItemLookup.html">ItemLookup</a><br>
4. <a href="http://docs.aws.amazon.com/AWSECommerceService/latest/DG/SimilarityLookup.html">SimilarityLookup</a><br>
5. <a href="http://docs.aws.amazon.com/AWSECommerceService/latest/DG/CartAdd.html">CartAdd</a><br>
6. <a href="http://docs.aws.amazon.com/AWSECommerceService/latest/DG/CartClear.html">CartClear</a><br>
7. <a href="http://docs.aws.amazon.com/AWSECommerceService/latest/DG/CartCreate.html">CartCreate</a><br>
8. <a href="http://docs.aws.amazon.com/AWSECommerceService/latest/DG/CartGet.html">CartGet</a><br>
9. <a href="http://docs.aws.amazon.com/AWSECommerceService/latest/DG/CartModify.html">CartModify</a><br>

<h2>Usage</h2>
1. Load and initialize Apai Class
```php
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use Edwinmugendi\Amazon\Apai;

$apai = new Apai();
```
2. Set the following 4 configs using the <code>$apai->setConfig()</code> function

//Set configs
$apai->setConfig('ApiKey', 'XXXXX');
$apai->setConfig('ApiSecret', 'XXXX');
$apai->setConfig('AssociativeTag', 'XXXX');
$apai->setConfig('EndPoint', 'webservices.amazon.de');

3. Set the parameters using the <code>$apai->setParam()</code> function
//Set parameters
$apai->setParam('SearchIndex', 'All');
$apai->setParam('ResponseGroup', 'Offers');
$apai->setParam('Keywords', 'hp laptop');

4. Call the actual function eg ItemSearch

$verbose = true; //Print url sent to Amazon and the results from Amazon
$response = $apai->itemSearch($verbose);

5. Handle the response. The response is an array with status and response keys. 

if ($response['status']) {
    $item_lookup_xml = new \SimpleXMLElement($response['response']);
} else {
    echo $response['response'];
}//E# if else statement

For sample code, check the <code>tests</code> folder.

