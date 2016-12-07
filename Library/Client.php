<?php
@ob_start(); @session_start();
require(__DIR__."/Responder.php");
require(__DIR__."/cUrl.php");
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
 class SkytellsClient
  {
    
    private $APIKEY = ""; 
    public $ENDPOINT = "https://v.skytells.net/";
    private $Userid;
    private $Username;
    var $WebHandler;
    var $Responder;
    
     function __construct($Key)
     {
       try
        {
         
          $this->APIKEY = (!empty($Key) && isset($Key)) ? $Key : die("Skytells Client Requires API Key");
          $this->WebHandler = new WebHandler($this->APIKEY);
          $this->Responder = new Responder();
          $_authenticate = $this->authenticateApiKey();
          if ($_authenticate == false) { die("Authentication Error!"); }
          else { return true; }
         
        }
        catch (Exception $e)
         {
           return "Caught exception: ".$e->getMessage();
         }
     }
     
     function authenticateApiKey()
     {
        try
        {
            if (isset($this->APIKEY) && !empty($this->APIKEY) && $this->APIKEY !== NULL)
             {
                $Auth = (!empty($this->WebHandler->MakeRequest("/me"))) ? $this->WebHandler->MakeRequest("/me") : false;
                 if ($Auth === false) { return false; }
                 else
                 {
                     $Auth = json_decode($Auth);
                     $this->Userid = (empty($Auth->id)) ? "0" : $Auth->id;
                     $this->Username = (empty($Auth->name)) ? "0" : $Auth->name;
                     if ($this->Userid == "0" || $this->Username == "0") { return false; }
                     else { return true; }
                 }
             }else
             {
                return false;
             }
        } 
        catch (Exception $e)
         {
           return "Caught exception -> Authentication: ".$e->getMessage();
         }
     }
    
    
     /* ----- API HTTPS GET ------*
     * This is the main handler for exploring Skytells API
     * So, You can perform GET action by calling this function
     * Example : $SkytellsClient->Get("me");
     * You can set this function to return the response as an STD Class Object
     * Using the following Call : $SkytellsClient->Get("me", TRUE);
     * WARNING : This function performs HTTP GET Only, If you planning to use it
     * for POSTING an parameter to the API your api call will NOT be accepted.
     */
     function Get($Query, $StdClass_Return = false)
     {
       try
         {
           $_QUERY = (!isset($Query) || empty($Query)) ?
             $this->Responder->Push(FALSE, "Please fill out the Query field", "Get()")
              : strip_tags($Query);
           $Response = ($StdClass_Return == true) ? json_decode($this->WebHandler->MakeRequest($_QUERY))
           : $this->WebHandler->MakeRequest($_QUERY);
            
            return $Response;
         }
         catch (Exception $e)
          {
            return "Caught exception: ".$e->getMessage();
          }
     }
    
    
    
    
     /* ----- API HTTPS POST ------*
     * This is the one of main handlers for exploring Skytells API
     * So, You can perform POST action by calling this function
     * Query => The query used for API Call.
     * PostedData => The PostHeaders ( Parameters ), must be in Array.
     * Example : $SkytellsClient->Post("sms/send", array("to" => "1xxxx", "message" => "test"));
     * You can set this function to return the response as an STD Class Object
     * Using the following Call :$SkytellsClient->Post("sms/send", array("to" => "1xxxx", "message" => "test"), TRUE);
     * WARNING : All Posted Parameters must be in a PHP ARRAY.
     */
     function Post($Query, $PostData, $StdClass_Return = false)
     {
       try
         {
           $_QUERY = (!isset($Query) || empty($Query)) ?
             $this->Responder->Push(FALSE, "Please fill out the Query field", "Get()")
              : strip_tags($Query);
           $Response = ($StdClass_Return == true) ? json_decode($this->WebHandler->MakeRequest($_QUERY, $PostData))
           : $this->WebHandler->MakeRequest($_QUERY, $PostData);
            
            return $Response;
         }
         catch (Exception $e)
          {
            return "Caught exception: ".$e->getMessage();
          }
     }
    
    
    
    
     /* ----- GETTING CURRENT USER DETAILS ---- */
     function getMyDetails()
      {
            return $this->WebHandler->MakeRequest("/me");
      }
     
     
     
     /* ----- GET CURRENT USERID ------*
      * This function returns the current user id
     */
     function getUserID()
     {
      try
      {
       $__UserDetails = (!empty($this->getMyDetails()) ) ?
         json_decode($this->getMyDetails()) :
          $this->Responder->Push(false, "Cannot Get Userid", "getUserID");
  
        return $__UserDetails->id;
      } 
     catch (Exception $e)
         {
           return "Caught exception: ".$e->getMessage();
         }
    }
     
     
     /* ----- GET CURRENT USERNAME ------*
      * This function returns the current user name
     */
     function getUserName()
     {
      try
      {
       $__UserDetails = (!empty($this->getMyDetails()) ) ?
         json_decode($this->getMyDetails()) :
          $this->Responder->Push(false, "Cannot Get Username", "getUserName");
  
        return $__UserDetails->name;
      } 
     catch (Exception $e)
         {
           return "Caught exception: ".$e->getMessage();
         }
    }
     
     
     
     /* ----- GET USER's TRANSACTIONS ------ *
     * This functions returns all transaction issued by the current user
     * Includes : Sent SMS, Sent Voice Calls ...etc
     */
     function getTransactions($User = "me")
        {
            return $this->WebHandler->MakeRequest("$User/transactions", array("limit" => "50"));
        }
     
     /* ----- REGISTER SENDER ID ----- *
     * This function let you register your sender id.
     * The SenderID is the main identifier for each SMS you send
     * You must register your senderID before sending or you can use
     * The default senderID ("Skytells").
     * WARNING : By registering a sender id you may be charged for $0.50
     */
     function registerSenderID($SENDER)
     {
       try
       {
         if (empty($SENDER) || !isset($SENDER))
         {
          return $this->Responder->Push(false, "Cannot register empty SenderID", "registerSenderID()");
         }
         else
         {
          $res = $this->Post("sms/addsender", array("sender" => $SENDER));
          if (!empty($res))
           {
            return $res;
           }
           else
           {
            return $this->Responder->Push(false, "Cannot Perform this action at the moment", "registerSenderID");
           }
         }
       }
       catch(Exception $e)
        {
         return "Skytells Client Throwed an Exception : $e";
        }
     }
     
     
     
     /* ----- SEND SMS ------ *
     * This Action requires at least $1.00 Skytells Credit.
     * Please ensure that receiver's mobile phone number doesn't starts with (+) or (00)
     * As Example (+1xxxxxx) => Will NOT be accepted.
     * The Accepted mobile phone numbers is (1xxxxxx) - (1) => Means the country code
     * You may have to register your SenderID by calling registerSender("sendername");
     * By Registering a Sender ID you'll be charged for $0.10.
     * Please do not use this feature for spamming or scamming people.
     */
     function sendSMS($Numbers, $Message, $Sender = "Skytells")
     {
         if (empty($Numbers)) 
         {
             return
                $this->Responder->Push(false, "Please enter the receiver's number(s)", "SMS Sender");
         }else if (empty($Message))
         {
             return
                $this->Responder->Push(false, "Please write the message's content", "SMS Sender");
         }else if (empty($Sender))
         {
             return
                $this->Responder->Push(false, "Cannot send the SMS with empty Sender ID", "SMS Sender");
         }
         
         $RequestHeaders = array( "to" => $Numbers,
                                  "message" => $Message,
                                  "sender" => $Sender );
         $Response = $this->WebHandler->MakeRequest("sms/send", $RequestHeaders);
         return $Response;
         
     }
    
    
    
     /* ----- GET SMS DETAILS ----- *
     * This function will get a single SMS details from your account history.
     * You can perform this action by passing the SMS_ID as a parameter
     * The returned response will include all details about your SMS.
     * You may have to grant (user_sms) permission in case of receiving
     * SMS(s) which were sent from other account.
     */
     function getSMSDetails($SMSID)
        {
            return
                $this->WebHandler->MakeRequest("sms/$SMSID");
        }
        
        
     /* ----- GET ALL SENT SMSs ----- *
     * This function will return all sent SMSs from this account.
     * You may have to grant (user_sms) permission in case of receiving
     * SMS(s) which were sent from other account.
     */
     function getSMSHistory($LIMIT = 25)
        {
            return
                $this->WebHandler->MakeRequest("me/sms",array(
                 'limit' => "$LIMIT")
                );
        }
     
     
     
     
      /* ----- PHONE CALLS  ------ *
     * This Action requires at least $1.00 Skytells Credit.
     * Please ensure that receiver's mobile phone number doesn't starts with (+) or (00)
     * As Example (+1xxxxxx) => Will NOT be accepted.
     * The Accepted mobile phone numbers is (1xxxxxx) - (1) => Means the country code
     * Only messages written in English will be accepted.
     * Please ensure that your message < 250 chrs.
     * Please do not use this feature for spamming or scamming people.
     */
     function sendCall($Number, $Message)
     {
         if (empty($Number)) 
         {
             return
                $this->Responder->Push(false, "Please enter the receiver's number(s)", "Phone Calls Sender");
         }else if (empty($Message))
         {
             return
                $this->Responder->Push(false, "Please write the spoken message's content for the phone call", "Phone Calls Sender");
         }
         
         $RequestHeaders = array( "to" => $Numbers,
                                  "message" => $Message);
         $Response = $this->WebHandler->MakeRequest("ttscall/send", $RequestHeaders);
         return $Response;
         
     }
     
     
     /* ----- GET PHONE CALL DETAILS ----- *
     * This function will get a single PHONE CALL's details from your account history.
     * You can perform this action by passing the CALLID as a parameter
     * The returned response will include all details about your Phone Call.
     * You may have to grant (user_calls) permission in case of receiving
     * Call(s) which were sent from other account.
     */
     function getCallDetails($CALLID)
        {
            return
                $this->WebHandler->MakeRequest("ttscall/$CALLID");
        }
     
     
     /* ----- GET ALL SENT VOICE CALLS ----- *
     * This function will return all sent voice calls from this account.
     * You may have to grant (user_calls) permission in case of receiving
     * Calls(s) which were sent from other account.
     */
     function getCallsHistory($LIMIT = 25)
       {
            return
                $this->WebHandler->MakeRequest("me/ttscalls",array(
                 'limit' => "$LIMIT")
                );
        }
     
     
        
    }
     
  
