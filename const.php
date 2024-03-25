<?php
// php 상수설정
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
define("KAKAO_API", $_ENV['KAKAO_API']);
// define("KAKAO_API", "test");

define("NAVER_API",$_ENV['NAVER_API']);
define("NAVER_CLIENT_SECRET", $_ENV['NAVER_CLIENT_SECRET']);

class NetworkInfo {
    public static $HOST;
    public static $USER;
    public static $PASSWORD;
    public static $DB;
}

NetworkInfo::$HOST = $_ENV['DB_HOST'];
NetworkInfo::$USER = $_ENV['DB_USERNAME'];
NetworkInfo::$PASSWORD = $_ENV['DB_PASSWORD'];
NetworkInfo::$DB = $_ENV['DB_NAME'];

class SocialLogin {
    const REDIRECT_URL = "http://dongseong.dothome.co.kr/social_login.php";

    static public function socialLoginUrl($loginState) {
        switch($loginState) {
            // case "google":
            //     return 'https://accounts.google.com/o/oauth2/v2/auth?client_id='.GOOGLE_API.'&redirect_uri='.self::REDIRECT_URL.'&response_type=code&state=google&scope=https://www.googleapis.com/auth/userinfo.email+https://www.googleapis.com/auth/userinfo.profile&access_type=offline&prompt=consent';
            case "kakao":
                return 'https://kauth.kakao.com/oauth/authorize?client_id='.KAKAO_API.'&redirect_uri='.self::REDIRECT_URL.'&response_type=code&state=kakao&prompt=login';
            case "naver":
                return 'https://nid.naver.com/oauth2.0/authorize?client_id='.NAVER_API.'&redirect_uri='.self::REDIRECT_URL.'&response_type=code&state=naver';
            default:
                return "";
        }
    }

}
$mysqlConnect = mysqli_connect(NetworkInfo::$HOST, NetworkInfo::$USER, NetworkInfo::$PASSWORD, NetworkInfo::$DB);

?>