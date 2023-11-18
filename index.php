<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Page</title>
</head>
<body>
    <h1>Index Page</h1>
    <?php if ($_GET['action'] == '') { ?>
        <a href="login.php"><button>เข้าสู่ระบบ</button></a>
        <a href="register.php"><button>สมัครสมาชิก</button></a>
    <?php } ?>

    <?php if ($_GET['action'] == 'buyer') { 
        if(!isset($_SESSION['buyer_login'])) {
            header('location: login.php?action=pleaselogin');
            exit();
        }
    ?>
        <h3>ยินดีต้อนรับผู้ซื้อ, <?= $_SESSION['buyer_name'] ?></h3>
        <a href="logout.php"><button>ออกจากระบบ</button></a>
    <?php } ?>

    <?php if ($_GET['action'] == 'seller') { 
        if(!isset($_SESSION['seller_login'])) {
            header('location: login.php?action=pleaselogin');
            exit();
        }
    ?>
        <h3>ยินดีต้อนรับผู้ขาย, <?= $_SESSION['seller_name'] ?></h3>
        <a href="logout.php"><button>ออกจากระบบ</button></a>
    <?php } ?>

    <?php if ($_GET['action'] == 'user') { 
        if(!isset($_SESSION['user_login'])) {
            header('location: login.php?action=pleaselogin');
            exit();
        }      
    ?>
        <h3>ยินดีต้อนรับผู้ซื้อและผู้ขาย, <?= $_SESSION['user_name'] ?></h3>
        <a href="logout.php"><button>ออกจากระบบ</button></a>
    <?php } ?>
</body>
</html>