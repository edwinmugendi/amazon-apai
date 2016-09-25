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
     * S# resetParam() function
     * 
     * @author Edwin Mugendi <edwinmugendi@gmail.com>
     * 
     * Reset parameters
     * 
     */
    public function resetParam() {
        $this->params = array();
    }

//E# resetParam() function

    /**
     * S# setConfig() function
     * 
     * @author Edwin Mugendi <edwinmugendi@gmail.com>
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
     * @author Edwin Mugendi <edwinmugendi@gmail.com>
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
     * S# cartModify() function
     * 
     * @author Edwin Mugendi <edwinmugendi@gmail.com>
     * 
     * Cart Modify
     * 
     * @param boolean $verbose Verbose ie print link
     * 
     */
    public function cartModify($verbose = false) {

        $this->setParam('Operation', 'CartModify');

        return $this->makeApiCall($verbose);
    }

//E# cartModify() function

    /**
     * S# cartGet() function
     * 
     * @author Edwin Mugendi <edwinmugendi@gmail.com>
     * 
     * Cart Get
     * 
     * @param boolean $verbose Verbose ie print link
     * 
     */
    public function cartGet($verbose = false) {

        $this->setParam('Operation', 'CartGet');

        return $this->makeApiCall($verbose);
    }

//E# cartGet() function

    /**
     * S# cartCreate() function
     * 
     * @author Edwin Mugendi <edwinmugendi@gmail.com>
     * 
     * Cart Create
     * 
     * @param boolean $verbose Verbose ie print link
     * 
     */
    public function cartCreate($verbose = false) {

        $this->setParam('Operation', 'CartCreate');

        return $this->makeApiCall($verbose);
    }

//E# cartCreate() function

    /**
     * S# cartClear() function
     * 
     * @author Edwin Mugendi <edwinmugendi@gmail.com>
     * 
     * Cart Clear
     * 
     * @param boolean $verbose Verbose ie print link
     * 
     */
    public function cartClear($verbose = false) {

        $this->setParam('Operation', 'CartClear');

        return $this->makeApiCall($verbose);
    }

//E# cartClear() function

    /**
     * S# cartAdd() function
     * 
     * @author Edwin Mugendi <edwinmugendi@gmail.com>
     * 
     * Cart Add
     * 
     * @param boolean $verbose Verbose ie print link
     * 
     */
    public function cartAdd($verbose = false) {

        $this->setParam('Operation', 'CartAdd');

        return $this->makeApiCall($verbose);
    }

//E# cartAdd() function

    /**
     * S# similarityLookup() function
     * 
     * @author Edwin Mugendi <edwinmugendi@gmail.com>
     * 
     * Similarity lookup
     * 
     * @param boolean $verbose Verbose ie print link
     * 
     */
    public function similarityLookup($verbose = false) {

        $this->setParam('Operation', 'SimilarityLookup');

        return $this->makeApiCall($verbose);
    }

//E# similarityLookup() function

    /**
     * S# browseNodeLookup() function
     * 
     * @author Edwin Mugendi <edwinmugendi@gmail.com>
     * 
     * Browse node lookup
     * 
     * @param boolean $verbose Verbose ie print link
     * 
     */
    public function browseNodeLookup($verbose = false) {

        $this->setParam('Operation', 'BrowseNodeLookup');

        return $this->makeApiCall($verbose);
    }

//E# browseNodeLookup() function

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
     * @param boolean $verbose Verbose ie print link and response
     * 
     */
    public function itemSearch($verbose = false) {

        $this->setParam('Operation', 'ItemSearch');

        return $this->makeApiCall($verbose);
    }

//E# itemSearch() function

    /**
     * S# makeApiCall() function
     *
     * @author Edwin Mugendi <edwinmugendi@gmail.com>
     *  
     * Make Api Call
     * 
     * @param boolean $verbose Verbose ie print link and response
     *
     */
    private function makeApiCall($verbose = false) {
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

        try {
            $status = 1;
            $response = curl_exec($curl);
        } catch (Exception $ex) {
            $status = 0;
            $response = $ex->getMessage();
        }

        if ($verbose) {
            var_dump($response);
        }//E# if statement

        curl_close($curl);

        return array(
            'status' => $status,
            'response' => $response
        );
    }

//E# makeApiCall() function
}

//E# Apai() function