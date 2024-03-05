const xmark = document.getElementById("xmark");
const toggle = document.getElementById("toggle");
const viewNav = document.getElementById("view_nav");
toggle.addEventListener("click", function () {
  viewNav.style.right = "0"; // 수정된 부분: 오른쪽으로 이동하지 않도록 값 변경
});

xmark.addEventListener("click", function () {
  viewNav.style.right = "-100%"; // 수정된 부분: 헤더 바깥으로 나가도록 값 변경
});
