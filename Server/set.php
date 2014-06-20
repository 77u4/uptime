<?php
//SET Uptime Password
define(SETTING_PASS, "PASSWORD");

if(($_GET['auth'] == SETTING_PASS)){
    $uptimeFile = 'uptime.txt';
    $messageFile = 'message.txt';
    
    if(isset($_GET['time'])){
        if($_GET['time'] == "now"){
            $timestamp = time();
        }else{
            $timestamp = htmlentities($_GET['time']);
        }
        
        file_put_contents($uptimeFile, $timestamp);
    }
    
    if(isset($_GET['msg'])){
        $message = $_GET['msg']; //Lieber htmlentities but no.
        file_put_contents($messageFile, $message);
    }

}

header('Location: http://uptime.jh0.eu');