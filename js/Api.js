$(document).ready(function () {
  $.ajax({
    url: "http://yj4newproject.dothome.co.kr/api.php",
    method: "GET",
    dataType: "json",
    success: function (data) {
      const food = data.restaurantData;
      console.log("맛집 정보:", food);

      const event = data.eventData;
      console.log("이벤트 정보:", event);
    },
    error: function (xhr, status, error) {
      console.error("Error fetching data:", error);
    },
  });
});
