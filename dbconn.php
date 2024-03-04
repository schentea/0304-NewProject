<?php
// MySQL 데이터베이스 연결 설정
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
$servername = "localhost";
$username = "root"; // MySQL 사용자 이름
$password = "1220"; // MySQL 비밀번호
$database = "test"; // MySQL 데이터베이스 이름

// MySQL 데이터베이스에 연결
$conn = new mysqli($servername, $username, $password, $database);

// 연결 오류 확인
if ($conn->connect_error) {
    die("MySQL 연결 실패: " . $conn->connect_error);
}

// 만약 POST 요청이 들어왔을 경우 (로그인 시)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 사용자가 입력한 로그인 정보 가져오기
    $email = $_POST['email'];
    $password = $_POST['password'];

    // 입력된 정보와 일치하는 사용자가 있는지 데이터베이스에서 확인
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    // 만약 결과가 존재하면 로그인 성공
    if ($result->num_rows > 0) {
        // 세션 시작
        session_start();
        // 사용자 정보를 세션에 저장 (예시: 사용자 ID)
        $_SESSION['user_email'] = $email;
        // 로그인 성공을 클라이언트에게 알리기 위해 HTTP 상태코드 200 반환
        http_response_code(200);
    } else {
        // 로그인 실패를 클라이언트에게 알리기 위해 HTTP 상태코드 401 반환
        http_response_code(401);
    }
} else {
    // POST 요청이 아닌 경우, 데이터를 가져오는 요청이므로 쿼리를 실행하여 데이터를 반환합니다.
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    // 데이터를 배열로 저장
    $data = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    // 데이터를 JSON 형식으로 반환
    header('Content-Type: application/json');
    echo json_encode($data);
}

// MySQL 연결 종료
$conn->close();
?>
