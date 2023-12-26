<?php
include("../admin/connection.php");
?>
<div class="cardBox">
                <div class="card">
                    <div>
                    <?php
                        $que = "select * from tbl_appointment where id = $_SESSION[hospital_session]";
                        $resu = mysqli_query($connection,$que);
                        $appointmentcount = mysqli_num_rows($resu);
                        ?>
                        <div class="numbers"><?php echo $appointmentcount ?></div>
                        <div class="cardName">Appointments</div>
                    </div>
                </div>
                <div class="card">
                    <div>
                    <?php
                        $qu = "select * from tbl_test where id = $_SESSION[hospital_session]";
                        $res = mysqli_query($connection,$qu);
                        $testcount = mysqli_num_rows($res);
                        ?>
                        <div class="numbers"><?php echo $testcount ?></div>
                        <div class="cardName">Covid Test</div>
                    </div>
                </div>
            </div>  