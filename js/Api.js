async function fetchData() {
  try {
    const response = await fetch("http://localhost/test/api.php");
    const data = await response.json();

    const food = data.restaurantData;
    console.log("맛집 정보:", food);

    const event = data.eventData;
    console.log("이벤트 정보:", event);
  } catch (error) {
    console.error("Error fetching data:", error);
  }
}

window.onload = fetchData;
