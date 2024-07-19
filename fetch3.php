<?php
include('database.php');
if(isset($_POST['fetch_personnel'])){
    $empquery = "SELECT *, CONCAT(firstname, ' ', COALESCE(SUBSTRING(middlename, 1, 1), ''), '. ', lastname, ' ', ext_name) AS fullname FROM tbl_employee WHERE 1=1";

    $terms = (isset($_POST['term']) && !empty($_POST['term'])) ? $_POST['term'] : null;

    if($terms){
        $empquery .= " AND (firstname LIKE '%" . $terms . "%'";
        $empquery .= " OR middlename LIKE '%" . $terms . "%'";
        $empquery .= " OR lastname LIKE '%" . $terms . "%')";
    } else {
        $empquery .= " LIMIT 10";
    }

    $queryIns = $conn2->query($empquery);
    $employees = array();

    while ($row = $queryIns->fetch_assoc()) {
        $employees[] = $row;
    }

    $conn2->close();

    echo json_encode(['results' => $employees]);
};

?>