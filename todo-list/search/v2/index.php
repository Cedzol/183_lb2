<?php

if (!isset($_GET["userid"]) || !isset($_GET["terms"])){
    die("Not enough information to search");
}

$userid = $_GET["userid"];
$terms = $_GET["terms"];

require_once '../../fw/db.php';
$conn = getConnection();
$stmt = $conn->prepare("select ID, title, state from tasks where userID =? and title like %?%");
// Execute the statement
$stmt->bind_param("ss", $userid, $terms);
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