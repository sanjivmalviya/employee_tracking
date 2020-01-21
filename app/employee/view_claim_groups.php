<?php

   require_once('../../functions.php');

   $request = json_decode(trim(file_get_contents('php://input')));

   $data = null;

    if(isset($request->employee_id)){         

       $date = date('d-m-Y');

      if(isset($request->date_from)){
   
         $date_from = date('d-m-Y', strtotime($request->date_from));
           
          if(isset($request->date_to) && $request->date_to != ""){
             
              $date_to = date('d-m-Y', strtotime($_POST['date_to']));
              $claim_details = "SELECT claim_group_id,employee_id,claim_request_date,SUM(travel_distance) as total_travel_distance,travel_rate,SUM(total_travel_rate) as total_travel_rate,claim_status,(SELECT employee_name FROM tbl_employees WHERE employee_id = employee_id ORDER BY employee_id ASC LIMIT 1) AS employee_name,COUNT(*) as total_trips FROM tbl_employee_travel_claims WHERE claim_request_date BETWEEN '".$date_from."' AND '".$date_to."' GROUP BY claim_group_id ORDER BY claim_status ASC ";

          }else{
          
              $claim_details = "SELECT claim_group_id,employee_id,claim_request_date,SUM(travel_distance) as total_travel_distance,travel_rate,SUM(total_travel_rate) as total_travel_rate,claim_status,(SELECT employee_name FROM tbl_employees WHERE employee_id = employee_id ORDER BY employee_id ASC LIMIT 1) AS employee_name,COUNT(*) as total_trips FROM tbl_employee_travel_claims WHERE claim_request_date = '".$date_from."' GROUP BY claim_group_id ORDER BY claim_status ASC ";

          }
      
    }else{

       $claim_details = "SELECT claim_group_id,employee_id,claim_request_date,SUM(travel_distance) as total_travel_distance,travel_rate,SUM(total_travel_rate) as total_travel_rate,claim_status,(SELECT employee_name FROM tbl_employees WHERE employee_id = employee_id ORDER BY employee_id ASC LIMIT 1) AS employee_name,COUNT(*) as total_trips FROM tbl_employee_travel_claims GROUP BY claim_group_id ORDER BY claim_status ASC ";

    } 
  
    $data = getRaw($claim_details);
    if(isset($data) && count($data) > 0){
        $status = 1;
        $msg = "data found";
     }else{
        $status = 0;
        $msg = "no data found";
     }


   }else{

      $status = 0;
      $msg = "invalid request";

    }
 $data = array('status' => $status, 'message' => $msg, 'data'=>$data);
 echo json_encode($data);