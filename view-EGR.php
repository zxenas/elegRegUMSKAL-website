<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start();

include('includes/dbconnection.php');
if (strlen($_SESSION['omrsaid']==0)) {
  header('location:logout.php');
  } else{
if(isset($_POST['submit']))
  {


$vid=$_GET['viewid'];
    $status=$_POST['status'];
   $remark=$_POST['remark'];
  

$sql= "update tblregistration set Status=:status,Remark=:remark where ID=:vid";
$query=$dbh->prepare($sql);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':remark',$remark,PDO::PARAM_STR);
$query->bindParam(':vid',$vid,PDO::PARAM_STR);

 $query->execute();

  echo '<script>alert("Remark has been updated")</script>';
 echo "<script>window.location.href ='all-reg.php'</script>";
}


  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
   

    <title>Online Electrical Goods Registration System || View Electrical Goods Registration</title>

    <!-- vendor css -->
    <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="lib/jquery-toggles/toggles-full.css" rel="stylesheet">
    <link href="lib/highlightjs/github.css" rel="stylesheet">
    <link href="lib/datatables/jquery.dataTables.css" rel="stylesheet">
    <link href="lib/select2/css/select2.min.css" rel="stylesheet">

    <!-- Amanda CSS -->
    <link rel="stylesheet" href="css/amanda.css">
  </head>

  <body>

<?php include_once('includes/header.php');
include_once('includes/sidebar.php');

 ?>


    <div class="am-pagetitle">
      <h5 class="am-title">View Electrical Goods Registration</h5>
     
    </div><!-- am-pagetitle -->

    <div class="am-mainpanel">
      <div class="am-pagebody">

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">View Electrical Goods Registration</h6>
        

          <div class="table-wrapper" style="padding-top: 20px">
            <?php
                               $vid=$_GET['viewid'];

$sql = "SELECT tblregistration.*, tbluser.FirstName, tbluser.LastName, tbluser.StudPhoneNum, tbluser.emailaddress,tblregistration.ResidentialAdd,
goodsdata.Goods1, goodsdata.SirimNum1, goodsdata.Goods2, goodsdata.SirimNum2,
goodsdata.Goods3, goodsdata.SirimNum3, goodsdata.Goods4, goodsdata.SirimNum4,
 goodsdata.Goods5, goodsdata.SirimNum5
FROM tblregistration
JOIN tbluser ON tblregistration.UserID = tbluser.ID
LEFT JOIN goodsdata ON tblregistration.RegistrationNumber = goodsdata.RegistrationNumber
WHERE tblregistration.ID=:vid";
                               


$query = $dbh -> prepare($sql);
$query-> bindParam(':vid', $vid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);


