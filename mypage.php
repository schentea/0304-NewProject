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
$username2 = isset($_GET['username']) ? $_GET['username'] : null;

// 사용자 정보를 가져오는 SQL 쿼리 작성
if ($username2) {
    $sql = "SELECT * FROM userInfo WHERE uid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username2);
    $stmt->execute();
    $result = $stmt->get_result();
    $userInfo = $result->fetch_assoc();

    // 공연 정보를 가져오는 SQL 쿼리 작성
    $sql2 = "SELECT * FROM userShowInfo WHERE uid = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param('s', $username2);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $showInfo = array();

    // 공연 정보를 배열로 저장
    while ($row = $result2->fetch_assoc()) {
        $showInfo[] = $row;
    }
    
    // 결과가 없을 경우에 대한 처리
    if (!$userInfo || !$showInfo) {
        die("사용자 정보나 공연 정보가 존재하지 않습니다.");
    }
    
    // JSON 응답
    header('Content-Type: application/json'); // JSON 응답임을 명시
    echo json_encode(array("success" => true, "userInfo" => $userInfo, "showInfo" => $showInfo));
} else {
    die("사용자 이름이 없습니다.");
}
?>
