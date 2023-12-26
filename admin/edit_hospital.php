<?php
include("connection.php");
session_start();
if(!isset($_SESSION['admin_session']))
{

    echo "<script>
     window.location.href='logout.php';
     </script>";
}
$q = "select * from tbl_hospitals where id=$_GET[id]";
$res = mysqli_query($connection,$q);
$r = mysqli_fetch_assoc($res);

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
        padding: 30px 50px;
        display: flex;
        justify-content: space-around;
        /* margin-top: -15px; */
    }
    .maincontent .leftside
    {
        width: 45%;

    }
    .maincontent .rightside
    {
        width: 40%;
        /* align-items: center; */

        /* justify-content: center; */
        /* width: 400px; */
    
    }
    .maincontent .rightside input
    {
        justify-content: center;
        align-items: center;
        margin-left: 35px;
        margin-top: 20px;
    }
    .maincontent .rightside .image
    {
        width: 380px;
        margin-left: 40px;
        height: 300px;
        border: 1px solid black;
    }
    .maincontent .rightside .image img
    {
        width: 100%;
        height: 100%;
        object-fit: cover;
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
                <div class="leftside">
            <h1>Edit / Update HOSPITAL</h1>
            <form method="post" enctype="multipart/form-data">
                <input type="text" placeholder="Enter Hospital Name" name="name" value="<?php  echo $r['name']?>" > <br><br>
                <input type="number" placeholder="Enter Hospital Number" name="phone" value="<?php  echo $r['contact']?>"> <br><br>
                <select name="city" >
                    <option hidden>select any city</option>
                    <?php
                    $query = "select * from tbl_city";
                    $result = mysqli_query($connection,$query);
                    foreach($result as $row1)
                    {
                        echo "<option value='".$row1['id']."'";
                        if($r['cid']==$row1['id'])
                        {
                            echo "selected";
                        }
                        echo ">".$row1['name']."</option>";
                    }
                    ?>
                </select><br><br>
                <input type="email" placeholder="Enter Hospital Email" name="email" value="<?php  echo $r['email']?>"> <br><br>
                <input type="password" placeholder="Enter Hospital password" name="password" value="<?php  echo $r['password']?>"> <br><br>
                <input type="text" placeholder="Enter Hospital Address" name="address" value="<?php  echo $r['address']?>"> <br><br>
               
                <input type="submit" value="UPDATE HOSPITAL" name="btnadd">
                
            </form>
                </div>
            <?php
            if(isset($_POST['btnadd']))
            {
                $name = $_POST['name'];
                $phone = $_POST['phone'];
                $city = $_POST['city'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $address= $_POST['address'];
                $qry ="update tbl_hospitals set name='$name',contact='$phone',cid='$city',email='$email',password='$password',address='$address' where id = $_GET[id] ";
                $result = mysqli_query($connection,$qry);
                if($result)
                {
                    echo "<script>alert('UPADTE HOSPITAL SUCCESSFULLY');
                    window.location.href='hospital.php'</script>";
                }
                else
                {
                    echo "<script>alert('UPDATE HOSPITAL FAILED')</script>";
                }
            }
            ?>
            <div class="rightside">
                <div class="image">
                    <img src="<?php echo $r['image'] ?>" alt="">
                </div>
                <form method="post" enctype="multipart/form-data">
                    <input type="file" name="image" >
                    <input type="submit" name="submitt" value="UPDATE IMAGE">
                    <?php
                    if(isset($_POST['submitt']))
                    {
                      $imagename = $_FILES['image']['name'];
                      $imagetmp = $_FILES['image']['tmp_name'];
                      $path = "assets/imgs/hospital_images/$imagename";
                      move_uploaded_file($imagetmp,$path);
                      $qr ="update tbl_hospitals set image='$path' where id = $_GET[id]";
                      $re = mysqli_query($connection,$qr);
                       if($re)
                          {
                            echo "<script>alert('UPDATE IMAGE SUCCESSFULLY');
                           </script>";
                            }
                        else
                         {
                           echo "<script>alert('UPDATE IMAGE FAILED')</script>";
                          }
                        }
                       
                    ?>
                </form>

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