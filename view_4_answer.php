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
  
  
  <!-- body-page -->
  <div class="auto-group-k445-dpy">
    <?php
            if($flag == false){
              echo '<script>
                     alert("Lỗi chưa xác định được trang mà bạn muốn truy cập");
                     location.href = "home.php";
                   </script>';

            }elseif($flag==true){        
                view();

        ?>
    <h1>DẠNG CÂU HỎI: 1 đáp án</h1>
    <a class="btn btn-primary btn-block" id="btn-add" href="listadd.php?id_courses=<?php echo $id_courses ?>" style="text-decoration: none ; margin: 10px 0 0 0">Trở lại</a>
    <form action="" method="POST" enctype="multipart/form-data">
    <div style="font-size: 15px; margin: 0px 10%;" > 
        <div class="form-group">
            <label for="name_quiz"><span style="color: red;"></span>Tên câu hỏi</label>
            <input class="form-control" type="text" name="name_question" id="" placeholder="Vui lòng nhập câu hỏi" value="<?php echo isset($_POST['name_question'])?$_POST['name_question']:"" ?>" readonly>
        </div>
    
        
        <p>Các lựa chọn và đáp án đúng</p>
        <?php 
            question_answer();
        ?>

        <?php 
            }
        ?>
        
       <?php
                function view(){
                    include("sql.php");
                    $sql_query="SELECT `id_question`, `name_question`, `type_question`, `answer`, `answer_correct`, `courses_id`, `status` FROM `question`";
                    $do=mysqli_query($conn,$sql_query);
                    if(mysqli_num_rows($do)>0){
                        while($row=mysqli_fetch_array($do)) {   
                            if($row['id_question']==$_SESSION['view']){
                                $_POST['name_question']=$row['name_question'];

                                $answer=explode("/",$row['answer']);
                                $count=0;
                                $answer_correct=$row['answer_correct'];

                                foreach($answer as $key){
                                    if($key!=""){
                                        $count+=1; //Kiểm tra rỗng của đáp án;
                                        $answer_array[]=$key; //Thêm các đáp án vào mảng
                                    }
                                }
                                $_SESSION['count_answers']=$count; //Set số đáp án hiển thị;
                                for ($i=1; $i <=$count ; $i++) { 
                                    $_POST["text".$i]=$answer_array[$i-1];
                                        if($answer_correct==$answer_array[$i-1]){
                                            $_POST[$i]="checked";    
                                    }
                                }
                            }
                        }
                    }
                }
                function question_answer(){
                    $n=$_SESSION['count_answers'];
                    for ($i = 1; $i <= $n; $i++) {
                    $ischecked = (isset($_POST[$i])) ? "checked" : "";

                    echo '<div style="margin: 20px 0 0 0;" class="input-group mb-3">';
                    echo '<div class="input-group-text"><input type="radio" name="'.$i.'" value="'.$i.'" '.$ischecked.' readonly></div>';
                                    ?>

                    <input name="<?php echo "text".$i;  ?>" type="text" class="form-control" placeholder="Nhập đáp án" value="<?php echo isset($_POST["text".$i])? $_POST["text".$i]:""; ?>" readonly>
                                    <?php
                    echo '</div>';
                    }
                }
        ?>

    </div>

    </form>

    
  </div>
  <!-- body-page -->

  <div class="auto-group-bf7j-LMK">
    <?php include("footer.php"); ?>
  </div>
</div>
</body>