<?php
// 데이터베이스 연결 설정
require_once 'const.php';
$servername = NetworkInfo::$HOST;
$username = NetworkInfo::$USER;
$password = NetworkInfo::$PASSWORD;
$dbname = NetworkInfo::$DB;

// POST 요청으로부터 받은 데이터 추출
$data = json_decode(file_get_contents("php://input"));

// 사용자명, 장소, 공연 제목, 공연 날짜 추출
$username2 = $data->username;
$venue = $data->venue;
$showName = $data->showName;
$showDate = $data->showDate;

// 데이터베이스 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 검사
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 데이터베이스에서 해당 공연 정보 삭제
$sql = "DELETE FROM userShowInfo WHERE uid=? AND showplace=? AND showname=? AND showtime=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $username2, $venue, $showName, $showDate);

if ($stmt->execute()) {
    // 삭제 성공
    $response = array("success" => true);
    echo json_encode($response);
} else {
    // 삭제 실패
    $response = array("success" => false, "error" => $conn->error);
    echo json_encode($response);
}

// 데이터베이스 연결 종료
$stmt->close();
$conn->close();
?>
