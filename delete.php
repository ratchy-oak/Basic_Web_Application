<?php
require_once "config.php";

if(!isset($_SESSION['admin_login'])) {
    header('location: login.php?action=pleaselogin');
    exit();
}

if (isset($_POST["delete"])) {
    if (isset($_POST["id"]) && !empty(trim($_POST["id"]))) {
        $id = trim($_POST["id"]);
    
        $sql = "DELETE FROM users WHERE id = $id";
        
        if($mysqli->query($sql) === true){
            header("location: admin.php?action=deleted");
            exit();
        } else{
            header("location: delete.php?action=failed");
            exit();
        }
    } else{
        header("location: admin.php?action=iderror");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 mb-3">ลบข้อมูลสมาชิก</h2>
                    <?php if ($_GET['action'] == 'failed') { ?>
                        <p>ลบข้อมูลไม่สำเร็จ</p>
                    <?php } ?>
                    <form action="delete.php" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>คุณแน่ใจหรือไม่ที่จะลบข้อมูลผู้ใช้นี้?</p>
                            <p>
                                <input type="submit" value="ใช่" name="delete" class="btn btn-danger">
                                <a href="admin.php" class="btn btn-secondary ml-2">ไม่</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>