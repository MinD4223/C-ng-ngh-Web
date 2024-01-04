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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="	sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A700"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A500%2C600%2C700%2C800"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat%3A500%2C600%2C700%2C800"/>
  <link rel="stylesheet" href="./styles/personal_page.css"/>
</head>
<body>
<div class="index">
  <!-- navbar -->
  <?php
    include("header.php") ;
  ?>
  <!-- navbar -->
  
  <!-- body-page -->
  <div class="auto-group-k445-dpy">
    <h1>Thông tin cá nhân</h1>

    <form action="" method="POST" enctype="multipart/form-data">
          <div style="font-size: 15px; margin: 0px 10%;">
              <?php
                  $id = $_SESSION['id_user'];
                  $sql_info = "SELECT `user_account`, `user_full_name` FROM `user` WHERE `id_user` = $id ";
                  $user_account = "";
                  $user_full_name = "";
                  
                  $do = mysqli_query($conn, $sql_info);
                  while ($row = mysqli_fetch_array($do)) {
                      $user_account = $row['user_account'];
                      $user_full_name = $row['user_full_name'];
                  }
              ?>
              <div class="form-group">
                  <input style="margin: 5px 0 0 0;" id="btn-add" class="btn btn-primary btn-block" name="btn-return" type="submit" value="Quay lại">
                  <?php
                    if (isset($_POST['btn-return'])) {
                        header("location: home.php");
                    }
                  ?>
              </div>
              
              <div class="form-group">
                  <label for="name_quiz">Họ tên người dùng:</label>
                  <input class="form-control" value="<?php echo $user_full_name?>" readonly  type="text" name="dang_cau_hoi" id="">
              </div>

              <div class="form-group">
                <label for="name_quiz">Tên tài khoản:</label>
                <input class="form-control" value="<?php echo $user_account?>" readonly  type="text" name="dang_cau_hoi" id="">
              </div>

                
              <div style="margin: 20px 0 0 0;" class="d-grid">
                  <input id="btn-add" class="btn btn-primary btn-block" name="btn" type="submit" value="Thay đổi thông tin">
              </div>
             
          </div>
          </form>
          <?php
            if (isset($_POST['btn'])) {
                header("location: change_personal_page.php");
            }
          ?>

    
  </div>
  <!-- body-page -->

  <div class="auto-group-bf7j-LMK">Nhóm Công nghệ Web - Website học tập</div>
</div>
</body>