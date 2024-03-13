<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
// 데이터베이스 연결 정보
$servername = "localhost"; // MySQL 호스트 이름
$username = "dongseong"; // MySQL 사용자 이름
$password = "ghflqud1220!"; // MySQL 비밀번호
$dbname = "dongseong"; // 사용할 데이터베이스 이름

// POST로부터 받은 사용자 이름
$username2 = json_decode(file_get_contents('php://input'), true)['username'];

// 데이터베이스 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 중복 사용자 이름 체크
$stmt_check = $conn->prepare("SELECT uid FROM userInfo WHERE uid = ?");
$stmt_check->bind_param("s", $username2);
$stmt_check->execute();
$stmt_check->store_result();

if ($stmt_check->num_rows > 0) {
    // 중복된 사용자 이름이 존재할 경우
    echo "이미 사용 중인 아이디입니다.";
} else {
    // 중복된 사용자 이름이 없는 경우, 회원가입 처리 진행
    echo "";
}

$stmt_check->close();
$conn->close();
?>
