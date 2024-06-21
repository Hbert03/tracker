<?php
session_start();
include('database.php');

if (isset($_POST['fetch'])) {
    $hris_code = $_SESSION['hris_code'];
    function getDataTable1($draw, $start, $length, $search) {
        global $conn1;
        global $hris_code;

        $sortableColumns = array('Fullname', 'Position', 'purpose_travel', 'destination');
        
        $orderBy = $sortableColumns[0];
        $orderDir = 'ASC';

        if (isset($_POST['order'][0]['column']) && isset($_POST['order'][0]['dir'])) {
            $columnIdx = intval($_POST['order'][0]['column']);
            $orderDir = $_POST['order'][0]['dir'];

            if (isset($sortableColumns[$columnIdx])) {
                $orderBy = $sortableColumns[$columnIdx];
            }
        }

        $query = "SELECT *  FROM employee_tracker WHERE hris_code ='$hris_code'";
        if (!empty($search)) {
            $query .= " AND (Fullname LIKE '%" . $conn1->real_escape_string($search) . "%' OR Position LIKE '%" . $conn1->real_escape_string($search) . "%' OR purpose_travel LIKE '%" . $conn1->real_escape_string($search) . "%' OR destination LIKE '%" . $conn1->real_escape_string($search) . "%')";
        }

        $query .= " ORDER BY $orderBy $orderDir LIMIT $start, $length";

        $result = $conn1->query($query);

        $totalQuery = "SELECT COUNT(*) as total FROM employee_tracker Where hris_code='$hris_code'";
        if (!empty($search)) {
            $totalQuery .= " AND (Fullname LIKE '%" . $conn1->real_escape_string($search) . "%' OR Position LIKE '%" . $conn1->real_escape_string($search) . "%' OR purpose_travel LIKE '%" . $conn1->real_escape_string($search) . "%' OR destination LIKE '%" . $conn1->real_escape_string($search) . "%')";
        }
        $totalResult = $conn1->query($totalQuery);
        $totalRow = $totalResult->fetch_assoc();
        $totalRecords = $totalRow['total'];

       
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $statusClass = '';
            if ($row['status'] == 'Pending') {
                $statusClass = 'badge badge-warning';
            } elseif ($row['status'] == 'Approved') {
                $statusClass = 'badge badge-primary';
            } elseif ($row['status'] == 'Rejected') {
                $statusClass = 'badge badge-danger';
            }
            $row['status'] = '<span class="' . $statusClass . '">' . $row['status'] . '</span>';

            $data[] = $row;
        }


        $output = array(
            "draw" => intval($draw),
            "recordsTotal" => intval($totalRecords),
            "recordsFiltered" => intval($totalRecords),
            "data" => $data
        );

        return json_encode($output);
    }

    $draw = $_POST["draw"];
    $start = $_POST["start"];
    $length = $_POST["length"];
    $search = $_POST["search"]["value"];

    echo getDataTable1($draw, $start, $length, $search);    
    exit();
}





