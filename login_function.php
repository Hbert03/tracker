<?php
include('session.php');


if (isset($_POST['user']) && isset($_POST['password'])) {

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $user = validate($_POST['user']);
    $pass = validate($_POST['password']);

    $pass = md5($pass);

    $sql = "SELECT * FROM tbl_employee  WHERE username='$user' AND password='$pass'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['hris_code'] = $row['hris_code'];

        if (isset($row['hris_code'])) {
            $user_id = $row['hris_code'];
            $user_sql = "SELECT e.*, o.office_name, u.user_id  FROM tbl_employee e INNER JOIN tbl_office o ON e.department_id = o.id INNER JOIN tbl_user u ON u.user_id = o.id  WHERE hris_code='$user_id'";
            $user_result = mysqli_query($conn, $user_sql);
        
            if ($user_result && mysqli_num_rows($user_result) === 1) {
                $user_data = mysqli_fetch_assoc($user_result);
        
                $_SESSION['hris_code'] = $user_data['hris_code'];
                $_SESSION['user_id'] = $user_data['user_id'];
                $_SESSION['firstname'] = $user_data['firstname'];
                $_SESSION['middlename'] = substr($user_data['middlename'], 0, 1);
                $_SESSION['lastname'] = $user_data['lastname'];
                $_SESSION['position'] = $user_data['position'];
                $_SESSION['office_name'] = $user_data['office_name'];
                
            }
        }
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['login'] = "Wrong Username and Password!";
        $_SESSION['login_code'] = "error";
        header("Location: login.php");
        exit();
    }
} else {
    $_SESSION['login'] = "Try Again";
    $_SESSION['login_code'] = "error";
    header("Location: login.php");
    exit();
}
?>
