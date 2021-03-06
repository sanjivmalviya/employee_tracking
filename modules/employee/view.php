<?php

 require_once('../../functions.php');

 $login_id = $_SESSION['ets_credentials']['user_id'];
 $login_type = $_SESSION['ets_credentials']['user_type'];

 $table_name = 'tbl_employees';
 $field_name = 'employee_id';
 
 if($login_type == '1'){
    $employees = getAll('tbl_employees');
 }else{
   $employees = getWhere('tbl_employees','added_by',$login_id);
 }

 if(isset($_GET['delete_id'])){
         
   if(delete($table_name,$field_name,$_GET['delete_id'])){
      $success = "Record Deleted Successfully";
      header('location:view.php');

   }else{
      $error = "Failed to Delete Record";
   }

 }

?>
<!DOCTYPE html>
<html>
   <head>
      <style>
         .popover{
            z-index: 99999 !important;
            max-width: 100% !important;
            width: 100% !important;
         }
      </style>
   </head>
   <?php require_once('../../include/headerscript.php'); ?>
   <body class="fixed-left">
      <!-- Begin page -->
      <div id="wrapper">
         <!-- Top Bar Start -->
         <?php require_once('../../include/topbar.php'); ?>
         <!-- Top Bar End -->
         <!-- ========== Left Sidebar Start ========== -->
         <?php require_once('../../include/sidebar.php'); ?>
         <!-- Left Sidebar End -->
         <!-- ============================================================== -->
         <!-- Start Page Content here -->
         <!-- ============================================================== -->
         <div class="content-page">
            <!-- Start content -->
            <div class="content">
               <div class="container">
                  <div class="row">
                     <div class="col-xs-12">
                        <div class="page-title-box">
                           <h4 class="page-title">Employees</h4>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="card-box">
                           <div class="row">

                           		<table class="table table-striped table-bordered table-condensed table-hover" style="margin-top: 50px;">
                           			
                           			<thead>
                                       <th>Sr.</th>
                                       <?php if($login_type == 1){ ?>
                                       <th>Admin</th>
                                       <?php } ?>
                                       <th>Name</th>
                                       <th>Employee Code</th>
                                       <th>Designation</th>
                                       <th>Employee Grade</th>
                                       <th>Added at</th>           
                                       <th class="text-center">Pending Leaves</th>           
                                       <th class="text-center">App Access</th>           
                           				<th class="text-right">Actions</th>
                           			</thead>

                           			<tbody>
                           				
                           				<?php if(isset($employees) && count($employees) > 0){ ?>

                           					<?php $i=1; foreach($employees as $rs){ ?>

                           					<tr>
                                             <td><?php echo $i++; ?></td>
                                             <?php if($login_type == 1){ ?>
                                             <td>
                                                <?php 
                                                   $added_by = getOne('tbl_admins','admin_id',$rs['added_by']);
                                                   echo $added_by['admin_name'];
                                                ?> 
                                             </td>
                                             <?php } ?>
                                             <td><a  
                                             title="More details about employee" href='detail.php?id=<?php echo $rs['employee_id'];  ?>'><?php echo $rs['employee_name']; ?></a></td>
                                             <td><?php echo $rs['employee_code']; ?></td>
                                             <td><?php echo $rs['employee_designation']; ?></td>
                                             <td><?php echo $rs['employee_grade']; ?></td>
                                             <td><?php echo $rs['created_at']; ?></td>
                                             <td class="text-center"><?php 

                                                $this_year = date('Y');
                                                $total_annual_leaves = "SELECT leaves FROM tbl_employee_total_leaves WHERE year = '$this_year' AND employee_id = '".$rs['employee_id']."' ";
                                                $total_annual_leaves = getRaw($total_annual_leaves);

                                                $total_annual_spent_leaves = "SELECT SUM(total_days) as spent_leaves FROM tbl_employee_grant_leaves WHERE YEAR(created_at) = '$this_year' AND employee_id = '".$rs['employee_id']."' ";
                                                $total_annual_spent_leaves = getRaw($total_annual_spent_leaves);
                                                
                                                if( isset($total_annual_leaves) && count($total_annual_leaves) > 0){
   
                                                   $pending_leaves = $total_annual_leaves[0]['leaves'] - $total_annual_spent_leaves[0]['spent_leaves'];
                                                   echo "<a href='leave_history.php?id=".$rs['employee_id']."'>".$pending_leaves."</a>";

                                                }else{

                                                   echo "N/A";
                                                   
                                                }
                                             ?></td>
                                             <td class="text-center"><?php if($rs['employee_app_access'] == 1){ echo "<span class='text-primary'>Yes</span>"; }else{ echo "<span class='text-danger'>No</span>"; } ?></td>
                                             <td>
                                                <a href="add.php?edit_id=<?php echo $rs['employee_id']; ?>"><i class="fa fa-pencil"></i></a>
                                                <a href="view.php?delete_id=<?php echo $rs['employee_id']; ?>" onclick=" return confirm('Are you sure ?'); "><i class="fa fa-trash"></i></a>
                                             </td>
                           					</tr>
                           					<?php } ?>

                           				<?php } ?>

                           			</tbody>

                           		</table>

                                 <div class="row">
                                    <div class="col-md-12 p-t-30">
                                          <?php if(isset($success)){ ?>
                                             <div class="alert alert-success"><?php echo $success; ?></div>
                                          <?php }else if(isset($warning)){ ?>
                                             <div class="alert alert-warning"><?php echo $warning; ?></div>
                                          <?php }else if(isset($error)){ ?>
                                             <div class="alert alert-danger"><?php echo $error; ?></div>
                                          <?php } ?>
                                       </div>  
                                 </div>
                      
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               
               <!-- container -->
            </div>
            <!-- content -->
         </div>
         <!-- ============================================================== -->
         <!-- End of the page -->
         <!-- ============================================================== -->
      </div>
      <!-- END wrapper -->
      <!-- START Footerscript -->
      <?php require_once('../../include/footerscript.php'); ?>

      <script>
         
         $(function(){

            $('.danger').popover({ html : true});

         });

      </script>

   </body>
</html>
