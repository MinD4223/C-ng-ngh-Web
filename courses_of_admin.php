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
  <link rel="stylesheet" href="./styles/courses_of_admin.css"/>
</head>
<body>
<div class="index">
  
  <?php
    include("header.php") ;
  ?>
  <?php 
        if($_SESSION['role']=="admin"){
    ?>
  <h1>KHÓA HỌC</h1>
  <!-- body-page -->



  <form action="" method="POST" enctype="multipart/form-data">
        <div style="font-size: 15px; margin: 0px 10%;">
            <div class="form-group">
                <input style="padding: 10px 20px;" id="btn-add" class="btn btn-primary btn-block" name="btn-return" type="submit" value="Thêm khóa học">
                <?php
                    if (isset($_POST['btn-return'])) {
                        header("location: add_courses.php");
                    }
                ?>
            </div>         
        </div>
    </form>

  <div class="auto-group-k445-dpy">

  <?php
    $sql_courses = "SELECT `id_courses`, `name_courses`, `image_courses` FROM `courses`";
    $_SESSION["id_courses"] = "";
    $result = $conn->query($sql_courses);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $_SESSION["id_courses"] = $row["id_courses"];
    ?>
                    <div class="item">
                        <div class="item-all">
                            <img src="./img/<?php echo $row['image_courses']?>" class="item-avatar" alt="Course Image">
                            <div class="item-content">
                                <h5 class="item-title"><?php echo $row['name_courses']; ?></h5>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <a class="btn btn-primary btn-block" id="btn-add" href="listadd.php?id_courses=<?php echo $row["id_courses"]?>" 
                                    style="text-decoration: none ; margin: 10px 0 0 0">Truy cập</a>
                                    <!-- Thẻ truy cập để đưa admin đến danh sách các câu hỏi kèm theo id khóa học -->
                                    <a class="btn btn-primary btn-block" id="btn-add" href="add_student_courses.php?id_courses=<?php echo $row["id_courses"]?>" 
                                    style="text-decoration: none; margin: 10px 0 0 0">Thêm sinh viên</a>  

                                </form>
                                <?php
                                    
                                ?>
                            </div>
                        </div>
                    </div>
            
    <?php
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