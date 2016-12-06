<?php
/**
 * Skytells API Client --------------------------------------*
 * Version : 1.0.01
 * Copyrights 2007 - 2017 Skytells, Inc, All Rights Reserved.
 * API Reference : https://developers.skytells.net
 * Website : https://www.skytells.net 
 * Updated DateTime: 01/12/2016 5:00 AM
 * License : GNU GENERAL PUBLIC LICENSE
 * ----------------------------------------------------------*
 * PLEASE READ THE API REFERENCE BEFORE MAKING API CALLS
 * ----------------------------------------------------------*
 */
class WebHandler
    {
    private $APIKEY = ""; 
    public $ENDPOINT = "https://v.skytells.net/";
   
    function __construct($Key)
     {
       try
        {
         
          $this->APIKEY = (!empty($Key)) ? $Key : "NULL";
         
          return true;
         
        }
        catch (Exception $e)
         {
           return "Caught exception: ".$e->getMessage();
         }
     }
     
        
     function MakeRequest($Query, $Params = "")
     {
         
        $curl = curl_init();
      
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => "https://v.skytells.net/".$Query."?key=$this->APIKEY",
            CURLOPT_USERAGENT => 'SkytellsClint',
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $Params
        ));
        
        $resp = curl_exec($curl);
       
        curl_close($curl);
        return $resp;
     }
     
    }