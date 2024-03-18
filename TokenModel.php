<?php
//토큰 모델(불변객체)(캡슐화 => 안정성 보장)
class TokenModel{
    private $accessToken;
    private $refreshToken;
    
    public function __construct($data){
       $this->accessToken = $data['access_token'];
       $this->refreshToken = $data['refresh_token'];
    } 

    public function getAccessToken(){
        return $this->accessToken;
    }

    public function getRefreshToken(){
        return $this->refreshToken;
    }
}
?>