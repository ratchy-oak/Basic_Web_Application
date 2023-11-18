<?php
require_once 'config.php';

if(!isset($_SESSION['admin_login'])) {
    header('location: login.php?action=pleaselogin');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>    
    <div class="container-fluid pt-3">
        <h3>ยินดีต้อนรับแอดมิน, <?= $_SESSION['admin_name'] ?></h3>
        <a href="logout.php"><button>ออกจากระบบ</button></a>
        <div class="row">
            <div class="col-md-12">
                <div class="mt-5 mb-3 clearfix">
                    <h2 class="pull-left">ข้อมูลผู้ใช้งาน</h2>
                    <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> เพิ่มสมาชิกผู้ใช้งาน</a>
                </div>
                <?php if ($_GET['action'] == 'success') { ?>
                        <p>เพิ่มข้อมูลสำเร็จ</p>
                <?php } ?>
                <?php if ($_GET['action'] == 'deleted') { ?>
                        <p>ลบข้อมูลสำเร็จ</p>
                <?php } ?>
                <?php if ($_GET['action'] == 'iderror') { ?>
                    <p>ไม่พบผู้ใช้ลำดับนี้</p>
                <?php } ?>
                <?php if ($_GET['action'] == 'updatesuccess') { ?>
                    <p>แก้ไขข้อมูลสำเร็จ</p>
                <?php } ?>
                <?php
                $sql = "SELECT * FROM users";
                if($query = $mysqli->query($sql)){
                    if($query->num_rows > 0){
                        echo '<table class="table table-bordered table-striped">';
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>ลำดับ</th>";
                                    echo "<th>ชื่อจริง</th>";
                                    echo "<th>นามสกุล</th>";
                                    echo "<th>อีเมล</th>";
                                    echo "<th>ชื่อผู้ใช้</th>";
                                    echo "<th>เบอร์โทรศัพท์</th>";
                                    echo "<th>สิทธิผู้ใช้งาน</th>";
                                    echo "<th>จัดการ</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($row = $query->fetch_array()){
                                echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['firstname'] . "</td>";
                                    echo "<td>" . $row['lastname'] . "</td>";
                                    echo "<td>" . $row['email'] . "</td>";
                                    echo "<td>" . $row['username'] . "</td>";
                                    echo "<td>" . $row['tel'] . "</td>";
                                    echo "<td>" . $row['role'] . "</td>";
                                    echo "<td>";
                                        echo '<a href="update.php?id='. $row['id'] .'" class="mr-3" title="แก้ไขข้อมูล" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                        echo '<a href="delete.php?id='. $row['id'] .'" title="ลบข้อมูล" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                    echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";                            
                        echo "</table>";
                    } else{
                        echo '<div class="alert alert-danger"><em>ไม่พบสมาชิกผู้ใช้งาน</em></div>';
                    }
                } else{
                    echo "เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง";
                }
                ?>
            </div>
        </div>        
    </div>
</body>
</html>