<?php
include("../admin/connection.php");
session_start();
if(!isset($_SESSION['hospital_session']))
{

    echo "<script>
     window.location.href='logout.php';
     </script>";
}
$query = "select * from tbl_hospitals where id = $_SESSION[hospital_session]";
$result = mysqli_query($connection,$query);
$row = mysqli_fetch_assoc($result)
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccination System</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/index.css">
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
      <?php
      include("navigation.php");
      ?>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <div class="user">
                    <a href="profile.php">
                    <img src="<?php echo $row['image']?>" alt=""></a>
                </div>
            </div>
            <!-- ======================= Cards ================== -->
           <?php
           include("card.php")
           ?>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>