<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$url1 = "https://www.daegufood.go.kr/kor/api/tasty.html?mode=json&addr=%EC%A4%91%EA%B5%AC";
$url2 = "https://dgfca.or.kr/ajax/event/list.json?event_gubun=DP&start_date=2023-03";

$curl1 = curl_init();
curl_setopt($curl1, CURLOPT_URL, $url1);
curl_setopt($curl1, CURLOPT_RETURNTRANSFER, true);
$data1 = curl_exec($curl1);
curl_close($curl1);

$curl2 = curl_init();
curl_setopt($curl2, CURLOPT_URL, $url2);
curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
$data2 = curl_exec($curl2);
curl_close($curl2);

$decodedData1 = json_decode($data1);
$decodedData2 = json_decode($data2);

$result = array(
    'restaurantData' => $decodedData1,
    'eventData' => $decodedData2
);

echo json_encode($result);
?>
