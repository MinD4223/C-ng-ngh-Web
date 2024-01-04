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
  <div class="logo">
      <img class="rectangle-3-7N5" src="./logo/logo.png"/>
      <p class="hnue-learning-3Fj">HNUE - LEARNING</p>
      <p class="creative-dedicated-YCV">Creative-Dedicated</p>
  </div>
  <div id="main">
    <div class="form">
        <h2>Đăng nhập</h2>
        <form method="post" action="">
            <div class="input-form">
                <span>Tên người dùng</span>
                <input type="text" name="user_name" placeholder="Vui lòng nhập tên người dùng" value="<?php echo isset($_POST["register"]) && $_POST["user_name"] != "" ? $_POST["user_name"] : "";?>">
                <?php if (isset($_POST["register"]) && $_POST["user_name"] == "") {
                        echo '<div id="notification" class="alert alert-warning text-center" role="alert">Vui lòng nhập tên đăng nhập của bạn</div>';
                }?>
            </div>
            <div class="input-form">
                <span>Mật khẩu</span>
                <input type="password" name="pass_word" id="password" placeholder="Vui lòng nhập mật khẩu">
                <?php if (isset($_POST["register"]) && $_POST["password"] == "") {
                        echo '<div id="notification" class="alert alert-warning text-center" role="alert">Vui lòng nhập mật khẩu của bạn</div>';
                }?>
            </div>
            <div class="input-form">
                <p>Bạn chưa có tài khoản? <a href="signup.php">Đăng ký</a></p>
            </div>
            <input type="submit" value="Đăng nhập" name="login" id="submit-form">
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
          if (isset($_POST["login"])) {
              $login_name = $_POST["user_name"];
              $login_password = $_POST["pass_word"];
              $id_user = "";  
            
              if (empty($login_name) || empty($login_password)) {
                  echo '<div id="notification" class="alert alert-warning text-center" role="alert">Đăng ký không thành công</div>';
                  $_SESSION['login'] = false;
              }else {
                  $sql = "SELECT `id_user`, `user_account`,`user_full_name`,`password`, `role` FROM `user`";
                  $do = mysqli_query($conn, $sql);
                  $flag = false; // flag để kiểm tra đăng nhập
                  $encode_login_pass_word = md5($login_password);


                  while ($row = mysqli_fetch_array($do)) {
                        if ($login_name == $row['user_account'] && $encode_login_pass_word == $row['password']) {
                            $id_user = $row['id_user'];
                            $flag = true;
                            $role = $row['role'];
                            $user_full_name=$row['user_full_name'];
                        }
                  }

                  if ($flag == true) {
                        $_SESSION['id_user'] = $id_user;
                        $_SESSION['login'] = true;
                        $_SESSION['role'] = $role;
                        $_SESSION['user_full_name']=$user_full_name;
                        header("location: home.php");
                  }else {
                        echo '<div id="notification" class="alert alert-warning text-center" role="alert">Tài khoản hoặc mật khẩu chưa đúng vui lòng kiển tra lại</div>';
                        $_SESSION['login'] = false;
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