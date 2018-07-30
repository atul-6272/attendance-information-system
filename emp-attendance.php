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
        
        <style>
		.alert{
			margin-left:10px;
			font-size:14px;
		}
 .blink {
            animation: blinker 1s linear infinite;
        }
		@keyframes blinker {  
            50% { opacity: 0; }
       }
		</style>
    </head>
    <body>
  <?php include('includes/header.php');?>
            
       <?php include('includes/sidebar.php');?>
            <div class="container" style=" margin-top:50px;">
				<div class="content"style="float:left; background-color:white; height:70px; width:20%; border-radius:4px; text-align:center; margin-left:100px;">
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
                                <span style="font-size:20px;"><?php echo htmlentities($result->FirstName." ".$result->LastName);?></p>
                               
                         <?php }} ?>
                                
				
				</div>
				<div class="content"style="float:left;background-color:white; margin-left:20px; height:70px; width:20%; border-radius:4px; text-align:center;">
				
                        <span style="font-size:20px;  padding-bottom:0;"><?php echo  date("d/m/Y");?></span>        
				
				</div>
				<div class="content"style="float:left;background-color:white; margin-left:20px; height:70px; width:20%; border-radius:4px; text-align:center;">
				
                        <span style="font-size:20px; padding-bottom:0;"><?php date_default_timezone_set('Asia/Kolkata');$date=date("h:i:sa");echo  $date;?></span>        
				
				</div>
				
				
				
				
			</div>
			    <div class="content"style="float:left; margin-left:23%; margin-top:20px; height:70px; width:50%; border-radius:4px; text-align:center;">

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

						<form  method="post" >
							<input type="submit" id="intime" name="intime" class="waves-effect waves-light btn indigo m-b-xs" style="width:25%; float:left;margin-left:37.5%;" value="IN TIME" >
<span class="blink" style="float:left; margin-left:30px;  width:20%; border-radius:4px; text-align:center ;">
				
                       
                        <span style=" color:red;font-size:18px;  padding-top:0;">  </b>  <?php echo $dbintime; ?></span>  
				</span>
						</form>
						<span>
						
				</div>
				<div class="content"style="float:left; margin-left:23%; margin-top:20px; height:70px; width:50%; border-radius:4px; text-align:center;">
						<form method="post" >
							<input type="submit" id="outtime" name="outtime" class="waves-effect waves-light btn indigo m-b-xs" style="width:25%;" value="OUT TIME" >
						</form>
						
				</div>
				
				
				
				
				
				<!--  ATTENDANCE LOGIC   -->
				<?php
				
				//-----------------IN TIME-------------------
				
				if(isset($_POST['intime'])) 
				{
					$sql = "SELECT date FROM tbl_in_time_attendance where EmpId= '" . $id . "' ORDER BY tbl_in_time_attendance.date DESC LIMIT 1";
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
						$message= "IN-TIME ALREADY STORED";
						echo "<script type='text/javascript'>alert('$message');</script>";
	
					}
					else{
						$sql = "INSERT INTO tbl_in_time_attendance (EmpId, intime, date)VALUES ('" . $id . "',NOW(),'" . $date . "')";
						$query = $dbh->prepare($sql);
						$query->execute();
					
						$message= "IN-TIME HAS BEEN RECORDED";
						echo "<script type='text/javascript'>alert('$message');</script>";
						echo "<div>IN TIME SUBMITTED</div>";
						
						
					}
					}
					
					//-----------------OUT TIME-------------------
					if(isset($_POST['outtime'])) 
					{ 
						$sql = "SELECT date FROM tbl_out_time_attendance where EmpId= '" . $id . "' ORDER BY tbl_out_time_attendance.date DESC LIMIT 1";
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
							$sql="update tbl_out_time_attendance set outtime= NOW() where EmpId ='" . $id . "'  AND date= '" . $date . "' ";
							$query = $dbh->prepare($sql);
							$query->execute();
							$message= "OUT-TIME HAS BEEN UPDATED";
							echo "<script type='text/javascript'>alert('$message');</script>";
							
						}
						else{
							$sql = "INSERT INTO tbl_out_time_attendance (EmpId, outtime,date)VALUES (:id,NOW(), NOW())";
							$query = $dbh->prepare($sql);
							$query->bindParam(':id',$id,PDO::PARAM_STR);
							$query->execute();
							$message= "OUT-TIME HAS BEEN RECORDED";
							echo "<script type='text/javascript'>alert('$message');</script>";
							
						}
				
				
					
				
				}
				
				
				?>
			
       
        
        <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/js/alpha.min.js"></script>
        <script src="assets/js/pages/form_elements.js"></script>
		
		
        
    </body>
</html>
<?php  ?> 