<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
session_start();

$servername = "localhost";
$username = "dongseong";
$password = "ghflqud1220!";
$dbname = "dongseong";

$request_body = file_get_contents('php://input');
$data = json_decode($request_body);

$uid = $data->uid;
$BZ_NM = $data->BZ_NM;

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM userFoodInfo WHERE uid = ? AND BZ_NM = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $uid, $BZ_NM);

if ($stmt->execute()) {
    echo json_encode(array("success" => true, "message" => "음식 정보가 성공적으로 삭제되었습니다."));
} else {
    echo json_encode(array("success" => false, "message" => "음식 정보 삭제에 실패했습니다."));
}

$stmt->close();
$conn->close();
?>