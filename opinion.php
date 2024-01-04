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
    	    <h1>Đóng góp ý kiến</h1>
    </div>
    <div style="font-size: 15px; margin: 0px 10%;" >
        <form method="post">
        <div>
            <a style="width: 50pt; height: 20pt; font-size: 10pt; font-family: Arial;" class="btn btn-primary btn-block" href="home.php">Trở lại</a>
        </div>
        
        <div>
            <table class="table table-striped">
                <tr>
                    <td>STT</td>
                    <td>Ý kiến</td>
                    <td>Tác giả</td>
                    <td>Trạng thái</td>
                    <td>Thao tác</td>
                </tr>
            <?php 
                    $id_user=$_SESSION['id_user'];
                    $i=0;
                    include("sql.php");
                    if($_SESSION['role']=='admin'){
                        $sql_query="SELECT `id_opinion`, `id_user`, `opinion`, `status` FROM `opinion`";
                    }elseif($_SESSION['role']=='student'){
                        $sql_query="SELECT `id_opinion`, `id_user`, `opinion`, `status` FROM `opinion` WHERE `id_user`=$id_user";
                    }


                    $do=mysqli_query($conn,$sql_query);
                    if(mysqli_num_rows($do)>0){
                        while($row=mysqli_fetch_array($do)) {
                            $id_temp=$row['id_user'];
                            $sql_temp="SELECT `id_user`, `user_account`, `user_full_name`, `password`, `role`, `point` FROM `user` WHERE `id_user`=$id_temp";
                            $do_temp=mysqli_query($conn,$sql_temp);
                            $row_temp=mysqli_fetch_array($do_temp);

                            $id=$row['id_opinion'];
                            $i++;
            ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row['opinion']; ?></td>
                    <td><?php echo $row_temp['user_full_name'];?></td>
                    <td><?php echo $row['status']; ?></td>  
                    <td>
                        <?php
                            echo '<input class="btn btn-primary btn-block" type="submit" name="del'.$id.'" value="Xóa" >';
                            echo " ";
                            if($_SESSION['role']=="admin" && $row['status']=="Chưa duyệt"){
                                echo '<input class="btn btn-primary btn-block" type="submit" name="submit'.$id.'" value="Duyệt" >';
                            }
                        ?>
                        <?php 
                            if(isset($_POST["del".$id])){
                                $sql1="DELETE FROM `opinion` WHERE `id_opinion`=$id";
                                if ($conn->query($sql1) === TRUE) {
                                   echo '<script>
                                            alert("Xóa thành công");
                                            location.href = "opinion.php";
                                          </script>';
                                } else {
                                  echo "Lỗi: " . $conn->error;
                                }
                            }
                            if(isset($_POST["submit".$id])){
                                $sql2="UPDATE `opinion` SET `status`='Đã duyệt' WHERE `id_opinion`=$id";
                                if ($conn->query($sql2) === TRUE) {
                                   echo '<script>
                                            alert("Duyệt thành công");
                                            location.href = "opinion.php";
                                          </script>';
                                } else {
                                  echo "Lỗi: " . $conn->error;
                                }
                            }
                         ?>   
                     </td>    
                </tr>
            <?php
                        }
                    }
            ?>
            </table>
        </div>
        <div style="margin: 10% 0; background: lightblue; font-family: Arial; text-align: center;">
                <h2>Nhập đóng góp ý kiến</h2>
                <div>
                    <input type="text" name="text_opinion" placeholder="Nhập đóng góp ý kiến" size="50">
                </div>
                <div>
                    <input class="btn btn-primary btn-block" type="submit" name="submit_opinion" value="Gửi" >
                    <?php 
                        if(isset($_POST['submit_opinion'])){
                            if($_POST['text_opinion']!=""){
                                $name=$_POST['text_opinion'];
                                $status="Chưa duyệt";
                                $sql0="INSERT INTO `opinion`( `id_user`, `opinion`, `status`) VALUES ('$id_user','$name','$status')";
                                if ($conn->query($sql0) === TRUE) {
                                   echo '<script>
                                            alert("Đóng góp ý kiến thành công");
                                            location.href = "opinion.php";
                                          </script>';
                                } else {
                                  echo "Lỗi: " . $conn->error;
                                }
                            }else{
                                echo '<script>
                                        alert("Vui lòng nhập ý kiến");
                                    </script>';
                            }
                        }    
                    ?>
                </div>
        </div>
        </form>
    </div>


    
  </div>
  <!-- body-page -->

  <div class="auto-group-bf7j-LMK">
    <?php include("footer.php"); ?>
  </div>
</div>
</body>