<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['emplogin'])==0)
    {   
header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <title>Employee | Attendance</title>
        
        
        
        <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css"/>
        
        
        <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        
        
    </head>
    <body>
  <?php include('includes/header.php');?>
            
       <?php include('includes/sidebar.php');?>
	   <div style="margin-left:250px;; margin-top:20px;">ATTENDANCE STATUS</div>
            <div class="container" style=" margin-top:50px;">
				
				<?php 
$eid=$_SESSION['emplogin'];

$sql = "SELECT * from  tbl_employees where EmpId=:eid";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);

$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$id = $result->EmpId;
			
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
                                
                               
                         <?php }} ?>
                                
				
				<div class="content"style="float:left;background-color:white; margin-left:20px; height:70px; width:20%; border-radius:4px; text-align:center; margin-left:100px;">
				
                        <span style="font-size:20px;  padding-bottom:0;"><?php echo  date("d/m/Y");?></span>        
				
				</div>
				
				<?php 
						$sql = "SELECT * FROM tbl_in_time_attendance where EmpId= '" . $id . "' ORDER BY tbl_in_time_attendance.date DESC LIMIT 1";
						$query = $dbh->prepare($sql);
						$query->execute();
						$results=$query->fetchAll(PDO::FETCH_OBJ);
				
						if($query->rowCount() > 0)
						{
							foreach($results as $result)
							{
								$dbdate = $result->date;
							}
						}
						date_default_timezone_set('Asia/Kolkata');
				
						$date = date('Y-m-d');
						if($date==$dbdate){
						$dbintime= $result->intime;
						}
						
	
					
					
					?>
				
				<div style="float:left;background-color:white; margin-left:20px; height:70px; width:20%; border-radius:4px; text-align:center ">
						<h6> <b>IN TIME</b> </h6>
                        <span style="font-size:18px;  padding-bottom:0;">  <?php echo  $dbintime; ?></span>  
				</div>
				<?php 
						$sql = "SELECT * FROM tbl_out_time_attendance where EmpId= '" . $id . "' ORDER BY tbl_out_time_attendance.date DESC LIMIT 1";
						$query = $dbh->prepare($sql);
						$query->execute();
						$results=$query->fetchAll(PDO::FETCH_OBJ);
				
						if($query->rowCount() > 0)
						{
							foreach($results as $result)
							{
								$dbdate = $result->date;
							}
						}
						date_default_timezone_set('Asia/Kolkata');
				
						$date = date('Y-m-d');
						if($date==$dbdate){
						$dbouttime= $result->outtime;
						}
						
	
					
					
					?>
				<div style="float:left;background-color:white; margin-left:20px; height:70px; width:20%; border-radius:4px; text-align:center">
				
                       <h6> <b>OUT TIME</b> </h6>
                        <span style="font-size:18px;  padding-bottom:0;">  <?php echo  $dbouttime; ?></span>  
				</div>		
				
				
				
				
				
				
				
       
        
        <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/js/alpha.min.js"></script>
        <script src="assets/js/pages/form_elements.js"></script>
		
		
        
    </body>
</html>
<?php  ?> 