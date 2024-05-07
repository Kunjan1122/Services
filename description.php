<?php include('connection.php'); ?>
<link rel="stylesheet" href="style.css">
<?php include('header.php');?>

<div class="div">
<div class="container">
<?php
$S_ID = isset($_GET['id']) ? $_GET['id'] : null;

 
    $stmt = $conn->prepare("SELECT * FROM service where md5(service_id) =?");
    $stmt->bind_param("s",$S_ID);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0){
                    $row = $result->fetch_assoc();
                    $id= $row['service_id'];
                    $service_image=$row['image'];
                    $ser_image = json_decode($service_image);
                    ?>
                    <div class='description'>
                    <h3><?= $row['service_name'] ?></h3>
                    <p style="text-align:left " ><?= $row['small_desc'] ?></p>
                    <p style="text-align:left" ><?= $row['large_desc'] ?></p>
                    <a id="btn" href='contact.php?id=<?=md5($id)?>' class='details'>Get a quote</a>
                    </div>
                    <img  id="image" src='<?= $ser_image[0] ?>'>
                    <?php 
                }

?>
</div>
</div>

<?php include('footer.php');?>

</html>