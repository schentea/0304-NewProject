<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// 데이터베이스 연결 정보
$servername = "localhost"; // MySQL 호스트 이름
$username = "dongseong"; // MySQL 사용자 이름
$password = "ghflqud1220!"; // MySQL 비밀번호
$dbname = "dongseong"; // 사용할 데이터베이스 이름

//클라이언트에서 전송한 정보
$data = json_decode(file_get_contents("php://input"), true);

// 받은 데이터에서 필요한 값 추출
$venue = $data['venue'];
$showName = $data['showName'];
$showDate = $data['showDate'];
$username2 = $data['username'];
$isLiked = $data['isLiked'];
// 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
$sql = "INSERT INTO userShowInfo (uid, showplace, showname, showtime, isLiked) VALUES (?, ?, ?, ?, ?)";

// SQL 쿼리를 실행하기 위한 준비
$stmt = $conn->prepare($sql);

// 바인딩 매개변수 설정
$stmt->bind_param("sssss", $username2, $venue, $showName, $showDate, $isLiked);

// 쿼리 실행
if ($stmt->execute()) {
    echo json_encode(array("success" => true));
} else {
    echo json_encode(array("success" => false, "error" => $conn->error));
}

// 데이터베이스 연결 종료
$stmt->close();
$conn->close();
?>