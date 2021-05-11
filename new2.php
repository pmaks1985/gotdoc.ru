<?php


$url1 = "https://service.gotdoc.ru/api/?class=Market&action=getPrivateId";
$ch = curl_init($url1);

curl_setopt($ch, CURLOPT_POST, true); //используем POST-запрос
curl_setopt($html, CURLOPT_USERAGENT, 'Opera/9.80 (Windows NT 5.1; U; ru) Presto/2.7.62 Version/11.01');
curl_setopt($html, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($html, CURLOPT_RETURNTRANSFER, true);

$text = curl_exec($ch);
var_dump($text);