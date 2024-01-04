<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="	sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat%3A600%2C700"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A400%2C600%2C700"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Barlow+Condensed%3A400"/>
  <link rel="stylesheet" href="./styles/login-signup.css"/>
</head>
<body>
<div class="login-n4u">
  <div>
      <img class="rectangle-3-7N5" src="./logo/logo.png"/>
      <p class="hnue-learning-3Fj">HNUE - LEARNING</p>
      <p class="creative-dedicated-YCV">Creative-Dedicated</p>
  </div>
  <div id="main">
    <div class="form">
        <h2>Đăng ký</h2>
        <form method="post" action="">
            <div class="input-form">
                <span>Tên người dùng</span>
                <input type="text" name="user_name" placeholder="Vui lòng nhập tên người dùng" value="<?php echo isset($_POST["register"]) && $_POST["user_name"] != "" ? $_POST["user_name"] : "";?>">   
                <?php if (isset($_POST["register"]) && $_POST["user_name"] == "") {
                        echo '<div id="notification" class="alert alert-warning text-center" role="alert">Vui lòng nhập tên đăng nhập của bạn</div>';
                }?> 
            </div>
            <div class="input-form">
                <span>Họ tên đầy đủ</span>
                <input type="text" name="full_name" placeholder="Vui lòng nhập họ và tên" value="<?php echo isset($_POST["register"]) && $_POST["full_name"] != "" ? $_POST["full_name"] : "";?>" >
                <?php if (isset($_POST["register"]) && $_POST["full_name"] == "") {
                        echo '<div id="notification" class="alert alert-warning text-center" role="alert">Vui lòng nhập họ và tên đầy đủ trước khi đăng ký</div>';
                }?>
            </div>
            <div class="input-form">
                <span>Mật khẩu</span>
                <input type="password" placeholder="Vui lòng nhập mật khẩu" name="pass_word" value="<?php echo isset($_POST["register"]) && $_POST["pass_word"] != "" ? $_POST["pass_word"] : "";?>">
                <?php if (isset($_POST["register"]) && $_POST["pass_word"] == "") {
                        echo '<div id="notification" class="alert alert-warning text-center" role="alert">Vui lòng nhập mật khẩu trước khi đăng ký</div>';
                    }
                    ?>
            </div>
            <div class="input-form">
                <span>Nhập lại mật khẩu</span>
                <input type="password" name="re_pass_word" placeholder="Vui lòng nhập lại mật khẩu" value="<?php echo isset($_POST["register"]) && $_POST["re_pass_word"] != "" ? $_POST["re_pass_word"] : "";?>" >
                <?php if (isset($_POST["register"]) && $_POST["re_pass_word"] == "") {
                        echo '<div id="notification" class="alert alert-warning text-center" role="alert">Vui lòng nhập lại xác nhận mật khẩu trước khi đăng ký</div>';
                        }?>
            </div>
            <div class="input-form">
                <p>Bạn chưa có tài khoản? <a href="login.php">Đăng nhập</a></p>
            </div>
            <input type="submit" value="Đăng ký" name="register" id="submit-form">
        </form>
        
        <?php
             $DB_HOST = 'localhost';
             $DB_USER = 'root';
             $DB_PASS = '';
             $DB_NAME = '7_project_k71'; 
         
             $conn=mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME) or die("Không thể kết nối tới cơ sở dữ liệu");
                 if($conn){
                     mysqli_query($conn,"SET NAMES 'utf8'");
                 }else{
                     echo "Bạn đã kết nối thất bại";
                 }
         
        ?>        

        <?php
            if (isset($_POST["register"])) {
                $user_name = $_POST["user_name"]; // tên đăng nhập
                $full_name = ucwords($_POST["full_name"]); // tên đầy đủ
                $pass_word = $_POST["pass_word"]; // mật khẩu
                $re_pass_word = $_POST["re_pass_word"]; 

                if (empty($user_name) || empty($full_name) || empty($pass_word) || empty($re_pass_word)) {
                    echo '<div id="notification" class="alert alert-warning text-center" role="alert">Đăng ký không thành công</div>';
                }else {
                    if (strlen($pass_word) >= 6) {
                        $sql = "SELECT `id_user`, `user_account`, `user_full_name`, `password`, `role`, `point` FROM `user`";// lấy dữ liệu bảng user
                        $do = mysqli_query($conn, $sql);
                        $flag = true; // cờ kiểm tra trùng tài khoản
        
                        while ($row = mysqli_fetch_array($do)) {
                            if ($user_name == $row['user_account']) {
                                $flag = false;
                            }
                        }
        
                        if ($flag == true) {
                            if ($pass_word == $re_pass_word) {      
                                $encode_pass_word = md5($pass_word); // mã hóa mật khẩu
                                $sql1 = "INSERT INTO `user` (`id_user`,`user_account`, `user_full_name`, `password`, `role`, `point`) 
                                            VALUES ('null', '$user_name', '$full_name', '$encode_pass_word', 'student', 'null' )";
                                if ($conn->query($sql1) === TRUE) {
                                    echo'<script>
                                            alert("Đăng ký thành công");
                                            location.href = "login.php";
                                        </script>';
                                }else {
                                    echo "Lỗi". $conn->error;
                                }
                            }else {
                                echo '<div id="notification" class="alert alert-warning text-center" role="alert">Đăng ký không thành công</div>';
                            }
                        }else {
                            echo '<div id="notification" class="alert alert-warning text-center" role="alert">Tên đăng nhập đã tồn tại vui lòng dùng tên khác</div>';
                        }
                    }else {
                        echo '<div id="notification" class="alert alert-warning text-center" role="alert">Mật khẩu phải lớn hơn 6 ký tự</div>';
                    }
                }
                
               

            }
        ?>

    </div>
  </div>
</div>
<div class="auto-group-bf7j-LMK">
    <?php include("footer.php"); ?>
  </div>
</body>