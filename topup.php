<?php

// Sensitif
$username = "cazekoD7ELKg";
$apikey = "a3bd1141-63f8-5885-9d9a-c52bbcf2c97b";

// Hash ID
$timestamp = time();
$randNum = rand(1, 1000);
$seed = $timestamp * $randNum;
$encryptData = hash('sha256', $timestamp . $seed);
$hash = strtoupper($encryptData);

// variable
$buyer_sku_code = "DANA5";
$customer_no = "0895359738286";
$ref_id = $hash;
$sign = md5($username . $apikey . $ref_id);
 
// Data permintaan API
$data = array(
    'ref_id' => $ref_id,
    'username' => $username,
    'buyer_sku_code' => $buyer_sku_code,
    'customer_no' => $customer_no,
    'sign' => $sign,
);
 
// Mengirim permintaan ke API
$ch = curl_init();
 
curl_setopt($ch, CURLOPT_URL, 'https://api.digiflazz.com/v1/transaction');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
 
$response = curl_exec($ch);
 
curl_close($ch);
 
echo $response;
