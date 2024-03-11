// 모달 가져오기
var modal = document.getElementById("foodModal");

// 모달 닫기 버튼 가져오기
var span = document.getElementsByClassName("foodclose")[0];

let div = document.querySelectorAll(".swiper-slide");

// 버튼을 클릭하면 모달 열기
div.forEach(function (item) {
  item.onclick = function () {
    modal.style.display = "block";
  };
});

// 닫기 버튼을 클릭하면 모달 닫기
span.onclick = function () {
  modal.style.display = "none";
};

// 모달 외부를 클릭하면 모달 닫기
window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};
