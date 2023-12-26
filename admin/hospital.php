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
        width: 85px;
        /* margin: 0px -4px; */
        border-radius: 5px;
        background-color: #178066;
        border: none;
        color: #ffffff;
    }
    .container1 .btndeactivate
    {
        background-color: red;
        /* color: black; */
    }
    .container1 .btn
    {
        padding: 10px;
        /* width: 85px; */
        /* margin: 10px 0px; */
        margin-top: 8px;
        margin-bottom: -5px;
        /* display: inline-block; */
        /* margin: 0px -4px; */
        border-radius: 5px;
        background-color: #178066;
        border: none;
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
          <div class="container1">
          <h1>List of Hospitals</h1>
          <a href="add_new_hospital.php"><button class="btn">Create New Hospital</button></a>
          <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php
            $query = "select * from tbl_hospitals";
            $result = mysqli_query($connection,$query);
            foreach($result as $row)
            {
                echo "<tbody>
                <tr>
                    <td>$row[id]</td>
                    <td>$row[name]</td>
                    <td>$row[email]</td>
                    <td>$row[address]</td>
                    <td>$row[status]</td>
                    <td><a href='view_hospital.php?id=$row[id]'><button>View</button></a>&nbsp;
                    <a href='edit_hospital.php?id=$row[id]'><button>Edit</button></a>&nbsp;";
                    if($row['status']=="deactivate")
                    {
                      echo "&nbsp;<a href='activate_hospital.php?id=$row[id]' ><button class='btnactivate'>Activate</button></a>";

                    }
                    else
                    {
                      echo "<a href='deactivate_hospital.php?id=$row[id]' ><button class='btndeactivate'>Deactivate</button></a>";
                    }
                    
                    
                "</tr>
            </tbody>";
            }
            ?>
            
           
          </table>

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