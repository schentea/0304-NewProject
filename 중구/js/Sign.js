function isValidUsername(username) {
  if (username.length < 4 || username.length > 10) {
    return false;
  }
  return /^[a-zA-Z0-9]+$/.test(username);
}

function isValidPassword(password) {
  if (password.length < 8) {
    return false;
  }
  return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/.test(
    password
  );
}

function isValidEmail(email) {
  return /\S+@\S+\.\S+/.test(email);
}

function isValidPhoneNumber(tel) {
  return /^010\d{8}$/.test(tel);
}

function checkValidity() {
  let username = document.getElementById("username").value;
  let password = document.getElementById("password").value;
  let email = document.getElementById("email").value;
  let tel = document.getElementById("tel").value;

  let isUsernameValid = isValidUsername(username);
  let isPasswordValid = isValidPassword(password);
  let isEmailValid = isValidEmail(email);
  let isTelValid = isValidPhoneNumber(tel);

  document.getElementById("usernameError").textContent = isUsernameValid
    ? ""
    : "아이디는 4자 이상 10자 이하의 알파벳과 숫자만 가능합니다.";
  document.getElementById("passwordError").textContent = isPasswordValid
    ? ""
    : "비밀번호는 최소 8자 이상의 대소문자, 숫자, 특수문자를 포함해야 합니다.";
  document.getElementById("emailError").textContent = isEmailValid
    ? ""
    : "올바른 이메일 주소를 입력해주세요.";
  document.getElementById("telError").textContent = isTelValid
    ? ""
    : "올바른 전화번호 형식을 입력해주세요. (예시: 01012345678)";

  let submitButton = document.getElementById("signSubmitBtn");
  submitButton.disabled = !(
    isUsernameValid &&
    isPasswordValid &&
    isEmailValid &&
    isTelValid
  );
}

function signup() {
  let username = document.getElementById("username").value;

  // 중복 아이디 확인을 위해 서버에 요청
  fetch("http://dongseong.dothome.co.kr/check_username.php", {
    method: "POST",
    body: JSON.stringify({ username: username }), // 사용자 이름을 서버에 전달
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => response.text())
    .then((data) => {
      if (data === "이미 사용 중인 아이디입니다.") {
        document.getElementById("usernameError").textContent = data;
      } else {
        // 중복 아이디가 아니면 회원가입 요청 보내기
        let formData = new FormData(document.getElementById("signupForm"));
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
              alert("올바른 양식을 지켜주세요.");
              console.error("회원가입에 실패했습니다.");
            }
          })
          .catch((error) => {
            console.error("Error:", error);
          });
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

document
  .getElementById("signupForm")
  .addEventListener("submit", function (event) {
    event.preventDefault();
    checkValidity();
    // 클라이언트 측에서 유효성 검사를 통과한 경우에만 회원가입 요청을 보냄
    let submitButton = document.getElementById("signSubmitBtn");
    if (!submitButton.disabled) {
      signup();
    }
  });

document.getElementById("username").addEventListener("input", checkValidity);
document.getElementById("password").addEventListener("input", checkValidity);
document.getElementById("email").addEventListener("input", checkValidity);
document.getElementById("tel").addEventListener("input", checkValidity);

checkValidity();
