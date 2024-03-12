document.addEventListener('scroll', () => {
    for (let p of document.querySelectorAll('.scroHidden')) {
        if (p.getBoundingClientRect().top - window.innerHeight + 50 <= 0) {
            p.classList.add('scroVisible');
        } else {
            p.classList.remove('scroVisible');
        }
    }

    for (let p of document.querySelectorAll('.blurImg')) {
        if (p.getBoundingClientRect().top - window.innerHeight + 150 <= 0) {
            p.classList.remove('scroBlur');
        } else p.classList.add('scroBlur');
    }

    if (document.querySelector('#introH3').getBoundingClientRect().top - window.innerHeight <= 0) {
        document.querySelector('#topWrap').classList.remove('none');
    } else document.querySelector('#topWrap').classList.add('none');
});

document.querySelector('#topBtn2').addEventListener('click', () => {
    window.open(
        'https://1330chat.visitkorea.or.kr:3000/#/ttalk_main/CHAT1330_160635739001093018/_0200_0200_LUIS',
        '_blank',
        'width=450,height=700,top=100,left=200'
    );
});
