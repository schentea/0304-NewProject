// 모달 가져오기
var foodmodal = document.getElementById("foodModal");

// 모달 닫기 버튼 가져오기
var foodspan = document.getElementsByClassName("foodclose")[0];

let div = document.querySelectorAll(".swiper-slide");

// 버튼을 클릭하면 모달 열기
div.forEach(function (item) {
  item.onclick = function () {
    foodmodal.style.display = "flex";
    document.querySelector(".foodmodal-content").classList.add("modalAni");
  };
});

// 닫기 버튼을 클릭하면 모달 닫기
foodspan.onclick = function () {
  foodmodal.style.display = "none";
};

// 모달 외부를 클릭하면 모달 닫기
window.onclick = function (event) {
  if (event.target == foodmodal) {
    foodmodal.style.display = "none";
  }
};
