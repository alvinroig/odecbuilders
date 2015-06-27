<?php
    include_once "includes/database.php";
     echo $db -> ifLogin();
     $id = $_SESSION['empID'];
     $icon = '<i class="fa fa-dashboard"></i>';
     $title = "Reports";
    
?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Draftsman | My Reports</title>
        <?php include_once ("includes/head.php"); ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <?php include_once ("includes/navigation.php"); ?>
            <class="right-side">
                <section class="content">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <span class="glyphicon glyphicon-list"></span>
                                    <h3 class="box-title">&nbsp;List Of My Projects</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                 <table class="table table-bordered">
                                <thead>
                                        <tr role="row">
                                            <th colspan="1" rowspan="1"><i class="fa fa-bars"></i> Project ID</th> 
                                            <th colspan="1" rowspan="1"><i class="fa fa-flag"></i> Project Name</th> 
                                            <th colspan="1" rowspan="1"><i class="fa fa-user"></i> Client Name</th> 
                                            <th colspan="1" rowspan="1"><i class="fa fa-phone-square"></i> Contact Number</th>
                                            <th colspan="1" rowspan="1"><i class="fa fa-map-marker"></i> Location</th>
                                            <th colspan="1" rowspan="1"><i class="fa fa-calendar"></i> Start Date</th>
                                            <th colspan="1" rowspan="1"><i class="fa fa-calendar"></i> Due Date</th>
                                            <th colspan="1" rowspan="1"><i class="fa fa-book"></i> Logs</th>
                                    </thead>
                                <tbody>
                                    <?php echo $db -> fetchListOfmyProjects($id); ?>
                                </tbody>
                                </table>
                   
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                    </div><!-- /.row -->

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




    </body>
</html>