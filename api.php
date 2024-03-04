<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$url1 = "https://www.daegufood.go.kr/kor/api/tasty.html?mode=json&addr=%EC%A4%91%EA%B5%AC";
$url2 = "https://dgfca.or.kr/ajax/event/list.json?event_gubun=DP&start_date=2023-03";

$data1 = file_get_contents($url1);
$data2 = file_get_contents($url2);

$result = array(
    'restaurantData' => json_decode($data1),
    'eventData' => json_decode($data2)
);

echo json_encode($result);
?>