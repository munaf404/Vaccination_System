<?php
include("../admin/connection.php");
session_start();
if(!isset($_SESSION['patient_session']))
{
    session_start();
    session_destroy();
    echo "<script>window.location.href='login.php'</script>";
}
$quer= "select * from tbl_patient where id = $_SESSION[patient_session]";
$resul = mysqli_query($connection,$quer);
$ro = mysqli_fetch_assoc($resul);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/favicon.png" type="">

  <title> Orthoc </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

</head>
<style>
    header
    {
        background-color: #178066;
    }
    .maincontent
    {
        display: flex;
        justify-content: space-evenly;
    }
    .maincontent .leftside
    {
        width: 40%;
        margin-top: 20px;
        /* margin-left: 30px; */
        /* border: 1px solid black; */
    }
    .maincontent .leftside h1
    {
        font-size: 37px;
        margin-top: 5px;
        font-weight: bold;
    }
    .maincontent .leftside input,
    .maincontent .leftside select
    {
        width: 100%;
        border: 1px solid lightgray;
        background-color: #ddd;
        outline: none;
        margin: 12px 0;
        padding: 7px 15px;
        border-radius: 5px;
    }
    .maincontent .leftside input[type=submit]
    {
        background-color: #178066;
        color: white;
        /* padding: 5px 0; */
        font-size: 19px;
    }
    .maincontent .rightside input
    {
        width: 100%;
        border: 1px solid lightgray;
        background-color: #ddd;
        outline: none;
        margin: 12px 0;
        padding: 5px 15px;
        border-radius: 5px;
    }
    .maincontent .rightside input[type=submit]
    {
        background-color: #178066;
        color: white;
        /* padding: 5px 0; */
        font-size: 19px;
    }
    .maincontent .rightside
    {
        width: 40%;
        margin-top: 70px;

    }
    .maincontent .rightside h1
    {
        font-size: 30px;
        margin-bottom: 20px;
        font-weight: bold;
    }
    .maincontent .rightside table
    {
        width: 100%;
    }
    .maincontent .rightside table,tr,th,td
    {
        border: 2px solid #ccc;
        text-align: center;
        padding: 8px;
    }
    .maincontent .rightside table thead
    {
        background-color: #178066;
        color: white;
    }
    footer
    {
        margin-top: 50px;
    }

