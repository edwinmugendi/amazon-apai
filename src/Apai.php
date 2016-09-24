<?php

namespace Edwinmugendi\Amazon;

/**
 * S# Apai() function
 * 
 * Amazon Product Advertising API
 * 
 * @author Edwin Mugendi <edwinmugendi@gmail.com>
 * 
 */
class Apai {

    private $params = array();
    private $configs = array();

    /**
     * S# setConfig() function
     * 
     * Set a configuration
     * 
     * @param str $name Name
     * @param str $value Value
     */
    public function setConfig($name, $value) {
        $this->configs[$name] = $value;
    }

//E# setConfig() function

    /**
     * S# setParam() function
     * 
     * Set param
     * 
     * @param str $name Name
     * @param str $value Value
     */
    public function setParam($name, $value) {
        $this->params[$name] = $value;
    }

//E# setParam() function

    /**
     * S# itemLookup() function
     * 
     * @author Edwin Mugendi <edwinmugendi@gmail.com>
     * 
     * Item Lookup
     * 
     * @param boolean $verbose Verbose ie print link
     * 
     */
    public function itemLookup($verbose = false) {

        $this->setParam('Operation', 'ItemLookup');

        return $this->makeApiCall($verbose);
    }

//E# itemLookup() function

    /**
     * S# itemSearch() function
     * 
     * @author Edwin Mugendi <edwinmugendi@gmail.com>
     * 
     * Item Search
     * 
     * @param boolean $verbose Verbose ie print link
     * 
     */
    public function itemSearch($verbose = false) {

        $this->setParam('Operation', 'ItemSearch');

        return $this->makeApiCall($verbose);
    }

//E# itemSearch() function


    private function makeApiCall($verbose) {
        $this->setParam('Service', 'AWSECommerceService');
        $this->setParam('AWSAccessKeyId', $this->configs['ApiKey']);
        $this->setParam('AssociateTag', $this->configs['AssociativeTag']);
        //uri
        $uri = "/onca/xml";

        // Set current timestamp if not set
        if (!isset($this->params["Timestamp"])) {
            $this->params["Timestamp"] = gmdate('Y-m-d\TH:i:s\Z');
        }//E# if statement
        // Sort the parameters by key
        ksort($this->params);

        $pairs = array();

        foreach ($this->params as $key => $value) {
            array_push($pairs, rawurlencode($key) . "=" . rawurlencode($value));
        }//E# foreach statement
        // Generate the canonical query
        $canonical_query_string = join("&", $pairs);

        // Generate the string to be signed
        $string_to_sign = "GET\n" . $this->configs['EndPoint'] . "\n" . $uri . "\n" . $canonical_query_string;

        // Generate the signature required by the Product Advertising API
        $signature = base64_encode(hash_hmac("sha256", $string_to_sign, $this->configs['ApiSecret'], true));

        // Generate the signed URL
        $request_url = 'http://' . $this->configs['EndPoint'] . $uri . '?' . $canonical_query_string . '&Signature=' . rawurlencode($signature);

        // Get cURL resource
        $curl = \curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $request_url,
        ));

        if ($verbose) {
            echo '<p>' . $request_url . '</p>';
        }

        $response = curl_exec($curl);

        if ($verbose) {
            var_dump($response);
        }//E# if statement
        
        curl_close($curl);

        return $response;
    }

}

//E# Apai() function