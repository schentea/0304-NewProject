<?php
require_once 'const.php'; // NetworkInfo 클래스가 있는 파일을 포함합니다.

class SocialLoginRepository {
    private $con;

    public function __construct() {
        $this->con = mysqli_connect(NetworkInfo::$HOST, NetworkInfo::$USER, NetworkInfo::$PASSWORD, NetworkInfo::$DB);

        if (mysqli_connect_errno()) {
            throw new Exception("Failed to connect to MySQL: " . mysqli_connect_error());
        }
    }

    public function findUserByEmail($email) {
        try {
            $sql = "select * from userInfo where uid='$email'";
            $result = mysqli_query($this->con, $sql);
            
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                echo("<script>console.log(`성공`)</script>");
                return $row;
            } else {
                echo("<script>console.log(`실패`)</script>");
                return null;
            }
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    public function signup($profileModel, $state) {
        try {
            $sql = "insert into userInfo(uid, pw, name, email) ";
            $sql .= "values('$profileModel->email', '$profileModel->uid', '$profileModel->nickname', '$profileModel->email')";
            mysqli_query($this->con, $sql);
            mysqli_close($this->con);
            echo("
            <script>
                sessionStorage.setItem('username', '" . $profileModel->email . "');
                location.href = 'index.php';
            </script>
            ");
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }
}
?>
