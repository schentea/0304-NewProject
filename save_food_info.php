<?php
// 세션 시작
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
session_start();

// 데이터베이스 연결 정보
$servername = "localhost"; // MySQL 호스트 이름
$username = "dongseong"; // MySQL 사용자 이름
$password = "ghflqud1220!"; // MySQL 비밀번호
$dbname = "dongseong"; // 사용할 데이터베이스 이름

// POST 데이터로부터 음식 정보를 받아옵니다.
$request_body = file_get_contents('php://input');
$data = json_decode($request_body);

// 받아온 데이터에서 필요한 정보를 추출합니다.
$uid = $data->uid;
$BZ_NM = $data->BZ_NM;
$SMPL_DESC = $data->SMPL_DESC;
$GNG_CS = $data->GNG_CS;
$TLNO = $data->TLNO;
$MBZ_HR = $data->MBZ_HR;
$PKPL = $data->PKPL;
$BKN_YN = $data->BKN_YN;
$INFN_FCL = $data->INFN_FCL;
$MNU1 = $data->MNU1;
$MNU2 = $data->MNU2;
$MNU3 = $data->MNU3;
$IMAGE = $data->IMAGE;
$isLiked = $data->isLiked;

// 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL 쿼리 생성
$sql = "INSERT INTO userFoodInfo (uid, BZ_NM, SMPL_DESC, GNG_CS, TLNO, MBZ_HR, PKPL, BKN_YN, INFN_FCL, MNU1, MNU2, MNU3, IMAGE, isLiked) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssssss", $uid, $BZ_NM, $SMPL_DESC, $GNG_CS, $TLNO, $MBZ_HR, $PKPL, $BKN_YN, $INFN_FCL, $MNU1, $MNU2, $MNU3, $IMAGE, $isLiked);

// 쿼리 실행
if ($stmt->execute()) {
    echo json_encode(array("success" => true, "message" => "음식 정보가 성공적으로 저장되었습니다."));
} else {
    echo json_encode(array("success" => false, "message" => "음식 정보 저장에 실패했습니다."));
}

// 연결 종료
$stmt->close();
$conn->close();
?>