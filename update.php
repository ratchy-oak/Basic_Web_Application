<?php
require_once 'config.php';

if(!isset($_SESSION['admin_login'])) {
    header('location: login.php?action=pleaselogin');
    exit();
}

$id = trim($_GET['id']);
$query = $mysqli->query("SELECT * FROM users WHERE id = '$id'");
$fetch = $query->fetch_array(MYSQLI_ASSOC);

if (isset($_POST["update"])) {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $tel = trim($_POST['tel']);
    $role = trim($_POST['role']);

    $sql = "UPDATE users SET firstname='$firstname', lastname='$lastname',email='$email', username='$username', tel='$tel', role='$role'  WHERE id = '$id'";
    if ($mysqli->query($sql) === true) {
        header("location: admin.php?action=updatesuccess");
        exit();
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Page</title>
</head>
<body>
    <a href="admin.php"><button>กลับสู่หน้าแรก</button></a>
    <h1>แก้ไขข้อมูล</h1>
    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
        <div>
            <label for="firstname">ชื่อจริง</label>
            <input type="text" name="firstname" value="<?php echo $fetch['firstname']; ?>" required>
        </div>
        <div>
            <label for="lastname">นามสกุล</label>
            <input type="text" name="lastname" value="<?php echo $fetch['lastname']; ?>" required>
        </div>
        <div>
            <label for="email">อีเมล</label>
            <input type="email" name="email" value="<?php echo $fetch['email']; ?>" required>
        </div>
        <div>
            <label for="username">ชื่อผู้ใช้</label>
            <input type="text" name="username" value="<?php echo $fetch['username']; ?>" required>
        </div>
        <div>
            <label for="tel">เบอร์โทรศัพท์</label>
            <input type="tel" name="tel" value="<?php echo $fetch['tel']; ?>" required>
        </div>
        <div>
            <label for="role">สิทธิผู้ใช้งาน</label>
            <select name="role" required>
                <option value="buyer" <?php echo $fetch['role'] == 'buyer' ? 'selected="selected"' : '' ?>>ผู้ซื้อสินค้า</option>
                <option value="seller" <?php echo $fetch['role'] == 'seller' ? 'selected="selected"' : '' ?>>ผู้ขายสินค้า</option>
                <option value="user" <?php echo $fetch['role'] == 'user' ? 'selected="selected"' : '' ?>>ผู้ซื้อและผู้ขายสินค้า</option>
                <option value="admin" <?php echo $fetch['role'] == 'admin' ? 'selected="selected"' : '' ?>>ผู้ดูแลระบบ</option>
            </select>
        </div>
        <button type="submit" name="update">แก้ไขข้อมูล</button>
    </form>
</body>
</html>