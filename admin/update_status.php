
<?php
session_start();
include('../database.php');

if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = intval($_POST['id']);
    $status = $_POST['status'];

    $query = "UPDATE employee_tracker SET status='$status' WHERE id=$id";
    $result = $conn1->query($query);

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn1->error]);
    }
}
?>
