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

// 클라이언트에서 전송한 JSON 데이터 받아오기
$data = json_decode(file_get_contents("php://input"), true);

// 수정할 비밀번호와 확인용 비밀번호 가져오기
$username2 = $data['username'];
$password2 = $data['password'];
$confirmPassword = $data['confirmPassword'];

// 비밀번호와 확인용 비밀번호가 일치하는지 확인
if ($password2 !== $confirmPassword) {
    // 일치하지 않으면 오류 메시지 반환
    $response = array("success" => false, "message" => "비밀번호가 일치하지 않습니다.");
    echo json_encode($response);
    exit;
}

// 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 수정할 비밀번호를 해싱하여 저장
$hashedPassword = password_hash($password2, PASSWORD_DEFAULT);

// 사용자의 비밀번호를 수정하는 SQL 쿼리
$query = "UPDATE userInfo SET pw = ? WHERE uid = ?";

// 쿼리를 준비
if ($stmt = $conn->prepare($query)) {
    // 바인딩
    $stmt->bind_param("ss", $hashedPassword, $username2); // "s"는 string 타입을 의미
    // 실행
    if ($stmt->execute()) {
        // 성공적으로 수정됨을 응답으로 반환
        $response = array("success" => true, "message" => "비밀번호가 성공적으로 수정되었습니다.");
        echo json_encode($response);
    } else {
        // 수정 실패 시 메시지를 응답으로 반환
        $response = array("success" => false, "message" => "비밀번호 수정 실패");
        echo json_encode($response);
    }

    // 문 닫기
    $stmt->close();
} else {
    // 쿼리 준비 실패 시 메시지를 응답으로 반환
    $response = array("success" => false, "message" => "비밀번호 수정 쿼리 준비 실패");
    echo json_encode($response);
}

// 연결 종료
$conn->close();
?>
