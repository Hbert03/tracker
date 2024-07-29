<?php

include 'database.php'; 

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    
    $query = "SELECT et.*, 
                     GROUP_CONCAT(CONCAT(e2.firstname, ' ', e2.lastname) SEPARATOR ', ') as join_user ,
                       GROUP_CONCAT(CONCAT(e2.position) SEPARATOR ', ') as join_position 
              FROM employee_tracker et
              LEFT JOIN depedldn_tracker.travel_join tj ON tj.travel_id = et.id
              LEFT JOIN depedldn.tbl_employee e2 ON e2.hris_code = tj.hris_code
              WHERE et.id = ?
              GROUP BY et.id";
    $stmt = $conn1->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc(); 

    echo json_encode($row);
}

?>