</style>
<body>
    <?php
    include("header.php");
    ?>
    <div class="maincontent">
        <div class="leftside">
            <h1>Book Appointment</h1>
            <form method="post">
            <input type="hidden" value="<?php echo $ro['id'] ?>" readonly name="pid">
                <input type="text" value="<?php echo $ro['name'] ?>" readonly>
                <select name="hid">
                    <option hidden>Select Any Hospital</option>
                    <?php
                    $query = "select * from tbl_hospitals where status='activate'";
                    $result =  mysqli_query($connection,$query);
                    foreach($result as $row)
                    {
                        echo "<option value='$row[id]'>$row[name]</option>";
                    }
                    ?>
                </select>
                <input type="date" name="date">
                <select name="time" >
                    <option value="" hidden>Select Slot</option>
                    <option value="9-11">9-11</option>
                    <option value="11-1">11-1</option>
                    <option value="1-3">1-3</option>
                    <option value="3-5">3-5</option>
                </select>
                <select name="vid">
                    <option hidden>Select Any Vaccine</option>
                    <?php
                    $query = "select * from tbl_vaccine where status='avaliable'";
                    $result =  mysqli_query($connection,$query);
                    foreach($result as $row)
                    {
                        echo "<option value='$row[id]'>$row[name]</option>";
                    }
                    ?>
                </select>
                <input type="submit" value="Book Appointment" name="btnbook">
                
            </form>
            <?php
            if(isset($_POST['btnbook']))
            {
                $pid = $_POST['pid'];
                $hid = $_POST['hid'];
                $date = $_POST['date'];
                $time = $_POST['time'];
                $vid = $_POST['vid'];

                $exisiting_appointment = mysqli_query($connection,"select * from tbl_appointment where h_id='$hid' and date='$date' and time='$time' and p_id='$_SESSION[patient_session]'");
                if(mysqli_num_rows($exisiting_appointment)>0)
                {
                    echo "<script>
                    alert('Appointment Already Exist')
                    window.location.href='appointment.php';
                    </script>";

                }
                else{
                    $current_vaccine = mysqli_query($connection,"select * from tbl_appointment where v_id='$vid' and p_id=$_SESSION[patient_session]");
                    $exisiting_vaccine = mysqli_fetch_assoc($current_vaccine);
                    if($exisiting_vaccine && $exisiting_vaccine['v_id']==$vid)
                    {
                $q="insert into tbl_appointment (p_id,h_id,date,time,v_id) values ('$pid','$hid','$date','$time','$vid')";
                $r = mysqli_query($connection,$q);
                if($r)
                {
                    echo "<script>
                    alert('Appointment Booked')
                    window.location.href='appointment.php';
                    </script>";
                }
            }
            else
            {
                echo "<script>
                alert('You Have To Select Same Vaccine')
                </script>";
            }
            }
            }
            ?>
           
        </div>
        <div class="rightside">
            <h1>Your Appointment</h1>
            <table>
                <thead>
                    <tr>
                        <th>Hospital Name</th>
                        <th>Vaccine Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query ="select tbl_hospitals.name as 'hname',tbl_vaccine.name as 'vname', tbl_appointment.* from tbl_appointment inner join tbl_hospitals on tbl_appointment.h_id = tbl_hospitals.id inner join tbl_vaccine on tbl_appointment.v_id=tbl_vaccine.id inner join tbl_patient on tbl_appointment.p_id=tbl_patient.id where tbl_patient.id = $_SESSION[patient_session]";
                    $result = mysqli_query($connection,$query);
                    foreach($result as $row)
                    {
                        echo "<tr>
                        <td>$row[hname]</td>
                        <td>$row[vname]</td>
                        <td>$row[date]</td>
                        <td>$row[time]</td>
                        <td>$row[status]</td>
                        </tr>";
                    }

                    ?>
                </tbody>
            </table>
            
        </div>
    </div>
     <!-- footer section -->
  <footer class="footer_section">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-lg-3 footer_col">
          <div class="footer_contact">
            <h4>
              Reach at..
            </h4>
            <div class="contact_link_box">
              <a href="">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span>
                  Location
                </span>
              </a>
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  Call +01 1234567890
                </span>
              </a>
              <a href="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>
                  demo@gmail.com
                </span>
              </a>
            </div>
          </div>
          <div class="footer_social">
            <a href="">
              <i class="fa fa-facebook" aria-hidden="true"></i>
            </a>
            <a href="">
              <i class="fa fa-twitter" aria-hidden="true"></i>
            </a>
            <a href="">
              <i class="fa fa-linkedin" aria-hidden="true"></i>
            </a>
            <a href="">
              <i class="fa fa-instagram" aria-hidden="true"></i>
            </a>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 footer_col">
          <div class="footer_detail">
            <h4>
              About
            </h4>
            <p>
              Beatae provident nobis mollitia magnam voluptatum, unde dicta facilis minima veniam corporis laudantium alias tenetur eveniet illum reprehenderit fugit a delectus officiis blanditiis ea.
            </p>
          </div>
        </div>
        <div class="col-md-6 col-lg-2 mx-auto footer_col">
          <div class="footer_link_box">
            <h4>
              Links
            </h4>
            <div class="footer_links">
              <a class="" href="index.html">
                Home
              </a>
              <a class="" href="about.html">
                About
              </a>
              <a class="active" href="departments.html">
                Departments
              </a>
              <a class="" href="doctors.html">
                Doctors
              </a>
              <a class="" href="contact.html">
                Contact Us
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 footer_col ">
          <h4>
            Newsletter
          </h4>
          <form action="#">
            <input type="email" placeholder="Enter email" />
            <button type="submit">
              Subscribe
            </button>
          </form>
        </div>
      </div>
      <div class="footer-info">
        <p>
          &copy; <span id="displayYear"></span> All Rights Reserved By
          <a href="https://html.design/">Free Html Templates</a>
        </p>
      </div>
    </div>
  </footer>
  <!-- footer section -->
</body>
</html>