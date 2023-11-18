<?php
require_once 'config.php';

$username = $password = "";

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $query = $mysqli->query("SELECT * FROM users WHERE username = '$username'");
    $num = $query->num_rows;
    $fetch = $query->fetch_array(MYSQLI_ASSOC);

    if ($num != 0) {
        if ($fetch['role'] == 'admin') {
            if ($fetch['password'] == $password) {
                $_SESSION[$fetch['role'] . '_login'] = $fetch['id'];
                $_SESSION[$fetch['role'] . '_name'] = $fetch['username'];
                header('location: admin.php');
            } else {
                header('location: login.php?action=passworderror');
                exit();
            }  
        } else {
            if ($fetch['password'] == $password) {
                $_SESSION[$fetch['role'] . '_login'] = $fetch['id'];
                $_SESSION[$fetch['role'] . '_name'] = $fetch['username'];
                header('location: index.php?action=' . $fetch['role']);
            } else {
                header('location: login.php?action=passworderror');
                exit();
            }   
        }
    } else {
        header('location: login.php?action=usernameerror');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <a href="index.php"><button>กลับสู่หน้าแรก</button></a>
    <h1>เข้าสู่ระบบ</h1>
    <?php if ($_GET['action'] == 'success') { ?>
        <p>เพิ่มข้อมูลสำเร็จ</p>
    <?php } ?>
    <?php if ($_GET['action'] == 'usernameerror') { ?>
        <p>ไม่พบข้อมูลในระบบ</p>
    <?php } ?>
    <?php if ($_GET['action'] == 'passworderror') { ?>
        <p>รหัสผ่านไม่ถูกต้อง</p>
    <?php } ?>
    <?php if ($_GET['action'] == 'pleaselogin') { ?>
        <p>กรุณาเข้าสู่ระบบ</p>
    <?php } ?>
    <form action="login.php" method="post">
        <div>
            <label for="username">ชื่อผู้ใช้</label>
            <input type="text" name="username" required>
        </div>
        <div>
            <label for="password">รหัสผ่าน</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit" name="login">เข้าสู่ระบบ</button>
    </form>
    <p>ยังไม่เป็นสมาชิกใช่ไหม คลิ๊กที่นี่เพื่อ <a href="register.php">สมัครสมาชิก</a></p>
</body>
</html>