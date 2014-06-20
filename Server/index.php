<?php
$uptime = file_get_contents("uptime.txt");
?>
<!Doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Uptime</title>
<style>
body{
    font-family: 'Courier New', sans-serif;
}
</style>
</head>
<body onload="update();">
   <center>
    <h1 id="uptime"></h1>
    <h2 id="message"></h2>
   </center>
   <script src="jquery.min.js"></script>
   <script>
   function nulliere(intTime){
       if(intTime < 10){
           intTime = "0"+intTime+""
       }
       return intTime
   }
   
   function update(){
       setInterval(function(){
            var uptime = <?=$uptime?>
            ,   wokeUp
            ,   nowUptime
            
            nowUptime = new Date(Date.now() - uptime*1000)
           var timestring = nulliere(nowUptime.getHours())+":"+nulliere(nowUptime.getMinutes())+":"+nulliere(nowUptime.getSeconds())
           document.getElementById("uptime").innerHTML = timestring
           $('#message').load('message.txt')
       }, 1000);
   }
   </script>
</body>
</html>