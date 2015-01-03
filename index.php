<?php

// include excoin class
include_once ('excoin.php');

// url
$url = 'https://api.exco.in/v1/account/summary';

// keys
$apikey = 'API_KEY';
$apisecret = 'API_SECRET';
        
// create class
$excoin = new Excoin($url, $apikey, $apisecret);

// get JSON objects
$nonce = $excoin->getNonceResult();
$timestamp = $excoin->getTimestampResult();

// print nonce result
echo '<h1>Excoin API nonce request result:</h1>';
echo '<pre>';
print_r($nonce);
echo '</pre>';

echo '<br/><br/>';

// print timestamp result
echo '<h1>Excoin API timestamp request result:</h1>';
echo '<pre>';
print_r($nonce);
echo '</pre>';

?>
