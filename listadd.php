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
  <link rel="stylesheet" href="./styles/listadd.css"/>
</head>
<body>
<div class="index">
  
  <?php
      include("header.php") ;
      include("sql.php");
  ?>
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
  <!-- navbar -->
  
  <!-- body-page -->
  <div class="auto-group-k445-dpy">
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

      <h1>KHÓA HỌC: 
      <?php if (isset($name_courses)) {
                              echo $name_courses[0];}
                          else { echo "Chưa xác định";} 
      ?>
      </h1>
      <?php 
        if($flag1 == false || $flag2 == false){
          echo '<script>
                 alert("Lỗi chưa xác định được khóa học mà bạn muốn truy cập");
                 location.href = "home.php";
               </script>';
        }elseif($flag1==true&&$flag2==true){
          
      ?>
      <?php 

      ?>
    <div class="dropdown">
        <div class="them-khoa-hoc" href="#">Thêm câu hỏi</div>
        <div class="dropdown-content">
            <a href="add_text_answer.php?id_courses=<?php echo $id_courses ?>" id="cau-1">Câu hỏi dạng điền</a>
            <a href="add_4_answer.php?id_courses=<?php echo $id_courses ?>" id="cau-2">Câu hỏi dạng chọn 1 đáp án</a>
            <a href="add_many_answer.php?id_courses=<?php echo $id_courses ?>" id="cau-3">Câu hỏi dạng chọn nhiều đáp án</a>
        </div>
    </div>
    <a class="them-khoa-hoc" href="exercise.php?id_courses=<?php echo $id_courses ?>">Luyện tập</a>
    <a class="them-khoa-hoc" href="courses_of_role.php">Trở lại</a>
    <div class="danhsachcauhoi">DANH SÁCH CÂU HỎI</div>  
    <div class="d-flex flex-wrap flex-column align-items-center" style="padding: 0;margin: 0 0 0 0; ">
      <table  class="table table-striped" style="font-size: 13pt; font-family: arial;">
          <tr>
              <th>STT</th>
              <th>Tên câu hỏi</th>
              <th>Khóa học</th>
              <th>Loại câu hỏi</th>
              <th>Tác giả</th>
              <th>Trạng thái</th>
              <th>Thao tác</th> 
          </tr>
            <?php

                  $order_x=0;
                  $sql_query="SELECT `id_question`, `name_question`, `type_question`, `answer`, `answer_correct`, `courses_id`,`author`, `status` FROM `question` WHERE `courses_id`=$id_courses";
                  $do=mysqli_query($conn,$sql_query);
                  if(mysqli_num_rows($do)>0){
                    while($row=mysqli_fetch_array($do)) {
                    if($row['author']==$_SESSION['id_user']||$_SESSION['role']=="admin"){
                        $order_x++;
                        $temp=$row['author'];
                        $sql_name_user = "SELECT `id_user`, `user_account`, `user_full_name`, `password`, `role`, `point` FROM `user` WHERE `id_user`=$temp";
                        $result_user = mysqli_query($conn, $sql_name_user);
                        $name_user = mysqli_fetch_array($result_user);                  
              ?>
          <tr>
              <td ><?php echo $order_x; ?></td>
              <td ><?php echo $row['name_question']; ?></td>
              <td ><?php echo $name_courses[0]; ?></td>
              <td ><?php echo $row['type_question']; ?></td>
              <td ><?php echo $name_user['user_full_name']; ?></td>
              <td ><?php echo $row['status']; ?></td>
              <td>
                <form method="post" >
                  <div>
                    <input class="btn btn-primary btn-block" name="<?php echo "view".$row['id_question']; ?>" type="submit" value="Xem trước">
                  <?php
                    if($_SESSION['role']=="admin"){
                    ?>
                    <input class="btn btn-primary btn-block" name="<?php echo "del".$row['id_question']; ?>" type="submit" value="Xóa">
                    <?php 
                      if($row['status']=="Chưa duyệt"){  
                    ?>
                    <input class="btn btn-primary btn-block" name="<?php echo "status".$row['id_question']; ?>" type="submit" value="Duyệt">
                    <?php
                          } 
                        }
                      }
                    ?>
                  </div>
                </form>
              </td>
            <?php
                  $id=$row['id_question'];
                  $name=$row["name_question"];
                  if(isset($_POST["view".$id])){
                     if($row['type_question']=="Câu hỏi nhiều đáp án"){
                        $_SESSION['view']=$id;
                        echo '<script>
                                location.href = "view_many_answer.php?id_courses='.$id_courses.'";
                            </script>';
                     }elseif($row['type_question']=="Câu hỏi 1 đáp án"){
                        $_SESSION['view']=$id;
                        echo '<script>
                                location.href = "view_4_answer.php?id_courses='.$id_courses.'";
                            </script>';
                     }elseif($row['type_question']=="Câu hỏi điền"){
                        $_SESSION['view']=$id;
                        echo '<script>
                                location.href = "view_text_answer.php?id_courses='.$id_courses.'";
                            </script>';
                     }
                  }
                  elseif(isset($_POST["del".$id])){
                      $sql1="DELETE FROM `question` WHERE id_question=$id";
                        if ($conn->query($sql1) === TRUE) {
                            echo '<script>
                                    alert("Xóa câu hỏi '.$name.' thành công");
                                    location.href = "listadd.php?id_courses='.$id_courses.'";
                                  </script>';
                        } else {
                            echo "Lỗi: " . $conn->error;
                        }
                  }elseif(isset($_POST["status".$id])){
                      $sql2=" UPDATE `question` SET `status`='Đã duyệt' WHERE id_question=$id";
                        if ($conn->query($sql2) === TRUE) {
                            echo '<script>
                                    alert("Duyệt câu hỏi '.$name.' thành công");
                                    location.href = "listadd.php?id_courses='.$id_courses.'";
                                  </script>';
                        } else {
                            echo "Lỗi: " . $conn->error;
                        }
                  }
              }
            }
            ?>

            <?php 
             }
             ?>
          </tr>
      </table>
    </div>
    
  </div>
  <!-- body-page -->

  <div class="auto-group-bf7j-LMK">
    <?php include("footer.php"); ?>
  </div>
</div>
</body>