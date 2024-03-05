// 로그인 모달 열기
document.getElementById('loginButton').addEventListener('click', function() {
    document.getElementById('loginModal').style.display = 'block';
});

// 로그인 모달 닫기
document.getElementsByClassName('close2')[0].addEventListener('click', function() {
    document.getElementById('loginModal').style.display = 'none';
});

// 로그인 폼 제출
document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // 기본 동작 방지    
    var formData2 = new FormData(this); // 폼 데이터를 가져옴

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://yj4newproject.dothome.co.kr/login.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                alert(xhr.responseText); // 서버에서 반환된 메시지를 알림창으로 표시
                document.getElementById('loginModal').style.display = 'none'; // 모달창 닫기
            } else {
                console.error('에러 발생:', xhr.statusText);
            }
        }
    };
    xhr.onerror = function () {
        console.error('네트워크 상태가 이상합니다.');
    };
    xhr.send(formData2);
});