if (isset($_POST['fetch2'])) {
    $hris_code = $_SESSION['hris_code'];
    function getDataTable1($draw, $start, $length, $search) {
        global $conn1;
        global $hris_code;

        $sortableColumns = array('Name', 'section', 'position');
        
        $orderBy = $sortableColumns[0];
        $orderDir = 'ASC';

        if (isset($_POST['order'][0]['column']) && isset($_POST['order'][0]['dir'])) {
            $columnIdx = intval($_POST['order'][0]['column']);
            $orderDir = $_POST['order'][0]['dir'];

            if (isset($sortableColumns[$columnIdx])) {
                $orderBy = $sortableColumns[$columnIdx];
            }
        }

        $query = "SELECT *  FROM pass_slip WHERE hris_code ='$hris_code'";
        if (!empty($search)) {
            $query .= " AND (Name  LIKE '%" . $conn1->real_escape_string($search) . "%' OR section LIKE '%" . $conn1->real_escape_string($search) . "%' OR position LIKE '%" . $conn1->real_escape_string($search) . "%' OR purpose LIKE '%" . $conn1->real_escape_string($search) . "%')";
        }

        $query .= " ORDER BY $orderBy $orderDir LIMIT $start, $length";

        $result = $conn1->query($query);

        $totalQuery = "SELECT COUNT(*) as total FROM pass_slip Where hris_code='$hris_code'";
        if (!empty($search)) {
            $totalQuery .= " AND (Name LIKE '%" . $conn1->real_escape_string($search) . "%' OR section LIKE '%" . $conn1->real_escape_string($search) . "%' OR position LIKE '%" . $conn1->real_escape_string($search) . "%' OR purpose LIKE '%" . $conn1->real_escape_string($search) . "%')";
        }
        $totalResult = $conn1->query($totalQuery);
        $totalRow = $totalResult->fetch_assoc();
        $totalRecords = $totalRow['total'];

       
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $statusClass = '';
            if ($row['status'] == 'Pending') {
                $statusClass = 'badge badge-warning';
            } elseif ($row['status'] == 'Approved') {
                $statusClass = 'badge badge-primary';
            } elseif ($row['status'] == 'Rejected') {
                $statusClass = 'badge badge-danger';
            }
            $row['status'] = '<span class="' . $statusClass . '">' . $row['status'] . '</span>';

            $data[] = $row;
            
        }


        $output = array(
            "draw" => intval($draw),
            "recordsTotal" => intval($totalRecords),
            "recordsFiltered" => intval($totalRecords),
            "data" => $data
        );

        return json_encode($output);
    }

    $draw = $_POST["draw"];
    $start = $_POST["start"];
    $length = $_POST["length"];
    $search = $_POST["search"]["value"];

    echo getDataTable1($draw, $start, $length, $search);    
    exit();
}






if (isset($_POST['fetch3'])) {
    $hris_code = $_SESSION['hris_code'];
    function getDataTable1($draw, $start, $length, $search) {
        global $conn1;
        global $hris_code;

        $sortableColumns = array('name', 'position');
        
        $orderBy = $sortableColumns[0];
        $orderDir = 'ASC';

        if (isset($_POST['order'][0]['column']) && isset($_POST['order'][0]['dir'])) {
            $columnIdx = intval($_POST['order'][0]['column']);
            $orderDir = $_POST['order'][0]['dir'];

            if (isset($sortableColumns[$columnIdx])) {
                $orderBy = $sortableColumns[$columnIdx];
            }
        }

        $query = "SELECT *  FROM locator_slip WHERE hris_code ='$hris_code'";
        if (!empty($search)) {
            $query .= " AND (name  LIKE '%" . $conn1->real_escape_string($search) . "%' OR position LIKE '%" . $conn1->real_escape_string($search) . "%' OR purpose_of_travel LIKE '%" . $conn1->real_escape_string($search) . "%')";
        }

        $query .= " ORDER BY $orderBy $orderDir LIMIT $start, $length";

        $result = $conn1->query($query);

        $totalQuery = "SELECT COUNT(*) as total FROM locator_slip Where hris_code='$hris_code'";
        if (!empty($search)) {
            $totalQuery .= " AND (name LIKE '%" . $conn1->real_escape_string($search) . "%' OR position LIKE '%" . $conn1->real_escape_string($search) . "%' OR purpose_of_travel LIKE '%" . $conn1->real_escape_string($search) . "%')";
        }
        $totalResult = $conn1->query($totalQuery);
        $totalRow = $totalResult->fetch_assoc();
        $totalRecords = $totalRow['total'];

       
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $statusClass = '';
            if ($row['status'] == 'pending') {
                $statusClass = 'badge badge-warning';
            } elseif ($row['status'] == 'Approved') {
                $statusClass = 'badge badge-primary';
            } elseif ($row['status'] == 'Rejected') {
                $statusClass = 'badge badge-danger';
            }
            $row['status'] = '<span class="' . $statusClass . '">' . $row['status'] . '</span>';

            $data[] = $row;
            
        }


        $output = array(
            "draw" => intval($draw),
            "recordsTotal" => intval($totalRecords),
            "recordsFiltered" => intval($totalRecords),
            "data" => $data
        );

        return json_encode($output);
    }

    $draw = $_POST["draw"];
    $start = $_POST["start"];
    $length = $_POST["length"];
    $search = $_POST["search"]["value"];

    echo getDataTable1($draw, $start, $length, $search);    
    exit();
}
?>






