<?php
include("connection.php");
session_start();
if(!isset($_SESSION['admin_session']))
{

    echo "<script>
     window.location.href='logout.php';
     </script>";
}

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
<style>
    body
    {
        height: 120vh;
    }
    .container1
    {
        margin-left: 20px;
        margin-top: 10px;
    }
    .container1 table
    {
     width: 95%;
     margin-top: 20px;
    }
    .container1 table,td,th
    {
   
        text-align: center;
        border: 1px solid #999;
        border-collapse: collapse;
        padding: 10px;
    }
    .container1 table button
    {
        padding: 10px;
        width: 80px;
    }
    .container1 ul
    {
        margin-left: 25px;
        /* margin-top: 23px; */
    }
    .container1 ul li
    {
        margin-top: 15px;
        font-size: 17px;
    }
    .container1 img
    {
        margin: 20px 0;
        width: 350px;
        height: 250px;
        /* border: 1px solid black; */
    }
</style>

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
                    <img src="assets/imgs/customer01.jpg" alt="">
                </div>
            </div>
            <!-- ======================= Cards ================== -->
          <div class="container1">
          <h1>List of Hospitals</h1>
        <?php
            $query = "select tbl_hospitals.*,tbl_city.name as 'cname' from tbl_hospitals inner join tbl_city on tbl_hospitals.cid=tbl_city.id where tbl_hospitals.id=$_GET[id]";
            $result = mysqli_query($connection,$query);
            $row = mysqli_fetch_assoc($result);
        ?>
        <img src="<?php echo $row['image']  ?>" alt="">
        <ul>
            <li>Hospital ID : <?php echo $row['id'] ?></li>
            <li>Hospital NAME : <?php echo $row['name'] ?></li>
            <li>Hospital CONTACT : <?php echo $row['contact'] ?></li>
            <li>CITY : <?php echo $row['cname'] ?></li>
            <li>Hospital EMAIL : <?php echo $row['email'] ?></li>
            <li>Hospital PASSWORD : <?php echo $row['password'] ?></li>
            <!-- <li>Hospital IMAGE : <?php echo $row['image'] ?></li> -->
            <li>Hospital ADDRESS : <?php echo $row['address'] ?></li>
            <li>Hospital STATUS : <?php echo $row['status'] ?></li>
            
        </ul>

          </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>