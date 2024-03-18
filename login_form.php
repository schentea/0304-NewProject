<?php 
include "const.php"
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>로그인</title>
    <link rel="stylesheet" href="./css/Sign.css" />
    <link href="https://webfontworld.github.io/SCoreDream/SCoreDream.css" rel="stylesheet" />
    <link rel="icon" href="./image/logo.svg" />
    <script src="https://kit.fontawesome.com/247e9f18da.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <a class="backHomeA" href="index.php">
      <div class="backHome">
        <i class="fa-solid fa-house fa-xl"></i>
        <p>홈페이지</p>
      </div>
    </a>
    <div class="loginWrap">
      <p id="loginTitle">로그인</p>
      <form id="loginForm">
        <div class="loginInputs">
          <div style="position: relative">
            <input class="loginInput" type="text" id="username2" name="username" placeholder="" required />
            <label class="label-custom">아이디</label>
          </div>
          <div style="position: relative">
            <input class="loginInput" type="password" id="password2" name="password" placeholder="" required />
            <label class="label-custom">비밀번호</label>
          </div>
          <button id="loginSubmitBtn" type="submit">로그인</button>
        </div>
        <div id="goSign">아직 아이디가 없다면? <a href="sign_form.php" target="_self">가입하기</a></div>
        <br /><br />
        <button class="naverBtn" type="button"><img src="./image/naverIcon.png" alt="네이버 아이콘" /><a href=<?php echo SocialLogin::socialLoginUrl("naver") ?>> 네이버로 로그인</a></button>
        <br />
        <button class="googleBtn" type="button"><img src="./image/kakaoIcon.png" alt="카카오 아이콘" /> <a href=<?php echo SocialLogin::socialLoginUrl("kakao") ?>>카카오로 로그인</a></button>
      </form>
    </div>
    <script src="./js/Login.js"></script>
  </body>
</html>
