<!DOCTYPE html>
<html>
    <body>
<?php
function getIpAddress()
{
    $ipAddress = '';
    if (! empty($_SERVER['HTTP_CLIENT_IP'])) {
        // to get shared ISP IP address
        $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
    } else if (! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // check for IPs passing through proxy servers
        // check if multiple IP addresses are set and take the first one
        $ipAddressList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        foreach ($ipAddressList as $ip) {
            if (! empty($ip)) {
                // if you prefer, you can check for valid IP address here
                $ipAddress = $ip;
                break;
            }
        }
    } else if (! empty($_SERVER['HTTP_X_FORWARDED'])) {
        $ipAddress = $_SERVER['HTTP_X_FORWARDED'];
    } else if (! empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
        $ipAddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    } else if (! empty($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ipAddress = $_SERVER['HTTP_FORWARDED_FOR'];
    } else if (! empty($_SERVER['HTTP_FORWARDED'])) {
        $ipAddress = $_SERVER['HTTP_FORWARDED'];
    } else if (! empty($_SERVER['REMOTE_ADDR'])) {
        $ipAddress = $_SERVER['REMOTE_ADDR'];
    }
    return $ipAddress;
}
$ip = getIpAddress();

//call api
$url = file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip); 
//decode json data
$getInfo = json_decode($url);

echo "<p><b>";
echo $getInfo->geoplugin_request . "</b></p>";
echo "<p><b>";
echo $getInfo->geoplugin_city . ", " . $getInfo->geoplugin_countryName . "</b></p>";
 
echo "<table border='1' width='40%' align='left'><tr><td>IP ADDRESS:</td><td>";
echo $getInfo->geoplugin_request;
echo "</td></tr><tr><td>COUNTRY:</td><td>";
echo $getInfo->geoplugin_countryName;
echo "</td></tr><tr><td>COUNTRY CODE:</td><td>";
echo $getInfo->geoplugin_countryCode;
echo "</td></tr><tr><td>CITY:</td><td>";
echo $getInfo->geoplugin_city;
echo "</td></tr><tr><td>STATE OR REGION:</td><td>";
echo $getInfo->geoplugin_region;
echo "</td></tr><tr><td>REGION CODE:</td><td>";
echo $getInfo->geoplugin_regionCode;
echo "</td></tr><tr><td>CURRENCY CODE:</td><td>";
echo $getInfo->geoplugin_currencyCode;
echo "</td></tr><tr><td>CONTINENT NAME:</td><td>";
echo $getInfo->geoplugin_continentName;
echo "</td></tr><tr><td>CONTINENT CODE:</td><td>";
echo $getInfo->geoplugin_continentCode;
echo "</td></tr><tr><td>LATITUTE:</td><td>";
echo $getInfo->geoplugin_latitude;
echo "</td></tr><tr><td>LONGITUDE:</td><td>";
echo $getInfo->geoplugin_longitude;
echo "</td></tr><tr><td>TIMEZONE:</td><td>";
echo $getInfo->geoplugin_timezone;
echo "</td></tr><tr></table>";     
?>
    </body>
</html>
