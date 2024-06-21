<?php
session_start();
include('../database.php');

if (isset($_POST['fetch'])) {
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
        $query = "SELECT * FROM employee_tracker WHERE office_id IN ($allowed_user_ids_str)";
        
        if (!empty($search)) {
            $query .= " AND (Fullname LIKE '%" . $conn1->real_escape_string($search) . "%' OR Position LIKE '%" . $conn1->real_escape_string($search) . "%' OR purpose_travel LIKE '%" . $conn1->real_escape_string($search) . "%' OR destination LIKE '%" . $conn1->real_escape_string($search) . "%')";
        }

        $query .= " ORDER BY date DESC LIMIT $start, $length";

        $result = $conn1->query($query);

        $totalQuery = "SELECT COUNT(*) as total FROM employee_tracker WHERE office_id IN ($allowed_user_ids_str)";
        
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



if (isset($_POST['travelOrder'])) {
 
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

        $query = "SELECT *  FROM employee_tracker WHERE status = 'Approved' AND MONTH(date) = MONTH(NOW()) 
        AND YEAR(date) = YEAR(NOW())";
        if (!empty($search)) {
            $query .= " AND (fullname  LIKE '%" . $conn1->real_escape_string($search) . "%' OR date LIKE '%" . $conn1->real_escape_string($search) . "%' OR position LIKE '%" . $conn1->real_escape_string($search) . "%' OR purpose_travel LIKE '%" . $conn1->real_escape_string($search) . "%')";
        }

        $query .= "ORDER BY date LIMIT $start, $length";

        $result = $conn1->query($query);

        $totalQuery = "SELECT COUNT(*) as total FROM employee_tracker WHERE status = 'Approved' AND MONTH(date) = MONTH(NOW()) 
        AND YEAR(date) = YEAR(NOW())";
        if (!empty($search)) {
            $totalQuery .= " AND (fullname LIKE '%" . $conn1->real_escape_string($search) . "%' OR date LIKE '%" . $conn1->real_escape_string($search) . "%' OR position LIKE '%" . $conn1->real_escape_string($search) . "%' OR purpose_travel LIKE '%" . $conn1->real_escape_string($search) . "%')";
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
 
    function getDataTable1($draw, $start, $length, $search) {
        global $conn1;

        $sortableColumns = array('Name', 'purpose_travel', 'position');
        
        $orderBy = $sortableColumns[0];
        $orderDir = 'ASC';

        if (isset($_POST['order'][0]['column']) && isset($_POST['order'][0]['dir'])) {
            $columnIdx = intval($_POST['order'][0]['column']);
            $orderDir = $_POST['order'][0]['dir'];

            if (isset($sortableColumns[$columnIdx])) {
                $orderBy = $sortableColumns[$columnIdx];
            }
        }

        $query = "SELECT *  FROM locator_slip WHERE status = 'Approved' AND office_id IN (334, 335) AND MONTH(date) = MONTH(NOW()) 
        AND YEAR(date) = YEAR(NOW())";
        if (!empty($search)) {
            $query .= " AND (name  LIKE '%" . $conn1->real_escape_string($search) . "%' OR purpose_travel LIKE '%" . $conn1->real_escape_string($search) . "%' OR position LIKE '%" . $conn1->real_escape_string($search) . "%')";
        }

        $query .= " ORDER BY date LIMIT $start, $length";

        $result = $conn1->query($query);

        $totalQuery = "SELECT COUNT(*) as total FROM locator_slip WHERE status = 'Approved' AND  office_id IN (334, 335) AND MONTH(date) = MONTH(NOW()) 
        AND YEAR(date) = YEAR(NOW())";
        if (!empty($search)) {
            $totalQuery .= " AND (name LIKE '%" . $conn1->real_escape_string($search) . "%' OR purpose_travel LIKE '%" . $conn1->real_escape_string($search) . "%' OR position LIKE '%" . $conn1->real_escape_string($search) . "%')";
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
