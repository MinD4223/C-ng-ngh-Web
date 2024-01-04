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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="  sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A700"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A500%2C600%2C700%2C800"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat%3A500%2C600%2C700%2C800"/>
  <link rel="stylesheet" href="./styles/add_4_answer.css"/>
</head>
<body>
<div class="index">
    <?php
        include("header.php") ;
    ?>
    <?php
    // nhận id khóa học từ trang courses_of_admin 
        $flag=true;
        if (isset($_GET["id_courses"])) {
          $id_courses = $_GET["id_courses"];
          $_SESSION['id_courses'] = $id_courses;
        }else {
          $flag=false;
        }
    ?>
  <div class="auto-group-k445-dpy">
     <?php
            if($flag == false){
              echo '<script>
                     alert("Lỗi chưa xác định được trang mà bạn muốn truy cập");
                     location.href = "home.php";
                   </script>';

            }else{        

        ?>
    <div style="text-align: center;">
    	    <h1>Kết quả</h1>
    </div>
    <div style="font-size: 15px; margin: 0px 10%;" >
        <div>
            <a class="btn btn-primary btn-block" id="btn-add" href="listadd.php?id_courses=<?php echo $id_courses ?>" style="text-decoration: none ; margin: 10px 0 0 0">Trở lại</a>
        </div>
        <div style="text-align: center;">
            <img src="img/ex.jpg">
        </div>
        <div style="background: skyblue; font-size: 25px; margin:0 10%; font-family: Times New Roman;">
            <div>
                <?php
                    $point=$_SESSION['point'];  
                    $id=$_SESSION['id_user'];

                    $flag=false;
                    include("sql.php");
                    $sql="SELECT `id_user`, `user_account`, `user_full_name`, `password`, `role`, `point` FROM `user` WHERE `id_user`=$id"; 
                    $do1=mysqli_query($conn,$sql);
                    if(mysqli_num_rows($do1)>0){
                        while($row=mysqli_fetch_array($do1)) {
                            if($point>$row['point']){
                                $flag=true;
                            }
                        }
                    }
                    if($flag==true){
                        $sql_query="UPDATE `user` SET `point`='$point' WHERE `id_user`=$id"; 
                        $do2=mysqli_query($conn,$sql_query);
                    }
                ?>
            </div>
            <div>
                <?php
                    echo "Tên tài khoản: " ;
                    echo $_SESSION['user_full_name'];
                    echo "<br>";
                    echo "<br>";

                ?>
            </div>
        	<div>
                <?php 
                    echo "Điểm của bạn: " ;
                    echo $point;
                    echo "<br>";
                    echo "<br>";
                ?>
            </div>
            <div>
                <?php 
                    if($point<80){
                        echo "Bạn cần luyện tập lại để đạt điểm cao hơn ";
                    }elseif($point>=80){
                        echo "Chúc mừng bạn đã hoàn thành xuất sắc bài luyện tập";
                    }
                ?>
            </div>

        </div>
    </div>

 <?php 
            }
        ?>
    
  </div>
  <!-- body-page -->

<div class="auto-group-bf7j-LMK">
    <?php include("footer.php"); ?>
  </div>
</div>
</body>