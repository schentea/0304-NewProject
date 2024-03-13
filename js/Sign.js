// 회원가입 폼 제출 시 동작
document
  .getElementById("signupForm")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // 폼 제출 기본 동작 막기 (페이지 새로고침)

    // 사용자 입력값 가져오기
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var tel = document.getElementById("tel").value;

    // 사용자 입력값 유효성 검사 함수들
    function isValidUsername(username) {
      // 길이 검사 (예시: 4자 이상 10자 이하)
      if (username.length < 4 || username.length > 10) {
        return false;
      }
      // 특수문자 및 공백 검사
      return /^[a-zA-Z0-9]+$/.test(username);
    }

    function isValidPassword(password) {
      // 길이 검사 (예시: 8자 이상)
      if (password.length < 8) {
        return false;
      }
      // 대소문자, 숫자, 특수문자 혼합 검사
      return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/.test(
        password
      );
    }

    function isValidEmail(email) {
      return /\S+@\S+\.\S+/.test(email);
    }

    function isValidPhoneNumber(tel) {
      // 정규식 패턴에 따라 변경 가능
      return /^\d{3}\d{3,4}\d{4}$/.test(tel);
    }

    // 사용자 입력값 유효성 검사
    if (!isValidUsername(username)) {
      console.error(
        "사용자 이름은 4자 이상 10자 이하의 알파벳과 숫자만 가능합니다."
      );
      // 사용자에게 알리는 코드 추가
      return;
    }

    if (!isValidPassword(password)) {
      console.error(
        "비밀번호는 최소 8자 이상의 대소문자, 숫자, 특수문자를 포함해야 합니다."
      );
      // 사용자에게 알리는 코드 추가
      return;
    }

    if (!isValidEmail(email)) {
      console.error("올바른 이메일 주소를 입력해주세요.");
      // 사용자에게 알리는 코드 추가
      return;
    }

    if (!isValidPhoneNumber(tel)) {
      console.error(
        "올바른 전화번호 형식을 입력해주세요. (예시: 010-1234-5678)"
      );
      // 사용자에게 알리는 코드 추가
      return;
    }

    // 회원가입 데이터를 서버로 보내는 등의 작업 수행
    var formData = new FormData(this);
    fetch("http://dongseong.dothome.co.kr/sign.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        if (response.ok) {
          console.log("회원가입이 완료되었습니다.");
          alert("회원가입이 완료되었습니다.");
          window.location.href = "http://dongseong.dothome.co.kr/";
        } else {
          console.error("회원가입에 실패했습니다.");
          // 실패 시 사용자에게 알리는 코드 추가
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        // 오류 시 사용자에게 알리는 코드 추가
      });
  });
