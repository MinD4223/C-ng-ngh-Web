
<?php
  session_start();// thêm sinh viên vào khóa học tương ứng mà admin chọn
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
  <link rel="stylesheet" href="./styles/add_student_courses.css"/>
</head>
<body>
<div class="index">
  
  <?php
      include("header.php") ;
  ?>
  <!-- navbar -->
  
  <!-- body-page -->
  <div class="auto-group-k445-dpy">
    <?php
    // nhận id khóa học từ trang courses_of_admin 
        $flag1=true;
        $flag2=true;
        if (isset($_GET["id_courses"])) {
          $id_courses = $_GET["id_courses"];
          $_SESSION['id_courses'] = $id_courses;
        }else {
          $flag1=false;
        }
    ?>
    <?php
    //Lấy ra tên khóa học
       if(isset($id_courses)){
        $sql_name_courses = "SELECT `name_courses` FROM `courses` WHERE `id_courses` = $id_courses ";
        $result = mysqli_query($conn, $sql_name_courses);
        $name_courses = mysqli_fetch_array($result);

       }else{
          $flag2=false;
       }
    ?>
    <h1>KHÓA HỌC: <?php if (isset($name_courses)) {
                              echo $name_courses[0];}
                          else { echo "Chưa xác định";} 
      ?></h1>
    <?php 
        if($flag1 == false || $flag2 == false){
          echo '<script>
                 alert("Lỗi chưa xác định được khóa học mà bạn muốn truy cập");
                 location.href = "home.php";
               </script>';
        }elseif($flag1==true&&$flag2==true){
          
      ?>
    <a class="them-khoa-hoc" href="courses_of_role.php">Trở lại</a>
        
    <form action="" method="POST" enctype="multipart/form-data">
          <div class="form-group">
              <label for="name_quiz"><span style="color: red;">*</span>Nhập tên ID sinh viên muốn thêm vào khóa học</label>
              <input class="form-control"  type="text" name="id_sinh_vien" id="btn-add"
                   value="" >
              <input  class="btn btn-primary btn-block" name="btn" type="submit" value="Thêm sinh viên">
          </div>
    </form>
    <?php
        if (isset($_POST['btn'])) {
            $id_add = $_POST['id_sinh_vien'];
            $sql_temp = "SELECT `id_user_courses`, `user_id`, `courses_id` FROM `user_courses` ";// lấy dữ liệu bảng user
            $do_temp = mysqli_query($conn, $sql_temp);
            $flag_temp = true; // cờ kiểm tra trùng tài khoản
            while ($row_temp = mysqli_fetch_array($do_temp)) {
                if ($id_add == $row_temp['user_id'] && $id_courses==$row_temp['courses_id']) {
                    $flag_temp = false;
                }
            }
            if($flag_temp==true){
              echo '<script>
                     alert("Thêm sinh viên thành công");
                     location.href = "add_student.php?id_user='.$id_add.'";
                   </script>';
            }else{
              echo '<script>
                     alert("Lỗi tài khoản đã có trong khóa học");
                   </script>';
            }
        }
    ?>
    <?php
      // dùng session để tạo thông báo khi thêm thành công
      if (isset($_SESSION['add'])&& $_SESSION['add'] == true) {
          echo '<div id="notification" class="alert alert-success text-center" role="alert">Thêm thành công ID: '.$_SESSION['student_add'].'</div>';
          $_SESSION['add'] == false;
      } 
    ?>

    <div class="danhsachcauhoi">DANH SÁCH SINH VIÊN</div>
     

    <div class="d-flex flex-wrap flex-column align-items-center" style="padding: 0;margin: 0 0 0 0; ">
      <table id="table"  class="table table-striped" style="font-size: 13px;font-family:  Montserrat, 'Source Sans Pro';">
          <tr>
              <th>ID khóa học</th> 
              <th>ID sinh viên</th>
              <th>Tên tài khoản</th>
              <th>Tên sinh viên</th>
              <th>Thao tác</th> 
          </tr>
          
          <?php
              $sql_add = "SELECT `id_user`, `user_account`, `user_full_name`, `id_user_courses` 
                          FROM `user` JOIN `user_courses` ON `user`.`id_user` = `user_courses`.`user_id` 
                          WHERE `user_courses`.`courses_id` = $id_courses;";
              $do = mysqli_query($conn, $sql_add);
              if (mysqli_num_rows($do) > 0) {                 
                  while ($row = mysqli_fetch_array($do)) {
          ?>
          <tr>
              <td><?php echo $id_courses?></td> 
              <td><?php echo $row['id_user']?></td>
              <td><?php echo $row['user_account']?></td>
              <td><?php echo $row['user_full_name']?></td>
              <td>
                  <a class="btn btn-primary btn-block" id="btn-add" href="delete_student.php?id_user_courses=<?php echo $row['id_user_courses']?>" 
                        style="text-decoration: none; margin: 1px 0 0 ">Xóa</a>
              </td> 
          </tr>          
          <?php
                }
              }
          ?>

     <?php 
             }
             ?>          
          
                   
              
          
      </table>
    </div>
  </div>
  
  
  <!-- body-page -->


<div class="auto-group-bf7j-LMK">
    <?php include("footer.php"); ?>
  </div>
</div>


</body>
