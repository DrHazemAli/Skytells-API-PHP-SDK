<?php
/**
 * Skytells API Client v1.0
 * Copyrights 2007 - 2017 Skytells, Inc, All Rights Reserved.
 * https://developers.skytells.net
 * Date: 01/12/2016
 * Time: 5:00 AM
 * License : GNU GENERAL PUBLIC LICENSE
 */
 class Responder
 {
     function Push($Status, $Message, $Handler)
        {
            $Res["status"] = $Status;
            $Res["message"] = $Message;
            $Res["handler"] = $Handler;
            return json_encode($Res);
        }
 }