<?php session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: ../login.php");
        exit();
    }
    if ($_SESSION['role'] != 1){
        header("Location: ../index.php");
        exit();
    }
    require_once '../fw/header.php';

    $conn = getConnection();
    $stmt = $conn->prepare("SELECT users.ID, users.username, roles.title FROM users inner join permissions on users.ID = permissions.userID inner join roles on permissions.roleID = roles.ID order by ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($db_id, $db_username, $db_title);
?>
<h2>User List</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Role</th>
    </tr>
    <?php
        // Fetch the result
        while ($stmt->fetch()) {
            echo "<tr><td>$db_id</td><td>$db_username</td><td>$db_title</td></tr>";
        }
    ?>
</table>

<?php
    require_once '../fw/footer.php';
?>