<?php

   require_once('../../functions.php');

   $login_id = $_SESSION['ets_credentials']['user_id'];
 
   $table_name = 'tbl_vendors';
   $field_name = 'vendor_id';

   if(isset($_POST['submit'])){
    
      $next_id = 'SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "'.DB.'" AND TABLE_NAME = "tbl_vendors" ';
      $next_id = getRaw($next_id);
      $next_id = $next_id[0]['AUTO_INCREMENT'];
      $vendor_code = 'VE/'.sprintf('%05d',($next_id));

      $vendor_name = $_POST['vendor_name'];
      $contact_person_name = $_POST['contact_person_name'];
      $vendor_address = $_POST['vendor_address'];
      $vendor_pincode = $_POST['vendor_pincode'];
      $vendor_email = $_POST['vendor_email'];
      $vendor_landline = $_POST['vendor_landline'];
      $vendor_mobile = $_POST['vendor_mobile'];
      $vendor_gst = $_POST['vendor_gst'];
      $vendor_gst_type = $_POST['vendor_gst_type'];        
      
      $vendor_mode_of_payment = $_POST['vendor_mode_of_payment'];
      $vendor_pan = $_POST['vendor_pan'];         
      $vendor_aadhaar_number = $_POST['vendor_aadhaar_number'];

      $vendor_aadhaar = "";
      if($_FILES['vendor_aadhaar']['error'][0] == 0){

         // FILE DATA 
         $file = $_FILES['vendor_aadhaar'];    
         $allowed_extensions = array('jpg','jpeg','png','gif');
         $target_path = "../../uploads/aadhaar/";
         $file_prefix = "IMG_";
         $upload = file_upload($file,$allowed_extensions,$target_path,$file_prefix);
        
         if($upload['error'] == 1){

               $error = "Failed to Upload files, try again later";

         }else{

             foreach($upload['files'] as $rs){

                  $vendor_aadhaar = $rs;

             }

         }

       }

      $vendor_gst_certificate = "";
      if($_FILES['vendor_gst_certificate']['error'][0] == 0){

         // FILE DATA 
         $file = $_FILES['vendor_gst_certificate'];    
         $allowed_extensions = array('jpg','jpeg','png','gif');
         $target_path = "../../uploads/gst_certificate/";
         $file_prefix = "IMG_";
         $upload = file_upload($file,$allowed_extensions,$target_path,$file_prefix);
        
         if($upload['error'] == 1){

               $error = "Failed to Upload files, try again later";

         }else{

             foreach($upload['files'] as $rs){

                  $vendor_gst_certificate = $rs;

             }

         }

       }

      $vendor_food_license_certificate = "";
      if($_FILES['vendor_food_license_certificate']['error'][0] == 0){

         // FILE DATA 
         $file = $_FILES['vendor_food_license_certificate'];    
         $allowed_extensions = array('jpg','jpeg','png','gif');
         $target_path = "../../uploads/food_license/";
         $file_prefix = "IMG_";
         $upload = file_upload($file,$allowed_extensions,$target_path,$file_prefix);
        
         if($upload['error'] == 1){

               $error = "Failed to Upload files, try again later";

         }else{

             foreach($upload['files'] as $rs){

                  $vendor_food_license_certificate = $rs;

             }

         }

       }

      $form_data = array(
        'added_by' => $login_id,
        'vendor_name' => $vendor_name,
        'vendor_code' => $vendor_code,
        'contact_person_name' => $contact_person_name,
        'vendor_address' => $vendor_address,
        'vendor_pincode' => $vendor_pincode,
        'vendor_email' => $vendor_email,
        'vendor_landline' => $vendor_landline,
        'vendor_mobile' => $vendor_mobile,
        'vendor_gst' => $vendor_gst,
        'vendor_gst_type' => $vendor_gst_type,
        'vendor_mode_of_payment' => $vendor_mode_of_payment,
        'vendor_pan' => $vendor_pan,
        'vendor_aadhaar_number' => $vendor_aadhaar_number,
      );

      if( isset($vendor_aadhaar) && $vendor_aadhaar != ""){
        $form_data['vendor_aadhaar'] = $vendor_aadhaar;
      }
      if( isset($vendor_gst_certificate) && $vendor_gst_certificate != ""){
        $form_data['vendor_gst_certificate'] = $vendor_gst_certificate;
      }

     if(insert('tbl_vendors',$form_data)){

         $success = "Vendor Added Successfully";

     }else{

         $error = "Failed to add vendor, try again later";
         // unlink($rs);

     }


  }      

   if(isset($_GET['edit_id'])){


         $edit_data = getOne($table_name,$field_name,$_GET['edit_id']);

         $edit_data = array(
            'vendor_name' => $edit_data['vendor_name'],
            'vendor_code' => $edit_data['vendor_code'],
            'contact_person_name' => $edit_data['contact_person_name'],
            'vendor_address' => $edit_data['vendor_address'],
            'vendor_pincode' => $edit_data['vendor_pincode'],
            'vendor_email' => $edit_data['vendor_email'],
            // 'vendor_password' => $edit_data['vendor_password'],
            'vendor_landline' => $edit_data['vendor_landline'],
            'vendor_mobile' => $edit_data['vendor_mobile'],
            'vendor_gst' => $edit_data['vendor_gst'],
            'vendor_gst_type' => $edit_data['vendor_gst_type'],
            'vendor_mode_of_payment' => $edit_data['vendor_mode_of_payment'],
            'vendor_pan' => $edit_data['vendor_pan'],
            'vendor_aadhaar_number' => $edit_data['vendor_aadhaar_number'],
            );


   }



   if(isset($_POST['update'])){

      $vendor_aadhaar = "";
      if($_FILES['vendor_aadhaar']['error'][0] == 0){

         // FILE DATA 
         $file = $_FILES['vendor_aadhaar'];    
         $allowed_extensions = array('jpg','jpeg','png','gif');
         $target_path = "../../uploads/aadhaar/";
         $file_prefix = "IMG_";
         $upload = file_upload($file,$allowed_extensions,$target_path,$file_prefix);
        
         if($upload['error'] == 1){

               $error = "Failed to Upload files, try again later";

         }else{

             foreach($upload['files'] as $rs){

                  $vendor_aadhaar = $rs;

             }

         }

       }

      $vendor_gst_certificate = "";
      if($_FILES['vendor_gst_certificate']['error'][0] == 0){

         // FILE DATA 
         $file = $_FILES['vendor_gst_certificate'];    
         $allowed_extensions = array('jpg','jpeg','png','gif');
         $target_path = "../../uploads/gst_certificate/";
         $file_prefix = "IMG_";
         $upload = file_upload($file,$allowed_extensions,$target_path,$file_prefix);
        
         if($upload['error'] == 1){

               $error = "Failed to Upload files, try again later";

         }else{

             foreach($upload['files'] as $rs){

                  $vendor_gst_certificate = $rs;

             }

         }

       }

       $form_data = array(
        'vendor_name' => $_POST['vendor_name'],
        'contact_person_name' => $_POST['contact_person_name'],
        'vendor_address' => $_POST['vendor_address'],
        'vendor_pincode' => $_POST['vendor_pincode'],
        'vendor_email' => $_POST['vendor_email'],
        'vendor_landline' => $_POST['vendor_landline'],
        'vendor_mobile' => $_POST['vendor_mobile'],
        'vendor_gst' => $_POST['vendor_gst'],
        'vendor_gst_type' => $_POST['vendor_gst_type'],
        'vendor_mode_of_payment' => $_POST['vendor_mode_of_payment'],
        'vendor_pan' => $_POST['vendor_pan'],
        'vendor_aadhaar_number' => $_POST['vendor_aadhaar_number'],
      );

      if( isset($vendor_aadhaar) && $vendor_aadhaar != ""){
        $form_data['vendor_aadhaar'] = $vendor_aadhaar;
      }
      if( isset($vendor_gst_certificate) && $vendor_gst_certificate != ""){
        $form_data['vendor_gst_certificate'] = $vendor_gst_certificate;
      }
 
       if(update('tbl_vendors',$field_name,$_GET['edit_id'],$form_data)){

           $success = "Vendor Updated Successfully";
      
       }else{

           $error = "Failed to update vendor, try again later";

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

                           <h4 class="page-title">Add Vendor</h4>

                           <div class="clearfix"></div>

                        </div>

                     </div>                   

                  </div>

                  <div class="row">   

                     <div class="col-sm-12">

                        <div class="card-box">

                           <div class="row">

                               <form method="post" class="form-horizontal" enctype="multipart/form-data">

                                 <div class="col-md-12">

                                    <div class="row">


                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="vendor_name">Vendor Name<span class="text-danger">*</span></label>

                                             <input type="text" name="vendor_name" parsley-trigger="change" required="" placeholder="" class="form-control" id="vendor_name" value="<?php if(isset($edit_data['vendor_name'])){ echo $edit_data['vendor_name']; } ?>" >

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="contact_person_name">Contact Person Name</label>

                                             <input type="text" name="contact_person_name" parsley-trigger="change"placeholder="" class="form-control" id="contact_person_name" value="<?php if(isset($edit_data['contact_person_name'])){ echo $edit_data['contact_person_name']; } ?>">

                                          </div>

                                       </div>


                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="vendor_address">Address</label>

                                             <input type="text" name="vendor_address" parsley-trigger="change"  placeholder="" class="form-control" id="vendor_addres" value="<?php if(isset($edit_data['vendor_address'])){ echo $edit_data['vendor_address']; } ?>">

                                          </div>

                                       </div>

                               

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="vendor_pincode">Pin code</label>

                                             <input type="number" name="vendor_pincode" parsley-trigger="change"  placeholder="" class="form-control" id="vendor_pincode" value="<?php if(isset($edit_data['vendor_pincode'])){ echo $edit_data['vendor_pincode']; } ?>">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="vendor_email">Email <span class="text-danger">*</span></label>

                                             <input type="email" required="" name="vendor_email" parsley-trigger="change"  placeholder="" class="form-control" id="vendor_email" value="<?php if(isset($edit_data['vendor_email'])){ echo $edit_data['vendor_email']; } ?>">

                                          </div>

                                       </div>
<!-- 
                                     <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="vendor_password">Password<span class="text-danger">*</span> &nbsp;<input type="button" class="btn btn-default btn-xs pull-right generatePassword" value="Generate"></label>

                                             <input type="text" name="vendor_password" parsley-trigger="change" required="" placeholder="" class="form-control" id="vendor_password" value="<?php if(isset($edit_data['vendor_password'])){ echo $edit_data['vendor_password']; } ?>">

                                          </div>

                                       </div>
 -->

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="vendor_landline">Landline Number </label>

                                             <input type="number" name="vendor_landline" parsley-trigger="change"placeholder="" class="form-control" id="vendor_landline" value="<?php if(isset($edit_data['vendor_landline'])){ echo $edit_data['vendor_landline']; } ?>">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="vendor_mobile">Mobile <span class="text-danger">*</span></label>

                                             <input type="number" name="vendor_mobile" parsley-trigger="change" required="" placeholder="" class="form-control" id="vendor_mobile" value="<?php if(isset($edit_data['vendor_mobile'])){ echo $edit_data['vendor_mobile']; } ?>">

                                          </div>

                                       </div>
                                        <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="vendor_mode_of_payment">Mode of Payment</label>

                                             <input name="vendor_mode_of_payment" id="vendor_mode_of_payment" parsley-trigger="change" class="form-control" value="<?php if(isset($edit_data['vendor_gst'])){ echo $edit_data['vendor_mode_of_payment']; } ?>">

                                          </div>

                                       </div>


                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="vendor_pan">Pan Number</label>

                                             <input type="text" name="vendor_pan" parsley-trigger="change" placeholder="" class="form-control" id="vendor_pan" value="<?php if(isset($edit_data['vendor_pan'])){ echo $edit_data['vendor_pan']; } ?>">

                                          </div>

                                       </div>


                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="vendor_gst_type">Gst Type<span class="text-danger">*</span></label>

                                             <select name="vendor_gst_type" parsley-trigger="change"  class="form-control select2" id="vendor_gst_type">

                                                <option <?php if(isset($edit_data['vendor_gst_type']) && $edit_data['vendor_gst_type'] == "1"){ echo "selected";  } ?> value="1">CGST/SGST</option>

                                                <option <?php if(isset($edit_data['vendor_gst_type']) && $edit_data['vendor_gst_type'] == "2"){ echo "selected";  } ?> value="2">IGST</option>

                                             </select>

                                          </div>

                                       </div>


                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="vendor_gst">Gst No</label>

                                             <input type="text" name="vendor_gst" parsley-trigger="change"  placeholder="" class="form-control" id="vendor_gst" value="<?php if(isset($edit_data['vendor_gst'])){ echo $edit_data['vendor_gst']; } ?>">

                                          </div>

                                       </div>


                                        <div class="col-md-4">

                                          <div class="form-group">

                                             <label class="control-label">Upload GST Certificate</label>

                                             <input type="file" class="filestyle"  name="vendor_gst_certificate[]" id="vendor_gst_certificate" value="<?php if(isset($edit_data['vendor_gst_certificate'])){ echo $edit_data['vendor_gst_certificate']; } ?>">

                                          </div>

                                       </div>

                                      

                                       <div class="clearfix"></div>


                                    

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="vendor_aadhaar_number">Aadhaar Number</label>

                                             <input type="text" name="vendor_aadhaar_number" parsley-trigger="change" placeholder="" class="form-control" id="vendor_aadhaar_number" value="<?php if(isset($edit_data['vendor_aadhaar_number'])){ echo $edit_data['vendor_aadhaar_number']; } ?>">

                                          </div>

                                       </div>


                                        <div class="col-md-4">

                                          <div class="form-group">

                                             <label class="control-label">Upload Aadhaar</label>

                                             <input type="file" class="filestyle"  name="vendor_aadhaar[]" id="vendor_aadhaar" value="<?php if(isset($edit_data['vendor_aadhaar'])){ echo $edit_data['vendor_aadhaar']; } ?>">

                                          </div>

                                       </div>

                                       <div class="clearfix"></div>


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


   </body>

</html>
