<?php
    session_start();
?>

<?php
echo $_SESSION['role'];
    if (isset($_SESSION['role']) && $_SESSION['role'] == "admin") {
        header("location: courses_of_admin.php");
    }elseif (isset($_SESSION['role']) && $_SESSION['role'] == "student") {
        header("location: courses_of_student.php");
    }
?>