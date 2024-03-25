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

// POST로부터 받은 사용자 입력값
$username2 = $_POST['username'];
$password2 = $_POST['password'];
$name = $_POST['name'];
$email = $_POST['email'];
$tel = $_POST['tel'];

$hashed_pw = password_hash($password2, PASSWORD_DEFAULT);

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
    $stmt_check->close();
} else {
    // 중복된 사용자 이름이 없는 경우, 회원가입 처리 진행
    $stmt_check->close();

    // 매개변수화된 SQL 쿼리 생성
    $sql = "INSERT INTO userInfo (uid, pw, name, email, tel) VALUES (?, ?, ?, ?, ?)";

    // SQL 쿼리를 준비합니다.
    $stmt = $conn->prepare($sql);

    // 매개변수에 사용자 입력값을 바인딩합니다.
    $stmt->bind_param("sssss", $username2, $hashed_pw, $name, $email, $tel);

    // SQL 쿼리를 실행합니다.
    if ($stmt->execute()) {
        echo "회원가입이 완료되었습니다.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // 데이터베이스 연결 종료
    $stmt->close();
}

$conn->close();
?>
