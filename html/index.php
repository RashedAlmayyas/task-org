<?php
include('../includes/config.php');
if(isset($_POST['submit']))
{


$email=$_POST['email'];
$password=md5($_POST['password']);

    
$sql ="INSERT INTO users(email, password) VALUES(:email, :password)";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script type='text/javascript'>alert('Registration Sucessfull!');</script>";
echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
}
else 
{
$error="Something went wrong. Please try again";
}

}
else{
    if(isset($_GET['del']))
    {
    $id=$_GET['del'];
    
    $sql = "delete from task WHERE id=:id";
    $query = $dbh->prepare($sql);
    $query -> bindParam(':id',$id, PDO::PARAM_STR);
    $query -> execute();
    
    $msg="Data Deleted successfully";
    }
    
    if(isset($_REQUEST['unconfirm']))
        {
        $aeid=intval($_GET['unconfirm']);
        $memstatus=1;
        $sql = "UPDATE task SET status=:status WHERE  id=:aeid";
        $query = $dbh->prepare($sql);
        $query -> bindParam(':status',$memstatus, PDO::PARAM_STR);
        $query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
        $query -> execute();
        $msg="Changes Sucessfully";
        }
    
        if(isset($_REQUEST['confirm']))
        {
        $aeid=intval($_GET['confirm']);
        $memstatus=0;
        $sql = "UPDATE task SET status=:status WHERE  id=:aeid";
        $query = $dbh->prepare($sql);
        $query -> bindParam(':status',$memstatus, PDO::PARAM_STR);
        $query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
        $query -> execute();
        $msg="Changes Sucessfully";
        }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600|Open+Sans:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="../css/spur.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
    <script src="../js/chart-js-config.js"></script>
    <title>OHG</title>
</head>

<body>
    <div class="dash">
        <div class="dash-nav dash-nav-dark">
            <header>
                <a href="#!" class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </a>
                <a href="index.php" class="spur-logo"><i class="fas fa-bolt"></i> <span>OHG</span></a>
            </header>
            <nav class="dash-nav-list">
                <a href="index.php" class="dash-nav-item">
                    <i class="fas fa-home"></i> Dashboard </a>
                    <li><a href="download.php"><i class="fa fa-download"></i> &nbsp;Download Task-List</a>
                <div class="dash-nav-dropdown">
                   
                </div>
            </nav>
        </div>
        <div class="dash-app">
            <header class="dash-toolbar">
                <a href="#!" class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </a>
                <a href="#!" class="searchbox-toggle">
                    <i class="fas fa-search"></i>
                </a>
                <div class="card-body ">
                    <form class="form-inline" method="post">
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="inputPassword2" class="sr-only">Email</label>
                            <input type="email" class="form-control" id="inputPassword2" name="email" placeholder="Email">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="inputPassword2" class="sr-only">Password</label>
                            <input type="password" class="form-control" id="inputPassword2" name="password" placeholder="Password">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary mb-2">Add Staff</button>
                    </form>
                </div>
                <div class="tools">
               
                    <div class="dropdown tools-item">
                        <a href="#" class="" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                            <a class="dropdown-item" href="#!">Profile</a>
                            <a class="dropdown-item" href="logout.php">Logout</a>
                        </div>
                    </div>
                </div>
            </header>
            <main class="dash-content">
                <div class="container-fluid">
                  
                    <div class="row">
                        <div class="col-lg-4">
                            <a href="./add-task.php">
                            <div class="stats stats-dark">
                                <h3 class="stats-title"> Add Task </h3>
                                <div class="stats-content">
                                    <div class="stats-icon">
                                    </div>
                                  
                                    </div>
                                </div>
                            </div>
                        </a>
                            <div class="col-lg-1">
</div>
                        
                        <div class="col-xl-6">
                            <div class="card spur-card">
                                <div class="card-header">
                                    <div class="spur-card-icon">
                                        <i class="fas fa-bell"></i>
                                    </div>
                                    <div class="spur-card-title"> Notifications </div>
                                </div>
                                <div class="card-body ">
                                    <div class="notifications">
                                        <!--
                                        <a href="#!" class="notification">
                                            <div class="notification-icon">
                                                <i class="fas fa-inbox"></i>
                                            </div>
                                            <div class="notification-text">New comment</div>
                                            <span class="notification-time">21 days ago</span>
                                        </a>
                                        <a href="#!" class="notification">
                                            <div class="notification-icon">
                                                <i class="fas fa-inbox"></i>
                                            </div>
                                            <div class="notification-text">New comment</div>
                                            <span class="notification-time">21 days ago</span>
                                        </a>
                                        <a href="#!" class="notification">
                                            <div class="notification-icon">
                                                <i class="fas fa-inbox"></i>
                                            </div>
                                            <div class="notification-text">New comment</div>
                                            <span class="notification-time">21 days ago</span>
                                        </a>
                                        <div class="notifications-show-all">
                                            <a href="#!">Show all</a>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="card spur-card">
                                <div class="card-header">
                                    <div class="spur-card-icon">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                    <div class="spur-card-title"> Task Today </div>
                                  
                                </div>
                                <div class="card-body spur-card-body-chart">
                                    <table class="table table-hover table-in-card">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Job</th>
                                                <th scope="col">Staff</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Note</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
<?php $sql = "SELECT * from  task ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>	
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($result->job);?></td>
                                            <td><?php echo htmlentities($result->staff);?></td>
                                            <td><?php echo htmlentities($result->dd);?></td>
                                            <td><?php echo htmlentities($result->note);?></td>

                                            <td>
                                            
                                            <?php if($result->status == 1)
                                                    {?>
                                                    <a href="index.php?confirm=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to Un-Compleate the Task')">Compleate <i class="fa fa-check-circle"></i></a> 
                                                    <?php } else {?>
                                                    <a href="index.php?unconfirm=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to Compleate the Task')">Un-Complate <i class="fa fa-times-circle"></i></a>
                                                    <?php } ?>
</td>
                                            </td>
											
<td>
<a href="index.php?del=<?php echo $result->id;?>&name=<?php echo htmlentities($result->staff);?>" onclick="return confirm('Do you want to Delete');"><i class="fa fa-trash" style="color:red"></i></a>&nbsp;&nbsp;
</td>
										</tr>
										<?php $cnt=$cnt+1; }} ?>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="../js/spur.js"></script>
</body>

</html>
<?php } ?>