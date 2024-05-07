<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="Task.css"> -->
    <script src="https://kit.fontawesome.com/01084ba05a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include('header.php');?>
    <div class="container">
        <div class="products">
            <h1 id="heading">
                Services
            </h1>
            <img src="" alt="">
            <div class="Sub_con_1">
                <?php include('connection.php'); 
                $stmt = $conn->prepare("SELECT * FROM service");
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $id= $row['service_id'];
                        $service_image=$row['image'];
                        $ser_image = json_decode($service_image);
                        ?>
                        <div class='box'>
                        <img class='image' src='<?=$ser_image[0]?>'>
                        <h3><?= $row['service_name'] ?> </h3>
                        <p> <?= $row['small_desc']?> </p>
                        <a id="read_more" href='description.php?id=<?=md5($id)?>'  data-service-id='$id' class='details'>Read More</a>
                         </div>
                         <?php
                    }
                }
                ?>    
            </div>
        </div>
    </div>
    <?php include('footer.php');?>
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script type="text/javascript">
    $(document).ready(function(){
        $('#services').addClass('active'); 
    });
</script>
