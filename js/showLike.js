function selectButton(index) {
  var buttons = document.querySelectorAll(".button");
  var contents = document.querySelectorAll(".content");

  buttons.forEach(function (button, i) {
    if (i === index - 1) {
      button.classList.add("selected");
      contents[i].classList.add("show");
    } else {
      button.classList.remove("selected");
      contents[i].classList.remove("show");
    }
  });
}

// 공연 찜목록 있는지 확인, 있으면 대체 텍스트 삭제
const observeMutation = (targetSelector) => {
  const observer = new MutationObserver((mutationsList, observer) => {
    mutationsList.forEach((mutation) => {
      if (mutation.type === "childList") {
        const target = document.querySelector(targetSelector);
        const noHeartTxt = target.querySelector(".noHeartTxt");
        if (noHeartTxt) {
          noHeartTxt.remove();
        }
      }
    });
  });

  const targetNode = document.querySelector(targetSelector);
  if (targetNode) {
    observer.observe(targetNode, {
      childList: true,
      subtree: true,
    });
  }
};

observeMutation("#consertList");
observeMutation("#artList");
observeMutation("#likeList");
