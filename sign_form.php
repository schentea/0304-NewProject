<?php
include "const.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>회원가입</title>
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
    <div class="SignWrap">
      <p id="signTitle">회원가입</p>
      <form id="signupForm" action="sign.php" method="post">
        <div class="signupInputs">
          <div style="position: relative">
            <input placeholder="" class="signInput" type="text" id="username" name="username" required />
            <label class="label-custom">아이디</label><br />
            <label id="usernameError" style="color: red"></label>
          </div>
          <div style="position: relative">
            <input placeholder="" class="signInput" type="email" id="email" name="email" required />
            <label class="label-custom">이메일</label><br />
            <label id="emailError" style="color: red"></label>
          </div>
          <div style="position: relative">
            <input placeholder="" class="signInput" type="password" id="password" name="password" required />
            <label class="label-custom">비밀번호</label>
            <i class="fa-regular fa-eye"></i>
            <br />
            <label id="passwordError" style="color: red"></label>
          </div>
          <div style="position: relative">
            <input placeholder="" class="signInput" type="text" id="name" name="name" required />
            <label class="label-custom">이름</label>
          </div>
          <div style="position: relative">
            <input placeholder="" class="signInput" type="number" id="tel" name="tel" required />
            <label class="label-custom">핸드폰 번호</label><br />
            <label id="telError" style="color: red"></label>
          </div>
        </div>
        <button id="signSubmitBtn" type="submit">가입하기</button>
        <div id="goSign">
          이미 아이디가 있다면?
          <a href="login.php" target="_self">로그인하기</a>
        </div>

        <button class="naverBtn" type="button" style="margin-top: 50px">
          <img src="./image/naverIcon.png" alt="네이버 아이콘" /><a href=<?php echo SocialLogin::socialLoginUrl("naver") ?>> 네이버로 회원가입</a></button
        ><br />
        <button class="googleBtn" type="button">
          <img src="./image/kakaoIcon.png" alt="카카오 아이콘" /><a href=<?php echo SocialLogin::socialLoginUrl("kakao") ?>> 카카오로 회원가입</a>
        </button>

      </form>
    </div>
    <script src="./js/Sign.js"></script>
  </body>
</html>
