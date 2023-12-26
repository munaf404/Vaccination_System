<?php

include("connection.php");
$query = "update tbl_feedback set status='hide' where id = $_GET[id]";
mysqli_query($connection,$query);
echo "<script>window.location.href='feedback.php'</script>";
?>