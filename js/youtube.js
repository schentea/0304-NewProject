// fetch("https://youtube.googleapis.com/youtube/v3/search?part=snippet&maxResults=30&q=%EB%8C%80%EA%B5%AC%20%EB%8F%99%EC%84%B1%EB%A1%9C&type=video&videoDefinition=high&videoEmbeddable=true&videoSyndicated=true&key=AIzaSyCQQflyO0tAoDpSR2wnLzHKGKoDgZSopRU")
//   .then((res) => res.json())
//   .then((data) => {
//     const words = ["위험", "동성로 말고", "25년", "또간집", "초라해진", "흉물", "클럽", "2007년", "밤거리", "망함?", "판슥", "랜덤플레이댄스", "탄핵", "쳐직", "이준석", "핫플🔥?!", "3차 먹방", "임영웅", "당일치기 코스 추천♥️"];
//     const youtube = data?.items?.filter((item) => !words.some((keyword) => item.snippet.title.includes(keyword))).slice(0, 5);
//     document.querySelector("#youtube_container #Main_Grid").innerHTML = youtube.map((tube) => `<a data-video="${tube.id.videoId}"><img src="${tube.snippet.thumbnails.high.url}" /></a>`).join("");

//     // 클릭 이벤트 바인딩
//     $(".popupModalVideo a").click(function () {
//       const videoId = $(this).data("video");
//       console.log("Video ID:", videoId);
//       $(".video_modal_popup").addClass("reveal"), $(".video_modal_popup .video-wrapper").remove(), $(".video_modal_popup").append("<div class='video-wrapper'><iframe width='560' height='315' src='https://youtube.com/embed/" + videoId + "?rel=0&playsinline=1' allow='autoplay; encrypted-media' allowfullscreen></iframe></div>");

//       // 비디오가 로드된 후 재생 시작
//       setTimeout(() => {
//         $("iframe").get(0).contentWindow.postMessage('{"event":"command","func":"playVideo","args":""}', "*");
//       }, 1000);
//     });
//   });

// // 팝업 닫기 이벤트 처리
// $(".video_modal_popup-closer").click(function () {
//   $(".video_modal_popup .video-wrapper").remove(), $(".video_modal_popup").removeClass("reveal");
// });

const title = document.getElementById("youtube_title");
const grid = document.getElementById("Main_Grid");
const section = document.getElementById("youtube_section");

if (grid.getElementsByTagName("a").length === 0) {
  // title의 display 속성을 none으로 설정
  title.style.display = "none";
  // section의 높이를 0으로 설정
  section.style.height = "0";
}
