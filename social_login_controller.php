<?php
include "const.php";
include "TokenModel.php";
include "ProfileModel.php";
class SocialLoginController {
    //모델
    private $tokenModel = null;
    private $profileModel = null;
    
    // 레포지토리
    private $socialLoginRepository;

    // 인가코드
    private $code;

    // 플랫폼 구분자
    private $state;

    function __construct($code, $state, $socialLoginRepository
    )
    {
        $this->code = $code;
        $this->state = $state;
        $this->socialLoginRepository = $socialLoginRepository;
        // $this->socialLoginRepository = $socialLoginRepository;
    }

    function getToken() {
        //apikey 초기화
        $restApiKey = '';
        //returnUrl 초기화
        $returnUrl = '';
        //loginUrl 초기화
        $loginUrl = '';
        //client키 초기화
        $client_secret = '';
        //공통 callbackurl
        $callbackUrl = urlencode(SocialLogin::REDIRECT_URL);
        //kakao apikey 입력
        if($this->state =='kakao') {
            $restApiKey = KAKAO_API;
            $loginUrl = "https://kauth.kakao.com/oauth";
        }else{
            $restApiKey = NAVER_API;
            $client_secret = NAVER_CLIENT_SECRET;
            $loginUrl = "https://nid.naver.com/oauth2.0";
        }
        
        $returnUrl = "$loginUrl/token?grant_type=authorization_code&client_id=".$restApiKey
        ."&redirect_uri=".$callbackUrl."&code=".$this->code;
        $returnUrl .= $client_secret != '' ? "&client_secret=".$client_secret : '';
        
        try {
            // php 데이터 전송 툴(CURL)
            $ch = curl_init();
            $body_data = array(
                "code"=>$this->code,
                "client_id" => $restApiKey,
                "client_secret" =>$client_secret,
                "redirect_uri"=>$callbackUrl,
                "grant_type" =>"authorization_code"
            );
            // 객체를 json으로 인코딩
            $body = json_encode($body_data);

            //url 지정
            curl_setopt($ch,CURLOPT_URL,$returnUrl);
            //post로 전송
            curl_setopt($ch,CURLOPT_POST,true); 
            // 전송할 body값 입력
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
            //문자열로 변환
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
             //curl 실행
            $response = curl_exec($ch);
            $data = json_decode($response, true);
            
            // print_r($response);
           
            $tokenModel = new TokenModel($data);
            $this->tokenModel = $tokenModel;
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }
    function getProfile() {
        $header = array("Authorization: Bearer ".$this->tokenModel->getAccessToken());
        $profile_url = '';
        if($this->state == 'kakao'){
            $profile_url = "https://kapi.kakao.com/v2/user/me";
        }
        else {
            $profile_url = "https://openapi.naver.com/v1/nid/me";
        }
        

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$profile_url);
            //문자열로 변환
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        //header 입력
        curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
        //json데이터
        $response = curl_exec($ch);
        //종료
        curl_close($ch);

        $decoded_data = json_decode($response,true);
        echo("
            <script>
            console.log('1');
            </script>
            ");
        
        $uid= '';
        $nickname='';
        $email ='';
        if($this->state == 'naver'){
            $responseData = $decoded_data['response'];
            $uid = $responseData['id'];
            $nickname = $responseData['nickname'];
            $email =$responseData['email'];
            echo("
            <script>
            console.log('2');
            </script>
            ");
        }
        else if($this->state == 'kakao'){
            $uid = $decoded_data['id'];
            $kakaoAccount = $decoded_data['kakao_account'];
            $nickname = $kakaoAccount['profile']['nickname'];
            $email = $kakaoAccount['email'];
        }

        $profileModel = new ProfileModel($uid, $nickname, $email);
        $this -> profileModel = $profileModel;
        return $profileModel;
    }        
    function login () {
        $data = $this->socialLoginRepository->findUserByEmail($this->profileModel->email);
        if ($data == null) {
            // 가입된 이메일이 없으면 회원가입을 진행합니다.
            $this->socialLoginRepository->signup($this->profileModel, $this->state);
            
        } else {
            // 가입된 이메일이 존재하면 세션을 설정하고 메인 페이지로 이동합니다.
            session_start();
            $_SESSION["userid"] = $data['email'];
            $_SESSION["username"] = $data['nickname'];
            $_SESSION["id"] = $data['uid'];
            $_SESSION["accessToken"] = $this->tokenModel->getAccessToken();
            $_SESSION["state"] = $this->state;
            echo("
            <script>
                sessionStorage.setItem('username', '" . $data['email'] . "');
                alert('로그인 성공');
                location.href = 'index.php';
            </script>
            ");
        }
    }
}
