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
    .maincontent
    {
        padding: 30px 90px;
        /* margin-top: -15px; */
    }
    .maincontent h1
    {
        text-align: center;
        /* justify-content: center; */
        /* align-items: center; */
        /* margin: 20px; */
        margin-top: -10px;
        margin-bottom: 20px;
        
    }
    .maincontent input,
    .maincontent form select
    {
        width: 100%;
        border: none;
        outline: none;
        background-color: #eee;
        padding: 15px 20px;
        border-radius: 6px;
        /* margin: 1.5px 0px; */
    }
    .maincontent input[type=submit]
    {
        background-color: #178066;
        color: #ffffff;
    }
    .maincontent .gender 
    {
        /* background-color: #178066; */
        /* margin-top: 10px; */
        width: 300px;
        display: flex;
        margin-left: 15px;
        justify-content: space-between;
        /* align-items: flex-start; */
        flex-direction: column;
    }
    .maincontent .gender span 
    {
        font-size: 16px;
    }
    .maincontent .gender .input 
    {
        display: flex;
        /* margin-top: 10px; */
        margin-bottom: 20px;
        justify-content: space-between;
        align-items: center;
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
          
            <div class="maincontent">
            <h1>REGISTER NEW PATIENT</h1>
            <form method="post" enctype="multipart/form-data">
                <input type="text" placeholder="Enter Patient Name" name="name" > <br><br>
                <input type="number" placeholder="Enter Patient Number" name="phone"> <br><br>
                <select name="city" >
                    <option hidden>select any city</option>
                    <?php
                    $query = "select * from tbl_city";
                    $result = mysqli_query($connection,$query);
                    foreach($result as $row)
                    {
                        echo "<option value='$row[id]'>$row[name]</option>";
                    }
                    ?>
                </select><br><br>
                <input type="email" placeholder="Enter Patient Email" name="email"> <br><br>
                <input type="password" placeholder="Enter Patient password" name="password"> <br><br>
                <input type="text" placeholder="Enter Patient Address" name="address"> <br><br>
                <select name="gender" >
                    <option hidden>select any gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select><br><br>
                <select name="status" >
                    <option hidden>select any status</option>
                    <option value="activate">Activate</option>
                    <option value="deactivate">Deactivate</option>
                </select><br><br>
                <input type="file" name="image"> <br><br>
                <input type="submit" value="Add New Patient" name="btnadd">
                
            </form>
            <?php
            if(isset($_POST['btnadd']))
            {
                $name = $_POST['name'];
                $phone = $_POST['phone'];
                $city = $_POST['city'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $address= $_POST['address'];
                $status = $_POST['status'];
                $gender = $_POST['gender'];
                $imagename = $_FILES['image']['name'];
                $imagetmp = $_FILES['image']['tmp_name'];
                $path = "assets/imgs/patient_images/$imagename";
                move_uploaded_file($imagetmp,$path);
                $qry ="insert into tbl_patient (name,contact,cid,email,password,image,address,gender,status) values ('$name','$phone','$city','$email','$password','$path','$address','$gender','$status')";
                $result = mysqli_query($connection,$qry);
                if($result)
                {
                    echo "<script>alert('ADD HOSPITAL SUCCESSFULLY');
                    window.location.href='patient.php'</script>";
                }
                else
                {
                    echo "<script>alert('ADD HOSPITAL FAILED')</script>";
                }
            }
            ?>
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