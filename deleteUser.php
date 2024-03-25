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
$userId = $_POST['userId'];
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "DELETE FROM userInfo WHERE id = ?";
if ($stmt = $conn->prepare($query)) {
    // 바인딩
    $stmt->bind_param("i", $userId); // "i"는 integer 타입을 의미합니다.
    // 실행
    if ($stmt->execute()) {
        // 성공적으로 삭제됨을 응답으로 반환
        $response = array("success" => true);
        echo json_encode($response);
    } else {
        // 삭제 실패 시 메시지를 응답으로 반환
        $response = array("success" => false, "message" => "사용자 정보 삭제 실패");
        echo json_encode($response);
    }

    // 문 닫기
    $stmt->close();
} else {
    // 쿼리 준비 실패 시 메시지를 응답으로 반환
    $response = array("success" => false, "message" => "삭제 쿼리 준비 실패");
    echo json_encode($response);
}

// 연결 종료
$conn->close();
?>