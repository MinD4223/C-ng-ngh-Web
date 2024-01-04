
<div class="auto-group-kjof-tmb">
    <a href="home.php">
      <img class="rectangle-4-6mB" src="./logo/logo_chuan-removebg-preview.png"/>
    </a>
    <div class="group-3-ntu">
      <a class="trang-ch-K89" href="home.php">Trang chủ</a>
      <a class="kha-hc-Bw3" href="courses_of_role.php">Khóa học</a>
      <a class="xp-hng-uc9" href="rank.php">Xếp hạng</a>
    </div>
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
    if (empty($_SESSION['login']) || empty($_SESSION['id_user'])) {
        header("location: login.php");
    }else {
      # code...
      $id = $_SESSION['id_user'];
      $sql = "SELECT `user_full_name` FROM `user` WHERE `id_user` = $id";
      $do = mysqli_query($conn, $sql);
      $name = "";
      while($row = mysqli_fetch_array($do)){
          $name = $row['user_full_name'];
      }
    }
    ?>

    <?php

      if (isset($_SESSION['login'])  && $_SESSION['login'] == true) {
          echo '<div class="dropdown">
                  <div class="auto-group-c6dj-p6q">'.$name.'</div>
                  <div class="dropdown-content">
                      <a href="personal_page.php" id="infor">Thông tin cá nhân</a>
                      <a href="opinion.php">Đóng góp ý kiến</a>
                      <a href="logout.php" id="logout">Đăng xuất</a>
                  </div>
              </div>';
      }else {
            header("location: login.php");
      }
    ?>

    <?php 
    if(!isset($_SESSION['courses'])){
      $_SESSION['courses']="";
    }
    if(!isset($_SESSION['count_answers'])){
      $_SESSION['count_answers']=4;
    }
    if(!isset($_SESSION['view'])){
      $_SESSION['view']="";
    }
    if(!isset($_SESSION['role'])){
      $_SESSION['role']="student";
    }
    if(!isset($_SESSION['user_full_name'])){
      $_SESSION['user_full_name']="";
    }
    if(!isset($_SESSION['point'])){
      $_SESSION['point']=0;
    }

    ?>
    
</div>