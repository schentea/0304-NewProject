// 회원가입 폼 제출 시 동작
document
  .getElementById("signupForm")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // 폼 제출 기본 동작 막기 (페이지 새로고침)
    formData = new FormData(this);

    // 여기서부터는 회원가입 데이터를 서버로 보내는 등의 작업을 수행합니다.
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