$cnt=1;
if(count($results) > 0)
{
foreach($results as $row)
{               ?>
 <table border="1" class="table table-bordered">
 
<tr align="center">
<td colspan="8" style="font-size:20px;color:red">
 Registration Number:   <?php  echo $row->RegistrationNumber;?></td></tr>



 <tr align="center">
 <td colspan="9" style="font-size:20px;color:red">
 Date of Register: <?php  echo $row->DateofReg;?></td></tr>


    ?>
    <table border="1" class="table table-bordered">
        <!-- Existing code for Registration Number -->
        <!-- ... -->

        <!-- New Section: REGISTRATION DETAIL -->
        <tr align="center">
            <td colspan="9" style="font-size:20px;color:blue">
                REGISTRATION DETAIL</td>
        </tr>

        <tr>
            <th>Date of Register:</th>
            <td colspan="8"><?php echo $row->DateofReg; ?></td>
        </tr>

        <!-- New Section: STUDENT INFORMATION -->
        
        </tr>
        <tr>
            <th>Name of Student:</th>
            <td colspan="8"><?php echo $row->StudName; ?></td>
        </tr>
        <tr>
            <th>Matric Number:</th>
            <td colspan="8"><?php echo $row->MatricNum; ?></td>
        </tr>
        <tr>
            <th>Gender:</th>
            <td colspan="8"><?php echo $row->Gender; ?></td>
        </tr>
        <tr>
            <th>Email Address:</th>
            <td colspan="8"><?php echo $row->StudEmail; ?></td>
        </tr>
        <tr>
            <th>Phone Number:</th>
            <td colspan="8"><?php echo $row->StudPhoneNum; ?></td>
        </tr>
        <tr>
            <th>Residential Address:</th>
            <td colspan="8"><?php echo $row->ResidentialAdd; ?></td>
        </tr>
        <!-- Add more details as needed -->

        <!-- New Section: ELECTRONIC ITEM -->
        <tr align="center">
            <td colspan="9" style="font-size:20px;color:red">
                ELECTRONIC ITEM</td>
        </tr>
        <tr>
            <th>1st Item:</th>
            <td><?php echo $row->Goods1; ?></td>
            <th>1st Item Sirim Number:</th>
            <td colspan="6"><?php echo $row->SirimNum1; ?></td>
        </tr>
        <tr>
            <th>1st Item:</th>
            <td><?php echo $row->Goods2; ?></td>
            <th>1st Item Sirim Number:</th>
            <td colspan="6"><?php echo $row->SirimNum2; ?></td>
        </tr>
        <tr>
            <th>1st Item:</th>
            <td><?php echo $row->Goods3; ?></td>
            <th>1st Item Sirim Number:</th>
            <td colspan="6"><?php echo $row->SirimNum3; ?></td>
        </tr>
        <tr>
            <th>1st Item:</th>
            <td><?php echo $row->Goods4; ?></td>
            <th>1st Item Sirim Number:</th>
            <td colspan="6"><?php echo $row->SirimNum4; ?></td>
        </tr>
        <tr>
            <th>1st Item:</th>
            <td><?php echo $row->Goods5; ?></td>
            <th>1st Item Sirim Number:</th>
            <td colspan="6"><?php echo $row->SirimNum5; ?></td>
        </tr>
        <!-- Add similar rows for other electronic items -->

    </table>
<?php
}
?>
    
     <th colspan="2">Order Final Status</th>

    <td colspan="2"> <?php  $status=$row->Status;
    
if($row->Status=="Verified")
{
  echo "Your application has been verified";
}

if($row->Status=="Rejected")
{
 echo "Your application has been cancelled";
}


if($row->Status=="")
{
  echo "Pending";
}
 

     ;?></td>
     <th colspan="2">Admin Remark</th>
    <?php if($row->Status==""){ ?>

                     <td colspan="4"><?php echo "Your application has still pending"; ?></td>
<?php } else { ?>                  <td colspan="4"><?php  echo htmlentities($row->Status);?>
                  </td>
                  <?php } ?>
  </tr>
 
  <?php $cnt = $cnt + 1;
}} ?>

<?php if ($results[0]->Status == ""): ?>
  <p align="center" style="padding-top: 20px">                            
    <button class="btn btn-primary waves-effect waves-light w-lg" data-toggle="modal" data-target="#myModal">Take Action</button>
  </p> 
<?php endif; ?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Take Action</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <table class="table table-bordered table-hover data-tables">

                                <form method="post" name="submit">

                                
                               
     <tr>
    <th>Remark :</th>
    <td>
    <textarea name="remark" placeholder="Remark" rows="12" cols="14" class="form-control" required="true"></textarea></td>
  </tr> 
   
 
  <tr>
    <th>Status :</th>
    <td>

   <select name="status" class="form-control" required="true" >
     <option value="Verified" selected="true">Verified</option>
     <option value="Rejected">Rejected</option>
   </select></td>
  </tr>
</table>
</div>
<div class="modal-footer">
 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 <button type="submit" name="submit" class="btn btn-primary">Update</button>
  
  </form>
          </div><!-- table-wrapper -->
        </div><!-- card -->

    
      </div><!-- am-pagebody -->
     <?php include_once('includes/footer.php');?>
    </div><!-- am-mainpanel -->

    <script src="lib/jquery/jquery.js"></script>
    <script src="lib/popper.js/popper.js"></script>
    <script src="lib/bootstrap/bootstrap.js"></script>
    <script src="lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="lib/jquery-toggles/toggles.min.js"></script>
    <script src="lib/highlightjs/highlight.pack.js"></script>
    <script src="lib/datatables/jquery.dataTables.js"></script>
    <script src="lib/datatables-responsive/dataTables.responsive.js"></script>
    <script src="lib/select2/js/select2.min.js"></script>

    <script src="js/amanda.js"></script>
    <script>
      $(function(){
        'use strict';

        $('#datatable1').DataTable({
          responsive: true,
          language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
          }
        });

        $('#datatable2').DataTable({
          bLengthChange: false,
          searching: false,
          responsive: true
        });

        // Select2
        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

      });
    </script>
  </body>
</html>
<?php  ?>
