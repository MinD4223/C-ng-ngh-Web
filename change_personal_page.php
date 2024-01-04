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
  <link rel="stylesheet" href="./styles/change_personal_page.css"/>
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
    <h1>Thay đổi thông tin cá nhân</h1>
    
    <form action="" method="POST" enctype="multipart/form-data">
          <div style="font-size: 15px; margin: 0px 10%;">
              <div class="form-group">
                  <input style="margin: 5px 0 0 0;" id="btn-add" class="btn btn-primary btn-block" name="btn-return" type="submit" value="Quay lại">
                  <?php
                    if (isset($_POST['btn-return'])) {
                        header("location: personal_page.php");
                    }
                  ?>
              </div>
              <div class="form-group">
                  <label for="name_quiz" style="font-weight: bold; color: #4f76fd;">Nhập tên tài khoản muốn thay đổi:</label>
                  <input class="form-control"  type="text" name="user_account" id=""
                   value="" placeholder="Vui lòng nhập tên tài khoản muốn thay đổi">
                   <input style="margin: 5px 0 0 0;" id="btn-add" class="btn btn-primary btn-block" name="btn-user-account" type="submit" value="Cập nhật thông tin thay đổi">
                   <?php
                      if (isset($_POST['btn-user-account'])) {
                          $id = $_SESSION['id_user'];
                          $user_account = $_POST['user_account'];
                          if (!empty($user_account)) {
                              $sql_modify_user_account = "UPDATE `user`
                                                          SET `user_account` = ('$user_account') 
                                                          WHERE `id_user` = $id";
                              if ($conn->query($sql_modify_user_account) === TRUE) {
                                  echo '<div class="alert alert-success text-center" role="alert">Thay đổi tên tài khoản thành công</div>';
                              }else {
                                  echo '<div class="alert alert-warning text-center" role="alert"Thay đổi tên tài khoản thất bại</div>';
                              }
                          }else {
                              echo '<div class="alert alert-warning text-center" role="alert">Vui lòng nhập tên đăng nhập muốn sửa</div>';
                          }
                          
                      }
                    ?>
              </div>
              
              <div class="form-group">
                  <label for="name_quiz" style="font-weight: bold; color: #4f76fd;">Nhập họ tên muốn thay đổi:</label>
                  <input class="form-control"  type="text" name="user_full_name" id=""
                  value="" placeholder="Vui lòng nhập họ tên muốn thay đổi">
                  <input style="margin: 5px 0 0 0;" id="btn-add" class="btn btn-primary btn-block" name="btn-user-full-name" type="submit" value="Cập nhật thông tin thay đổi">
                  <?php
                      if (isset($_POST['btn-user-full-name'])) {
                          $id = $_SESSION['id_user'];
                          $user_full_name = ucwords($_POST['user_full_name']);
                          if (!empty($user_full_name)) {
                              $sql_modify_user_full_name = "UPDATE `user`
                                                          SET `user_full_name` = ('$user_full_name') 
                                                          WHERE `id_user` = $id";
                              if ($conn->query($sql_modify_user_full_name) === TRUE) {
                                  echo '<div class="alert alert-success text-center" role="alert">Thay đổi tên người dùng thành công</div>';
                              }else {
                                  echo '<div class="alert alert-warning text-center" role="alert"Thay đổi tên người dùng thất bại</div>';
                              }
                          }else {
                              echo '<div class="alert alert-warning text-center" role="alert">Vui lòng nhập tên người dùng muốn sửa</div>';
                          }
                          
                      }
                    ?>
                </div>

              <div class="form-group">
                  <label for="name_quiz" style="font-weight: bold; color: #4f76fd;">Nhập mật khẩu muốn thay đổi:</label>
                  <input class="form-control"  type="text" name="password" id=""
                  value="" placeholder="Vui lòng nhập mật khẩu muốn thay đổi">
                  <input style="margin: 5px 0 0 0;" id="btn-add" class="btn btn-primary btn-block" name="btn-pass-word" type="submit" value="Cập nhật thông tin thay đổi">
                  <?php
                      if (isset($_POST['btn-pass-word'])) {
                          $id = $_SESSION['id_user'];
                          $password = md5($_POST['password']);
                          if (!empty($password)) {
                              $sql_modify_pass = "UPDATE `user`
                                                          SET `password` = ('$password') 
                                                          WHERE `id_user` = $id";
                              if ($conn->query($sql_modify_pass) === TRUE) {
                                  echo '<div class="alert alert-success text-center" role="alert">Thay đổi mật khẩu thành công</div>';
                              }else {
                                  echo '<div class="alert alert-warning text-center" role="alert"Thay đổi mật khẩu thất bại thất bại</div>';
                              }
                          }else {
                              echo '<div class="alert alert-warning text-center" role="alert">Vui lòng nhập mật khẩu muốn sửa</div>';
                          }
                          
                      }
                    ?>
                </div> 
                  <!-- // <div class="alert alert-warning text-center" role="alert">Thêm câu hỏi thất bại</div>
                  // <div class="alert alert-success text-center" role="alert">Thêm câu hỏi thành công</div> -->
              <!-- <div style="margin: 20px 0 0 0;" class="d-grid">
                  <input id="btn-add" class="btn btn-primary btn-block" name="btn" type="submit" value="Cập nhật thông tin thay đổi">
              </div> -->
          </div>
          </form>


    
  </div>
  <!-- body-page -->

  <div class="auto-group-bf7j-LMK">Nhóm  Công nghệ Web - Website học tập</div>
</div>
</body>