// 로그인 폼 제출 이벤트 리스너
document
  .getElementById("loginForm")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // 기본 동작 방지

    // 폼 데이터를 직렬화하여 변수에 저장
    let formData = $(this).serialize();

    // AJAX 요청
    $.ajax({
      url: "http://dongseong.dothome.co.kr/login.php",
      type: "POST", // POST 방식으로 데이터 전송
      data: formData, // 직렬화된 폼 데이터를 전송
      dataType: "json", // 서버에서 받을 데이터 형식을 JSON으로 설정
      success: function (response) {
        // 서버로부터의 응답을 받았을 때 실행되는 함수
        if (response.success) {
          // 로그인 성공
          alert(response.message);
          sessionStorage.setItem("username", response.username);
          window.location.href = "./index.html";
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
$(document).ready(function () {
  // 카카오로 로그인 버튼 클릭 이벤트 처리
  $("#kakao").click(function () {
    // AJAX 요청을 사용하여 PHP 파일 호출
    $.ajax({
      url: "http://dongseong.dothome.co.kr/testKakao.php", // PHP 파일의 경로
      type: "GET", // GET 또는 POST 요청 가능
      dataType: "json", // 응답 데이터 타입은 JSON으로 기대
      success: function (response) {
        // AJAX 요청이 성공적으로 완료됐을 때 실행되는 함수
        console.log("성공:", response); // 응답 데이터를 콘솔에 출력하거나 필요한 처리를 수행
      },
      error: function (xhr, status, error) {
        // AJAX 요청이 실패했을 때 실행되는 함수
        console.error("실패:", xhr, status, error);
      },
    });
  });
});
