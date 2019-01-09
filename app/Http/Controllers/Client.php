<?php

namespace App\Http\Controllers;

class Client
{
    protected $url = null;
    
    public function __construct($url) {
        $this->url = $url;
    }
    
    public function execute($data)
    {
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_URL, $this->url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        
        $response = curl_exec($curl);
        
        curl_close($curl);      
        
        return $response;
    }
}
        