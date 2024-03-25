<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// 데이터베이스 연결 정보
require_once 'const.php';
$servername = NetworkInfo::$HOST;
$username = NetworkInfo::$USER;
$password = NetworkInfo::$PASSWORD;
$dbname = NetworkInfo::$DB;

// POST 데이터로부터 사용자명(username), 장소(venue), 공연 이름(showName), 공연 날짜(showDate)를 가져옵니다.
$request_body = file_get_contents('php://input');
$data = json_decode($request_body);

$username2 = $data->username;
$venue = $data->venue;
$showName = $data->showName; // 수정된 부분: 공연 이름을 추가합니다.
$showDate = $data->showDate; // 수정된 부분: 공연 날짜를 추가합니다.

// 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL 쿼리 생성
$sql = "SELECT COUNT(*) as liked FROM userShowInfo WHERE uid=? AND showplace=? AND showname=? AND showtime=?"; // 수정된 부분: 공연 이름과 공연 날짜를 조건에 추가합니다.
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $username2, $venue, $showName, $showDate); // 수정된 부분: 매개변수 개수를 4개로 변경합니다.

// 쿼리 실행
$stmt->execute();

// 결과 가져오기
$result = $stmt->get_result();

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