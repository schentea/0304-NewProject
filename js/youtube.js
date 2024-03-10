// fetch(
//   "https://youtube.googleapis.com/youtube/v3/search?part=snippet&maxResults=20&q=%EB%8C%80%EA%B5%AC%20%EB%8F%99%EC%84%B1%EB%A1%9C&type=video&videoDefinition=high&videoEmbeddable=true&videoSyndicated=true&key=AIzaSyDtRc2E1eLwf9L_bokvQYZ5dVKYZExNGNc"
// )
//   .then((res) => res.json())
//   .then((data) => {
//     const words = [
//       "위험",
//       "동성로 말고",
//       "25년",
//       "또간집",
//       "초라해진",
//       "흉물",
//       "클럽",
//       "2007년",
//       "밤거리",
//       "망함?",
//       "판슥",
//       "랜덤플레이댄스",
//       "탄핵",
//       "쳐직",
//       "이준석",
//       "핫플🔥?!",
//       "3차 먹방",
//       "임영웅",
//     ];
//     const youtube = data?.items
//       ?.filter(
//         (item) => !words.some((keyword) => item.snippet.title.includes(keyword))
//       )
//       .slice(0, 5);
//     console.log(youtube);
//     document.querySelector("#youtube_container #Main_Grid").innerHTML = youtube
//       .map(
//         (tube) =>
//           `<div><iframe width="100%" height="100%" src="https://www.youtube.com/embed/${tube.id.videoId};controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe></div>`
//       )
//       .join("");
//   });

// document.addEventListener("scroll", () => {
//   const start = document.querySelector("#introH2");
//   const top = document.querySelector("#topWrap");
//   if (start.getBoundingClientRect().top - window.innerHeight + 50 <= 0) {
//     top.classList.remove("none");
//   } else top.classList.add("none");
// });

// document.querySelector("#topBtn2").addEventListener("click", () => {
//   window.open(
//     "https://1330chat.visitkorea.or.kr:3000/#/ttalk_main/CHAT1330_160635739001093018/_0200_0200_LUIS",
//     "_blank",
//     "width=500,height=700"
//   );
// });
