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
  <link rel="stylesheet" href="./styles/add_text_answer.css"/>
</head>
<body>
<div class="index">
 
  <?php
    include("header.php") ;
  ?>
  <div class="auto-group-k445-dpy">
    <?php 
        if($_SESSION['role']=="admin"){
     ?>
    <h1>Thêm khóa học</h1>
        <div>
            <a style="width: 50pt; height: 20pt; font-size: 10pt; font-family: Arial;" class="btn btn-primary btn-block" href="courses_of_role.php">Trở lại</a>
        </div>

    <form action="" method="POST" enctype="multipart/form-data">
          <div style="font-size: 15px; margin: 0px 10%;">
              <div class="form-group">
                  <label for="name_quiz"><span style="color: red;">*</span>Nhập tên khóa học</label>
                  <input class="form-control"  type="text" name="ten_khoa_hoc" id=""
                   value="" >
              </div>
              <div class="form-group">
                  <label for="name_quiz">Ảnh cho Khóa học</label>
                  <input class="form-control"  type="file" name="file_tai_len" id="">
              </div>
              
                  <!-- // <div class="alert alert-warning text-center" role="alert">Thêm câu hỏi thất bại</div>
                  // <div class="alert alert-success text-center" role="alert">Thêm câu hỏi thành công</div> -->

              <div style="margin: 20px 0 0 0;" class="d-grid">
                  <input id="btn-add" class="btn btn-primary btn-block" name="btn" type="submit" value="Thêm khóa học">
              </div>
             
          </div>
          </form>
          <?php
            if (isset($_POST['btn'])) {
                $name_courses = $_POST['ten_khoa_hoc'];
                $img = basename($_FILES['file_tai_len']['name']); // basename để xóa các đường dẫn
                $link_file = "img/".$img;
                $imageFileType = strtolower(pathinfo($link_file,PATHINFO_EXTENSION)); // lấy đuôi file

                if (empty($name_courses)) {
                    echo '<div class="alert alert-warning text-center" role="alert">Vui lòng nhập tên khóa học</div>';
                }else {
                    if($_FILES["file_tai_len"]["size"] > 0) {
                        if ($imageFileType == "jpg") {
                            if (move_uploaded_file($_FILES["file_tai_len"]["tmp_name"], $link_file)) {
                                $sql1 = "INSERT INTO `courses` (`name_courses`, `image_courses`) 
                                        VALUES ('$name_courses', '$img')";
                                if ($conn->query($sql1) === TRUE) {
                                  echo '<script>
                                            alert("Thêm khóa học thành công");
                                            location.href = "add_courses.php";
                                        </script>';
                                }else {
                                  echo "Lỗi: ".$conn->error;
                                }
                            }else {
                              echo '<div class="alert alert-warning text-center" role="alert">Thêm khóa học không thành công</div>';
                            }
                        }else {
                          echo '<div class="alert alert-warning text-center" role="alert">File phải có đuôi là jpg</div>';
                        }
                    }else {
                        echo '<div class="alert alert-warning text-center" role="alert">File không tồn tại</div>';
                    }
                }
            }
          ?>
    <?php 
      }else{
        echo '<script>
                     alert("Lỗi chưa xác định được trang mà bạn muốn truy cập");
                     location.href = "home.php";
                   </script>';
      }
     ?>
    
  </div>
  <!-- body-page -->

<div class="auto-group-bf7j-LMK">
    <?php include("footer.php"); ?>
  </div>
</div>
</body>