<?php

   require_once('../../functions.php');

   $login_id = $_SESSION['ets_credentials']['user_id'];
   $table_name = 'tbl_employees';
   $field_name = 'employee_id';    

   if(isset($_POST['submit'])){

    $next_id = 'SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "'.DB.'" AND TABLE_NAME = "tbl_employees" ';
    $next_id = getRaw($next_id);
    $next_id = $next_id[0]['AUTO_INCREMENT'];
    $employee_code = 'EMP/'.sprintf('%05d',($next_id));
   
    // POST DATA
    $employee_name = $_POST['employee_name'];
    $employee_designation = $_POST['employee_designation'];
    $employee_mobile = $_POST['employee_mobile'];
    $employee_doj = $_POST['employee_doj'];
    $employee_dob = $_POST['employee_dob'];
    $employee_pan = $_POST['employee_pan'];
    $employee_email = $_POST['employee_email'];
    $employee_travel_rate = $_POST['employee_travel_rate'];

    if(isset($_POST['employee_app_access'])){
      $employee_app_access = 1;
    }else{
      $employee_app_access = 0;
    }

    $upload_dir = '../../uploads/aadhaar/';
    $extensions = array('jpg','jpeg','png');   
    
    $aadhaar_file = array();
    foreach ($_FILES['employee_aadhaar_file']["error"] as $key => $error) {

        if ($error == UPLOAD_ERR_OK) {  

            $tmp_name = $_FILES['employee_aadhaar_file']["tmp_name"][$key];
            $file_name = $_FILES['employee_aadhaar_file']["name"][$key];
            $extension = explode('.',$file_name);
            $file_extension = end($extension);

            if(in_array($file_extension, $extension)){
                
                $new_file_name = md5(uniqid()).".".$file_extension;             
                $destination = $upload_dir.$new_file_name;
                if(move_uploaded_file($tmp_name, $destination)){
                    $aadhaar_file[] = $new_file_name;
                }
            }   

        }
    }

    if(count($aadhaar_file) > 0){
        $aadhaar_file = $aadhaar_file[0];
    }else{
        $aadhaar_file = "";
    }

    $employee_aadhaar_file = $aadhaar_file;
    $employee_aadhaar_number = $_POST['employee_aadhaar_number'];

    $employee_password = $_POST['employee_password'];

    $upload_dir = '../../uploads/pan/';
    $extensions = array('jpg','jpeg','png');   
    
    $employee_pan_file = array();
    foreach ($_FILES['employee_pan_file']["error"] as $key => $error) {

        if ($error == UPLOAD_ERR_OK) {  

            $tmp_name = $_FILES['employee_pan_file']["tmp_name"][$key];
            $file_name = $_FILES['employee_pan_file']["name"][$key];
            $extension = explode('.',$file_name);
            $file_extension = end($extension);

            if(in_array($file_extension, $extension)){
                
                $new_file_name = md5(uniqid()).".".$file_extension;             
                $destination = $upload_dir.$new_file_name;
                if(move_uploaded_file($tmp_name, $destination)){
                   $employee_pan_file[] = $new_file_name;
                }
            }   

        }
    }

    if(count($employee_pan_file) > 0){
        $employee_pan_file = $employee_pan_file[0];
    }else{
        $employee_pan_file = "";
    }


    $employee_bank_name = $_POST['employee_bank_name'];
    $employee_bank_ifsc = $_POST['employee_bank_ifsc'];
    $employee_bank_branch = $_POST['employee_bank_branch'];
    $employee_bank_number = $_POST['employee_bank_number'];
    $employee_total_leaves = $_POST['employee_total_leaves'];     

    $form_data = array(
        'added_by' => $login_id,
        'employee_name' =>  $employee_name,
        'employee_code' =>  $employee_code,
        'employee_designation' =>  $employee_designation,
        'employee_mobile' =>  $employee_mobile,
        'employee_doj' =>  $employee_doj,
        'employee_dob' =>  $employee_dob,
        'employee_pan' =>  $employee_pan,
        'employee_pan_file' =>  $employee_pan_file,
        'employee_email' =>  $employee_email,
        'employee_aadhaar_file' =>  $employee_aadhaar_file,
        'employee_aadhaar_number' =>  $employee_aadhaar_number,
        'employee_password' =>  $employee_password,
        'employee_bank_name' =>  $employee_bank_name,
        'employee_bank_ifsc' =>  $employee_bank_ifsc,
        'employee_bank_branch' =>  $employee_bank_branch,
        'employee_bank_number' =>  $employee_bank_number,
        'employee_total_leaves' =>  $employee_total_leaves,
        'employee_app_access' =>  $employee_app_access,
        'employee_travel_rate' =>  $employee_travel_rate
     );

    if(insert('tbl_employees',$form_data)){
    
      $success = "Employee Added Successfully";
    
    }else{
    
      $error = "Failed to add Employee";
    
    }


   }



   if(isset($_GET['edit_id'])){

         $edit_data = getOne($table_name,$field_name,$_GET['edit_id']);         

         $edit_data = array(
            'added_by' => $login_id,
            'employee_name' => $edit_data['employee_name'],
            'employee_designation' => $edit_data['employee_designation'],
            'employee_mobile' => $edit_data['employee_mobile'],
            'employee_doj' => $edit_data['employee_doj'],
            'employee_dob' => $edit_data['employee_dob'],
            'employee_pan' => $edit_data['employee_pan'],
            'employee_pan_file' => $edit_data['employee_pan_file'],
            'employee_email' => $edit_data['employee_email'],
            'employee_aadhaar_file' => $edit_data['employee_aadhaar_file'],
            'employee_aadhaar_number' => $edit_data['employee_aadhaar_number'],
            'employee_password' => $edit_data['employee_password'],
            'employee_bank_name' => $edit_data['employee_bank_name'],
            'employee_bank_ifsc' => $edit_data['employee_bank_ifsc'],
            'employee_bank_branch' => $edit_data['employee_bank_branch'],
            'employee_bank_number' => $edit_data['employee_bank_number'],
            'employee_total_leaves' => $edit_data['employee_total_leaves'],
            'employee_app_access' => $edit_data['employee_app_access'],
            'employee_travel_rate' => $edit_data['employee_travel_rate']
         );

   }



  if(isset($_POST['update'])){



    // POST DATA

    $employee_name = $_POST['employee_name'];

    $employee_mobile = $_POST['employee_mobile'];

    $employee_designation = $_POST['employee_designation'];

    $employee_pan = $_POST['employee_pan'];

    $employee_doj = $_POST['employee_doj'];

    $employee_dob = $_POST['employee_dob'];

    $employee_email = $_POST['employee_email'];

    $employee_password = $_POST['employee_password'];

    $employee_aadhaar_number = $_POST['employee_aadhaar_number'];


    if(isset($_POST['employee_app_access'])){
      $employee_app_access = 1;
    }else{
      $employee_app_access = 0;
    }

    $employee_aadhaar_file = "";
    if($_FILES['employee_aadhaar_file']['error'][0] == 0){

       // FILE DATA 
       $file = $_FILES['employee_aadhaar_file'];    
       $allowed_extensions = array('jpg','jpeg','png','gif');
       $target_path = "../../uploads/aadhaar/";
       $file_prefix = "IMG_";
       $upload = file_upload($file,$allowed_extensions,$target_path,$file_prefix);
      
       if($upload['error'] == 1){

             $error = "Failed to Upload files, try again later";

       }else{

           foreach($upload['files'] as $rs){

                $employee_aadhaar_file = $rs;

           }

       }

    }

    $employee_pan_file = "";
    if($_FILES['employee_pan_file']['error'][0] == 0){

       // FILE DATA 
       $file = $_FILES['employee_pan_file'];    
       $allowed_extensions = array('jpg','jpeg','png','gif');
       $target_path = "../../uploads/pan/";
       $file_prefix = "IMG_";
       $upload = file_upload($file,$allowed_extensions,$target_path,$file_prefix);
      
       if($upload['error'] == 1){
             $error = "Failed to Upload files, try again later";
       }else{
           foreach($upload['files'] as $rs){
                $employee_pan_file = $rs;
           }
       }

    }     

     $form_data = array(

       'added_by' => $login_id,

       'employee_name' => $_POST['employee_name'],

       'employee_designation' => $_POST['employee_designation'],

       'employee_mobile' => $_POST['employee_mobile'],

       'employee_doj' => $_POST['employee_doj'],

       'employee_dob' => $_POST['employee_dob'],

       'employee_pan' => $_POST['employee_pan'],

       'employee_email' => $_POST['employee_email'],

       'employee_aadhaar_number' => $_POST['employee_aadhaar_number'],

       'employee_password' => $_POST['employee_password'],

       'employee_app_access' => $employee_app_access,

       'employee_travel_rate' => $_POST['employee_travel_rate'],
       
       'employee_total_leaves' => $_POST['employee_total_leaves'],


     );

      if( isset($employee_aadhaar_file) && $employee_aadhaar_file != ""){
        $form_data['employee_aadhaar_file'] = $employee_aadhaar_file;
      }
      if( isset($employee_pan_file) && $employee_pan_file != ""){
        $form_data['employee_pan_file'] = $employee_pan_file;
      }
      
      if(update($table_name,$field_name,$_GET['edit_id'],$form_data)){

           $success = "Employee Updated Successfully";

       }else{

           $error = "Failed to update Employee, try again later";

       }

   }


