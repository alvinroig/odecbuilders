<?php

include_once "database.php";
	echo $db -> ifLogin();
     $id = $_SESSION['empID']; 

	$q = $_GET['q'];

     date_default_timezone_set('Asia/Manila');
     $date=date('Y-m-d');
     $time=date('G:i A');
?>
<input type="hidden" name="time" value="<?php echo $time ?>"/>
<?php 
    $query = $dbh->query("SELECT COUNT(projectID) AS `count`, totalNumHours as `hours`, duedate as `dd` FROM project WHERE `draftsmanID` = '$id' AND status='ongoing' AND projectID='$q'");
    $query -> execute();
    $row = $query -> fetch(); 

    $d = date('Y-m-d');
    if($row["count"] > 0 && ($row['hours'] == 0 || $row['dd'] == $d)){
      echo  '<a href="includes/requestExt.php"><button class="btn btn-info" type="button">Request for Extension</button></a>';
    }else if($row["count"] > 0 && ($row['hours'] > 0 || $row['dd'] < $d)){
      echo  "<center>
      		<input type='hidden' name='pid' value='".$q."'/>  
          <input type='hidden' name='date2' value='".$date."'/>                                                             
             
             <a href='#punchin'><button class='btn btn-danger btn-md' type='button'>TIME IN</button></a>
             <input class='btn btn-default btn-md' type='submit' value='TIME OUT' name='punchout' disabled/></center>
        ";
        echo '<div id="punchin" class="modalDialog text-center" style="margin-top:-50px">
                <div class="modal-dialog">
                    <div class="modal-header">
                        
                    </div>

                    <div class="modal-body">
                        <p>TIME IN</p>
                        TIME:<input type="time" class="form-control" name="ti" value='.$time.'/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</br>
                        DATE:<input type="date" class="form-control" name="date1" value='.$date.' />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</br></br>
                    </div>

                    <div class="modal-footer">
                            <button class="btn btn-info" name="punchin" type="submit">TIME IN!</button>
                        
                        <a href=#close><button class="btn btn-default" type="button">BACK</button></a>

                    </div>
                </div>
            </div>';

    }else if($row["count"] == 0){
      echo  "<input class='btn btn-default btn-md' type='submit' value='TIME IN' name='punchin' disabled/>
        <input class='btn btn-default btn-md' type='submit' value='TIME OUT' name='punchout' disabled/>
        ";
    }
?>
