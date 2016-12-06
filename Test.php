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
require("Library/Client.php");
$Client = new SkytellsClient("{APIKEY}");
echo $Client->Get("me");