?>



<!DOCTYPE html>

<html>

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

                     <div class="col-md-6">

                        <div class="page-title-box">

                           <h4 class="page-title">Add Employee</h4>

                           <div class="clearfix"></div>

                        </div>

                     </div>                   

                  </div>

                  <div class="row">   

                     

                     <div class="col-sm-12">

                        <div class="card-box">

                           <div class="row">

                              <form method="post" class="form-horizontal" role="form" enctype="multipart/form-data">

                                 <div class="col-md-12">

                                    <div class="row">

                                       <div class="col-md-12">
                                        <h5>Employee Details : </h5>
                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_name">Name<span class="text-danger">*</span></label>

                                             <input type="text" name="employee_name" parsley-trigger="change" required="" placeholder="" class="form-control" id="employee_name" value="<?php if(isset($edit_data['employee_name'])){ echo $edit_data['employee_name']; } ?>">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_mobile">Mobile<span class="text-danger">*</span></label>

                                             <input type="number" name="employee_mobile" parsley-trigger="change" required="" placeholder="" class="form-control" id="employee_mobile" value="<?php if(isset($edit_data['employee_mobile'])){ echo $edit_data['employee_mobile']; } ?>">

                                          </div>
                                        </div>

                                        <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_email">Email<span class="text-danger">*</span></label>

                                             <input type="email" name="employee_email" parsley-trigger="change" required="" placeholder="" class="form-control" id="employee_email" value="<?php if(isset($edit_data['employee_email'])){ echo $edit_data['employee_email']; } ?>">

                                          </div>

                                       </div>
                                    
                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_designation">Designation</label>

                                             <input type="text" name="employee_designation" parsley-trigger="change" placeholder="" class="form-control" id="employee_designation" value="<?php if(isset($edit_data['employee_designation'])){ echo $edit_data['employee_designation']; } ?>">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label>DOJ</label>

                                             <div class="input-group">

                                                <input type="date" class="form-control" placeholder="mm/dd/yyyy" id="employee_doj" value="<?php if(isset($edit_data['employee_doj']) && $edit_data['employee_doj'] != ""){ echo date('Y-m-d',strtotime($edit_data['employee_doj'])); } ?>" name="employee_doj" >

                                                <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>

                                             </div>

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label>DOB</label>

                                             <div class="input-group">

                                                <input type="date" class="form-control" placeholder="mm/dd/yyyy" name="employee_dob" id="employee_dob" value="<?php if(isset($edit_data['employee_dob']) && $edit_data['employee_dob']!=""){ echo date('Y-m-d',strtotime($edit_data['employee_dob'])); } ?>" >

                                                <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>

                                             </div>

                                          </div>

                                       </div>

                                       

                                        <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_password">Password<span class="text-danger">*</span> &nbsp;<input type="button" class="btn btn-default btn-xs pull-right generatePassword" value="Generate"></label>

                                             <input type="text" name="employee_password" parsley-trigger="change" required="" placeholder="" class="form-control" id="employee_password" value="<?php if(isset($edit_data['employee_password'])){ echo $edit_data['employee_password']; } ?>">

                                          </div>

                                       </div>


                                        <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_total_leaves">Employee Total Leaves</label>

                                             <input type="number" parsley-trigger="change" placeholder="" class="form-control" name="employee_total_leaves" id="employee_total_leaves" value="<?php if(isset($edit_data['employee_total_leaves'])){ echo $edit_data['employee_total_leaves']; } ?>">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_aadhaar_number">Adhaar Number</label>

                                             <input type="text" parsley-trigger="change" placeholder="" class="form-control" name="employee_aadhaar_number" id="employee_aadhaar_number" value="<?php if(isset($edit_data['employee_aadhaar_number'])){ echo $edit_data['employee_aadhaar_number']; } ?>">

                                          </div>

                                       </div>

