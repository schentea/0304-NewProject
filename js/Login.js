// 로그인 모달 열기
document.getElementById("loginButton").addEventListener("click", function () {
  document.getElementById("loginModal").style.display = "block";
});

// 로그인 모달 닫기
document
  .getElementsByClassName("close2")[0]
  .addEventListener("click", function () {
    document.getElementById("loginModal").style.display = "none";
  });

// 로그인 폼 제출
document
  .getElementById("loginForm")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // 기본 동작 방지

    // 폼 데이터를 직렬화하여 변수에 저장
    let formData = $(this).serialize();

    // AJAX 요청
    $.ajax({
      url: "http://yj4newproject.dothome.co.kr/login.php",
      type: "POST", // POST 방식으로 데이터 전송
      data: formData, // 직렬화된 폼 데이터를 전송
      dataType: "json", // 서버에서 받을 데이터 형식을 JSON으로 설정
      success: function (response) {
        // 서버로부터의 응답을 받았을 때 실행되는 함수
        if (response.success) {
          // 로그인 성공
          alert(response.message);
          document.getElementById("loginModal").style.display = "none"; // 모달창 닫기
          console.log("현재 로그인된 사용자 :", response.username);
          document.getElementById("between").style.display = "none";
          document.getElementById("loginButton").style.display = "none";
          document.getElementById("openModalBtn").style.display = "none";
          const login = document.getElementById("rogin");
          const li = document.createElement("li");
          login.appendChild(li);
          li.innerText = response.username + "님 환영합니다.";
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
