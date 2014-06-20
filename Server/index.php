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
ul{
    list-style: none; 
}
</style>
</head>
<body onload="update();">
   <center>
    <h1 id="uptime"></h1>
    <h2 id="message"></h2>
    <p style="margin-top: 10%">Schlafstatistik seit <script>document.write(new Date(1403173800*1000))</script>:<ul>
        <li>Fri: 4:40h</li>
        <li></li>
        <li></li>
        <hr/>
        <li>Gesamt: 4:40h seit Anfang der Statistik.</li>
    </ul></p>
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
            
            nowUptime = new Date(Date.now() - Math.round(new Date( uptime ).getTime()) * 1000 )
           var timestring = nulliere(nowUptime.getDate()-1)+":"+nulliere(nowUptime.getHours())+":"+nulliere(nowUptime.getMinutes())+":"+nulliere(nowUptime.getSeconds())
           document.getElementById("uptime").innerHTML = timestring
           $('#message').load('message.txt')
       }, 1000);
   }
   </script>
</body>
</html>