<?php 
session_start();
//error_reporting(0);
session_regenerate_id(true);
include('../includes/config.php');

if(strlen($_SESSION['alogin'])==0)
	{	
	header("Location: index.php"); //
	}
	else{?>
<table border="1">
									<thead>
										<tr>
										<th>#</th>
											<th>job</th>
											<th>staff</th>
											<th>note</th>
											<th>dd</th>
											<th>status</th>
										</tr>
									</thead>

<?php 
$filename="Tssk list";
$sql = "SELECT * from task";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				

echo '  
<tr>  
<td>'.$cnt.'</td> 
<td>'.$job= $result->job.'</td> 
<td>'.$staff= $result->staff.'</td> 
<td>'.$note= $result->note.'</td> 
<td>'.$dd= $result->dd.'</td> 
<td>'.$Designation= $result->designation.'</td> 					
</tr>  
';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$filename."-report.xls");
header("Pragma: no-cache");
header("Expires: 0");
			$cnt++;
			}
	}
?>
</table>
<?php } ?>