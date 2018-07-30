<?php  
 //filter.php  
 
 if(isset($_POST["from_date"], $_POST["to_date"]))  
 {  
      $connect = mysqli_connect("localhost", "root", "", "ais");  
      $output = '';  
      $query = "  
           SELECT * FROM tbl_employees,tbl_in_time_attendance,tbl_out_time_attendance  WHERE tbl_employees.EmpId=tbl_in_time_attendance.EmpId AND tbl_in_time_attendance.EmpId=tbl_out_time_attendance.EmpId AND tbl_in_time_attendance.date=tbl_out_time_attendance.date AND tbl_in_time_attendance.date AND tbl_out_time_attendance.date  BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."' 
      ";  
      $result = mysqli_query($connect, $query); 
      $cnt=1;	  
      $output .= '  
           <table class="table table-bordered">  
                <tr>  
                     <th width="6%">Sr No.</th>  
                     <th width="15%">EMPLOYEE ID</th> 
					 <th width="20%">EMPLOYEE NAME</th>
                     <th width="15%">IN_TIME</th>  
                     <th width="15%">OUT_TIME</th>  
                     <th width="15%">DATE</th> 
					 <th width="25%">WORKING HOURS</th> 
                </tr>  
      ';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
						$outtime = $row["outtime"];
						$intime = $row["intime"];
						$array1 = explode(':', $intime);
						$array2 = explode(':', $outtime);

						$minutes1 = ($array1[0] * 60.0 + $array1[1])/60;
						$minutes2 = ($array2[0] * 60.0 + $array2[1])/60;

					    $diff = round(($minutes2 - $minutes1),1).' hrs';
	   
	   
                $output .= '  
                     <tr>  
                          <td align="center">'. $cnt .'</td>  
                          <td align="center">'. $row["EmpId"] .'</td>  
						  <td align="center">'. $row["FirstName"] . " " . $row["LastName"].'</td> 
                          <td align="center">'. $row["intime"] .'</td>  
                          <td align="center"> '. $row["outtime"] .'</td>  
                          <td align="center">'. $row["date"] .'</td> ';
		if ($diff < 8) {
        $output .= '<td align="center" style="background-color: #F42E2E;"> ' . $diff . ' </td>';
} else {
    $output .= '<td align="center" style="background-color: #55E443;"> ' . $diff . ' </td>';
}
$output .= '</tr>';
                   
          $cnt++;
           } 
			
      }  
      else  
      {  
           $output .= '  
                <tr>  
                     <td colspan="5">No Record Found</td>  
                </tr>  
           ';  
      }  
      $output .= '</table>';  
      echo $output;  
 }  
 
 
 ?>