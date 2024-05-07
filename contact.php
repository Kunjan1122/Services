<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
   <link rel="stylesheet" href="style.css">
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php include('connection.php'); 
    
    $nameErr= "";
    $phone_number_Err="";
    $email_Err="";
    
    $form_submit = false;
    $isFormValid = true;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST['name'];
        $phone_number = $_POST['phone_number'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $service = isset($_POST['service_name']) ? $_POST['service_name'] : '';
        // $service =$_POST['service_name'];

        if(empty($name)){
            $nameErr="Name is required";
            $isFormValid = false;
        }
        else{
            if(!preg_match("/^[a-zA-Z ]+$/",$name)){
                $nameErr="<br/>name should contain only character and space";
                $isFormValid = false;
            }
        }
        
        if(empty($phone_number)){
            $phone_number_Err="Phone number is required";
            $isFormValid = false;
        }else{
            if(!preg_match("/^[0-9]{10}+$/",$phone_number)){
                $phone_number_Err="<br/>invalid phone number";
                $isFormValid = false;
            }
        }
        
        if(empty($email)){
            $email_Err="Email is required";
            $isFormValid = false;
        }
        else{
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
                $isFormValid = false;
              }
            }
        
        if($isFormValid){
            if($conn->connect_error){
                die('Connection Failed: '.$conn->connect_error);
            } else {
                if($service){
                $stmt = $conn->prepare("INSERT INTO customer(customer_name,email,phone_number,message,service_id) VALUES (?,?,?,?,?)");
                $stmt->bind_param("ssssi", $name, $email, $phone_number, $message, $service);
                }else{
                    echo "hofop";
                   $stmt = $conn->prepare("INSERT INTO customer(customer_name,email,phone_number,message) VALUES (?,?,?,?)");
                $stmt->bind_param("ssss", $name, $email, $phone_number, $message);

                }
                
              if ($stmt->execute()) {
                echo "sucess";
                ?>
                    <script>
                        if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                    }
                    </script>
                    <?php
              }else{
                echo "hrhrhrrhrh".$service;
                echo $conn->connect_error;
              }
                $stmt->close();
                $form_submit = true;
            }
        }
     }  
    ?>
<?php
if($form_submit) {
    echo "hello";
?>
<script>
  Swal.fire({
    text: "We will contact you shortly!",
    title: "Thank you!  <?= $name?>",
    icon: "success"
})
</script>
<?php
}
?>
<div class="container">
<?php include('header.php');?>
<div class="contact">
<h1 style="color:rgb(105, 104, 104)">Contact Us</h1>

<form id="contact-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  >
<select name="service_name">
    <option value="">Select</option>
    <?php 
        $S_ID =$_GET['id'];
        $stmt = $conn->prepare("SELECT * FROM service");
        $stmt->execute();
        $result = $stmt->get_result();
        echo "<br>";
        if ($result->num_rows > 0){ 
            ?>
                <?php
            while($row = $result->fetch_assoc()) {
                if($S_ID == md5($row['service_id'])){
                    ?>
                    <option value="<?=$row['service_id']?>" <?=($S_ID == md5($row['service_id']))? "selected" :""?> > 
                    <?=$row['service_name'] ?>
                </option>
                    <?php 
                }
                else{
                    ?>
                    <option value="<?=$row['service_id']?>" <?=($S_ID == md5($row['service_id']))? "selected" :""?> > 
                    <?=$row['service_name'] ?>
                </option>
                    <?php 
                }
            }
            ?>
            <?php 
        }else{
            echo "working";
        }
    ?>
    </select>
    <br>
        <input maxlength="20"  type="text" placeholder="Name" name="name" ><br>
        <span style="color:red" ><?php echo $nameErr ?></span><br>
        <input maxlength="10"  type="text" placeholder="Phone Number" name="phone_number" ><br>
        <span style="color:red" ><?php echo $phone_number_Err ?></span><br>
        <input maxlength="50" type="email" placeholder="Email" name="email" >    <br>
        <span style="color:red" ><?php echo $email_Err ?></span><br>
        <!-- <input type="file" name="photo" id="photo" accept=".jpg, .jpeg, .png" value=""><br><br> -->
        <textarea name="message" placeholder="Message" id="mes"  cols="30" rows="3"></textarea><br><br>
        <button id="submit-btn" type="submit" name="submit-btn" value="button">Submit</button>
    </form>
</div>
</div>
<?php include('footer.php');?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script src="script.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#contact').addClass('active');    
    
});
</script>
