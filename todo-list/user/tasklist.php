<?php
    if (!isset($_SESSION['username'])) {
        header("Location: ../login.php");
        exit();
    }
    require_once 'config.php';
    $userid = $_SESSION['userid'];

    $conn = getConnection();
    $stmt = $conn->prepare("select ID, title, state from tasks where UserID =?");
    $stmt->bind_param("s", $userid);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($db_id, $db_title, $db_state);
?>
<section id="list">
    <a href="create.php">Create Task</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Description</th>
            <th>State</th>
            <th></th>
        </tr>
        <?php while ($stmt->fetch()) { ?>
            <tr>
                <td><?php echo $db_id ?></td>
                <td class="wide"><?php echo $db_title ?></td>
                <td><?php echo ucfirst($db_state) ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $db_id ?>">edit</a> | <a href="delete.php?id=<?php echo $db_id ?>">delete</a>
                </td>
            </tr>
        <?php } ?>        
    </table>
</section>