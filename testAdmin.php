<?php
// 데이터베이스 연결 정보
$servername = "localhost";
$username = "yj4newproject";
$password = "ghflqud1220!";
$dbname = "yj4newproject";

// 암호화된 비밀번호 생성
$hashed_password = password_hash("admin_password", PASSWORD_DEFAULT);

// 관리자 정보
$uid = "schentea";
$name = "admin";
$email = "schentea@gmail.com";
$tel = "01063702448";
$level = 2;

// 데이터베이스 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// MySQL 쿼리를 사용하여 관리자 정보 추가
$sql = "INSERT INTO userInfo (uid, pw, name, email, tel, level) 
        VALUES ('$uid', '$hashed_password', '$name', '$email', '$tel', $level)";

if ($conn->query($sql) === TRUE) {
    echo "관리자 계정이 성공적으로 생성되었습니다.";
} else {
    echo "오류: " . $sql . "<br>" . $conn->error;
}

// 데이터베이스 연결 종료
$conn->close();
?>