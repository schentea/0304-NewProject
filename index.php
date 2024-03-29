<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- 폰트어썸 -->
    <script
      src="https://kit.fontawesome.com/247e9f18da.js"
      crossorigin="anonymous"
    ></script>
    <!-- 부트스트랩 -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <script src="./js/jquery-2.2.4.min.js"></script>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>동성로</title>
    <!-- 캐러셀 -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <!-- 헤더 css -->
    <link rel="stylesheet" href="./css/Header_style.css" />
    <!-- 동성로 css -->
    <link rel="stylesheet" href="./css/Doungsung_style.css" />
    <!-- 맛집 css -->
    <link rel="stylesheet" href="./css/Good_foodlist_style.css" />
    <!-- 공연정보 css -->
    <link rel="stylesheet" href="./css/Show_section_style.css" />
    <!-- 유튜브 css -->
    <link rel="stylesheet" href="./css/Youtube_style.css" />
    <!-- 푸터 css -->
    <link rel="stylesheet" href="./css/Footer_style.css" />
    <!-- 회원가입 css -->
    <link rel="stylesheet" href="./css/Sign.css" />
    <!-- 공통 속성 css -->
    <link rel="stylesheet" href="./css/style.css" />
    <!-- 폰트 -->
    <link
      href="https://webfontworld.github.io/SCoreDream/SCoreDream.css"
      rel="stylesheet"
    />
    <link rel="icon" href="./image/logo.svg" />
  </head>
  <body>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const username = sessionStorage.getItem("username");
        const usernameWithoutDomain = username.replace(/@.*/, '');
        const loginButton = document.getElementById("loginButton");
        const openModalBtn = document.getElementById("openModalBtn");
        const between = document.getElementById("between");
        const ul = document.getElementById("rogin");
        
        if (usernameWithoutDomain) {
          if (usernameWithoutDomain === "schentea") {
            let user = createListItem("userinfo", `${usernameWithoutDomain.slice(0,2)}`);
            let user2 = document.createElement("li");;
            user2.classList.add("userinfoBig");
            user2.innerHTML = `<p>${usernameWithoutDomain.slice(0,2)}</p><p>${usernameWithoutDomain}</p>`
            user.addEventListener("click", function () {
              openAdminPage(usernameWithoutDomain);
            });
            user2.addEventListener("click", function () {
              openAdminPage(usernameWithoutDomain);
            });
            hideElements([loginButton, openModalBtn, between]);
            ul.appendChild(user);
            ul.appendChild(user2);
          } else {
            let user = createListItem("userinfo", `${usernameWithoutDomain.slice(0,2)}`);
            let user2 = document.createElement("li");;
            user2.classList.add("userinfoBig");
            user2.innerHTML = `<p>${usernameWithoutDomain.slice(0,2)}</p><p>${usernameWithoutDomain}</p>`
            // const logout = createListItem("logout", "로그아웃");
            // logout.addEventListener("click", function () {
            //   logoutUser();
            // });
            user.addEventListener("click", function () {
              openMyPage(usernameWithoutDomain);
            });
            user2.addEventListener("click", function () {
              openMyPage(usernameWithoutDomain);
            });
            hideElements([loginButton, openModalBtn, between]);
            ul.appendChild(user)
            ul.appendChild(user2)
          }
        } else {
          console.log("사용자가 존재하지 않습니다");
        }
      });

      function createListItem(className, text) {
        const li = document.createElement("li");
        li.classList.add(className);
        li.textContent = text;
        return li;
      }

      function hideElements(elements) {
        elements.forEach((element) => {
          element.style.display = "none";
        });
      }
      function openMyPage(username) {
        window.location.href = `http://dongseong.dothome.co.kr/showLikeList.html`;
      }
      function openAdminPage(username) {
        window.location.href = `http://dongseong.dothome.co.kr/adminPage.html`;
      }
      function logoutUser() {
        $.ajax({
          url: "http://dongseong.dothome.co.kr/logout.php",
          type: "POST",
          dataType: "json",
          success: function (response) {
            if (response.success) {
              sessionStorage.removeItem("username");
              window.location.reload();
            } else {
              alert(response.message);
            }
          },
          error: function (xhr, status, error) {
            console.error("AJAX 요청 중 오류 발생:", error);
          },
        });
      }
    </script>
    <!-- 헤더부분 -->
    <header class="sections">
      <!-- 헤더_안에있는 나브부분 -->
      <nav id="view_nav">
        <!-- 피시 나브 안에 왼쪽 로고 -->
        <div id="logo">
          <a href="#"><img src="./image/logo.svg" alt="logo" /></a>
        </div>
        <!-- 피시 나브 안에 중간부분 -->
        <div>
          <div id="xmark"><i class="fa-solid fa-xmark"></i></div>
          <ul id="gnb_menu" class="gnb_menu">
            <li><a href="#dongsungro">소개</a></li>
            <li><a href="#Good_foodlist">맛집</a></li>
            <li><a href="#Show_section">공연·전시</a></li>
            <li><a href="#youtube_section">유튜브</a></li>
          </ul>
        </div>
        <!-- 피시 나브 안에 우측 로그인부분 -->
        <div>
          <ul id="rogin" class="gnb_menu">
            <li id="loginButton">
              <a href="login_form.php" target="_self">로그인</a>
            </li>
            <span id="between"><span>|</span></span>
            <li id="openModalBtn">
              <a href="sign_form.php" target="_self">회원가입</a>
            </li>
          </ul>
        </div>
      </nav>
      <nav id="hidden_nav">
        <!-- 모바일 나브 안에 왼쪽 로고 -->
        <div id="hidden_logo"><img src="./image/logo.svg" alt="logo" /></div>
        <!-- 모바일 나브 안에 우측 토글버튼부분 -->
        <div id="toggle">
          <i class="fa-solid fa-bars"></i>
        </div>
      </nav>
      <!-- 헤더 안에 캐러셀부분 -->
      <div
        id="carouselExampleFade"
        class="carousel slide carousel-fade"
        data-bs-ride="carousel"
      >
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="./image/donsungro.png" class="d-block w-100" alt="..." />
            <div id="Header_title">
              <h2>문화의 중심지</h2>
              <h1>대구 동성로</h1>
            </div>
            <div class="progressBar"></div>
          </div>
          <div class="carousel-item">
            <img
              src="./image/head/donsungro2.jpg"
              class="d-block w-100"
              alt="..."
            />
            <div id="Header_title">
              <h2>젊은 기운이 살아 숨쉬는 도심의 가로광장</h2>
              <h1>대구 동성로</h1>
            </div>
            <div class="progressBar"></div>
          </div>
          <div class="carousel-item">
            <img
              src="./image/head/donsungro_bg5.jpg"
              class="d-block w-100"
              alt="..."
            />
            <div id="Header_title">
              <h2>대구의 대표 중심번화가</h2>
              <h1>동성로</h1>
            </div>
            <div class="progressBar"></div>
          </div>
        </div>
      </div>
      <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#carouselExampleFade"
        data-bs-slide="prev"
      >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#carouselExampleFade"
        data-bs-slide="next"
      >
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
      <!-- <video loop autoplay muted>
        <source src="./video/Headervideo2.mp4" type="video/mp4" />
      </video> -->
    </header>
    <!-- 동성로 소개부분 -->
    <section id="dongsungro" class="sections">
      <article>
        <!-- 동성로 소개 타이틀 -->
        <div class="scroHidden">
          <h3 style="color: #bbb" id="introH3" class="noSelec">
            <span class="redTxt">젊음</span>과
            <span class="redTxt">열정</span>의 거리
          </h3>
          <h2 class="bckTxt">동성로를 소개합니다</h2>
        </div>
        <!-- 동성로 사진 -->
        <div id="dongsungro_img_div">
          <img
            id="dongsungro_img"
            class="scroHidden blurImg scroBlur"
            src="./image/head/donsungro1.jpg"
            alt="동성로 메인 이미지"
          />
        </div>
        <!-- 동성로 소개 글 -->
        <div class="dongsungroTxt scroHidden noSelec">
          <h4>대구의 중심가</h4>
          <p>
            대구의 간판이자 중심삼권으로 동성로는 젊음의 열기가 느껴진다. 서울에
            명동이 있다면 대구는 동성로가 있다고 얘기할 수 있는 만큼 잘 조성
            되어 있는 곳이다. 공공디자인 사업으로 '테마가 있고 걷고 싶은 거리'
            가 생기면서 더 많은 사람들이 동성로를 찾는다.
          </p>
        </div>
        <div class="dongsungroTxt scroHidden noSelec">
          <h4>문화와 축제의 거리, 동성로</h4>
          <p>
            동성로에서는 매년 5월 지역 문화와 지역 산업이 함께 호흡하는 동성로
            축제도 개최하고 있다. 1990년 첫 막을 올린 이 축제는 21세기에
            들어서면서 대구·경북 젊음의 거리 동성로에 방문한 여러 나라
            사람들에게 한국문화의 전통성과 우수성을 알리고 있다.
          </p>
        </div>
      </article>
    </section>
    <!-- 맛집 목록 -->
    <section id="Good_foodlist" class="sections">
      <!-- 맛집 모달 -->
      <div id="foodModal" class="foodmodal">
        <div class="foodmodal-content">
          <div class="foodclose"><i class="fa-solid fa-xmark"></i></div>
          <div class="imgbox"></div>
          <div class="textbox">
            <div id="foodname"></div>
            <p id="foodname2"></p>
          </div>
          <div class="foodIcons">
            <div class="foodCarIcon">
              <i class="fa-solid fa-car"></i>
              <p></p>
            </div>
            <div class="foodBookIcon">
              <i class="fa-solid fa-book-open"></i>
              <p></p>
            </div>
            <div class="foodToyIcon">
              <i class="fa-solid fa-shapes"></i>
              <p></p>
            </div>
          </div>
          <div class="textbox2">
            <h5><i class="fa-solid fa-location-crosshairs"></i></h5>
            <p id="foodadr"></p>
          </div>
          <div class="textbox2">
            <h5><i class="fa-solid fa-phone"></i></h5>
            <p id="foodnum"></p>
          </div>
          <div class="textbox2">
            <h5><i class="fa-regular fa-clock"></i></h5>
            <p id="foodtime"></p>
          </div>
          <div class="foodMenusWrap"></div>
        </div>
      </div>
      <!-- 컨테이너-->
      <div id="container">
        <!-- 제목 -->
        <div id="foodTitWrap">
          <h3 class="scroHidden noSelec">
            <span class="redTxt">맛집</span>
            <span class="bckTxt">핫플레이스</span>
          </h3>
          <h2 class="scroHidden noSelec">
            <span class="bckTxt">놓치면 안될</span>
            <span class="redTxt">식당 투어</span>
          </h2>
        </div>

        <!-- 위쪽 공간 -->
        <h4 class="scroHidden noSelec">입을 즐겁게 해주는 맛집 여행</h4>
        <div id="up_container" class="scroHidden">
          <!-- 왼쪽 메세지 박스부분 -->
          <div class="balloon noSelec" id="balloon1">
            입을 즐겁게 해주는 맛집 여행
            <div><i class="fa-solid fa-utensils"></i> <i class="fa-solid fa-wine-glass wine"></i></div>
          </div>
          <!-- 오른쪽 캐러셀 부분 -->
          <div class="swiper mySwiper">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <div class="spinner-border text-danger" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="spinner-border text-danger" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="spinner-border text-danger" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="spinner-border text-danger" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="spinner-border text-danger" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="spinner-border text-danger" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="spinner-border text-danger" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="spinner-border text-danger" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="spinner-border text-danger" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
              </div>
              <div class="swiper-slide left">
                <div class="spinner-border text-danger" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
              </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
          </div>
        </div>
        <!-- 아래쪽 공간 -->
        <h4 class="scroHidden noSelec">동성로만의 특별한 먹거리를 만나보세요</h4>
        <div id="down_container" class="scroHidden" dir="rtl">
          <!-- 왼쪽 캐러셀 부분 -->
          <div class="swiper mySwiper">
            <div id="leftSlide" class="swiper-wrapper">
              <div class="swiper-slide right">
                <div class="spinner-border text-danger" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="spinner-border text-danger" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="spinner-border text-danger" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="spinner-border text-danger" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="spinner-border text-danger" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="spinner-border text-danger" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="spinner-border text-danger" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="spinner-border text-danger" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
              </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
          </div>
          <!-- 오른쪽 메시지 박스 부분 -->
          <div class="balloon noSelec" id="balloon2">
            동성로만의 특별한 먹거리를 만나보세요<br />
            <div><i class="fa-solid fa-fish-fins"></i><i class="fa-solid fa-drumstick-bite meet"></i></div>
          </div>
        </div>
      </div>
    </section>
    <!-- 공연 정보 -->
    <section id="Show_section" class="sections">
      <div id="Show_container">
        <!-- Show 타이틀 -->
        <div id="show_title_div" class="noSelec">
          <h3 class="scroHidden"><span class="redTxt">문화</span>와의 만남</h3>
          <h2 class="scroHidden">
            기억에 남을 <span class="redTxt">공연·전시</span>
          </h2>
        </div>
        <!-- 왼쪽 이미지 -->
        <div id="main_img_div" class="scroHidden">
          <div id="show_left_img_div">
            <!-- 위 -->
            <div id="show_left1" class="uip blurImg scroBlur">
              <p class="showImgName showLeName">아트플러스씨어터</p>
              <div id="showBlack">
                <p>
                  공연 목록 보러가기 <i class="fa-solid fa-chevron-right"></i>
                </p>
              </div>
            </div>
            <!-- 아래 -->
            <div id="show_left2" class="uip blurImg scroBlur">
              <p class="showImgName showLeName">라이크디즈 위드</p>
              <div id="showBlack">
                <p>
                  공연 목록 보러가기 <i class="fa-solid fa-chevron-right"></i>
                </p>
              </div>
            </div>
          </div>
          <!-- 오른쪽 이미지 -->
          <div id="show_right_img_div" class="blurImg scroBlur">
            <p class="showImgName">대구 콘서트하우스</p>
            <div id="showBlack">
              <p>
                공연 목록 보러가기 <i class="fa-solid fa-chevron-right"></i>
              </p>
            </div>
          </div>
        </div>
      </div>
      <!-- 아트 모달 -->
      <div id="showModal3" class="showModal">
        <div id="showModalIn3" class="showModalIn">
          <div id="showModalImg3" class="showModalImg">
            <div id="showModalClose3">
              <i class="fa-solid fa-xmark fa-lg"></i>
            </div>
          </div>
          <h4>아트플러스씨어터</h4>
          <p>
            관객과 소통할 수 있고, 휴머니즘이 있는 연극과 뮤지컬을 상연하는
            소극장입니다. 공연 기획, 제작, 신인 작가와 창작 작품 발굴 등 다양한
            분야에서 활동하고 있습니다.
          </p>
          <p>
            <i class="fa-solid fa-location-crosshairs"></i> 대구광역시 중구
            공평동 16-11
          </p>
          <p>
            <a href="https://artplustheater.modoo.at/" target="_blank"
              ><i class="fa-solid fa-house-chimney"></i> 홈페이지</a
            >
          </p>
          <ul id="showModalList3" class="showModalList">
            <div class="spinner-border text-danger" role="status"></div>
          </ul>
        </div>
      </div>
      <!-- 라이크 모달 -->
      <div id="showModal2" class="showModal">
        <div id="showModalIn2" class="showModalIn">
          <div id="showModalImg2" class="showModalImg">
            <div id="showModalClose2">
              <i class="fa-solid fa-xmark fa-lg"></i>
            </div>
          </div>
          <h4 >라이크디즈 위드</h4>
          <p>
            예술과 문화를 진정으로 즐기고 향유하는 창작자와 소비자를 위한
            곳입니다. 동성로에서만 볼 수 있는 감성 넘치는 작품들을 관람하고
            소장할 수 있는 공간을 제공합니다.
          </p>
          <p>
            <i class="fa-solid fa-location-crosshairs"></i> 대구광역시 중구
            동덕로8길 40-18
          </p>
          <p>
            <a href="https://likethiz.com/" target="_blank"
              ><i class="fa-solid fa-house-chimney"></i> 홈페이지</a
            >
          </p>
          <ul id="showModalList2" class="showModalList">
            <div class="spinner-border text-danger" role="status"></div>
          </ul>
        </div>
      </div>
      <!-- 콘서트하우스 모달 -->
      <div id="showModal1" class="showModal">
        <div id="showModalIn1" class="showModalIn">
          <div id="showModalImg1" class="showModalImg">
            <div id="showModalClose1">
              <i class="fa-solid fa-xmark fa-lg"></i>
            </div>
          </div>
          <h4 >대구 콘서트하우스</h4>
          <p>
            대구콘서트하우스는 1975년 개관한 유서깊은 종합 공연장으로,
            대구시립예술단인 대구시립합창단, 대구시립교향악단이 상주하고
            있습니다.
          </p>
          <p>
            <i class="fa-solid fa-location-crosshairs"></i> 대구광역시 중구
            태평로 141
          </p>
          <p>
            <a href="https://www.daeguconcerthouse.or.kr/" target="_blank"
              ><i class="fa-solid fa-house-chimney"></i> 홈페이지</a
            >
          </p>
          <ul id="showModalList1" class="showModalList">
            <div class="spinner-border text-danger" role="status"></div>
          </ul>
        </div>
      </div>
    </section>
    <!-- 동성로 유튜브 -->
    <section id="youtube_section" class="sections">
      <div id="youtube_container">
        <!-- 유튜브 타이틀 -->
        <div id="youtube_title">
          <h3 class="scroHidden noSelec">
            <span class="bckTxt">트렌드를</span>
            <span class="redTxt">한눈에!</span>
          </h3>
          <h2 class="scroHidden noSelec">
            <span class="redTxt"
              ><i class="fa-brands fa-youtube" style="color: #eb102c"></i
              >유튜브</span
            ><span class="bckTxt">로 동성로 살펴보기</span>
          </h2>
        </div>
        <div id="Main_Grid" class="popupModalVideo scroHidden"></div>
        <div class="video_modal_popup">
          <div class="video_modal_popup-closer"></div>
        </div>
      </div>
    </section>
    <!-- 푸터 -->
    <footer class="sections">
      <img src="./image/logo.svg" alt="logo" onclick="multiShoot()" />
      <!-- 제일위  -->
      <div id="footer_container">
        <div id="footer_top">
          <p style="font-weight: bold" class="noSelec">관련 사이트</p>
          <a href="https://thegoodnight.daegu.go.kr/kr/" target="_blank">
            <p>더굿나잇</p>
          </a>
          <a href="https://tour.daegu.go.kr/" target="_blank">
            <p>대구트립로드</p>
          </a>
          <a href="https://www.daegufood.go.kr/" target="_blank">
            <p>대구푸드</p>
          </a>
          <a href="http://www.daegucvb.com/mice/main/" target="_blank">
            <p>컨벤션뷰로</p>
          </a>
          <a href="https://github.com/schentea/0304-NewProject">
          깃허브
        </a>
        </div>
        
        <div id="footer_mid" class="noSelec">
          <p>
            <b>대구광역시 시청</b>&nbsp;&nbsp; 대구광역시 중구 공평로 88(동인동
            1가) | TEL: 053-803-2896(일반민원) | FAX: 053-803-2879
          </p>
        </div>
      </div>
    </footer>
    <div id="topWrap" class="none">
      <div id="topBtn1" class="topBtn">
        <a href="#"><i class="fa-solid fa-chevron-up"></i>TOP</a>
      </div>
      <div id="topBtn2" class="topBtn">
        <p>1330</p>
        여행<br />상담
      </div>
    </div>
    <!-- 헤더 스크립트 -->
    <script src="./js/Header_script.js"></script>
    <!-- 공연 -->
    <script src="./js/show.js" type="module"></script>
    <!-- api -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.2/dist/confetti.browser.min.js"></script>

    <script src="./js/youtube.js"></script>
    <!-- <script src="./js/Sign.js"></script>
    <script src="./js/Login.js"></script> -->
    <script src="./js/Api.js" type="module"></script>
    <!-- 스크롤 애니메이션 -->
    <script src="./js/wheelAni.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- 맛집모달 -->
    <!-- Bootscrap -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <!-- Initialize Swiper -->
    <script>
      var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        speed: 1000,
        breakpoints: {
          600 : {
            slidesPerView: 2,
          },
          800: {
            slidesPerView: 3,
          },
        },
        autoplay: {
          delay: 3000,
        },
      });
    </script>
    <!-- 폭죽 -->
    <script>
      function multiShoot() {
        var end = Date.now() + 300;
        var colors = ['#eb102c', '#ffffff'];

        function shootConfetti() {
          confetti({
            particleCount: 20,
            angle: 60,
            spread: 55,
            origin: { x: 0, y:0.7 },
            colors: colors
          });
          confetti({
            particleCount: 10,
            angle: 120,
            spread: 55,
            origin: { x: 1, y:0.7 },
            colors: colors
          });

          if (Date.now() < end) {
            requestAnimationFrame(shootConfetti);
          }
        }

        shootConfetti();
        }
    </script>
  </body>
</html>
