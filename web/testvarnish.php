<?php

$url = $_GET["url"];
$ret = curl_init($url);
curl_setopt($ret, CURLOPT_HTTPHEADER, array(
    'Surrogate-Capability:abc=ESI/1.0'
));
echo curl_exec($ret);

?>