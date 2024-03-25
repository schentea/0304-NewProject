<?php
// 세션 시작
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
session_start();

// DB 연결
require_once 'const.php';
$servername = NetworkInfo::$HOST;
$username = NetworkInfo::$USER;
$password = NetworkInfo::$PASSWORD;
$dbname = NetworkInfo::$DB;

// 데이터베이스 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 사용자 이름을 받아옴
$username2 = isset($_GET['username']) ? $_GET['username'] : null;

// 사용자 정보 및 공연, 음식 정보를 가져오는 SQL 쿼리 작성
if ($username2) {
    $sql = "SELECT * FROM userInfo WHERE uid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username2);
    $stmt->execute();
    $result = $stmt->get_result();
    $userInfo = $result->fetch_assoc();

    // 사용자 정보가 있는 경우에만 추가 작업 수행
    if ($userInfo) {
        $sql = "SELECT * FROM userShowInfo WHERE uid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username2);
        $stmt->execute();
        $result = $stmt->get_result();
        $showInfo = array();

        while ($row = $result->fetch_assoc()) {
            $showInfo[] = $row;
        }

        $sql = "SELECT * FROM userFoodInfo WHERE uid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username2);
        $stmt->execute();
        $result = $stmt->get_result();
        $foodInfo = array();

        while ($row = $result->fetch_assoc()) {
            $foodInfo[] = $row;
        }
    } else {
        die("사용자 정보가 존재하지 않습니다.");
    }

    // JSON 응답
    header('Content-Type: application/json'); // JSON 응답임을 명시
    echo json_encode(array("success" => true, "userInfo" => $userInfo, "showInfo" => $showInfo, "foodInfo" => $foodInfo));
} else {
    die("사용자 이름이 없습니다.");
}
?>
