<!-- <?php 
class Employee {
    private $count;

    public function __construct() {
        include('../database.php');


        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $user_id = $_SESSION['user_id'];
        $allowed_user_ids = $_SESSION['allowed_user_ids'];

        $allowed_user_ids_str = implode(",", array_map('intval', $allowed_user_ids));

        $sql = "SELECT COUNT(*) as total 
                FROM employee_tracker 
                WHERE 1=1
                AND MONTH(date) = MONTH(NOW()) 
                AND YEAR(date) = YEAR(NOW()) 
                AND office_id IN ($allowed_user_ids_str)";

        $query = $conn1->query($sql);
        $Data = $query->fetch_assoc();

        if ($Data) {
            $this->count = $Data['total'];
        } else {
            $this->count = 0;
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

        
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $user_id = $_SESSION['user_id'];
        $allowed_user_ids = $_SESSION['allowed_user_ids'];

        $allowed_user_ids_str = implode(",", array_map('intval', $allowed_user_ids));


        $sql = "SELECT COUNT(*) as total FROM locator_slip WHERE 1=1 AND MONTH(date) = MONTH(NOW()) 
        AND YEAR(date) = YEAR(NOW()) AND office_id IN ($allowed_user_ids_str)";
        
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

                
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $user_id = $_SESSION['user_id'];
        $allowed_user_ids = $_SESSION['allowed_user_ids'];

        $allowed_user_ids_str = implode(",", array_map('intval', $allowed_user_ids));
        $sql = "SELECT COUNT(*) as total FROM pass_slip WHERE 1=1 AND MONTH(date_t) = MONTH(NOW()) 
        AND YEAR(date_t) = YEAR(NOW()) AND office_id IN ($allowed_user_ids_str)";
        
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

?> -->