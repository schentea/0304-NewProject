const xmark = document.getElementById('xmark');
const toggle = document.getElementById('toggle');
const viewNav = document.getElementById('view_nav');
toggle.addEventListener('click', function () {
    viewNav.style.right = '0'; // 수정된 부분: 오른쪽으로 이동하지 않도록 값 변경
});

xmark.addEventListener('click', function () {
    viewNav.style.right = '-100%'; // 수정된 부분: 헤더 바깥으로 나가도록 값 변경
});

// 메인캐러셀

// 로딩중
// const slides = document.querySelectorAll('.swiper-slide');
// slides.forEach((item, index) => {
//     console.log('아템', item.innerHTML === '');
//     if (item.innerHTML === '') {
//         item.innerHTML = 'Loding...';
//     } else {
//         item.innerHTML = '';
//     }
// });
