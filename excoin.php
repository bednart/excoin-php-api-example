<?php

class Excoin {  
    
    private $url;
    private $apiKey;
    private $apiSecret;    
    
    public function __construct($url, $apiKey, $apiSecret)
    { 
        $this->url = $url;
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
    }
    
    /**
     * Call Excoin API using nonce.
     **/
    public function getNonceResult()
    {  
        // build message
        $nonce = time();
        $message = $nonce . $this->url;
        
        // sign message
        $sign = hash_hmac('sha256', $message, $this->apiSecret);
        
        // open session
        $session = curl_init($this->url);
        
        // set options
        curl_setopt($session, CURLOPT_HTTPHEADER, array('Api-Key: ' . $this->apiKey, 'Api-Signature: ' . $sign, 'Api-Nonce: ' . $nonce));
        curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($session, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);        
        
        // get result
        $result = curl_exec($session);
        
        // close session
        curl_close($session);
        
        // return result as JSON object
        return json_decode($result, true);        
    }
    
    /**
     * Call Excoin API using timestamp.
     */
    public function getTimestampResult()
    {        
        // build url - request will be valid for next 15 minutes (900 seconds)
        $expire = time() + 900;
        $url = $this->url . '?expire=' . $expire;
        
        // sign url
        $sign = hash_hmac('sha256', $url, $this->apiSecret);
        
        // open session
        $session = curl_init($url);
        
        // set options
        curl_setopt($session, CURLOPT_HTTPHEADER, array('Api-Key: ' . $this->apiKey, 'Api-Signature: ' . $sign));
        curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($session, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);        
        
        // get result
        $result = curl_exec($session);
        
        // close session
        curl_close($session);
        
        // return result as JSON object
        return json_decode($result, true); 	
    }    
}

?>
