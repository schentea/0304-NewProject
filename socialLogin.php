<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
// 데이터베이스 연결 정보
$servername = "localhost"; // MySQL 호스트 이름
$username = "dongseong"; // MySQL 사용자 이름
$password = "ghflqud1220!"; // MySQL 비밀번호
$dbname = "dongseong"; // 사용할 데이터베이스 이름

$conn = new mysqli($servername, $username, $password, $dbname);

$kakaoConfig =array(
    'client_id'=>"b40af43bcbd5aceac6b39a836dec3700",
    'client_secret'=>"vxfhD6e5qrqKK4iH3AG0wNyprMdscOUC",
    // 로그인 인증 URL
	'login_auth_url'=>'https://kauth.kakao.com/oauth/authorize?response_type=code&client_id={client_id}&redirect_uri={redirect_uri}&state={state}',

	// 로그인 인증토큰 요청 URL
	'login_token_url'=>'https://kauth.kakao.com/oauth/token?grant_type=authorization_code&client_id={client_id}&redirect_uri={redirect_uri}&client_secret={client_secret}&code={code}',

	// 프로필정보 호출 URL 
	'profile_url'=>'https://kapi.kakao.com/v2/user/me',	

);


?>