<?php
    $showError = "false";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include '_dbconnect.php';
        $user_email = $_POST['loginEmail'];
        $password = $_POST['loginPass'];
        $sql = "Select * from `users` where user_email = '$user_email';";
        $result = mysqli_query($conn,$sql);
        $numRows = mysqli_num_rows($result);
        if($numRows == 1){
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password,$row['user_pass'])){
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['useremail'] = $user_email;
                $_SESSION['sno'] = $row['sno'];
                echo "logged in" . $user_email;
                header("Location: /Forum/index.php");
            }
           
        }
        header("Location: /Forum/index.php");
    }

?>    