# Skytells API PHP SDK & Explorer
by Skytells, Inc.

**What is Skytells PM?**

_Skytells API is the primary way for developers to read and write to the Skytells.
You can Send SMS and Outbound Voice Calls or even WhatsApp messages using Skytells API.
The Skytells API has multiple versions available, read about what has changed and how to upgrade from older versions._

**Requirements**
- Apache / Web Server
- PHP = > 5.2.0
- API Key ( You can register a free account by visiting : https://www.skytells.net/signup )
- Skytells Credit ( For Paid Services )
- See ( Reference ) Down Below

**How to get started?**
1. Clone the SDK

2. Include the main class file on your script by calling :

```php
require("Library/Client.php");
```

3. Start Making Api Calls

### Reference
Please refere to Skytells Developer Console to learn how to use Skytells API by visiting these links below.
- [Create an Skytells Account](https://www.skytells.net/signup)
- [Skytells Developer Console](https://developers.skytells.net)





### How to Explore The Api Endpoints ?
You can do it by two different methods.
**GET**
> This is the main handler for exploring Skytells API
   So, You can perform GET action by calling this function
   Example : 
   ```php
   $SkytellsClient->Get("me");
   ```
   You can set this function to return the response as an STD Class Object
   Using the following Call : 
   ```php
   $SkytellsClient->Get("me", TRUE);
   ```
   WARNING : This function performs HTTP GET Only, If you planning to use it
   for POSTING an parameter to the API your api call will NOT be accepted.

**POST**
> This is the one of main handlers for exploring Skytells API
  So, You can perform POST action by calling this function
  Query => The query used for API Call.
  PostedData => The PostHeaders ( Parameters ), must be in Array.
  Example : 
   ```php
  echo $SkytellsClient->Post("sms/send", array("to" => "1xxxx", "message" => "test"));
   ```
  You can set this function to return the response as an STD Class Object
  Using the following Call :
   ```php
  echo $SkytellsClient->Post("sms/send", array("to" => "1xxxx", "message" => "test"), TRUE);
   ```
  WARNING : All Posted Parameters must be in a PHP ARRAY.





### Make Your First Call
After including the Client Class File into your script, You can perform your first API Call by calling this method

```php
require("Library/Client.php");

$Client = new SkytellsClient("APIKEY");

echo $Client->Get("me");
```

By calling this method, The API sends your account details into your script as JSON Object.


## SMS API

### Sending SMS
If you have enough credit to cover the SMS, You can send it right away by calling this function.

```php
require("Library/Client.php");

$Client = new SkytellsClient("APIKEY");

echo $Client->sendSMS("1XXXXXXNNNNNX", "SMS Message", "SenderName");
```

_* Please note : Numbers with (+) or (00) will not be accepted._



### Receiving SMS Details
You can perform GET on every outgoing/sent SMS on your account by calling this method.

```php
require("Library/Client.php");
$Client = new SkytellsClient("APIKEY");
echo $Client->getSMSDetails("SMSID");
```


### Receiving List of Sent SMS(s)
You can perform GET on every outgoing/sent SMS on your account by calling this method.

```php
require("Library/Client.php");
$Client = new SkytellsClient("APIKEY");
echo $Client->getSMSHistory("SMSID");
```



## Voice Calls API

### Sending a Wirtten Voice Call
If you have enough credit to cover the Mobile Call, You can send it right away by calling this function.

```php
require("Library/Client.php");

$Client = new SkytellsClient("APIKEY");

echo $Client->sendCall("1XXXXXXNNNNNX", "Call Content (Spoken Message)");
```

_* Please note : Numbers with (+) or (00) will not be accepted._



### Receiving Phone Call Details
You can perform GET on every outgoing/sent Call on your account by calling this method.

```php
require("Library/Client.php");
$Client = new SkytellsClient("APIKEY");
echo $Client->getCallDetails("SMSID");
```



### Receiving List of Sent SMS(s)
You can perform GET on every outgoing/sent call on your account by calling this method.

```php
require("Library/Client.php");
$Client = new SkytellsClient("APIKEY");
echo $Client->getCallsHistory("SMSID");
```





