<?php 
require 'config/database.php';

function fatchDataFormSheet(){
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://sheets.googleapis.com/v4/spreadsheets/1yrpztbAxPy9nNYn0gLaSlFXuGEbJ0lmMVyDUe1xpcXw/values/google?key=AIzaSyA-AggMMOtHNqI67OjgStQLhS44DYd7o98',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response, true);
}

$data = fatchDataFormSheet();
echo "<pre>";
print_r($data);

if(isset($data['values']) && isset($data['values']) > 0){

}

