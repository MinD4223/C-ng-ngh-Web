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
  <title>index</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A700"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A500%2C600%2C700%2C800"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat%3A500%2C600%2C700%2C800"/>
  <link rel="stylesheet" href="./styles/home.css"/>
  <link rel="stylesheet" href="./styles/header.css"/>
  
  
</head>
<body>
<div class="index">
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
    include("header.php") ;
  ?>

       

  <!-- navbar -->
  <!-- body-page -->
  <div class="auto-group-k445-dpy">
    <div class="auto-group-stm7-YS9">
      <p class="thng-tin-sjK">Thông tin</p>
      <p class="cho-mng-bn-n-vi-hnue-learning-o7B">Chào mừng bạn đến với HNUE-LEARNING</p>
      <p class="ni-gip-bn-hc-tp-vo-trao-i-kin-thc-vi-mi-ngi-cng-nhau-to-ra-cc-cu-hi-n-tp-kin-thc-scq">Nơi giúp bạn học tập vào trao đổi kiến thức với mọi người, cùng nhau tạo ra các câu hỏi để ôn tập kiến thức</p>
      <p class="h-thng-kha-hc-cung-cp-y-cc-kin-thc-v-lp-trnh-website-bao-gm--71P">Hệ thống khóa học cung cấp đầy đủ các kiến thức về lập trình website bao gồm:</p>
      <div class="auto-group-aixw-ndK">
        <div class="ellipse-1-iG5">
        </div>
        <p class="html-NrR">HTML</p>
      </div>
      <div class="auto-group-o2hj-Jk5">
        <div class="ellipse-2-Dc9">
        </div>
        <p class="css-h1X">CSS</p>
      </div>
      <div class="auto-group-dljr-E1T">
        <div class="ellipse-3-wgZ">
        </div>
        <p class="java-script-r2q">JAVA SCRIPT</p>
      </div>
      <a href="courses_of_role.php" class="auto-group-6qw5-Bau">BẮT ĐẦU</a>
    </div>
    <img class="rectangle-7-REM" src="./img/html-css-collage-concept-with-person.jpg"/>
  </div>
  <!-- body-page -->

  <div class="auto-group-bf7j-LMK">
    <?php include("footer.php"); ?>
  </div>
</div>
</body>