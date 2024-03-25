<?php
// 세션 시작
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
session_start();

require_once 'const.php';
$servername = NetworkInfo::$HOST;
$username = NetworkInfo::$USER;
$password = NetworkInfo::$PASSWORD;
$dbname = NetworkInfo::$DB;

// POST 데이터로부터 사용자 이름, 공연 이름, 공연 시간을 받아옵니다.
$request_body = file_get_contents('php://input');
$data = json_decode($request_body);

// 받아온 데이터에서 사용자 이름, 공연 이름, 공연 시간을 추출합니다.
$username2 = $data->username;
$BZ_NM = $data->BZ_NM;

// 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL 쿼리 생성
$sql = "DELETE FROM userFoodInfo WHERE uid = ? AND BZ_NM = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username2, $BZ_NM);

// 쿼리 실행
if ($stmt->execute() === TRUE) {
    // 성공적으로 삭제된 경우
    echo json_encode(array("success" => true, "message" => "공연 정보가 성공적으로 삭제되었습니다."));
} else {
    // 삭제 중 오류가 발생한 경우
    echo json_encode(array("success" => false, "message" => "공연 정보 삭제 중 오류가 발생했습니다."));
}

// 연결 종료
$stmt->close();
$conn->close();
?>