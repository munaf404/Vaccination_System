<?php

include("connection.php");
$query = "update tbl_hospitals set status='deactivate' where id = $_GET[id]";
mysqli_query($connection,$query);
echo "<script>window.location.href='hospital.php'</script>";
?>