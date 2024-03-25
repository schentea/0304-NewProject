<?php
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

// POST로부터 받은 사용자 입력값
$username2 = $_POST['username'];
$password2 = $_POST['password'];

// 데이터베이스 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 매개변수화된 SQL 쿼리 생성
$sql = "SELECT * FROM userInfo WHERE uid = ?";

// SQL 쿼리를 준비합니다.
$stmt = $conn->prepare($sql);

// 매개변수에 사용자 입력값을 바인딩합니다.
$stmt->bind_param("s", $username2);

// SQL 쿼리를 실행합니다.
$stmt->execute();

// 결과를 가져옵니다.
$result = $stmt->get_result();

// 결과 행 수를 확인하여 로그인 성공 여부를 결정합니다.
if ($result->num_rows > 0) {
    // 사용자가 존재하는 경우, 비밀번호를 확인합니다.
    $row = $result->fetch_assoc();
    // 데이터베이스에 저장된 해시된 비밀번호를 가져옵니다.
    $stored_hashed_password = $row['pw'];
    // 사용자가 제출한 비밀번호와 데이터베이스에 저장된 해시된 비밀번호를 비교합니다.
    if (password_verify($password2, $stored_hashed_password)) {
        // 세션에 사용자명 저장
        $_SESSION['username'] = $username2;
        // JSON 응답으로 반환
        echo json_encode(array('success' => true, 'message' => '로그인 성공', 'username' => $username2));
    } else {
        echo json_encode(array('success' => false, 'message' => '사용자명 또는 비밀번호가 잘못되었습니다.'));
    }
} else {
    echo json_encode(array('success' => false, 'message' => '사용자명 또는 비밀번호가 잘못되었습니다.'));
}

// 데이터베이스 연결 종료
$stmt->close();
$conn->close();
?>