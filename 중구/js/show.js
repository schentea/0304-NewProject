// 모달창
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

// api 데이터 불러오기
import { eventData, performData, fetchData } from "./Api.js";

fetchData()
  .then(() => {
    let art = performData.filter((a) => /아트플러스씨어터|여우별아트홀/.test(a.place));
    art = art
      .map(
        (a) => `<li>
          <p class="showTit">${a.subject.split(" - ")[0]}</p>
          <div class="showDate">
            <p class="showStart">📅 ${a.start_date.slice(2)}</p>
            ~
            <p class="showEnd">${a.end_date.slice(2)}</p>
          </div>
          <div class="heartBtn"></div>
        </li>`
      )
      .join("");
    document.querySelector("#showModalList3").innerHTML = art;

    let eve = eventData.filter((a) => a.place.includes("라이크디즈"));
    eve = eve
      .map(
        (a) => `<li>
          <p class="showTit">${a.subject.split("점_")[1] || a.subject}</p>
          <div class="showDate">
            <p class="showStart">📅 ${a.start_date.slice(2)}</p>
            ~
            <p class="showEnd">${a.end_date.slice(2)}</p>
          </div>
          <div class="heartBtn"></div>
        </li>`
      )
      .join("");
    document.querySelector("#showModalList2").innerHTML = eve;
    let today = new Date().toISOString().split("T")[0];
    let cons = performData.filter((a) => a.place.includes("콘서트하우스") && a.end_date >= today);
    cons = cons
      .map(
        (a) => `<li>
    <p class="showTit">${a.subject.replace(/ \- 대구|\(대구\)|－대구/g, "")}</p>
    <div class="showDate">
      <p class="showStart">📅 ${a.start_date.slice(2)}</p>
      ~
      <p class="showEnd">${a.end_date.slice(2)}</p>
    </div>
    <div class="heartBtn"></div>
  </li>`
      )
      .join("");
    document.querySelector("#showModalList1").innerHTML = cons;

    for (let h of document.querySelectorAll(".heartBtn")) {
      h.addEventListener("click", () => {
        h.classList.toggle("active");
      });
    }
  })
  .catch((error) => {});

// MutationObserver 생성
const observer = new MutationObserver((mutations) => {
  mutations.forEach((mutation) => {
    // 추가된 요소가 있는지 확인
    if (mutation.type === "childList") {
      mutation.addedNodes.forEach((node) => {
        // 추가된 요소가 .heartBtn인지 확인
        if (node.nodeType === 1 && node.classList.contains("heartBtn")) {
          node.addEventListener("click", () => {
            node.classList.toggle("active");
          });
        }
      });
    }
  });
});

observer.observe(document.body, { childList: true, subtree: true });
