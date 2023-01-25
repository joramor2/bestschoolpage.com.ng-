<?php
echo $url = 'http://182.70.254.8:4000/SENDVOICEAPI?fileurl=http://nagendramishra.com/voicecallnew/uploads/e400b5461f75735d4f670cdf5fd50525_8520190107113312.wav&numbers=9893304801&apikey=78d289d3-ff36-416a-a135-70606d51c8b6&username=user&service=VOICEJAR&callerid=9999999999&msgid=atest1';
echo '<br>';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url); //Url together with parameters
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Return data instead printing directly in Browser
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , 7); //Timeout after 7 seconds
curl_setopt($ch, CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
curl_setopt($ch, CURLOPT_HEADER, 0);
$result = curl_exec($ch);
curl_close($ch);
if(curl_errno($ch))  
echo 'Curl error: ' . curl_error($ch);
else
echo $result;