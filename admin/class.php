<?php 
 class Employee{
    private $count;

    public function __construct() {
        include('../database.php');

        $sql = "SELECT COUNT(*) as total FROM employee_tracker WHERE status = 'Approved' AND MONTH(date) = MONTH(NOW()) 
        AND YEAR(date) = YEAR(NOW())";
        
        $query = $conn1->query($sql);
        $Data = $query->fetch_assoc();

        if ($Data) {
            $this->count = $Data['total'];
        }
    }

    public function getValue($part) {
        switch ($part) {
            case "count":
                return $this->count;
            default:
                return null; 
        }
    }
   
}

class Employee1{
    private $count1;

    public function __construct() {
        include('../database.php');

        $sql = "SELECT COUNT(*) as total FROM locator_slip WHERE status = 'Approved' AND office_id IN (334, 335) AND MONTH(date) = MONTH(NOW()) 
        AND YEAR(date) = YEAR(NOW())";
        
        $query = $conn1->query($sql);
        $Data = $query->fetch_assoc();

        if ($Data) {
            $this->count1 = $Data['total'];
        }
    }

    public function getValue($part) {
        switch ($part) {
            case "count1":
                return $this->count1;
            default:
                return null; 
        }
    }
   
}


class Employee2{
    private $count2;

    public function __construct() {
        include('../database.php');

        $sql = "SELECT COUNT(*) as total FROM pass_slip WHERE status = 'Approved' AND MONTH(date_t) = MONTH(NOW()) 
        AND YEAR(date_t) = YEAR(NOW())";
        
        $query = $conn1->query($sql);
        $Data = $query->fetch_assoc();

        if ($Data) {
            $this->count2 = $Data['total'];
        }
    }

    public function getValue($part) {
        switch ($part) {
            case "count2":
                return $this->count2;
            default:
                return null; 
        }
    }
   
}

?>



