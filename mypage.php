<?php
// 세션 시작
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
session_start();

// DB 연결
$servername = "localhost";
$username = "dongseong";
$password = "ghflqud1220!";
$dbname = "dongseong";

// 데이터베이스 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 사용자 이름을 받아옴
$username2 = $_GET['username'];

// 사용자 정보를 가져오는 SQL 쿼리 작성
$sql = "SELECT * FROM userInfo WHERE uid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username2);
$stmt->execute();

// 결과 가져오기
$result = $stmt->get_result();
$userInfo = $result->fetch_assoc();

// 사용자 정보 출력
header('Content-Type: application/json'); // JSON 응답임을 명시
echo json_encode(array("success" => true, "userInfo" => $userInfo));
?>
