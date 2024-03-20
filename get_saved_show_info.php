<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// 데이터베이스 연결 정보
$servername = "localhost"; // MySQL 호스트 이름
$username = "dongseong"; // MySQL 사용자 이름
$password = "ghflqud1220!"; // MySQL 비밀번호
$dbname = "dongseong"; // 사용할 데이터베이스 이름

// POST 데이터로부터 사용자명(username)과 장소(venue)를 가져옵니다.
$request_body = file_get_contents('php://input');
$data = json_decode($request_body);

$username2 = $data->username;
$venue = $data->venue;

// 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL 쿼리 생성
$sql = "SELECT COUNT(*) as liked FROM userShowInfo WHERE uid = '$username2' AND showplace = '$venue'";
$result = $conn->query($sql);

// 결과 확인
if ($result->num_rows > 0) {
    // 사용자가 해당 장소에 대해 하트를 눌렀는지 여부를 반환합니다.
    $row = $result->fetch_assoc();
    $isLiked = $row['liked'] > 0 ? true : false;
} else {
    $isLiked = false;
}

// JSON 형태로 응답합니다.
header('Content-Type: application/json');
echo json_encode(['isLiked' => $isLiked]);

// 연결 종료
$conn->close();
?>