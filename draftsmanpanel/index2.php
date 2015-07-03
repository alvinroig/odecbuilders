<?php
     include_once "includes/database.php";
     echo $db -> ifLogin();
     $id = $_SESSION['empID'];
     $icon = '<i class="fa fa-dashboard"></i>';
     $title = "Overview";
    date_default_timezone_set('Asia/Manila');
    $date=date('Y-m-d');
?>

<!DOCTYPE html>
<html>
    <head>
        <?php

         include_once "includes/head.php"; 

         ?>
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <?php include_once "includes/navigation.php" ?>


            <!-- Right side column. Contains the navbar and content of the page -->
            <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="box box-warning">
                                <div class="box-header">
                                    <div class="box-title">Project TimeIn/TimeOut</div><br>
                                    <div class="box-body">
                                         <div class="form-group">



                                         <form method="POST" action="">
                                            <label><br>Project Name:<br> <?php echo $db -> fetchprojm($id); ?></label>
                                            <?php
                       

                                                
                                                        if(isset($_GET['s'])){
                                                            $s = $_GET['s'];
                                                            if($s == 'timein'){
                                                            echo '<div class="alert alert-success" id="alert" style="visibility: true; display: block; width:90%;">
                                                                <a href="#" class="close" data-dismiss="alert">&times;</a>
                                                                <strong>Success!</strong> Time In Project Successful.
                                                            </div>';
                                                            }else if($s=='errordate'){
                                                                echo '<div class="alert alert-danger" id="alert" style="visibility: true; display: block; width:90%;">
                                                                <a href="#" class="close" data-dismiss="alert">&times;</a>
                                                                <strong>Error!</strong> Invalid time out date.
                                                            </div>';
                                                            }else if($s=='errortime'){
                                                                echo '<div class="alert alert-danger" id="alert" style="visibility: true; display: block; width:90%;">
                                                                <a href="#" class="close" data-dismiss="alert">&times;</a>
                                                                <strong>Error!</strong> Time out cannot be less than your time in!
                                                            </div>';
                                                            }

                                                        }
                                                        
                                                    ?>
                                            <div class="box-footer">
                                                <label style="margin-left:140px;"></label><br>
                                                
                                                <?php
                                                     date_default_timezone_set('Asia/Manila');
                                                     $date=date('Y-m-d');
                                                     $time=date('G:i A');
                                                ?>

                                                <input type="hidden" name="date" value="<?php echo $date ?>"/>
                                                <input type="hidden" name="time" value="<?php echo $time ?>"/>
                                                <?php 
                                                    $pid = $_GET['pid'];
                                                    $query = $dbh->query("SELECT COUNT(projectID) AS `count`, totalNumHours as `hours`, duedate as `dd` FROM project WHERE `draftsmanID` = '$id' AND status='ongoing' AND projectID='$pid'");
                                                    $query -> execute();
                                                    $row = $query -> fetch();
                                                    $d = date('Y-m-d');
                                                    if($row["count"] > 0 && ($row['hours'] == 0 || $row['dd'] == $d)){
                                                      echo  "
                                                        <input class='btn btn-warning btn-lg' type='submit' value='Request for Extension' name='request'/>";
                                                    }else if($row["count"] > 0 && ($row['hours'] > 0 || $row['dd'] < $d)){
                                                      echo  "<center>
                                                             <input class='btn btn-default btn-md' type='submit' value='TIME IN' name='punchin'  disabled/>
                                                              <a href='#punchout'><button class='btn btn-danger btn-md' type='button'>TIME OUT</button></center>
                                                        ";

                                                        echo '<div id="punchout" class="modalDialog text-center" style="margin-top:-50px">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-header">
                                                                        
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <p>TIME OUT</p>
                                                                        TIME:<input type="time" class="form-control" name="to" value='.$time.' />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</br>
                                                                        DATE:<input type="date" class="form-control" name="date2" value='.$date.' />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</br></br>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                            <button class="btn btn-info" name="punchout" type="submit">TIME OUT!</button>
                                                                        
                                                                        <a href=#close><button class="btn btn-default" type="button">BACK</button></a>

                                                                    </div>
                                                                </div>
                                                            </div>';
                                                    }else if($row["count"] == 0){
                                                      echo  "<input class='btn btn-danger btn-lg' type='submit' value='TIME IN' name='punchin' disabled/>
                                                        <input class='btn btn-default btn-lg' type='submit' value='TIME OUT' name='punchout' disabled/>
                                                        ";
                                                    }

                                                ?>
                                            </div>     
                                      </div>
                                    </div>                                  
                                </div><!-- /.box-header -->
                                </form>
                            </div><!-- /.box -->
                        </div>



                        <div class="col-xs-6">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="fa fa-tasks"></i> List of Ongoing Projects</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr role="row">
                                            <th colspan="1" rowspan="1"><i class="fa fa-flag"></i> Project Name</th> 
                                            <th colspan="1" rowspan="1"><i class="fa fa-calendar"></i> Due Date</th> 
                                            <th colspan="1" rowspan="1"><i class="fa fa-check-circle-o"></i> Time Remaining</th>
                                            <th colspan="1" rowspan="1"><i class="fa fa-check-circle-o"></i> Logs</th>  
                                    </thead>
                                        <tbody>
                                             <?php echo $db -> fetchOngoingProjects($id); ?>
                                    </tbody></table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>

                               
                                    <?php

                                    $query = $dbh->query("SELECT TIMESTAMPDIFF(DAY,CURDATE(),duedate) as `diff`,projectName as `pn` FROM project WHERE `draftsmanID` = '$id' AND status = 'ongoing'");
                                    $query -> execute();
                                    $temp = 1;
                                    while($row = $query->fetch()){
                                        if($row['diff'] == 1){
                                            if($temp == 1){
                                            echo"<div class='col-xs-6'>
                                            <div class='box'>
                                            <div class='box-header'>
                                            <h3 class='box-title'><i class='fa fa-warning'></i> NOTICE!!</h3>
                                             
                                            <div class='box-body'>
                                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Your Project: ".$row['pn']." is due tommorow.  
                                            ";
                                            $temp = 2;
                                            }else{
                                                echo "     
                                                <div class='box-body'>
                                                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</br>Your Project: ".$row['pn']." is due tommorow. 
                                                ";
                                            }
                                        }elseif($row['diff'] == 0){
                                            if($temp == 1){
                                            echo"<div class='col-xs-6'>
                                            <div class='box'>
                                            <div class='box-header'>
                                            <h3 class='box-title'><i class='fa fa-warning'></i> NOTICE!!</h3></br>
                                                
                                            <div class='box-body'>
                                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Your Project: ".$row['pn']." is due today. 
                                            ";
                                            $temp = 2;
                                            }else{
                                                echo "     
                                                <div class='box-body'>
                                                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</br>Your Project: ".$row['pn']." is due today. 
                                                ";
                                            }
                                         //do nothing  
                                        }
                                    }
                                ?>
                            
                       </div>
                       </div>
                       </div>
                </section><!-- /.content -->
    </body>
</html>

<?php
    global $dbh;
    if(isset($_POST['punchout'])){
            $date2 = $_POST['date2'];
            $id = $_SESSION['empID'];
            $choice=$_GET['pid'];
            $timeout=$_POST['to'];
    

            
            $query = $dbh->query("SELECT `date` as 'date1', TIMESTAMPDIFF(minute,CONCAT(`date`,' ',timeIn),CONCAT('$date2',' ','$timeout')) as 'total' FROM projwork WHERE id=(SELECT MAX(id) FROM projwork) AND proj_id='$choice'");
            $row = $query->fetch();
            $date1 = $row['date1'];
            $total = $row['total'];

            if($date1>$date2){
                echo "<script>window.location='index2.php?pid=".$choice."&s=errordate&d1=".$date1."';</script>";
            }elseif($total<0){
                echo "<script>window.location='index2.php?pid=".$choice."&s=errortime&d1=".$total."';</script>";
            }else{    
                $db -> timeOut($id,$choice,$timeout,$date1,$date2);  
            }
           

          }
?>