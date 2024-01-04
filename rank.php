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
  <link rel="stylesheet" href="./styles/listadd.css"/>
</head>
<body>
<div class="index">
    <?php
        include("header.php") ;
    ?>
  <div class="auto-group-k445-dpy">
    <div style="text-align: center;">
    	    <h1>Bảng xếp hạng</h1>
    </div>
    <div style="font-size: 15px; margin: 0px 10%;" >
        <div>
            <a style="width: 50pt; height: 20pt; font-size: 10pt; font-family: Arial;" class="btn btn-primary btn-block" href="home.php">Trở lại</a>
        </div>
        <div style=" background: lightblue;">
            <?php
                $id=$_SESSION['id_user'];
                include("sql.php");
                $sql="SELECT `id_user`, `user_account`, `user_full_name`, `password`, `role`, `point` FROM `user` WHERE `id_user`=$id"; 
                $do1=mysqli_query($conn,$sql);
                if(mysqli_num_rows($do1)>0){
                    while($row=mysqli_fetch_array($do1)) {
                    echo "Điểm cao nhất của bạn hiện tại: ".$row['point'];
                        if($row['point']<80){
                            echo "<br>Bạn cần đạt trên 80 điểm để xếp hạng";
                        }
                    }
                }
            ?>
        </div>
        <div>
            <table class="table table-striped">
                <tr>
                    <td>STT</td>
                    <td>Tên người dùng</td>
                    <td>Điểm</td>
                </tr>
            <?php 
                include("sql.php");
                    $sql_query="SELECT `id_user`, `user_account`, `user_full_name`, `password`, `role`, `point` FROM `user` WHERE `point` >= 80 order by `point` DESC LIMIT 10";
                    $i=0;
                    $do=mysqli_query($conn,$sql_query);
                    if(mysqli_num_rows($do)>0){
                        while($row=mysqli_fetch_array($do)) {
                            $i++;
            ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['user_full_name']; ?></td>
                    <td><?php echo $row['point']; ?></td>    
                </tr>
            <?php
                        }
                    }
            ?>
            </table>
        </div>
        

    </div>


    
  </div>
  <!-- body-page -->

  <div class="auto-group-bf7j-LMK">
    <?php include("footer.php"); ?>
  </div>
</div>
</body>