let showModal1 = document.querySelector("#showModal1");
let showModal2 = document.querySelector("#showModal2");
let showModal3 = document.querySelector("#showModal3");

// 콘서트하우스 모달 열기
document.querySelector("#show_right_img_div").onclick = () => {
  showModal1.style.display = "flex";
  document.querySelector("#showModalIn1").classList.add("modalAni");
};
// X 모달 닫기
document.querySelector("#showModalClose1").onclick = () => {
  showModal1.style.display = "none";
};
// 모달 외부 클릭시 닫기
window.addEventListener("click", function (event) {
  if (event.target == showModal1) {
    showModal1.style.display = "none";
  }
});

// 라이크 모달 열기
document.querySelector("#show_left2").onclick = () => {
  showModal2.style.display = "flex";
  document.querySelector("#showModalIn2").classList.add("modalAni");
};
// X 모달 닫기
document.querySelector("#showModalClose2").onclick = () => {
  showModal2.style.display = "none";
};
// 모달 외부 클릭시 닫기
window.addEventListener("click", function (event) {
  if (event.target == showModal2) {
    showModal2.style.display = "none";
  }
});

// 아트 모달 열기
document.querySelector("#show_left1").onclick = () => {
  showModal3.style.display = "flex";
  document.querySelector("#showModalIn3").classList.add("modalAni");
};
// X 모달 닫기
document.querySelector("#showModalClose3").onclick = () => {
  showModal3.style.display = "none";
};
// 모달 외부 클릭시 닫기
window.addEventListener("click", function (event) {
  if (event.target == showModal3) {
    showModal3.style.display = "none";
  }
});
