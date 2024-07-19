 <?php
session_start();
include ('../database.php'); 

$user_id = $_SESSION['user_id'];
$allowed_user_ids = $_SESSION['allowed_user_ids'];


$allowed_user_ids_str = implode(',', $allowed_user_ids);


$today_date = date('Y-m-d');

$query = "
    SELECT COUNT(*) as count 
    FROM locator_slip ls 
    INNER JOIN users u ON ls.user_id = u.id
    WHERE ls.status = 'pending' 
    AND ls.user_id = $user_id
    AND ls.user_id IN ($allowed_user_ids_str)
    AND DATE(ls.date_created) = '$today_date'
";

$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    echo json_encode(['count' => $row['count']]);
} else {
    echo json_encode(['count' => 0]);
}
?> 
