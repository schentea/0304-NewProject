<?php
// 세션 시작
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
session_start();

// 데이터베이스 연결 정보
require_once 'const.php';
$servername = NetworkInfo::$HOST;
$username = NetworkInfo::$USER;
$password = NetworkInfo::$PASSWORD;
$dbname = NetworkInfo::$DB;

// POST 데이터로부터 사용자 ID와 음식 이름을 받아옵니다.
$request_body = file_get_contents('php://input');
$data = json_decode($request_body);

// 받아온 데이터에서 사용자 ID와 음식 이름을 추출합니다.
$uid = $data->uid;
$foodName = $data->foodName;

// 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL 쿼리 생성
$sql = "SELECT COUNT(*) as isLiked FROM userFoodInfo WHERE uid = ? AND BZ_NM = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $uid, $foodName);

// 쿼리 실행
$stmt->execute();
$result = $stmt->get_result();

// 결과 확인
if ($result->num_rows > 0) {
    // 결과가 있을 경우, 첫 번째 행의 isLiked 값을 반환
    $row = $result->fetch_assoc();
    $isLiked = $row["isLiked"] > 0 ? true : false;
} else {
    // 결과가 없을 경우, isLiked 값을 0으로 설정하여 반환
    $isLiked = false;
}
header('Content-Type: application/json');
echo json_encode(['isLiked' => $isLiked]);
// 연결 종료
$stmt->close();
$conn->close();
?>
