<?php  
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}




 $connect = mysqli_connect("localhost", "root", "", "ais");  
 $query = "SELECT * from tbl_employees, tbl_in_time_attendance , tbl_out_time_attendance WHERE tbl_employees.EmpId=tbl_in_time_attendance.EmpId AND tbl_in_time_attendance.EmpId=tbl_out_time_attendance.EmpId AND tbl_in_time_attendance.date=tbl_out_time_attendance.date";  
 $result = mysqli_query($connect, $query);
$cnt=1; 
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>ATTENDANCE REPORT</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
           <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		   
		   
<style>
button {
    background-color:#124B82;;
    border: none;
    color: white;
    padding: 5px 15px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
	margin-right:10px;
    font-size: 18px;
	border-radius:4px;
	
	
    
    cursor: pointer;

	}
th{text-align:center; font-size:16px;}
td{ font-size:16px;}



</style>		   
      </head>  
      <body>  
	  
			<div class="header" style="background-color:#00acc1; height:50px; width:100%;">
				<p style="padding-top:13px; padding-left:30px; font-size:18px; font-family: Roboto sans-serif;font-weight:700; color: white;"> <a href="dashboard.php" style="text-decoration:none;Roboto sans-serif;font-weight:700; color: white">AIS | Attendance Information System</a> 
				<span style="float:right; color:black;"> <button onclick="location.href='dashboard.php'">BACK</button></span></p>
			</div>
			
           <br /><br />  
		   
           <div class="container" style="width:1200px;">  
                 
                <h3 align="center">ATTENDANCE REPORT</h3><br /> 
				<div style="padding-left:15px; margin-bottom:8px;">  
                     <button type="submit" name="datewise" id="datewise" value="DATE WISE REPORT" class="btn btn-info"  style="width:20%; font-size:16px;" onclick="location.href='date-wise-report.php'"> DATE WISE REPORT </button> <span></span>
              
				<span style="padding-left:15px; margin-bottom:8px;">  
                    <button type="submit" id="employeewise" class="btn btn-info"  style="width:20%; font-size:16px;" onclick="location.href='employee-wise-report.php'"> EMPLOYEE WISE REPORT </button> <span></span>
               
				</span>
				 
				</div>					
				<br /> 
				
                <div class="col-md-3">  
                     <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" />  
                </div>  
                <div class="col-md-3">  
                     <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />  
                </div>  
				<div class="col-md-3">   
                     <input type="text" name="search_text" id="search_text" placeholder="Search by Employee ID"  class="form-control"   />
                </div>
                <div class="col-md-3" >  
                     <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info"  style="width:80px; font-size:16px;"/>  <span></span>
                </div> 
				
				 
				 
				
                <div style="clear:both"></div>                 
                <br />  
                <div id="report_table" style="margin-left:15px;">  
                     <table class="table table-bordered" id="reporttbl">  
							<thead>
						 <tr>  
                               <th width="6%">Sr No.</th>  
                               <th width="15%">EMPLOYEE ID</th> 
							   <th width="20%">EMPLOYEE NAME</th>
                               <th width="15%">IN_TIME</th>  
                               <th width="15%">OUT_TIME</th>  
                               <th width="15%">DATE</th> 
							   <th width="25%">Working Hours</th>
                          </tr>  
						  </thead>
                     <?php  
                     while($row = mysqli_fetch_array($result))  
                     {  
						
						
						$outtime = $row["outtime"];
						$intime = $row["intime"];
						$array1 = explode(':', $intime);
						$array2 = explode(':', $outtime);

						$minutes1 = ($array1[0] * 60.0 + $array1[1])/60;
						$minutes2 = ($array2[0] * 60.0 + $array2[1])/60;

					    $diff = round(($minutes2 - $minutes1),1).' hrs';
						
						
						
						
                     ?>  <tbody>
                          <tr>  
                               <td align="center"><?php echo $cnt; ?></td>  
                               <td align="center"><?php echo $row["EmpId"]; ?></td> 
							   <td align="center"><?php echo $row["FirstName"]." ".$row["LastName"]; ?></td>
							   <td align="center"><?php echo $row["intime"]; ?></td>  
                               <td align="center"><?php echo $row["outtime"]; ?></td>  
                               <td align="center"><?php echo $row["date"]; ?></td> 
							   <td align="center"<?php if($diff >= 8): ?> style="background-color:#55E443;" <?php else:; ?> style="background-color:#F42E2E;" <?php endif; ?>><?php echo $diff; ?></td>
							   
							   
							   
							   
							  
							   
                          </tr> 
						</tbody>						  
                     <?php $cnt++;  
                     }  
                     ?>  
                     </table>  
                </div>  
           </div>  
      </body>  
 </html>  
 <script>  
      $(document).ready(function(){  
           $.datepicker.setDefaults({  
                dateFormat: 'yy-mm-dd'   
           });  
           $(function(){  
                $("#from_date").datepicker();  
                $("#to_date").datepicker();  
           });  
           $('#filter').click(function(){  
                var from_date = $('#from_date').val();  
                var to_date = $('#to_date').val();  
				var search_text= $('#search_text').val();
                if(from_date!='' && to_date!=''&& search_text!='' )  
                {  
                     $.ajax({  
                          url:"filter.php",  
                          method:"POST",  
                          data:{from_date:from_date, to_date:to_date,search_text:search_text},  
                          success:function(data)  
                          {  
                               $('#report_table').html(data);  
                          }  
                     });  
                }  
                else  
                {  
                     alert("search option can't be blank");  
                }  
           });  
      });  
 </script>



</body>
</html>
