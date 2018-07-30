<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['emplogin'])==0)
    {   
header('location:index.php');
}

$date = date('Y-m-d');
$sql    = "SELECT * FROM in_time where EmpId = 'EMP6272' AND date = '" . $date . "'";
$query  = $dbh->prepare($sql);
					
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);

if($query->rowCount() > 0)
{
foreach($results as $result)
{
	 $dbintime = $result->intime;
	 $dbouttime = $result->outtime;
}
}

						$array1 = explode(':', $dbintime);
						$array2 = explode(':', $dbouttime);

						$minutes1 = ($array1[0] * 60.0 + $array1[1])/60;
						$minutes2 = ($array2[0] * 60.0 + $array2[1])/60;

					    echo $diff = round(($minutes2 - $minutes1),1).' hrs';


 
?>

