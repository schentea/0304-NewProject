// 로그인 폼 제출 이벤트 리스너
document
  .getElementById("loginForm")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // 기본 동작 방지

    // 폼 데이터를 직렬화하여 변수에 저장
    let formData = $(this).serialize();

    // AJAX 요청
    $.ajax({
      url: "http://dongseong.dothome.co.kr/Login.php",
      type: "POST", // POST 방식으로 데이터 전송
      data: formData, // 직렬화된 폼 데이터를 전송
      dataType: "json", // 서버에서 받을 데이터 형식을 JSON으로 설정
      success: function (response) {
        // 서버로부터의 응답을 받았을 때 실행되는 함수
        if (response.success) {
          // 로그인 성공
          alert(response.message);
          sessionStorage.setItem("username", response.username);
          window.location.href = "./index.php";
        } else {
          // 로그인 실패
          alert(response.message);
        }
      },
      error: function (xhr, status, error) {
        // AJAX 요청이 실패했을 때 실행되는 함수
        console.error("AJAX 요청 중 오류 발생:", error);
      },
    });
  });