<div class="clearfix"></div>
                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label class="control-label">Upload Aadhaar <?php if(isset($edit_data['employee_aadhaar_file']) && $edit_data['employee_aadhaar_file'] != ""){ ?>
                                                <a href="<?php echo "../../uploads/aadhaar/".$edit_data['employee_aadhaar_file']; ?>"><i class="fa fa-eye"></i></a> <?php } ?></label>

                                             <input type="file" class="filestyle" data-buttonname="btn-default" name="employee_aadhaar_file[]" id="employee_aadhaar_file" >

                                          </div>

                                       </div>


                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_pan">PAN Number </label>

                                             <input type="text" parsley-trigger="change" placeholder="" class="form-control" name="employee_pan" id="employee_pan" value="<?php if(isset($edit_data['employee_pan'])){ echo $edit_data['employee_pan']; } ?>">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label class="control-label">Upload PAN <?php if(isset($edit_data['employee_pan_file']) && $edit_data['employee_pan_file'] != ""){ ?>
                                                <a href="<?php echo "../../uploads/pan/".$edit_data['employee_pan_file']; ?>"><i class="fa fa-eye"></i></a> <?php } ?></label>

                                             <input type="file" class="filestyle" data-buttonname="btn-default" name="employee_pan_file[]" id="employee_pan_file" >

                                          </div>

                                       </div>


                                       <div class="clearfix"> </div>
                                       <div class="col-md-12">
                                        <h5>Bank Details : </h5>
                                       </div>
                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_bank_name">Bank Name</label>

                                             <input type="text" parsley-trigger="change" placeholder="" class="form-control" name="employee_bank_name" id="employee_bank_name" value="<?php if(isset($edit_data['employee_bank_name'])){ echo $edit_data['employee_bank_name']; } ?>">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_bank_ifsc">Bank IFSC</label>

                                             <input type="text" parsley-trigger="change" placeholder="" class="form-control" name="employee_bank_ifsc" id="employee_bank_ifsc" value="<?php if(isset($edit_data['employee_bank_ifsc'])){ echo $edit_data['employee_bank_ifsc']; } ?>">

                                          </div>

                                       </div>


                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_bank_branch">Bank Branch</label>

                                             <input type="text" parsley-trigger="change" placeholder="" class="form-control" name="employee_bank_branch" id="employee_bank_branch" value="<?php if(isset($edit_data['employee_bank_branch'])){ echo $edit_data['employee_bank_branch']; } ?>">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_bank_number">Bank Number</label>

                                             <input type="number" parsley-trigger="change" placeholder="" class="form-control" name="employee_bank_number" id="employee_bank_number" value="<?php if(isset($edit_data['employee_bank_number'])){ echo $edit_data['employee_bank_number']; } ?>">

                                          </div>

                                       </div>

                                       
                                        <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_travel_rate">Travel Rate (Per KM)</label>

                                             <input type="number" parsley-trigger="change" placeholder="" class="form-control" name="employee_travel_rate" id="employee_travel_rate" value="<?php if(isset($edit_data['employee_travel_rate'])){ echo $edit_data['employee_travel_rate']; } ?>">

                                          </div>

                                       </div>
                                       <div class="clearfix"> </div>
                                       <div class="col-md-12">
                                        <h5>Mobile Application : </h5>
                                       </div>    

                                       <div class="col-md-4">
                                         
                                          <div class="checkbox">
                                        
                                             <input type="checkbox" name="employee_app_access" id="employee_app_access" <?php if( isset($edit_data['employee_app_access']) && $edit_data['employee_app_access'] == '1'){ echo "checked"; } ?>> <label for="employee_app_access"> <span style="line-height: 25px;font-size: 15px;" >Allow App Access</span></label>
                                       
                                          </div>
                                       
                                       </div>
                                     

                                    </div>

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

                                       

                                       <div class="col-md-12" align="right">

                                          <?php if(isset($edit_data)){ ?>                                             

                                            <button type="submit" name="update" id="update" class="btn btn-danger btn-bordered waves-effect w-md waves-light m-b-5">Update</button>

                                         <?php }else{ ?>

                                            <button type="submit" name="submit" id="submit" class="btn btn-primary btn-bordered waves-effect w-md waves-light m-b-5">Submit</button>

                                         <?php } ?>

                                       </div>

                                    </div>

                                 </div>

                              </form>

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

         

         $('.generatePassword').on('click', function(){



            var password = randomPassword();

            $('#employee_password').val(password);



         });



      </script>



   </body>

</html>
