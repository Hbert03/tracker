<?php
session_start();
include('../database.php');

if (isset($_POST['fetch'])) {
    $user_id = $_SESSION['user_id'];
    $allowed_user_ids = $_SESSION['allowed_user_ids'];
    
    function getDataTable1($draw, $start, $length, $search) {
        global $conn1;
        global $allowed_user_ids;

        $sortableColumns = array('fFullname', 'position', 'purpose_travel', 'destination');
        
        $orderBy = $sortableColumns[0];
        $orderDir = 'ASC';
        
        if (isset($_POST['order'][0]['column']) && isset($_POST['order'][0]['dir'])) {
            $columnIdx = intval($_POST['order'][0]['column']);
            $orderDir = $_POST['order'][0]['dir'];

            if (isset($sortableColumns[$columnIdx])) {
                $orderBy = $sortableColumns[$columnIdx];
            }
        }

        $allowed_user_ids_str = implode(",", array_map('intval', $allowed_user_ids));
        $query = "SELECT e.*, 
                 GROUP_CONCAT(CONCAT(e2.firstname, ' ', e2.lastname) SEPARATOR ', ') AS join_users
                  FROM employee_tracker e
                  LEFT JOIN depedldn_tracker.travel_join tj ON tj.travel_id = e.id
                  LEFT JOIN depedldn.tbl_employee e2 ON e2.hris_code = tj.hris_code WHERE office_id IN ($allowed_user_ids_str) GROUP BY e.id ";
        
          
        if (!empty($search)) {
            $query .= " HAVING (date_start LIKE '%" . $conn1->real_escape_string($search) . "%' 
               OR position LIKE '%" . $conn1->real_escape_string($search) . "%' 
               OR purpose_travel LIKE '%" . $conn1->real_escape_string($search) . "%' 
               OR fullname LIKE '%" . $conn1->real_escape_string($search) . "%' 
               OR destination LIKE '%" . $conn1->real_escape_string($search) . "%')";
             }

        $query .= " ORDER BY date DESC LIMIT $start, $length";

        $result = $conn1->query($query);

        $totalQuery = "SELECT COUNT(*) as total FROM employee_tracker WHERE office_id IN ($allowed_user_ids_str)";
        
        if (!empty($search)) {
            $totalQuery .= " AND (fullname LIKE '%" . $conn1->real_escape_string($search) . "%' OR position LIKE '%" . $conn1->real_escape_string($search) . "%' OR purpose_travel LIKE '%" . $conn1->real_escape_string($search) . "%' OR destination LIKE '%" . $conn1->real_escape_string($search) . "%')";
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
            } elseif ($row['status'] == 'Disapproved') {
                $statusClass = 'badge badge-danger';
            }
            $row['status'] = '<span class="' . $statusClass . '">' . $row['status'] . '</span>';
            $row['actions'] = '
                <button style="background-color:transparent; border-color:green" class="btn btn-primary  approve-btn" data-id="' . $row['id'] . '"><i style="color:green" class="fas fa-check"></i></button>
                <button style="background-color:transparent; " class="btn btn-danger  reject-btn" data-id="' . $row['id'] . '"><i style="color:red" class="fas fa-times"></i></button>';

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


if (isset($_POST['pass_slip'])) {
    $user_id = $_SESSION['user_id'];
    $allowed_user_ids = $_SESSION['allowed_user_ids'];
    
    function getDataTable1($draw, $start, $length, $search) {
        global $conn1;
        global $allowed_user_ids;

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

        $allowed_user_ids_str = implode(",", array_map('intval', $allowed_user_ids));
        $query = "SELECT * FROM pass_slip WHERE office_id IN ($allowed_user_ids_str)";
        
        if (!empty($search)) {
            $query .= " AND (Name LIKE '%" . $conn1->real_escape_string($search) . "%' OR position LIKE '%" . $conn1->real_escape_string($search) . "%' OR purpose LIKE '%" . $conn1->real_escape_string($search) ."%')";
        }

        $query .= " ORDER BY date DESC LIMIT $start, $length";

        $result = $conn1->query($query);

        $totalQuery = "SELECT COUNT(*) as total FROM pass_slip WHERE office_id IN ($allowed_user_ids_str)";
        
        if (!empty($search)) {
            $totalQuery .= " AND (Name LIKE '%" . $conn1->real_escape_string($search) . "%' OR position LIKE '%" . $conn1->real_escape_string($search) . "%' OR purpose LIKE '%" . $conn1->real_escape_string($search) ."%')";
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
            } elseif ($row['status'] == 'Disapproved') {
                $statusClass = 'badge badge-danger';
            }
            $row['status'] = '<span class="' . $statusClass . '">' . $row['status'] . '</span>';
            $row['actions'] = '
                <button style="background-color:transparent; border-color:green" class="btn btn-primary  approve-btn" data-id="' . $row['id'] . '"><i style="color:green" class="fas fa-check"></i></button>
                <button style="background-color:transparent; " class="btn btn-danger  reject-btn" data-id="' . $row['id'] . '"><i style="color:red" class="fas fa-times"></i></button>';

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


if (isset($_POST['locator_Slip'])) {
    $user_id = $_SESSION['user_id'];
    $allowed_user_ids = $_SESSION['allowed_user_ids'];
    
    function getDataTable1($draw, $start, $length, $search) {
        global $conn1;
        global $allowed_user_ids;

        $sortableColumns = array('name', 'Position', 'purpose_travel', 'destination');
        
        $orderBy = $sortableColumns[0];
        $orderDir = 'ASC';
        
        if (isset($_POST['order'][0]['column']) && isset($_POST['order'][0]['dir'])) {
            $columnIdx = intval($_POST['order'][0]['column']);
            $orderDir = $_POST['order'][0]['dir'];

            if (isset($sortableColumns[$columnIdx])) {
                $orderBy = $sortableColumns[$columnIdx];
            }
        }

        $allowed_user_ids_str = implode(",", array_map('intval', $allowed_user_ids));
        $query = "SELECT * FROM locator_slip WHERE office_id IN ($allowed_user_ids_str)";
        
        if (!empty($search)) {
            $query .= " AND (name LIKE '%" . $conn1->real_escape_string($search) . "%' OR position LIKE '%" . $conn1->real_escape_string($search) . "%' OR purpose_travel LIKE '%" . $conn1->real_escape_string($search) . "%' OR destination LIKE '%" . $conn1->real_escape_string($search) . "%')";
        }

        $query .= " ORDER BY date DESC LIMIT $start, $length";

        $result = $conn1->query($query);

        $totalQuery = "SELECT COUNT(*) as total FROM locator_slip WHERE office_id IN ($allowed_user_ids_str)";
        
        if (!empty($search)) {
            $totalQuery .= " AND (name LIKE '%" . $conn1->real_escape_string($search) . "%' OR position LIKE '%" . $conn1->real_escape_string($search) . "%' OR purpose_travel LIKE '%" . $conn1->real_escape_string($search) . "%' OR destination LIKE '%" . $conn1->real_escape_string($search) . "%')";
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
            } elseif ($row['status'] == 'Disapproved') {
                $statusClass = 'badge badge-danger';
            }
            $row['status'] = '<span class="' . $statusClass . '">' . $row['status'] . '</span>';
            $row['actions'] = '
                <button style="background-color:transparent; border-color:green" class="btn btn-primary  approve-btn" data-id="' . $row['id'] . '"><i style="color:green" class="fas fa-check"></i></button>
                <button style="background-color:transparent; " class="btn btn-danger  reject-btn" data-id="' . $row['id'] . '"><i style="color:red" class="fas fa-times"></i></button>';

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



if (isset($_POST['locator1'])) {
    
    function getDataTable1($draw, $start, $length, $search) {
        global $conn1;
      

        $sortableColumns = array('name', 'Position', 'purpose_travel', 'destination');
        
        $orderBy = $sortableColumns[0];
        $orderDir = 'ASC';
        
        if (isset($_POST['order'][0]['column']) && isset($_POST['order'][0]['dir'])) {
            $columnIdx = intval($_POST['order'][0]['column']);
            $orderDir = $_POST['order'][0]['dir'];

            if (isset($sortableColumns[$columnIdx])) {
                $orderBy = $sortableColumns[$columnIdx];
            }
        }

        $query = "SELECT * FROM locator_slip WHERE office_id IN (340, 339, 347, 348, 351, 352, 349, 350, 341, 484, 487, 491, 332, 482)";
        
        if (!empty($search)) {
            $query .= " AND (name LIKE '%" . $conn1->real_escape_string($search) . "%' OR position LIKE '%" . $conn1->real_escape_string($search) . "%' OR purpose_travel LIKE '%" . $conn1->real_escape_string($search) . "%' OR destination LIKE '%" . $conn1->real_escape_string($search) . "%')";
        }

        $query .= " ORDER BY date DESC LIMIT $start, $length";

        $result = $conn1->query($query);

        $totalQuery = "SELECT COUNT(*) as total FROM locator_slip WHERE office_id IN (340, 339, 347, 348, 351, 352, 349, 350, 341, 484, 487, 491, 332, 482)";
        
        if (!empty($search)) {
            $totalQuery .= " AND (name LIKE '%" . $conn1->real_escape_string($search) . "%' OR position LIKE '%" . $conn1->real_escape_string($search) . "%' OR purpose_travel LIKE '%" . $conn1->real_escape_string($search) . "%' OR destination LIKE '%" . $conn1->real_escape_string($search) . "%')";
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
            } elseif ($row['status'] == 'Disapproved') {
                $statusClass = 'badge badge-danger';
            }
            $row['status'] = '<span class="' . $statusClass . '">' . $row['status'] . '</span>';
            $row['actions'] = '
                <button style="background-color:transparent; border-color:green" class="btn btn-primary  approve-btn" data-id="' . $row['id'] . '"><i style="color:green" class="fas fa-check"></i></button>
                <button style="background-color:transparent; " class="btn btn-danger  reject-btn" data-id="' . $row['id'] . '"><i style="color:red" class="fas fa-times"></i></button>';

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

if (isset($_POST['travelOrder'])) {
    $user_id = $_SESSION['user_id'];
    $allowed_user_ids = $_SESSION['allowed_user_ids'];


    function getDataTable1($draw, $start, $length, $search) {
        global $allowed_user_ids;
        global $conn1;

        $sortableColumns = array('fullname', 'section', 'position');
        
        $orderBy = 'e.date'; 
        $orderDir = 'ASC';

        if (isset($_POST['order'][0]['column']) && isset($_POST['order'][0]['dir'])) {
            $columnIdx = intval($_POST['order'][0]['column']);
            $orderDir = $_POST['order'][0]['dir'];

            
            if (isset($sortableColumns[$columnIdx])) {
                $orderBy = 'e.' . $sortableColumns[$columnIdx];
            }
        }

        $allowed_user_ids_str = implode(",", array_map('intval', $allowed_user_ids));

        $query = "SELECT e.*, 
                         GROUP_CONCAT(CONCAT(e2.firstname, ' ', e2.lastname) SEPARATOR ', ') AS join_users
                  FROM employee_tracker e
                  LEFT JOIN depedldn_tracker.travel_join tj ON tj.travel_id = e.id
                  LEFT JOIN depedldn.tbl_employee e2 ON e2.hris_code = tj.hris_code 
                  WHERE 1=1 
                    AND MONTH(e.date) = MONTH(NOW()) 
                    AND YEAR(e.date) = YEAR(NOW()) 
                    AND e.office_id IN ($allowed_user_ids_str) 
                  GROUP BY e.id";

        if (!empty($search)) {
            $query .= " HAVING (e.date_start LIKE '%" . $conn1->real_escape_string($search) . "%' 
                                OR e.position LIKE '%" . $conn1->real_escape_string($search) . "%' 
                                OR e.purpose_travel LIKE '%" . $conn1->real_escape_string($search) . "%' 
                                OR e.fullname LIKE '%" . $conn1->real_escape_string($search) . "%' 
                                OR e.destination LIKE '%" . $conn1->real_escape_string($search) . "%')";
        }

        $query .= " ORDER BY $orderBy $orderDir LIMIT $start, $length";

        $result = $conn1->query($query);

        $totalQuery = "SELECT COUNT(*) as total FROM employee_tracker WHERE office_id IN ($allowed_user_ids_str)";
        if (!empty($search)) {
            $totalQuery .= " AND (fullname LIKE '%" . $conn1->real_escape_string($search) . "%' 
                                OR position LIKE '%" . $conn1->real_escape_string($search) . "%' 
                                OR purpose_travel LIKE '%" . $conn1->real_escape_string($search) . "%' 
                                OR destination LIKE '%" . $conn1->real_escape_string($search) . "%')";
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
            } elseif ($row['status'] == 'Disapproved') {
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


if (isset($_POST['locatorSlip'])) {
    $user_id = $_SESSION['user_id'];
    $allowed_user_ids = $_SESSION['allowed_user_ids'];

    function getDataTable1($draw, $start, $length, $search) {
        global $allowed_user_ids;
        global $conn1;

        $sortableColumns = array('name', 'purpose_travel', 'position', 'date');
        $orderBy = 'date'; 
        $orderDir = 'ASC';

        if (isset($_POST['order'][0]['column']) && isset($_POST['order'][0]['dir'])) {
            $columnIdx = intval($_POST['order'][0]['column']);
            $orderDir = $_POST['order'][0]['dir'];

            if (isset($sortableColumns[$columnIdx])) {
                $orderBy = $sortableColumns[$columnIdx];
            }
        }

        $allowed_user_ids_str = implode(",", array_map('intval', $allowed_user_ids));
        $query = "SELECT * 
                  FROM locator_slip 
                  WHERE 1=1 
                    AND MONTH(date) = MONTH(NOW()) 
                    AND YEAR(date) = YEAR(NOW()) 
                    AND office_id IN ($allowed_user_ids_str)";

        if (!empty($search)) {
            $query .= " AND (name LIKE '%" . $conn1->real_escape_string($search) . "%' 
                        OR purpose_travel LIKE '%" . $conn1->real_escape_string($search) . "%' 
                        OR position LIKE '%" . $conn1->real_escape_string($search) . "%')";
        }

        $query .= " ORDER BY $orderBy $orderDir LIMIT $start, $length";

        $result = $conn1->query($query);

        $totalQuery = "SELECT COUNT(*) as total 
                       FROM locator_slip 
                       WHERE MONTH(date) = MONTH(NOW()) 
                         AND YEAR(date) = YEAR(NOW()) 
                         AND office_id IN ($allowed_user_ids_str)";

        if (!empty($search)) {
            $totalQuery .= " AND (name LIKE '%" . $conn1->real_escape_string($search) . "%' 
                            OR purpose_travel LIKE '%" . $conn1->real_escape_string($search) . "%' 
                            OR position LIKE '%" . $conn1->real_escape_string($search) . "%')";
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
            } elseif ($row['status'] == 'Disapproved') {
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



if (isset($_POST['sample'])) {
 
    function getDataTable1($draw, $start, $length, $search) {
        global $conn1;

        $sortableColumns = array('name', 'section', 'position');
        
        $orderBy = $sortableColumns[0];
        $orderDir = 'ASC';

        if (isset($_POST['order'][0]['column']) && isset($_POST['order'][0]['dir'])) {
            $columnIdx = intval($_POST['order'][0]['column']);
            $orderDir = $_POST['order'][0]['dir'];

            if (isset($sortableColumns[$columnIdx])) {
                $orderBy = $sortableColumns[$columnIdx];
            }
        }

        $query = "SELECT  *  FROM locator_slip WHERE status = 'Approved' AND office_id = '334' AND MONTH(date) = MONTH(NOW()) 
        AND YEAR(date) = YEAR(NOW())";
         if (!empty($search)) {
            $query .= " AND (name LIKE '%" . $conn1->real_escape_string($search) . "%' OR position LIKE '%" . $conn1->real_escape_string($search) . "%' OR purpose_travel LIKE '%" . $conn1->real_escape_string($search). "%')";
                             }
        $query .= "ORDER BY date LIMIT $start, $length";

        $result = $conn1->query($query);

        $totalQuery = "SELECT COUNT(*) as total FROM locator_slip WHERE status = 'Approved' AND office_id = '334' AND MONTH(date) = MONTH(NOW()) 
        AND YEAR(date) = YEAR(NOW())";

        if (!empty($search)) {
            $totalQuery .= " AND (name LIKE '%"  . $conn1->real_escape_string($search) . "%' OR position LIKE '%" . $conn1->real_escape_string($search) . "%' OR purpose_travel LIKE '%" . $conn1->real_escape_string($search) . "%')";
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
            } elseif ($row['status'] == 'Disapproved') {
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



if (isset($_POST['sample1'])) {
 
    function getDataTable1($draw, $start, $length, $search) {
        global $conn1;

        $sortableColumns = array('name', 'section', 'position');
        
        $orderBy = $sortableColumns[0];
        $orderDir = 'ASC';

        if (isset($_POST['order'][0]['column']) && isset($_POST['order'][0]['dir'])) {
            $columnIdx = intval($_POST['order'][0]['column']);
            $orderDir = $_POST['order'][0]['dir'];

            if (isset($sortableColumns[$columnIdx])) {
                $orderBy = $sortableColumns[$columnIdx];
            }
        }

        $query = "SELECT  *  FROM locator_slip WHERE status = 'Approved' AND office_id = '335' AND MONTH(date) = MONTH(NOW()) 
        AND YEAR(date) = YEAR(NOW())";
         if (!empty($search)) {
            $query .= " AND (name LIKE '%" . $conn1->real_escape_string($search) . "%' OR position LIKE '%" . $conn1->real_escape_string($search) . "%' OR purpose_travel LIKE '%" . $conn1->real_escape_string($search). "%')";
                             }
        $query .= "ORDER BY date LIMIT $start, $length";

        $result = $conn1->query($query);

        $totalQuery = "SELECT COUNT(*) as total FROM locator_slip WHERE status = 'Approved' AND office_id = '335' AND MONTH(date) = MONTH(NOW()) 
        AND YEAR(date) = YEAR(NOW())";

        if (!empty($search)) {
            $totalQuery .= " AND (name LIKE '%"  . $conn1->real_escape_string($search) . "%' OR position LIKE '%" . $conn1->real_escape_string($search) . "%' OR purpose_travel LIKE '%" . $conn1->real_escape_string($search) . "%')";
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
            } elseif ($row['status'] == 'Disapproved') {
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


if (isset($_POST['passSlip'])) {
  $user_id = $_SESSION['user_id'];
    $allowed_user_ids = $_SESSION['allowed_user_ids'];


    function getDataTable1($draw, $start, $length, $search) {
        global $conn1;
        global $allowed_user_ids;

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

        $allowed_user_ids_str = implode(",", array_map('intval', $allowed_user_ids));
        $query = "SELECT *  FROM pass_slip WHERE 1=1 AND MONTH(date) = MONTH(NOW()) 
        AND YEAR(date) = YEAR(NOW()) AND office_id IN ($allowed_user_ids_str)";
        if (!empty($search)) {
            $query .= " AND (Name  LIKE '%" . $conn1->real_escape_string($search) . "%' OR section LIKE '%" . $conn1->real_escape_string($search) . "%' OR position LIKE '%" . $conn1->real_escape_string($search) . "%' OR purpose LIKE '%" . $conn1->real_escape_string($search) . "%')";
        }

        $query .= " ORDER BY date LIMIT $start, $length";

        $result = $conn1->query($query);

        $totalQuery = "SELECT COUNT(*) as total FROM pass_slip WHERE 1=1 AND MONTH(date) = MONTH(NOW()) 
        AND YEAR(date) = YEAR(NOW()) AND office_id IN ($allowed_user_ids_str)";
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
            } elseif ($row['status'] == 'Disapproved') {
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


if (isset($_POST['passlip'])) {
 
    function getDataTable1($draw, $start, $length, $search) {
        global $conn1;

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

        $query = "SELECT *  FROM pass_slip WHERE status = 'Approved'";
        if (!empty($search)) {
            $query .= " AND (Name  LIKE '%" . $conn1->real_escape_string($search) . "%' OR section LIKE '%" . $conn1->real_escape_string($search) . "%' OR position LIKE '%" . $conn1->real_escape_string($search) . "%' OR purpose LIKE '%" . $conn1->real_escape_string($search) . "%')";
        }

        $query .= " ORDER BY date LIMIT $start, $length";

        $result = $conn1->query($query);

        $totalQuery = "SELECT COUNT(*) as total FROM pass_slip WHERE status = 'Approved'";
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
            } elseif ($row['status'] == 'Disapproved') {
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


if (isset($_POST['locatorslip1'])) {
    $user_id = $_SESSION['user_id'];
    $allowed_user_ids = $_SESSION['allowed_user_ids'];
    
    function getDataTable1($draw, $start, $length, $search) {
        global $conn1;
        global $allowed_user_ids;

        $sortableColumns = array('name', 'Position', 'purpose_travel', 'destination');
        
        $orderBy = $sortableColumns[0];
        $orderDir = 'ASC';
        
        if (isset($_POST['order'][0]['column']) && isset($_POST['order'][0]['dir'])) {
            $columnIdx = intval($_POST['order'][0]['column']);
            $orderDir = $_POST['order'][0]['dir'];

            if (isset($sortableColumns[$columnIdx])) {
                $orderBy = $sortableColumns[$columnIdx];
            }
        }

        $allowed_user_ids_str = implode(",", array_map('intval', $allowed_user_ids));
        $query = "SELECT * FROM locator_slip WHERE office_id IN ($allowed_user_ids_str)";
        
        if (!empty($search)) {
            $query .= " AND (name LIKE '%" . $conn1->real_escape_string($search) . "%' OR position LIKE '%" . $conn1->real_escape_string($search) . "%' OR purpose_travel LIKE '%" . $conn1->real_escape_string($search) . "%' OR destination LIKE '%" . $conn1->real_escape_string($search) . "%')";
        }

        $query .= " ORDER BY date DESC LIMIT $start, $length";

        $result = $conn1->query($query);

        $totalQuery = "SELECT COUNT(*) as total FROM locator_slip WHERE office_id IN ($allowed_user_ids_str)";
        
        if (!empty($search)) {
            $totalQuery .= " AND (name LIKE '%" . $conn1->real_escape_string($search) . "%' OR position LIKE '%" . $conn1->real_escape_string($search) . "%' OR purpose_travel LIKE '%" . $conn1->real_escape_string($search) . "%' OR destination LIKE '%" . $conn1->real_escape_string($search) . "%')";
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
            } elseif ($row['status'] == 'Disapproved') {
                $statusClass = 'badge badge-danger';
            }
            $row['status'] = '<span class="' . $statusClass . '">' . $row['status'] . '</span>';
            $row['actions'] = '
                <button style="background-color:transparent; border-color:green" class="btn btn-primary  approve-btn" data-id="' . $row['id'] . '"><i style="color:green" class="fas fa-check"></i></button>
                <button style="background-color:transparent; " class="btn btn-danger  reject-btn" data-id="' . $row['id'] . '"><i style="color:red" class="fas fa-times"></i></button>';

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


