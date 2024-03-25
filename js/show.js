console.log(
  `%c 
             ⣶⣿⣶⣤⣄⠀⠀⠀ 
             ⣿⣿⣿⣿⣿⣶⣿⠛⠁
             ⣿⣿⣿⠛⠛⠉⠁
⠀⠀⠀⢀⣠⣤⣤⣄⡀⠀⣿⣿⠿⠀⠀
⠀⣠⣶⣿⣿⠿⠿⠿⣿⣿⣿⣿⠀⠀⠀⠀⠀
⢰⣿⣿⠛⠤⠤⠤⠤⠻⣿⣿⣿⠀⠀⠀⠀⠀
⣿⣿⣿⠤⠤⠤⠤⠤⠤⣿⣿⣿⠀⠀⠀⠀⠀⠀⠀⠀
⣿⣿⣿⣄⠤⠤⠤⠤⣤⣿⣿⠿⠀⠀⠀⠀⠀⠀⠀⠀
⠘⠿⣿⣿⣶⣤⣤⣶⣿⣿⠿⠃⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠙⠻⠻⠿⠿⠿⠿⠛⠉⠀⠀⠀⠀

즐거운 동성로`,
  "color:#eb102c"
);

document.querySelector(".fa-fish-fins").addEventListener("click", function () {
  this.classList.toggle("fa-bounce");
});
document.querySelector(".fa-solid.meet").addEventListener("click", function () {
  if (this.classList.contains("fa-drumstick-bite")) {
    this.classList.remove("fa-drumstick-bite");
    this.classList.add("fa-bone", "fa-rotate-by");
    this.style.setProperty("--fa-rotate-angle", "-43deg");
  } else {
    this.classList.add("fa-drumstick-bite");
    this.classList.remove("fa-bone", "fa-rotate-by");
    this.style.removeProperty("--fa-rotate-angle");
  }
});
document.querySelector(".fa-utensils").addEventListener("click", function () {
  this.classList.toggle("fa-shake");
});
document.querySelector(".fa-solid.wine").addEventListener("click", function () {
  if (this.classList.contains("fa-wine-glass")) {
    this.classList.remove("fa-wine-glass");
    this.classList.add("fa-wine-glass-empty");
  } else {
    this.classList.remove("fa-wine-glass-empty");
    this.classList.add("fa-wine-glass");
  }
});
document.querySelector("#topBtn1").addEventListener("click", function () {
  this.classList.add("topBtnAni");

  setTimeout(() => {
    this.classList.remove("topBtnAni");
  }, 500);
});
document.querySelector("#topBtn1").addEventListener("mousedown", function () {
  this.style.transform = "scale(1.1, 0.8)";
});
document.querySelector("#topBtn1").addEventListener("mouseup", function () {
  this.style.transform = "";
});

// api 데이터 불러오기
import { eventData, performData, fetchData } from "./Api.js";
// 모달창
let showModal1 = document.querySelector("#showModal1");
let showModal2 = document.querySelector("#showModal2");
let showModal3 = document.querySelector("#showModal3");
// 모달 가져오기
let foodmodal = document.getElementById("foodModal");

// 모달 닫기 버튼 가져오기
let foodspan = document.getElementsByClassName("foodclose")[0];

let div = document.querySelectorAll(".swiper-slide");

