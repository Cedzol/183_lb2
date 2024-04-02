<?php session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: /");
    exit();
}
$taskid = "";
require_once 'fw/db.php';
require_once 'Log.php';
$log = new Log();

if (isset($_POST['id']) && strlen($_POST['id']) != 0){
    $taskid = $_POST["id"];
    $conn = getConnection();
    $stmt = $conn->prepare("select ID, title, state from tasks where ID = ?");
    $stmt->bind_param("s", $taskid);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows == 0) {
        $taskid = "";
    }
}

require_once 'fw/header.php';
if (isset($_POST['title']) && isset($_POST['state'])){
    $state = $_POST['state'];
    $title = $_POST['title'];
    $userid = $_SESSION['userid'];

    $log->wh_log("task id: " . $taskid);
    if ($taskid == ""){
        $conn = getConnection();
        $log->wh_log("Save new task for user " . $userid);
        $stmt = $conn->prepare("insert into tasks (title, state, userID) values (?, ?, ?)");
        $stmt->bind_param("sss", $title, $state, $userid);
        $stmt->execute();
    }
    else {
        $conn = getConnection();
        $log->wh_log("Save updated task " . $taskid ." for user " . $userid);
        $stmt = $conn->prepare("update tasks set title = ?, state = ? where ID =?");
        $stmt->bind_param("ssi", $title, $state, $taskid);
        $stmt->execute();
    }

    echo "<span class='info info-success'>Update successfull</span>";
}
else {
    echo "<span class='info info-error'>No update was made</span>";
}

require_once 'fw/footer.php';
?>
