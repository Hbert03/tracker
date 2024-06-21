<?php

include 'database.php'; 

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $query = "SELECT * FROM pass_slip WHERE id = ?";
    $stmt = $conn1->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc(); 

    echo json_encode($row);
}

?>
  