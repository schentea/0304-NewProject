<?php
class SocialLoginRepository{
    // mysqli_connect
    private $con;

    public function __construct($con)
    {
        $this->con = $con;
    }

    public function findUserByEmail($email) {
      
        try{
            $sql = "select * from userInfo where uid='$email'";
            $result = mysqli_query($this->con, $sql);
            
            if(mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                echo("
            <script>
                console.log(`성공`)
            </script>
            ");
                return $row;
            }
            else {echo("
                <script>
                    console.log(`실패`)
                </script>
                ");
                
                return null;
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
    public function signup($profileModel, $state){
        try {
            //회원가입과 동일한 sql문 + login_div 추가해서 넣기
            $sql = "insert into userInfo(uid, pw, name, email, tel) ";
            $sql .= "values('$profileModel->email', '$profileModel->uid', '$profileModel->nickname', '$profileModel->email', '$profileModel->uid')";
            //쿼리 실행
            mysqli_query($this->con,$sql);
            //쿼리 종료
            mysqli_close($this->con);
            echo("
            <script>
                sessionStorage.setItem('username', '" . $profileModel->email . "');
                location.href = 'index.php';
            </script>
            ");
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }
}