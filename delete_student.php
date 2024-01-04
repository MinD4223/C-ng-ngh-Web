<?php
    session_start();
?>

<?php
    $id_user_courses = $_GET['id_user_courses'];
    $courses_id = $_SESSION['id_courses'];
   
?>

<?php
        $DB_HOST = 'localhost';
        $DB_USER = 'root';
        $DB_PASS = '';
        $DB_NAME = '7_project_k71'; 
              
        $conn=mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME) or die("Không thể kết nối tới cơ sở dữ liệu");
            if($conn){
              mysqli_query($conn,"SET NAMES 'utf8'");
            }else{
              echo "Bạn đã kết nối thất bại";
            }
              
?> 


<?php
    $sql_add = "DELETE FROM `user_courses` WHERE `user_courses`.`id_user_courses` = $id_user_courses";
    if ($conn->query($sql_add) === TRUE) {
        $_SESSION['student_add'] = $id_user;
        header("location: add_student_courses.php?id_courses=".$courses_id);
    }
?>