// 버튼을 클릭하면 모달 열기
div.forEach(function (item) {
  item.onclick = function () {
    foodmodal.style.display = "flex";
    document.querySelector(".foodmodal-content").classList.add("modalAni");

    // 클릭한 음식의 이름을 저장하는 클로저
    (function () {
      let clickedFoodName = item.querySelector("p").textContent + " ";

      // 모달이 열릴 때 찜 정보와 선택한 음식의 이름을 함께 가져오기
      const username = sessionStorage.getItem("username");
      if (username) {
        $.ajax({
          url: "http://dongseong.dothome.co.kr/get_saved_food_info.php",
          type: "POST",
          dataType: "json",
          contentType: "application/json",
          data: JSON.stringify({ uid: username, foodName: clickedFoodName }), // 선택한 음식의 이름을 함께 보냄
          success: function (response) {
            let isLiked = response.isLiked;

            // 선택한 음식이 DB에 있는지 확인하고, 찜한 경우 하트를 활성화
            if (isLiked) {
              document.querySelector(".heartBtn").classList.add("active");
            }
          },
          error: function (xhr, status, error) {
            console.error("찜 정보를 가져오는 중 오류가 발생했습니다:", error);
          },
        });
      }
    })(); // 클로저 즉시 실행
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

// 콘서트하우스 모달 열기
document.querySelector("#show_right_img_div").onclick = () => {
  showModal1.style.display = "flex";
  document.querySelector("#showModalIn1").classList.add("modalAni");
  const username = sessionStorage.getItem("username");
  if (username) {
    getSavedShowInfo(username, venueNames.showModalList1);
  }
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
  const username = sessionStorage.getItem("username");
  if (username) {
    getSavedShowInfo(username, venueNames.showModalList2);
  }
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
  const username = sessionStorage.getItem("username");
  if (username) {
    getSavedShowInfo(username, venueNames.showModalList3);
  }
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
      const venueId = h.closest("ul").id;
      const venue = venueNames[venueId];
      const showName = h.closest("li").querySelector(".showTit").textContent;
      const showDate = h.closest("li").querySelector(".showDate").textContent;

      getSavedShowInfo(username, venue, showName, showDate, h); // 수정된 부분: 하트 버튼과 관련된 정보를 인자로 전달합니다.

      h.addEventListener("click", () => {
        if (username) {
          h.classList.toggle("active");
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
    success: function (response) {},
    error: function (xhr, status, error) {
      console.error("공연 정보 삭제 중 오류가 발생했습니다:", error);
    },
  });
}

function getSavedShowInfo(username, venue, showName, showDate, heartBtn) {
  // 서버에서 하트 상태 확인
  $.ajax({
    url: "http://dongseong.dothome.co.kr/get_saved_show_info.php",
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    data: JSON.stringify({
      username: username,
      venue: venue,
      showName: showName, // 수정된 부분: 공연 이름과 날짜도 함께 전달합니다.
      showDate: showDate,
    }),
    success: function (response) {
      // 하트 상태에 따라 클래스 추가
      if (response.isLiked) {
        heartBtn.classList.add("active"); // 수정된 부분: 전달된 하트 버튼에 active 클래스 추가
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
              if (
                node.nodeType === 1 &&
                node.classList.contains("heartBtn") &&
                node.classList.contains("active")
              ) {
                const isLiked = node.classList.contains("active") ? 1 : 0;
                const img = document.querySelector(".imgbox img");
                const menuItems = [];
                document.querySelectorAll(".foodMenu").forEach(function (menu) {
                  const menuItem = {
                    name: menu.querySelector("p").textContent,
                    description:
                      menu.querySelector("p:nth-child(2)").textContent,
                  };
                  menuItems.push(menuItem);
                });

                // 모달에 나와있는 정보들을 콘솔에 출력
                const IMAGE = img.src;
                const BZ_NM = foodname.textContent;
                const SMPL_DESC = foodname2.textContent;
                const GNG_CS = foodadr.textContent;
                const TLNO = foodnum.textContent;
                const MBZ_HR = foodtime.textContent;
                const PKPL = document.querySelector(
                  ".foodIcons .foodCarIcon p"
                ).textContent;
                const BKN_YN = document.querySelector(
                  ".foodIcons .foodBookIcon p"
                ).textContent;
                const INFN_FCL = document.querySelector(
                  ".foodIcons .foodToyIcon p"
                ).textContent;
                const firstMN =
                  menuItems[0].name + "/" + menuItems[0].description;
                const secondMN =
                  menuItems[1].name + "/" + menuItems[1].description;
                const thirdMN =
                  menuItems[2].name + "/" + menuItems[2].description;
                // console.log(IMAGE);
                // console.log(BZ_NM);
                // console.log(SMPL_DESC);
                // console.log(GNG_CS);
                // console.log(TLNO);
                // console.log(MBZ_HR);
                // console.log(PKPL);
                // console.log(BKN_YN);
                // console.log(INFN_FCL);
                // console.log(firstMN);
                // console.log(secondMN);
                // console.log(thirdMN);
                const data = {
                  uid: username,
                  BZ_NM: BZ_NM,
                  SMPL_DESC: SMPL_DESC,
                  GNG_CS: GNG_CS,
                  TLNO: TLNO,
                  MBZ_HR: MBZ_HR,
                  PKPL: PKPL,
                  BKN_YN: BKN_YN,
                  INFN_FCL: INFN_FCL,
                  MNU1: firstMN,
                  MNU2: secondMN,
                  MNU3: thirdMN,
                  IMAGE: IMAGE,
                  isLiked: isLiked, // 하트의 상태를 저장합니다.
                };

                $.ajax({
                  url: "http://dongseong.dothome.co.kr/save_food_info.php",
                  type: "POST",
                  dataType: "json",
                  contentType: "application/json",
                  data: JSON.stringify(data),
                  success: function (response) {
                    console.log("음식 정보를 서버에 전송했습니다.");
                  },
                  error: function (xhr, status, error) {
                    console.error(
                      "음식 정보 전송 중 오류가 발생했습니다:",
                      error
                    );
                  },
                });
              } else {
                const BZ_NM = foodname.textContent;
                const data = {
                  uid: username,
                  BZ_NM: BZ_NM,
                  isLiked: 0, // 삭제를 의미하는 값으로 설정
                };
                $.ajax({
                  url: "http://dongseong.dothome.co.kr/delete_food_info.php",
                  type: "POST",
                  dataType: "json",
                  contentType: "application/json",
                  data: JSON.stringify(data),
                  success: function (response) {
                    console.log("음식 정보를 서버에서 삭제했습니다.");
                  },
                  error: function (xhr, status, error) {
                    console.error(
                      "음식 정보 삭제 중 오류가 발생했습니다:",
                      error
                    );
                  },
                });
              }
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
