$(document).ready(function () {
    $('.owl-carousel').owlCarousel({
        loop: true, // 무한 루프 설정
        margin: 10, // 이미지 간격 설정
        nav: true, // 네비게이션 활성화
        responsive: {
            0: {
                items: 2, // 화면이 0px 이상일 때 1개씩 보이도록 설정
            },
            768: {
                items: 2, // 화면이 600px 이상일 때 3개씩 보이도록 설정
            },
            1024: {
                items: 3, // 화면이 1000px 이상일 때 5개씩 보이도록 설정
            },
        },
    });
});
