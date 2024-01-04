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
                add_question(); 
                add_del_answer();

        ?>
    <h1>DẠNG CÂU HỎI: Chọn một đáp án</h1>
    <a class="btn btn-primary btn-block" id="btn-add" href="listadd.php?id_courses=<?php echo $id_courses ?>" style="text-decoration: none ; margin: 10px 0 0 0">Trở lại</a>

    <form action="" method="POST" enctype="multipart/form-data">
    <div style="font-size: 15px; margin: 0px 10%;" >
        <div class="form-group">
            <label for="name_quiz"><span style="color: red;">*</span>Nhập tên câu hỏi</label>
            <input class="form-control" type="text" name="name_question" id="" placeholder="Vui lòng nhập câu hỏi" value="<?php echo isset($_POST['name_question'])?$_POST['name_question']:"" ?>">
        </div>
        
        
        <p>Nhập các lựa chọn và tích đáp án đúng</p>
                <?php
                    $n=$_SESSION['count_answers'];
                    for ($i = 1; $i <= $n; $i++) {
                        $ischecked=(isset($_POST['check_radio']) && $_POST['check_radio'] ==$i) ? "checked":"";
                        echo '<div style="margin: 20px 0 0 0;" class="input-group mb-3">';
                        echo '<div class="input-group-text"><input type="radio" name="check_radio" value="'.$i.'" '.$ischecked.'></div>';
                        ?>

                        <input name="<?php echo "text".$i;  ?>" type="text" class="form-control" placeholder="Nhập đáp án" value="<?php echo isset($_POST["text".$i])? $_POST["text".$i]:""; ?>">
                        <?php
                        echo '</div>';
                    }

                ?>    
                <input class="btn btn-primary btn-block" name="add_answer" type="submit" value="Thêm đáp án">  
                <input class="btn btn-primary btn-block" name="del_answer" type="submit" value="Xóa đáp án">   
                <input class="btn btn-primary btn-block" name="refresh" type="submit" value="Làm mới">                                
        <div style="margin: 20px 0 0 0;" class="d-grid">
            <input id="btn-add" class="btn btn-primary btn-block" name="add_question" type="submit" value="Thêm câu hỏi">
        </div>
    </div>
    </form>
    <?php 
        }
     ?>
            <?php 
            function add_del_answer(){
                $id_courses = $_GET["id_courses"];
                if(isset($_POST['add_answer'])){
                    $_SESSION['count_answers']+=1;
                    echo '<script>
                            location.href = "add_4_answer.php?id_courses='.$id_courses.'";
                        </script>';
                }
                if(isset($_POST['del_answer'])){
                    $_SESSION['count_answers']-=1;
                    echo '<script>
                            location.href = "add_4_answer.php?id_courses='.$id_courses.'";
                        </script>';
                }if(isset($_POST['refresh'])){
                    echo '<script>
                            location.href = "add_4_answer.php?id_courses='.$id_courses.'";
                        </script>';
                }
            }
            function add_question(){
                if(isset($_POST['add_question'])){
                    if($_POST["name_question"]!=""){
                        $flag=true;
                        $temp_answer="";
                        $temp_answer_correct="";
                        $n=$_SESSION['count_answers'];
                        for ($i = 1; $i <= $n; $i++) {
                            $text=$_POST["text".$i];
                            //Nối chuỗi đáp án với dấu / là dấu phân tách
                            $temp_answer=$temp_answer."/".$text;
                            if(isset($_POST['check_radio']) && $_POST['check_radio'] ==$i){
                                //Set đáp án đúng;
                                if($text!=""){
                                    $temp_answer_correct=$text;
                                }else{
                                    $flag=false;
                                }
                            }
                        }
                        //Kiểm tra đáp án đã tích có giá trị rỗng hay không
                        if($flag==true){
                            //Tách chuỗi để kiểm tra có tồn tại đáp án hay không
                            $temp_explode=explode("/",$temp_answer);
                            $flag1=false;
                            foreach ($temp_explode as $key) {
                                if($key!=""){
                                    $flag1=true;
                                }
                            }
                            //Kiểm tra có tồn tại đáp án hay không
                            if($flag1==true){
                                //Kiểm tra có đáp án đúng hay không
                                if($temp_answer_correct!=""){
                                    
                                    $id_courses = $_GET["id_courses"];

                                    $name_question=$_POST["name_question"];
                                    $type_question="Câu hỏi 1 đáp án";
                                    $answer=$temp_answer;
                                    $answer_correct=$temp_answer_correct;
                                    $courses=$id_courses; //Sau đổi thành id khóa học vào
                                    $author=$_SESSION['id_user'];
                                    $status="Chưa duyệt";
                                    if($_SESSION['role']=='admin'){
                                        $status="Đã duyệt";
                                    }

                                    include("sql.php");
                                    $sql_query ="INSERT INTO `question`(`name_question`, `type_question`, `answer`, `answer_correct`, `courses_id`,`author`, `status`) VALUES ('$name_question','$type_question','$answer','$answer_correct','$courses','$author','$status')";
                                        if ($conn->query($sql_query) === TRUE) {
                                                echo '<script>
                                                         alert("Thêm câu hỏi thành công");
                                                        location.href = "add_4_answer.php?id_courses='.$id_courses.'";
                                                    </script>';
                                        } else {
                                            echo "Lỗi: " . $conn->error;
                                        }
                                }else{
                                    echo '<div id="notification" class="alert alert-warning text-center" role="alert" style="font-size: 15px;  width:100%;">Vui lòng chọn đáp án đúng</div>';
                                }
                            }else{
                                echo '<div id="notification" class="alert alert-warning text-center" role="alert" style="font-size: 15px;  width:100%;">Vui lòng nhập đáp án</div>';
                            }
                        }else{
                           echo '<div id="notification" class="alert alert-warning text-center" role="alert" style="font-size: 15px;  width:100%;">Vui lòng nhập đáp án đã tích</div>';
                        }
                    }else{
                        echo '<div id="notification" class="alert alert-warning text-center" role="alert" style="font-size: 15px;  width:100%;">Vui lòng nhập câu hỏi</div>';
                    }
                }
            }
        ?>
        


    
  </div>
  <!-- body-page -->

<div class="auto-group-bf7j-LMK">
    <?php include("footer.php"); ?>
  </div>
</div>
</body>