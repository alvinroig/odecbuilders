<?php
   
    include_once("includes/database.php");
    echo $db -> ifLogin();
    $id = $_SESSION['empID'];


?>

<!DOCTYPE html>
<html>
    <head>
      <?php 
        $title = "Home";
        $icon = '<i class="fa fa-home"></i>';
        include_once "includes/head.php";
      ?>
    </head>
    <body class="skin-blue">
        <?php include_once "includes/navigation.php" ?>

                <!-- Main content -->
                <section class="content">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        <?php
                                            global $dbh;
                                            try{
                                                $query = $dbh->query("SELECT projectId, COUNT(*) as `status`
                                                                    FROM project
                                                                    WHERE status = 'ongoing' AND draftsmanID is not null");
                                            $query -> setFetchMode(PDO::FETCH_ASSOC);
                                            while($row = $query->fetch()){
                                                echo $row['status'];
                                            }
                                            }catch(PDOException $ex){
                                                echo $ex->getMessage();
                                            }
                                        ?>
                                    </h3>
                                    <p>
                                        Ongoing Projects


                                    </p>
                                    
                                </div>
                                <div class="icon">
                                    <i class="fa fa-briefcase"></i>
                                </div>
                                <a href="listProjects.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        <?php
                                            global $dbh;
                                            try{
                                                $query = $dbh->query("SELECT COUNT(*) as `number`
                                                                    FROM employee e JOIN account a ON
                                                                    a.empID=e.employeeID WHERE a.type = 'Draftsman/Tutor'
                                                                    OR a.type = 'Draftsman' OR a.type='Tutorial' 
                                                                    ");
                                            $query -> setFetchMode(PDO::FETCH_ASSOC);
                                            while($row = $query->fetch()){
                                                echo $row['number'];
                                            }
                                            }catch(PDOException $ex){
                                                echo $ex->getMessage();
                                            }
                                        ?>
                                    </h3>
                                    <p>
                                        Registered Users
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-group"></i>
                                </div>
                                <a href="listOfEmployees.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                       
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3>
                                        <?php
                                            global $dbh;
                                            try{
                                                $query = $dbh->query("SELECT COUNT(*) as `number`
                                                                    FROM leaves WHERE affirmation='0'
                                                                    ");
                                            $query -> setFetchMode(PDO::FETCH_ASSOC);
                                            while($row = $query->fetch()){
                                                echo $row['number'];
                                            }
                                            }catch(PDOException $ex){
                                                echo $ex->getMessage();
                                            }
                                        ?>
                                    </h3>
                                    <p>
                                        Leave Requests
                                    </p>
                                </div>
                                <div class="icon">
                                    <span class="glyphicon glyphicon-comment"/>
                                </div>
                                <a href="requests.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->
                    <div class="row">
                        

                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <span class="glyphicon glyphicon-briefcase"></span>
                                    <h3 class="box-title">&nbsp;Ongoing Projects</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr role="row">
                                                <th colspan="1" rowspan="1"><i class="fa fa-flag"></i> Project Name</th>
                                                <th colspan="1" rowspan="1"><i class="fa fa-male"></i> Draftsman</th>
                                                <th colspan="1" rowspan="1"><i class="fa fa-clock-o"></i> Time Left</th>
                                                <th colspan="1" rowspan="1"><i class="fa fa-clock-o"></i> Time Consumed</th>
                                        </thead>
                                        <tbody>
                                            <?php echo $db -> fetchOngoingProjects() ?>
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                            
                        </div>

                        

                    </div>

                    <!-- top row -->
                    <div class="row">
                        <div class="col-xs-12 connectedSortable">
                            
                        </div><!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-6 connectedSortable"> 
                            <!-- Box (with bar chart) -->
                                    <!-- tools box -->
                                         
                            

                        </section><!-- /.Left col -->
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        <section class="col-lg-6 connectedSortable">
                            <!-- Map box -->
                            

                        </section><!-- right col -->
                    </div><!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->


        <!-- jQuery 2.0.2 -->

        <!-- fullCalendar -->
        <script src="js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>


    </body>
</html>