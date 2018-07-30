     <aside id="slide-out" class="side-nav white fixed">
                <div class="side-nav-wrapper">
                    <div class="sidebar-profile">
                        <div class="sidebar-profile-image">
                            <img src="assets/images/profile-image.png" class="circle" alt="">
                        </div>
                        <div class="sidebar-profile-info">
                    <?php 
$eid=$_SESSION['eid'];
$sql = "SELECT FirstName,LastName,EmpId from  tbl_employees where id=:eid";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
                                <p><?php echo htmlentities($result->FirstName." ".$result->LastName);?></p>
                                <span><?php echo htmlentities($result->EmpId)?></span>
                         <?php }} ?>
                        </div>
                    </div>
              
                <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">
                  
  <li class="no-padding"><a class="waves-effect waves-grey" href="myprofile.php">My Profiles</a></li>
  <li class="no-padding"><a class="waves-effect waves-grey" href="emp-changepassword.php">Change Password</a></li>
  <li class="no-padding"><a class="waves-effect waves-grey" href="emp-attendance.php">Attendance</a></li>
  <li class="no-padding"><a class="waves-effect waves-grey" href="attendance-status.php">Attendance Status</a></li>
                    
                
         
               
                  <li class="no-padding">
                                <a class="waves-effect waves-grey" href="logout.php">Sign Out</a>
                            </li>  
                 
                   
                </ul>
                
                </div>
            </aside>