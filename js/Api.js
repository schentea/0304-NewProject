export let eventData = null;
export let performData = null;

export function fetchData() {
  return new Promise((resolve, reject) => {
    $.ajax({
      url: "http://yj4newproject.dothome.co.kr/api.php",
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
    url: "http://yj4newproject.dothome.co.kr/api.php",
    method: "GET",
    dataType: "json",
    success: function (data) {
      const food = data.restaurantData;
      console.log("맛집 정보:", food);

      fetch("https://api.odcloud.kr/api/15097368/v1/uddi:4ef1ceb1-f791-4db8-9edf-d85845bee754?page=1&perPage=10000&serviceKey=shkyKsQQnrCcxyGdsoxzB5QFrCQTkxcVx0By2Qc7rECl%2BrYh5RMmi95PsHbN5Je8CCJdA7hJy69mnMGEFj0hvw%3D%3D")
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
          console.log("test2", dataSlice);

          let dataArr = [];
          for (let Key in food) {
            if (food.hasOwnProperty(Key)) {
              dataArr.push(food[Key]);
            }
          }
          // console.log("184", typeof dataArr);
          // console.log("1000", typeof dataSlice);
          // 업소명이 같은 데이터 찾기
          const sameNameItems = [];
          const imgArr = [];

          dataArr[2].forEach((item1, index) => {
            // item1에서 필요한 속성이 정의되어 있는지 확인합니다.
            if (item1 && item1.BZ_NM) {
              const itemT1 = item1.BZ_NM.slice(0, 4);
              dataSlice.forEach((item2) => {
                // console.log("g", item1);
                // console.log("g2", item2);
                // item2에서 필요한 속성이 정의되어 있는지 확인합니다.
                if (item2 && item2.업소명) {
                  const itemT2 = item2.업소명.slice(0, 4);
                  if (itemT1 === itemT2 && !sameNameItems.some((item) => item.BZ_NM === item1.BZ_NM)) {
                    imgArr.push(item2);
                    sameNameItems.push(item1);
                  }
                }
              });
            }
          });
          // console.log("test", imgArr[1]["이미지 경로"]);

          const Slide = Array.from(document.querySelectorAll(".swiper-slide"));
          const swiperSlide = Slide.slice(0, 10);
          const swiperSlide1 = Slide.slice(10, 18);
          const imgArr2 = imgArr.slice(10, 18);
          console.log("두번째", imgArr2);
          const slides = document.querySelectorAll(".swiper-slide");
          slides.forEach((item) => {
            if (item.innerHTML === "") {
              item.innerHTML = "Loding...";
            } else {
              item.innerHTML = "";
            }
          });

          sameNameItems.slice(0, 10).forEach((item, index) => {
            const swiperText = document.createElement("p");

            swiperSlide[index].style.backgroundImage = `url('./${imgArr[index]["이미지 경로"]}/${imgArr[index]["파일명"]}')`;
            swiperSlide[index].style.backgroundPositon = "center";
            swiperSlide[index].style.backgroundSize = "cover";
            swiperSlide[index].appendChild(swiperText);

            swiperText.textContent = item.BZ_NM; // 예시로 업소명을 텍스트로 추가
          });

          sameNameItems.slice(11, 20).forEach((item, index) => {
            // console.log('안에는안되나?', imgArr);
            const swiperText = document.createElement("p");
            swiperSlide1[index].style.backgroundImage = `url('./${imgArr2[index]["이미지 경로"]}/${imgArr2[index]["파일명"]}')`;
            swiperSlide1[index].style.backgroundPositon = "center";
            swiperSlide1[index].style.backgroundSize = "cover";
            swiperSlide1[index].appendChild(swiperText);

            swiperText.textContent = item.BZ_NM; // 예시로 업소명을 텍스트로 추가
          });

          // console.log("이미지", imgArr);
          // console.log("같은 업체명", sameNameItems);
        })

        .catch((error) => console.error(error));
    },
    error: function (xhr, status, error) {
      console.error("Error fetching data:", error);
    },
  });
});
