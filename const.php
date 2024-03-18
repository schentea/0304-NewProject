<?php
// php 상수설정

define("KAKAO_API", "b40af43bcbd5aceac6b39a836dec3700");
// define("KAKAO_API", "test");

define("NAVER_API","pcCPupyj8FxDvPx41pPK");
define("NAVER_CLIENT_SECRET", "giXhPlaTJh");

class NetworkInfo {
    const HOST = "localhost";
    const USER = "dongseong";
    const PASSWORD ="ghflqud1220!";
    const DB = "dongseong";
}

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
$mysqlConnect = mysqli_connect(NetworkInfo::HOST,NetworkInfo::USER,NetworkInfo::PASSWORD, NetworkInfo::DB)

?>