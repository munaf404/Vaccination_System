<?php
include("connection.php");
?>
<div class="cardBox">
                <div class="card">
                    <div>
                        <?php
                        $query = "select * from tbl_patient";
                        $result = mysqli_query($connection,$query);
                        $patientcount = mysqli_num_rows($result);
                        ?>
                        <div class="numbers"><?php echo $patientcount ?></div>
                        <div class="cardName">Patient</div>
                    </div>
                </div>
                <div class="card">
                    <div>
                    <?php
                        $quer = "select * from tbl_hospitals";
                        $resul = mysqli_query($connection,$quer);
                        $hospitalcount = mysqli_num_rows($resul);
                        ?>
                        <div class="numbers"><?php echo $hospitalcount ?></div>
                        <div class="cardName">Hospital</div>
                    </div>
                </div>
                <div class="card">
                    <div>
                    <?php
                        $que = "select * from tbl_appointment";
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
                        $qu = "select * from tbl_test";
                        $res = mysqli_query($connection,$qu);
                        $testcount = mysqli_num_rows($res);
                        ?>
                        <div class="numbers"><?php echo $testcount ?></div>
                        <div class="cardName">Covid Test</div>
                    </div>
                </div>
            </div>  