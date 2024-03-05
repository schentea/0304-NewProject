// 모달 요소 가져오기
var modal = document.getElementById("myModal");

// 모달 열기 버튼 가져오기
var btn = document.getElementById("openModalBtn");

// 모달 닫기 버튼 가져오기
var span = document.getElementsByClassName("close")[0];

// 모달 열기 버튼을 클릭하면 모달을 보이게 함
btn.onclick = function () {
  modal.style.display = "block";
};

// 모달 닫기 버튼을 클릭하면 모달을 숨김
span.onclick = function () {
  modal.style.display = "none";
};

// 모달 외부를 클릭하면 모달을 숨김
window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};

// 회원가입 폼 제출 시 동작
document
  .getElementById("signupForm")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // 폼 제출 기본 동작 막기 (페이지 새로고침)
    var formData = new FormData(this);
    // 여기서부터는 회원가입 데이터를 서버로 보내는 등의 작업을 수행할 수 있습니다.
    console.log("회원가입 정보:", formData);
    modal.style.display = "none"; // 모달 닫기
  });
