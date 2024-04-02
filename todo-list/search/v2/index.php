<?php session_start();
require_once '../../fw/db.php';

if (!isset($_SESSION["userid"]) || !isset($_GET["terms"])){
    die("Not enough information to search");
}

$userid = $_SESSION["userid"];
$terms = $_GET["terms"];

$conn = getConnection();
$stmt = $conn->prepare("select ID, title, state from tasks where userID =? and title like '%$terms%'");
// Execute the statement
$stmt->bind_param("s", $userid);
$stmt->execute();
// Store the result
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $stmt->bind_result($db_id, $db_title, $db_state);
    while ($stmt->fetch()) {
        echo $db_title . ' (' . $db_state . ')<br />';
    }
}
?>