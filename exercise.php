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
<body onload="start()";>
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
  <!-- navbar -->
  
  <!-- body-page -->
  <div class="auto-group-k445-dpy">
    <?php
            if($flag == false){
              echo '<script>
                     alert("Lỗi chưa xác định được trang mà bạn muốn truy cập");
                     location.href = "home.php";
                   </script>';

            }else{        

        ?>
    <h1>Luyện tập</h1>
    <div>
        <a class="btn btn-primary btn-block" id="btn-add" href="listadd.php?id_courses=<?php echo $id_courses ?>" style="text-decoration: none ; margin: 10px 0 0 0">Trở lại</a>
    </div>
    <!-- Thời gian làm bài -->
    <div style="text-align: center; font-size: 15pt; margin: 0px 10% ; background: orangered;" >
        <div>
            <strong>
                Thời gian <br/>
            </strong>
           
        </div>
         
        <div>
            <span id="h">Giờ</span> :
            <span id="m">Phút</span> :
            <span id="s">Giây</span>
        </div>

        <script>
            var h = 0; // Giờ
            var m = 5; // Phút
            var s = 0; // Giây     
            var timeout = null; // Timeout
            function start(){
                // Nếu số giây = -1 tức là đã chạy ngược hết số giây, lúc này:
                //  - giảm số phút xuống 1 đơn vị
                //  - thiết lập số giây lại 59
                if (s === -1){
                    m -= 1;
                    s = 59;
                }
             
                // Nếu số phút = -1 tức là đã chạy ngược hết số phút, lúc này:
                //  - giảm số giờ xuống 1 đơn vị
                //  - thiết lập số phút lại 59
                if (m === -1){
                    h -= 1;
                    m = 59;
                }
             
                // Nếu số giờ = -1 tức là đã hết giờ, lúc này:
                //  - Dừng chương trình
                if (h == -1){
                    clearTimeout(timeout);
                    alert("Đã nộp bài");
                    location.href = "result.php";
                    return false;
                }
                document.getElementById('h').innerText = h.toString();
                document.getElementById('m').innerText = m.toString();
                document.getElementById('s').innerText = s.toString();

                //Gọi hàm mỗi 1 giây = 1000 mili giây;
                setTimeout(function(){
                    s--;
                    start();
                }, 1000);
            }

        </script>
    </div>


    <form action="" method="POST" enctype="multipart/form-data">
          <div style="font-size: 15px; margin: 0px 10%;">
                <?php   
			        view();
                    if(isset($_POST['Submit'])){
                        echo '<script>
                                    alert("Đã nộp bài");
                                    location.href = "result.php?id_courses='.$id_courses.'";
                                  </script>';
                        //echo $_SESSION['point'];
                    }   
			           ?>
			    <div style="margin: 20px 0 0 0;" class="d-grid">
                  <input id="btn-add" class="btn btn-primary btn-block" name="Submit" type="submit" value="Nộp bài">
              	</div>
        <?php 
            }
        ?>
              <?php 

                function view(){
                	$order=1;
                    $_SESSION['point']=0;
                    $id_courses = $_GET["id_courses"];
                    include("sql.php");

                    $sql_query="SELECT `id_question`, `name_question`, `type_question`, `answer`, `answer_correct`, `courses_id`, `status` FROM `question` WHERE `courses_id`=$id_courses and `status`='Đã duyệt' LIMIT 10 ";

                    $do=mysqli_query($conn,$sql_query);
                    if(mysqli_num_rows($do)>=10){
                        while($row=mysqli_fetch_array($do)) {
                            echo "<br>";
                        	echo "Câu thứ: ".$order;
                          //1 Đáp án
                           	if($row['type_question']=='Câu hỏi 1 đáp án'){
                           		$_POST['name_question_one']=$row['name_question'];
                                $answer_one=explode("/",$row['answer']);
                                $count_one=0;
                                $answer_correct_one=$row['answer_correct'];
                                $answer_array_one=array();
                                foreach($answer_one as $key_one){
                                    if($key_one!=""){
                                        $count_one+=1; //Kiểm tra rỗng của đáp án;
                                        $answer_array_one[]=$key_one; //Thêm các đáp án vào mảng
                                    }
                                }
                                $_SESSION['count_answers']=$count_one; //Set số đáp án hiển thị;
                                for ($i=1; $i <=$count_one ; $i++) { 
                                    $_POST["one".$i]=$answer_array_one[$i-1];
                                    if($answer_correct_one==$answer_array_one[$i-1]){
                                        if(isset($_POST['Submit'])){
                                            if(isset($_POST[$order.$order])&&$_POST[$order.$order]==$i){
                                                //Kiểm tra đáp án đúng
                                                $_SESSION['point']+=10;
                                            }
                                        }
                                    }
                                }

                ?>
                                <input class="form-control" type="text" name="name_question_one" id="" value="<?php echo isset($_POST['name_question_one'])?$_POST['name_question_one']:"" ?>" readonly>
                <?php
                                $n=$_SESSION['count_answers'];
      			                    for ($i = 1; $i <= $n; $i++) {
      			                    echo '<div style="margin: 20px 0 0 0;" class="input-group mb-3">';
      			                    echo '<div class="input-group-text"><input type="radio" name="'.$order.$order.'" value="'.$i.'"></div>';
      			    ?>

      			                    <input name="<?php echo "one".$i;  ?>" type="text" class="form-control" placeholder="Nhập đáp án" value="<?php echo isset($_POST["one".$i])? $_POST["one".$i]:""; ?>" readonly>
      			   <?php
      			                    echo '</div>';
      			                    }

                          // Nhiều đáp án

                           	}elseif($row['type_question']=='Câu hỏi nhiều đáp án'){
                           		$_POST['name_question_many']=$row['name_question'];

                                $answer_many=explode("/",$row['answer']);
                                $count_many=0;
                                $answer_correct_many=explode("/",$row['answer_correct']);
                                $answer_array_many=array();
                                
                                //Đếm số đáp án đúng;
                                //Trừ 1 vì $answer_correct[0] là rỗng
                                $count_answer_correct_many=count($answer_correct_many)-1;

                                foreach($answer_many as $key_many){
                                    if($key_many!=""){
                                        $count_many+=1; //Kiểm tra rỗng của đáp án;
                                        $answer_array_many[]=$key_many; //Thêm các đáp án vào mảng
                                    }
                                }
                                $_SESSION['count_answers']=$count_many; //Set số đáp án hiển thị;
                                $temp_many=array();
                                $c_many=0;
                                for ($j=1; $j <=$count_many ; $j++) {
                                    $_POST["many".$j]=$answer_array_many[$j-1];
                                    //Nếu nhấn submit
                                    if(isset($_POST['Submit'])){
                                        if(isset($_POST[$order.$j])){
                                            //$c_many là số đáp án người dùng tích ;
                                            $c_many++;
                                            foreach($answer_correct_many as $key_correct_many){
                                                if($answer_array_many[$j-1]==$key_correct_many){
                                                    if($_POST[$order.$j]==$j){
                                                        $temp_many[]="true";
                                                    } 
                                                }
                                            }
                                        }
                                    }
                                }
                                $count_temp=count($temp_many);
                                if($c_many==$count_answer_correct_many&&$count_temp==$count_answer_correct_many){
                                    $_SESSION['point']+=10;
                                }
                ?>
                                <input class="form-control" type="text" name="name_question_many" id="" value="<?php echo isset($_POST['name_question_many'])?$_POST['name_question_many']:"" ?>" readonly>
                <?php
                                $n=$_SESSION['count_answers'];
                                for ($j = 1; $j <= $n; $j++) {
                                                
                                echo '<div style="margin: 20px 0 0 0;" class="input-group mb-3">';
                                echo '<div class="input-group-text"><input type="checkbox" id="' . $j . '" name="' . $order.$j . '" value="' . $j . '" readonly></div>';
                ?>

                                <input name="<?php echo "many".$j;  ?>" type="text" class="form-control" placeholder="Nhập đáp án" value="<?php echo isset($_POST["many".$j])? $_POST["many".$j]:""; ?>" readonly>
                <?php
                                echo '</div>';
                                }
                           	}elseif($row['type_question']=='Câu hỏi điền'){
                           		$_POST['name_question_text']=$row['name_question'];                                
                ?>
                                <input class="form-control" type="text" name="name_question_text" id="" placeholder="Vui lòng nhập câu hỏi" value="<?php echo isset($_POST['name_question_text'])?$_POST['name_question_text']:"" ?>" readonly>
                            
                <?php
                                echo'<input name="'.$order.'" type="text" class="form-control" placeholder="Nhập đáp án" value="" >';
                                if(isset($_POST['Submit'])){
                                    //Lỗi khai báo?
                                    if($_POST[$order]==$row['answer_correct']){
                                        $_SESSION['point']+=10;
                                    }
                                }
                                
                            }
                            $order++;
                        }
                    }else{
                        echo'<script>
                                    alert("Hệ thống đang cập nhập câu hỏi. Vui lòng quay lại sau");
                                    location.href = "listadd.php?id_courses='.$id_courses.'";
                            </script>';
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