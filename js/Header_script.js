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

const progressBars = document.querySelectorAll('.progressBar');

progressBars.forEach((progressBar) => {
    let progress = 0;
    const interval = 100; // 1초마다 증가하는 속도

    function updateProgressBar() {
        progress += 100 / (5000 / interval); // 5초 동안 바를 채우는 데 필요한 시간
        progressBar.style.width = progress + '%';

        if (progress >= 100) {
            // 바가 다 찼을 때 다음 이미지로 넘어감
            progress = 0;
            progressBar.style.width = '0';
            $('.carousel').carousel('next');
        }
    }

    // 바를 업데이트하는 타이머 설정
    setInterval(updateProgressBar, interval);
});
