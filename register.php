<?php
require_once 'config.php';

$firstname = $lastname = $email = $username = $tel = $role = $password = $c_password = "";

if (isset($_POST['register'])) {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $tel = trim($_POST['tel']);
    $role = trim($_POST['role']);
    $password = trim($_POST['password']);
    $c_password = trim($_POST['c_password']);

    if ($password != $c_password) {
        header('location: register.php?action=passworderror');
        exit();
    }

    $equery = $mysqli->query("SELECT email FROM users WHERE email = '$email'");
    $enum = $equery->num_rows;

    $uquery = $mysqli->query("SELECT username FROM users WHERE username = '$username'");
    $unum = $uquery->num_rows;

    if ($enum == 0 && $unum == 0) {
        $sql = "INSERT INTO users (firstname, lastname, email, username, tel, role, password) VALUES ('$firstname', '$lastname', '$email', '$username', '$tel', '$role', '$password')";
        if ($mysqli->query($sql) === true) {
            header("location: login.php?action=success");
            exit();
        }
    } else if ($enum == 1 && $unum == 0) {
        header("location: register.php?action=emailerror");
        exit();
    } else if ($enum == 0 && $unum == 1) {
        header("location: register.php?action=usernameerror");
        exit();
    } else {
        header("location: register.php?action=emailerror");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
</head>
<body>
    <a href="index.php"><button>กลับสู่หน้าแรก</button></a>
    <h1>สมัครสมาชิก</h1>
    <?php if ($_GET['action'] == 'passworderror') { ?>
        <p>รหัสผ่านไม่ตรงกัน</p>
    <?php } ?>
    <?php if ($_GET['action'] == 'emailerror') { ?>
        <p>มีอีเมลนี้ในระบบแล้ว</p>
    <?php } ?>
    <?php if ($_GET['action'] == 'usernameerror') { ?>
        <p>มีชื่อผู้ใช้นี้ในระบบแล้ว</p>
    <?php } ?>
    <form action="register.php" method="post">
        <div>
            <label for="firstname">ชื่อจริง</label>
            <input type="text" name="firstname" required>
        </div>
        <div>
            <label for="lastname">นามสกุล</label>
            <input type="text" name="lastname" required>
        </div>
        <div>
            <label for="email">อีเมล</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label for="username">ชื่อผู้ใช้</label>
            <input type="text" name="username" required>
        </div>
        <div>
            <label for="tel">เบอร์โทรศัพท์</label>
            <input type="tel" name="tel" required>
        </div>
        <div>
            <label for="role">สิทธิผู้ใช้งาน</label>
            <select name="role" required>
                <option value="">เลือกสิทธิผู้ใช้งาน</option>
                <option value="buyer">ผู้ซื้อสินค้า</option>
                <option value="seller">ผู้ขายสินค้า</option>
                <option value="user">ผู้ซื้อและผู้ขายสินค้า</option>
            </select>
        </div>
        <div>
            <label for="password">รหัสผ่าน</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <label for="c_password">ยืนยันรหัสผ่าน</label>
            <input type="password" name="c_password" required>
        </div>
        <button type="submit" name="register">สมัครสมาชิก</button>
    </form>
    <p>เป็นสมาชิกแล้วใช่ไหม คลิ๊กที่นี่เพื่อ <a href="login.php">เข้าสู่ระบบ</a></p>
</body>
</html>