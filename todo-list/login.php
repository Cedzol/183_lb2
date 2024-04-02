<?php session_start();
require_once 'config.php';
require_once 'fw/db.php';
require_once 'Log.php';

$log = new Log();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT id, username, password, to_delete FROM users WHERE username=?");

    $stmt->bind_param("s", $username);

    $stmt->execute();

    $log->wh_log("Login request using userId $username and ip " . $_SERVER['REMOTE_ADDR']);

    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($db_id, $db_username, $db_password, $db_to_delete);
        $stmt->fetch();
        if (password_verify($password, $db_password) && !$db_to_delete) {
            $stmt = $conn->prepare("select users.id userid, roles.id roleid, roles.title rolename from users inner join permissions on users.id = permissions.userid inner join roles on permissions.roleID = roles.id where userid =?");
            $stmt->bind_param("s", $db_id);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($db_userid, $db_roleid, $db_rolename);
            $stmt->fetch();

            $_SESSION["username"] = $username;
            $_SESSION["userid"] = $db_id;
            $_SESSION["role"] = $db_roleid;
            header("Location: index.php");
            $log->wh_log("Login request successful for userId $username and ip " . $_SERVER['REMOTE_ADDR']);
            exit();
        } else {
            $log->wh_log("Login request failed for userId $username and ip " . $_SERVER['REMOTE_ADDR']);
        }
    } else {
        $log->wh_log("Login request failed username not found $username " . $_SERVER['REMOTE_ADDR']);
    }

    $stmt->close();
}
require_once 'fw/header.php';
?>

    <h2>Login</h2>

    <form id="form" method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control size-medium" name="username" id="username">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control size-medium" name="password" id="password">
        </div>
        <div class="form-group">
            <label for="submit" ></label>
            <input id="submit" type="submit" class="btn size-auto" value="Login" />
        </div>
    </form>

<?php
require_once 'fw/footer.php';
?>