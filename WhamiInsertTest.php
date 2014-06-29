<?php

function getRealIpAddr() {
  if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip=$_SERVER['HTTP_CLIENT_IP']; // share internet
  } elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip=$_SERVER['HTTP_X_FORWARDED_FOR']; // pass from proxy
  } else {
    $ip=$_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}

$ipreal = getRealIpAddr(); // Get the visitor's IP

//write the IP address to a cookie

//echo $ipreal;


setcookie("TT_API_IP_Addr", $ipreal);

?>

<!DOCTYPE html>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Flippadoo Form Tester</title>
<link href="http://208.75.75.92:8080/flippadoo/styles/style.css" rel="stylesheet" type="text/css">
<link href="http://208.75.75.92:8080/flippadoo/styles/jquery.datepick.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script src="http://208.75.75.92:8080/flippadoo/scripts/library/jquery.datepick.js"></script>
<script src="http://208.75.75.92:8080/flippadoo/scripts/tickit.js"></script>
<script type="text/javascript">
$(function() {
    $('.Datepicker').datepick();


});
function getDateTime() {
    var now     = new Date(); 
    var year    = now.getFullYear();
    var month   = now.getMonth()+1; 
    var day     = now.getDate();
    var hour    = now.getHours();
    var minute  = now.getMinutes();
    var second  = now.getSeconds(); 
    if(month.toString().length == 1) {
        var month = '0'+month;
    }
    if(day.toString().length == 1) {
        var day = '0'+day;
    }   
    if(hour.toString().length == 1) {
        var hour = '0'+hour;
    }
    if(minute.toString().length == 1) {
        var minute = '0'+minute;
    }
    if(second.toString().length == 1) {
        var second = '0'+second;
    }   
    var dateTime = year+'/'+month+'/'+day+' '+hour+':'+minute+':'+second;   
    return dateTime;
}

function creatTickitFn()
{
	var apiKey = $('#apiKey').val();
	var url = 'http://208.75.75.92:8080/flippadoo/mobile/tickitService/'+apiKey+'/createTickit';
 	$("#createTickit").attr("action",url);

	$("#createTickit").submit();
}


function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i].trim();
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
}


</script>


</head>

<body>

<div class="wrapper">
    <div style="width: 200px; height: 140px; margin: 30px auto; padding: 0 20px; background: #f1f1eb; border: 1px solid #0071BC; color: #0071BC; font-size: 15px; -moz-box-shadow:   0 0 10px 0 rgba(0,0,0,0.28); box-shadow:  0 0 10px 0 rgba(0,0,0,0.28); -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px;">
        <form name="createTickit" id ="createTickit" action="http://208.75.75.92:8080/flippadoo/mobile/tickitService/createTickit" enctype="multipart/form-data" method="post">
            <div class="header"></div>
            <h2><a href="http://208.75.75.92:8080/flippadoo/app/grid/tickitDetails">Whami from Home v1.0</a> </h2>
            <dl>
                 <dd>
                    <!-- Optional fields -->
                    <!-- input type="hidden" name="tickitCustomId" value="" -->
                    <SCRIPT type="text/javascript">
                      var MyAPI = getCookie("TT_APIKey"); 
                      document.write("<input type='hidden' name='apiKey' id='apiKey' value='" + MyAPI + "' >");                 
                      var MyAPI_IP = getCookie("TT_API_IP_Addr");
                      document.write("<input type='hidden' name='ip' value='" + MyAPI_IP + " ' >");  
                      document.write("<input type='hidden' name='msgBody' value='Local Whami time is: "+ getDateTime() +"'>")                    
                    </SCRIPT>  
                    <input type="hidden" name="ownerId" value="1">
                    <input type="hidden" name="tickitStatus" value="7">
                    <input type="hidden" name="tickitType" value="12">
                    <!-- in this case the type is child with a specific parent- just an example -->
                    <input type="hidden" name="parentId" value="123456804">
                    <input type="hidden" name="recipient" value="christopherhealy@outlook.com">
                    <input type="hidden" name="subject" value="Whami">
 		    <input type="hidden" name="startDate" value="">
                    <input type="hidden" name="endDate" value="">
                    <!-- substitute this with the actual GPS (this is Chris's home) -->
                    <!-- gps is an array that requires two values, separated by a semi-colon -->
                    <input type="hidden" name="gps" value="45.3875078;-75.7548862">
		    <input type="hidden" name="tickitFile" value="">
                </dd>               
               
            <dl>
            <div class="buttonBlock">
                <button class="submitBTN" onclick="creatTickitFn();">Whami</button>           </div>
	     
        </form>
<br>
<a href="http://TickitTaskit.com/SetAPIKey.php">Set/reset your TT API key</a>
    </div>
</div>
</body>
</html>
