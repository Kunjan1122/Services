<?php  include("connection.php");
if(isset($_POST['input_checked'])) {
                
                    $checkbox = $_POST['input_checked'];
                    // echo $checkbox;
                     print_r($checkbox);
                    foreach( $checkbox as $delete_id){
                    $delete_mutiple_ro= $conn->prepare("update  customer set is_delete=true WHERE customer_id=?");
                    $delete_mutiple_ro->bind_param('i',$delete_id);
                    if($delete_mutiple_ro->execute()){
                        echo 1;
                    }else{
                        echo 0;
                    }
                    }
            }
            else{
                echo "oops";
            }
  ?>