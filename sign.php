<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
// 데이터베이스 연결 정보
$servername = "localhost"; // MySQL 호스트 이름
$username = "yj4newproject"; // MySQL 사용자 이름
$password = "ghflqud1220!"; // MySQL 비밀번호
$dbname = "yj4newproject"; // 사용할 데이터베이스 이름

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
$conn->close();
?>
