# Skytells API PHP SDK & Explorer
by Skytells, Inc.

**What is Skytells API?**

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
- [SMS API](https://developers.skytells.net/sms-api-overview/?node=sms-api-overview)
- [Voice Calls API](https://developers.skytells.net/index.php?node=send-tts-call)




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




## Using Skytells API
Here's what you can do step by step..

### Make Your First Call
After including the Client Class File into your script, You can perform your first API Call by calling this method

```php
require("Library/Client.php");

$Client = new SkytellsClient("APIKEY");

echo $Client->Get("me");
```

By calling this method, The API sends your account details into your script as JSON Object.

Or simply you can authenticate your account/user using this method after passing the API key

```php
require("Library/Client.php");

$Client = new SkytellsClient("APIKEY");

echo $Client->getMyDetails();
```

By calling this method, The server will return the account's basic information such as
- ID
- Name
- E-Mail
- Mobile
- List of Transactions
- List of Sent SMS(s)
- List of Sent Voice Calls
- List of [Skytells PM](https://www.skytells.net/features) Licenses



Alright, Looks good?
Let's move on and send an SMS...

## SMS API

The Skytells SMS API one of the bestest backend SMS platforms, Which you can send an international mobile SMS with low rates. 

**Edges**
- Registering SenderID
- Send SMS
- Get an sent SMS Details
- Get All Sent SMS(s)


### Registering SenderID
The SenderID is the main identifier for each SMS you send
You must register your senderID before sending or you can use
By default the senderID ("Skytells") will be registered.

In order to register a new SenderID, Please perform this call.

```php
require("Library/Client.php");

$Client = new SkytellsClient("APIKEY");

echo $Client->registerSenderID("{YOURSENDERID}";
```

After then, Your SenderID ("Sender Name") will be registered on Skytells SMS API.
Now Everything is made up!, Let's Send our first SMS.

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
echo $Client->getSMSHistory();
```



## Voice Calls API

The Skytells Pre-Spoken Calls API one of the bestest backend TTS-Messages platforms, Which you can send an international mobile voice calls with low rates. 

**Edges**
- Sending TTS Calls
- Get an outgoing Call
- Get All Sent SMS(s)
- 
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
echo $Client->getCallDetails("CALLID");
```



### Receiving List of Sent Voice Call(s)
You can perform GET on every outgoing/sent call on your account by calling this method.

```php
require("Library/Client.php");
$Client = new SkytellsClient("APIKEY");
echo $Client->getCallsHistory();
```





## Account Management
You can manage/view your Skytells account using the following endpoints

### Profile Endpoints
- me
- me/sms
- me/transactions
- me/ttscalls
- me/licenses



#### Managing Profile using the API
You can perform fetch request on your profile normally by calling

```php
echo $Client->Get("me");
```

To Get Your UserID

```php
echo $Client->getUserID();
```


To Get Your UserName

```php
echo $Client->getUserName();
```



You can fetch all sent messages by calling this method
* Please note : You can perform this action on other profile if you have granted permission : ( user_sms )
* Normally, You can only perform this call on your profile.

```php
echo $Client->getSMSHistory();
```


You can fetch all created transactions by calling this method
* Please note : You can perform this action on other profile if you have granted permission : ( user_transactions )
* Normally, You can only perform this call on your profile.

```php
echo $Client->getTransactions("me");
```


In order to get the list of sent voice call, Please call this method
```php
echo $Client->getCallsHistory("me");
```


To get all Skytells PM licenses you own, Please perform this call

```php
echo $Client->Get("me/licenses");
```
