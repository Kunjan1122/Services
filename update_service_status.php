<?php  include("connection.php");
if(isset($_POST['service_id'])) {
                
                    $service_id = $_POST['service_id'];
                    $get_status=$conn->prepare("select is_delete from service where service_id='$service_id'");
                    $get_status->execute();
                    $result=$get_status->get_result();
                    $row =$result -> fetch_assoc();
                    $status=$row['is_delete'];
                    if($status == 0){
                        $update_status= $conn->prepare("update service set is_delete=true WHERE service_id='$service_id'");
                    }
                    else if($status == 1){
                        $update_status= $conn->prepare("update service set is_delete=false WHERE service_id='$service_id'");
                    }
                    if($update_status->execute()){
                        echo 1;
                    }else{
                        echo 0;
                    }
                    
            }
            else{
                echo "oops";
            }
  ?>