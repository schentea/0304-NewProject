<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
session_start();

// 로그아웃 요청인지 확인합니다.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 세션을 파기하여 로그아웃합니다.
    session_unset(); // 모든 세션 변수 제거
    session_destroy(); // 세션 파기

    // 로그아웃 성공 메시지를 JSON 응답으로 반환합니다.
    echo json_encode(array('success' => true, 'message' => '로그아웃 되었습니다.'));
    exit; // 코드 실행 중지
} else {
    // POST 요청이 아니면 오류 메시지를 JSON 응답으로 반환합니다.
    echo json_encode(array('success' => false, 'message' => '잘못된 요청입니다.'));
    exit; // 코드 실행 중지
}
?>