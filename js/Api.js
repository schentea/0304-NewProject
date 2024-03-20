export let eventData = null;
export let performData = null;

export function fetchData() {
  return new Promise((resolve, reject) => {
    $.ajax({
      url: "http://dongseong.dothome.co.kr/api.php",
      method: "GET",
      dataType: "json",
      success: (data) => {
        eventData = data.eventData;
        performData = data.performData;
        resolve();
      },
      error: (error) => {
        reject(error);
      },
    });
  });
}

$(document).ready(function () {
  $.ajax({
    url: "http://dongseong.dothome.co.kr/api.php",
    method: "GET",
    dataType: "json",
    success: function (data) {
      const food = data.restaurantData;

      fetch(
        "https://api.odcloud.kr/api/15097368/v1/uddi:4ef1ceb1-f791-4db8-9edf-d85845bee754?page=1&perPage=10000&serviceKey=shkyKsQQnrCcxyGdsoxzB5QFrCQTkxcVx0By2Qc7rECl%2BrYh5RMmi95PsHbN5Je8CCJdA7hJy69mnMGEFj0hvw%3D%3D"
      )
        .then((response) => {
          if (response.ok) {
            return response.json();
          }
          throw new Error("API 호출이 실패했습니다.");
        })
        .then((data) => {
          if (!data || !data.data) {
            throw new Error("데이터 형식이 올바르지 않습니다.");
          }

          const dataSlice = data.data.slice(9260, 10000);

          let dataArr = [];
          for (let Key in food) {
            if (food.hasOwnProperty(Key)) {
              dataArr.push(food[Key]);
            }
          }

          // 업소명이 같은 데이터 찾기
          const sameNameItems = [];
          const imgArr = [];

          dataArr[2].forEach((item1, index) => {
            // item1에서 필요한 속성이 정의되어 있는지 확인합니다.
            if (item1 && item1.BZ_NM) {
              const itemT1 = item1.BZ_NM.slice(0, 4);
              dataSlice.forEach((item2) => {
                if (item2 && item2.업소명) {
                  const itemT2 = item2.업소명.slice(0, 4);
                  if (
                    itemT1 === itemT2 &&
                    !sameNameItems.some((item) => item.BZ_NM === item1.BZ_NM)
                  ) {
                    imgArr.push(item2);
                    sameNameItems.push(item1);
                  }
                }
              });
            }
            // console.log(sameNameItems);
          });

          const Slide = Array.from(document.querySelectorAll(".swiper-slide"));
          const swiperSlide = Slide.slice(0, 10);
          const swiperSlide1 = Slide.slice(10, 18);
          const imgArr2 = imgArr.slice(10, 18);

          const slides = document.querySelectorAll(".swiper-slide");
          slides.forEach((item, index) => {
            if (item.innerHTML === "") {
              item.innerHTML = "Loding...";
            } else {
              item.innerHTML = "";
            }
          });
          const fooddiv = document.querySelector(".imgbox");
          const imgbox = document.createElement("img");
          const foodadr = document.querySelector("#foodadr");
          const foodnum = document.querySelector("#foodnum");
          const foodtime = document.querySelector("#foodtime");

          fooddiv.appendChild(imgbox);
          sameNameItems.slice(0, 10).forEach((item, index) => {
            const swiperText = document.createElement("p");

            swiperSlide[
              index
            ].style.backgroundImage = `url('./${imgArr[index]["이미지 경로"]}/${imgArr[index]["파일명"]}')`;
            swiperSlide[index].style.backgroundPositon = "center";
            swiperSlide[index].style.backgroundSize = "cover";
            swiperSlide[index].appendChild(swiperText);
            swiperText.textContent = item.BZ_NM; // 예시로 업소명을 텍스트로 추가
            swiperSlide[index].addEventListener("click", () => {
              // 클릭한 슬라이드의 이미지를 imgbox에 할당
              imgbox.src = `./${imgArr[index]["이미지 경로"]}/${imgArr[index]["파일명"]}`;
              // foodname.textContent = item.BZ_NM;
              foodname.innerHTML = `<h5>${item.BZ_NM}</h5> <div class="heartBtn"></div>`;
              foodname2.textContent = item.SMPL_DESC.replace(/<br \/>/g, "\n");
              foodadr.textContent = item.GNG_CS;
              foodnum.textContent = item.TLNO;
              foodtime.textContent = item.MBZ_HR;
              if (/^(|.*없음.*|.*불가.*)$/.test(item.PKPL)) {
                document.querySelector(
                  ".foodIcons .foodCarIcon p"
                ).textContent = "주차 불가";
              } else
                document.querySelector(
                  ".foodIcons .foodCarIcon p"
                ).textContent = "주차 가능";
              if (/^(|.*없음.*|.*불가.*)$/.test(item.BKN_YN)) {
                document.querySelector(
                  ".foodIcons .foodBookIcon p"
                ).textContent = "예약 불가";
              } else
                document.querySelector(
                  ".foodIcons .foodBookIcon p"
                ).textContent = "예약 가능";
              if (/^(|.*없음.*|.*불가.*)$/.test(item.INFN_FCL)) {
                document.querySelector(
                  ".foodIcons .foodToyIcon p"
                ).textContent = "놀이시설 없음";
              } else
                document.querySelector(
                  ".foodIcons .foodToyIcon p"
                ).textContent = "놀이시설 있음";
              let menusHTML = document.querySelector(".foodMenusWrap");
              menusHTML.innerHTML = "";
              item.MNU.split("<br />")
                .map((item) => item.trim())
                .filter((item) => item)
                .forEach((menuItem) => {
                  let match = menuItem.match(/(.+) (\d+,\d+)원/);
                  if (match) {
                    menusHTML.innerHTML += `
                      <div class="foodMenu">
                        <p>${match[1]}</p>
                        <p>${match[2]}원</p>
                      </div>
                    `;
                  }
                });
            });
          });
          const fooddiv2 = document.querySelector(".imgbox");
          const foodname = document.querySelector("#foodname");
          const foodname2 = document.querySelector("#foodname2");

          const imgbox2 = document.createElement("img");
          fooddiv2.appendChild(imgbox2);
          sameNameItems.slice(11, 20).forEach((item, index) => {
            const swiperText = document.createElement("p");
            swiperSlide1[
              index
            ].style.backgroundImage = `url('./${imgArr2[index]["이미지 경로"]}/${imgArr2[index]["파일명"]}')`;
            swiperSlide1[index].style.backgroundPositon = "center";
            swiperSlide1[index].style.backgroundSize = "cover";
            swiperSlide1[index].appendChild(swiperText);

            swiperText.textContent = item.BZ_NM; // 예시로 업소명을 텍스트로 추가
            swiperSlide1[index].addEventListener("click", () => {
              // 클릭한 슬라이드의 이미지를 imgbox에 할당
              imgbox.src = `./${imgArr2[index]["이미지 경로"]}/${imgArr2[index]["파일명"]}`;
              foodname.innerHTML = `<h5>${item.BZ_NM}</h5> <div class="heartBtn"></div>`;
              foodname2.textContent = item.SMPL_DESC.replace(/<br \/>/g, "\n");
              foodadr.textContent = item.GNG_CS;
              foodnum.textContent = item.TLNO;
              foodtime.textContent = item.MBZ_HR;
              if (/^(|.*없음.*|.*불가.*)$/.test(item.PKPL)) {
                document.querySelector(
                  ".foodIcons .foodCarIcon p"
                ).textContent = "주차 불가";
              } else
                document.querySelector(
                  ".foodIcons .foodCarIcon p"
                ).textContent = "주차 가능";
              if (/^(|.*없음.*|.*불가.*)$/.test(item.BKN_YN)) {
                document.querySelector(
                  ".foodIcons .foodBookIcon p"
                ).textContent = "예약 불가";
              } else
                document.querySelector(
                  ".foodIcons .foodBookIcon p"
                ).textContent = "예약 가능";
              if (/^(|.*없음.*|.*불가.*)$/.test(item.INFN_FCL)) {
                document.querySelector(
                  ".foodIcons .foodToyIcon p"
                ).textContent = "놀이시설 없음";
              } else
                document.querySelector(
                  ".foodIcons .foodToyIcon p"
                ).textContent = "놀이시설 있음";
              let menusHTML = document.querySelector(".foodMenusWrap");
              menusHTML.innerHTML = "";
              item.MNU.split("<br />")
                .map((item) => item.trim())
                .filter((item) => item)
                .forEach((menuItem) => {
                  let match = menuItem.match(/(.+) (\d+,\d+)원/);
                  if (match) {
                    menusHTML.innerHTML += `
                      <div class="foodMenu">
                        <p>${match[1]}</p>
                        <p>${match[2]}원</p>
                      </div>
                    `;
                  }
                });
            });
          });
        })

        .catch((error) => console.log(error));
    },
    error: function (xhr, status, error) {
      console.log("Error fetching data:", error);
    },
  });
});
