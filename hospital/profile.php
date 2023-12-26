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
<style>
    .container1{
        margin-left: 30px;
        display: flex;
    }
    .main .user img
    {
        object-fit: cover;
    }
    .container1 h1
    {
        margin-left: 35px;
        margin-bottom: 15px;
    }
    .container1 .leftside
    {
        width: 50%;
        margin-top: 10px ;
    }
    .container1 input,
    .container1 select
    {
        width: 300px;
        font-size: 18.5px;
        padding: 10px 20px;
        margin: 12px 18px;
        background-color: #ddd;
        border-radius: 5px;
        outline: none;
        border: none;
    }
    .container1 input[type="submit"]
    {
        background-color: #178066;
        color:#ffffff;
    }
    .container1 .rightside
    {
        width: 45%;
        /* border: 1px solid black; */
        justify-content: center;
        align-items: center;
        /* text-align: center; */
    }
    .container1 .rightside .image 
    {
        width: 300px;
        height: 270px;
        margin: 5px;
        margin-left: 15px;
        /* border: 1px solid black; */
    }
    .container1 .rightside .image img
    {
        width: 100%;
        height: 100%;
        object-fit: cover;
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
                    <img src="<?php echo $row['image']?>" alt="">
                </div>
            </div>
            <!-- ======================= Cards ================== -->
          <div class="container1">
            <div class="leftside">
            <h1>Profile</h1>
            <form method="post">
            <input type="text" placeholder="Enter your name" name="name" value="<?php echo $row['name'] ?>"><br>
            <input type="text" placeholder="Enter your email" name="email" value="<?php echo $row['email'] ?>"><br>
            <input type="text" placeholder="Enter your password" name="password" value="<?php echo $row['password'] ?>"><br>
            <input type="text" placeholder="Enter your Contact" name="contact" value="<?php echo $row['contact'] ?>"><br>
            <select name="city" >
                    <option hidden>select any city</option>
                    <?php
                    $query = "select * from tbl_city";
                    $result = mysqli_query($connection,$query);
                    foreach($result as $row1)
                    {
                        echo "<option value='".$row1['id']."'";
                        if($row['cid']==$row1['id'])
                        {
                            echo "selected";
                        }
                        echo ">".$row1['name']."</option>";
                    }
                    ?>
                </select>
            <input type="text" placeholder="Enter your address" name="address" value="<?php echo $row['address'] ?>"><br>

            <input type="submit" name="btnsubmit" value="Update Profile">
            </form>
            <?php
            if(isset($_POST['btnsubmit']))
            {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $contact = $_POST['contact'];
            $city = $_POST['city'];
            $address = $_POST['address'];
            $qur = "UPDATE tbl_hospitals SET name='$name',email='$email', password='$password',contact='$contact', cid='$city',address ='$address' where id = $_SESSION[hospital_session]";
            $re = mysqli_query($connection,$qur);
            if($re)
            {
                echo "<script>window.location.href='profile.php'</script>";
            }
        }
            ?>
            </div>
            <div class="rightside">
                <div class="image"><img src="<?php echo $row['image']?>"></div>
                <form method="post" enctype="multipart/form-data">
                    <input type="file" name="image">
                    <input type="submit" value="Update Image" name="btnupdate">
                </form>
                <?php
                if(isset($_POST['btnupdate']))
                {
                    $imagename =$_FILES['image']['name'];
                    $imagetmp =$_FILES['image']['tmp_name'];
                    $path = "assets/imgs/hospital_images/$imagename";
                    move_uploaded_file($imagetmp,$path);
                    $q = "update tbl_hospitals set image='$path' where id = $_SESSION[hospital_session]";
                    $r = mysqli_query($connection,$q);
                    if($r)
                    {
                        echo "<script>window.location.href='profile.php'</script>";
                    }
                }
                ?>
            </div>
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