// 모달창
let showModal1 = document.querySelector("#showModal1");
let showModal2 = document.querySelector("#showModal2");
let showModal3 = document.querySelector("#showModal3");

// 콘서트하우스 모달 열기
document.querySelector("#show_right_img_div").onclick = () => {
  showModal1.style.display = "flex";
  document.querySelector("#showModalIn1").classList.add("modalAni");
  getSavedShowInfo(
    sessionStorage.getItem("username"),
    venueNames.showModalList1
  );
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
  getSavedShowInfo(
    sessionStorage.getItem("username"),
    venueNames.showModalList2
  );
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
  getSavedShowInfo(
    sessionStorage.getItem("username"),
    venueNames.showModalList3
  );
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
const venueNames = {
  showModalList1: "대구 콘서트 하우스",
  showModalList2: "라이크디즈 위즈",
  showModalList3: "아트플러스 씨어터",
};

fetchData()
  .then(() => {
    let art = performData.filter((a) =>
      /아트플러스씨어터|여우별아트홀/.test(a.place)
    );
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
    let cons = performData.filter(
      (a) => a.place.includes("콘서트하우스") && a.end_date >= today
    );
    cons = cons
      .map(
        (a) => `<li>
      <p class="showTit">${a.subject.replace(
        / \- 대구|\(대구\)|－대구/g,
        ""
      )}</p>
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
    const username = sessionStorage.getItem("username");

    // 하트 버튼에 이벤트 리스너 추가
    for (let h of document.querySelectorAll(".heartBtn")) {
      h.addEventListener("click", () => {
        if (username) {
          h.classList.toggle("active");
          const venueId = h.closest("ul").id;
          const venue = venueNames[venueId];
          const showName = h
            .closest("li")
            .querySelector(".showTit").textContent;
          const showDate = h
            .closest("li")
            .querySelector(".showDate").textContent;

          const isLiked = h.classList.contains("active");
          saveShowInfo(venue, showName, showDate, username, isLiked);
        } else {
          alert("로그인 후 이용해주세요.");
          window.location.href = "login_form.php";
        }
      });
    }
  })
  .catch((error) => {});

function saveShowInfo(venue, showName, showDate, username, isLiked) {
  // 서버에 데이터 전송
  $.ajax({
    url: "http://dongseong.dothome.co.kr/save_show_info.php",
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    data: JSON.stringify({
      username: username,
      venue: venue,
      showName: showName,
      showDate: showDate,
      isLiked: isLiked,
    }),
    success: function (response) {
      console.log("공연 정보를 서버에 전송했습니다.");
      if (!isLiked) {
        deleteSavedShowInfo(username, venue, showName, showDate);
      }
    },
    error: function (xhr, status, error) {
      console.error("공연 정보 전송 중 오류가 발생했습니다:", error);
    },
  });
}
function deleteSavedShowInfo(username, venue, showName, showDate) {
  // 서버에 삭제 요청 보내기
  $.ajax({
    url: "http://dongseong.dothome.co.kr/delete_show_info.php",
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    data: JSON.stringify({
      username: username,
      venue: venue,
      showName: showName,
      showDate: showDate,
    }),
    success: function (response) {
      console.log("공연 정보를 서버에서 삭제했습니다.");
    },
    error: function (xhr, status, error) {
      console.error("공연 정보 삭제 중 오류가 발생했습니다:", error);
    },
  });
}

function getSavedShowInfo(username, venue) {
  // 서버에서 하트 상태 확인
  $.ajax({
    url: "http://dongseong.dothome.co.kr/get_saved_show_info.php",
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    data: JSON.stringify({
      username: username,
      venue: venue,
    }),
    success: function (response) {
      // 하트 상태에 따라 클래스 추가
      if (response.isLiked) {
        const venueId = Object.keys(venueNames).find(
          (key) => venueNames[key] === venue
        );
        // 수정된 부분: heartBtn 요소를 찾기 위해 ID 선택자를 사용합니다.
        const heartBtn = document.querySelector(`#${venueId} .heartBtn`);
        if (heartBtn) {
          heartBtn.classList.add("active");
        }
      }
    },
    error: function (xhr, status, error) {
      console.error("하트 상태 확인 중 오류가 발생했습니다:", error);
    },
  });
}

const observer = new MutationObserver((mutations) => {
  mutations.forEach((mutation) => {
    // 추가된 요소가 있는지 확인
    const username = sessionStorage.getItem("username");
    if (mutation.type === "childList") {
      mutation.addedNodes.forEach((node) => {
        // 추가된 요소가 .heartBtn인지 확인
        if (node.nodeType === 1 && node.classList.contains("heartBtn")) {
          node.addEventListener("click", () => {
            if (username) {
              node.classList.toggle("active");
            } else {
              alert("로그인 후 이용해주세요.");
              window.location.href = "login_form.php";
            }
          });
        }
      });
    }
  });
});

observer.observe(document.body, { childList: true, subtree: true });
