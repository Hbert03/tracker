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

    $sql = "SELECT * FROM tbl_user WHERE useraccount='$user' AND password='$pass'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['user_id'];
        $user_id = $_SESSION['user_id'];

        $user_groups = [
            340 => [340, 339, 347, 348, 351, 352, 349, 350, 341],
            481 => [340, 339, 347, 348, 351, 352, 349, 350, 341],
            482 => [340, 339, 347, 348, 351, 352, 349, 350, 341],
            499 => [340, 339, 347, 348, 351, 352, 349, 350, 341],
            334 => [334],
            335 => [335],
        ];

        if (array_key_exists($user_id, $user_groups)) {
            $_SESSION['allowed_user_ids'] = $user_groups[$user_id];

            $user_sql = "SELECT u.*, o.office_name FROM tbl_user u INNER JOIN tbl_office o ON u.user_id = o.id WHERE u.user_id='$user_id'";
            $user_result = mysqli_query($conn, $user_sql);
        
            if ($user_result && mysqli_num_rows($user_result) === 1) {
                $user_data = mysqli_fetch_assoc($user_result);
                $_SESSION['office_name'] = $user_data['office_name'];
            }
            
            if (in_array($user_id, [340, 481, 482])) {
                header("Location: index.php");
            } elseif ($user_id == 499) {
                header("Location: index_.php");
            } elseif (in_array($user_id, [334, 335])) {
                header("Location: index__.php");
            }
            exit();
        } else {
            $_SESSION['login'] = "Access Denied!";
            $_SESSION['login_code'] = "error";
            header("Location: login.php");
            exit();
        }
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
