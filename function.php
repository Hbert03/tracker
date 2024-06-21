<?php
session_start();
include('database.php');
 
if (isset($_POST['save'])){
    $hris_code = $_SESSION['hris_code'];
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $position = $_POST['position'];
    $permanent_station = $_POST['permanent_station'];
    $purpose_of_travel = $_POST['purpose_of_travel'];
    $host_of_activity = $_POST['host_of_activity'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $destination = $_POST['destination'];
    $fund_source = $_POST['fund_source'];

    $query = "INSERT INTO employee_tracker (hris_code, fullname, position, station, purpose_travel, host_activity, date_start, date_end, destination, fund_source, office_id)
    VALUES ('$hris_code','$name', '$position', '$permanent_station', '$purpose_of_travel', '$host_of_activity', '$start_date', '$end_date', '$destination', '$fund_source', '$user_id')";

    if (mysqli_query($conn1, $query)){
    echo "1";
    } else {
    echo "0";
    }
   
}



if (isset($_POST['save2'])){
    $hris_code = $_SESSION['hris_code'];
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $section = $_POST['section'];
    $position = $_POST['position'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $purpose = $_POST['purpose'];
    $date = $_POST['date'];

    $query = "INSERT INTO pass_slip (hris_code, Name, section, position, time_leave, time_return, purpose, office_id, date)
    VALUES ('$hris_code','$name', '$section', '$position', '$start_time', '$end_time', '$purpose',  '$user_id', '$date')";

    if (mysqli_query($conn1, $query)){
    echo "1";
    } else {
    echo "0";
    }
   
}




if (isset($_POST['save3'])){
    $hris_code = $_SESSION['hris_code'];
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $position = $_POST['position'];
    $permanent_station = $_POST['permanent_station'];
    $purpose_of_travel = $_POST['purpose_of_travel'];
    $datetime = $_POST['datetime'];
    $offical = $_POST['official'];
    $destination = $_POST['destination'];
 

    $query = "INSERT INTO locator_slip (hris_code, name, position, permanent_position, purpose_travel, datetime, official, destination, office_id)
    VALUES ('$hris_code','$name', '$position', '$permanent_station', '$purpose_of_travel', '$datetime', '$offical', '$destination', '$user_id')";

    if (mysqli_query($conn1, $query)){
    echo "1";
    } else {
    echo "0";
    }
   
}
?>
