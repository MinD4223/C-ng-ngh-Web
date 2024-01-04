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
  <!-- navbar -->
  <?php
    include("header.php") ;
  ?>

  <!-- navbar -->
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
    <h1>DẠNG CÂU HỎI: Điền một đáp án</h1>
    <a class="btn btn-primary btn-block" id="btn-add" href="listadd.php?id_courses=<?php echo $id_courses ?>" style="text-decoration: none ; margin: 10px 0 0 0">Trở lại</a>

    <form action="" method="POST" enctype="multipart/form-data">
          <div style="font-size: 15px; margin: 0px 10%;">
              <div class="form-group">
                  <label for="name_quiz"><span style="color: red;">*</span>Nhập tên câu hỏi</label>
                  <input class="form-control" type="text" name="name_question" id="" placeholder="Vui lòng nhập câu hỏi" value="<?php echo isset($_POST['name_question'])?$_POST['name_question']:"" ?>">
              </div>
              <div style='margin: 20px 0 0 0;' class='input-group mb-3'>   
                  <input name='answer' type='text' class='form-control' placeholder='Nhập đáp án'value="<?php echo isset($_POST['answer'])?$_POST['answer']:"" ?>">
              </div>  
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
                   if(isset($_POST['refresh'])){
                        $id_courses = $_GET["id_courses"];
                        echo '<script>
                                location.href = "add_text_answer.php?id_courses='.$id_courses.'";
                            </script>';
                    }
                  }

                   function add_question(){
                    if(isset($_POST['add_question'])){
                      if($_POST["name_question"]!=""){
                        if($_POST["answer"]!=""){
                            $id_courses = $_GET["id_courses"];

                            $name_question=$_POST["name_question"];
                            $type_question="Câu hỏi điền";
                            $answer="";
                            $answer_correct=$_POST["answer"];
                            $courses=$id_courses; 
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
                                            location.href = "add_text_answer.php?id_courses='.$id_courses.'";
                                          </script>';
                                  } else {
                                    echo "Lỗi: " . $conn->error;
                                  }
                        }else{
                          echo '<div id="notification" class="alert alert-warning text-center" role="alert" style="font-size: 15px;  width:100%;">Vui lòng nhập đáp án</div>';
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