<?php
include 'connection.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $malik_phn = $_POST['phone_number'] ?? '';
    $malik_pass = $_POST['password'] ?? '';
    $malik_name = $_POST['name'] ?? '';
    $malik_role = $_POST['role'] ?? '';

    $target_directory="images/";
    $allowedTypes = ['jpg', 'png', 'jpeg', 'gif'];

    $database=$conn->prepare('select image from malik where malik_phone_number=?');
        $database->bind_param('s',$malik_phn);
        $database->execute();
        $result=$database->get_result();
        $row=$result->fetch_assoc();
        $image=$row['image'];
        unlink($image);

    $target_file=$target_directory.basename($_FILES["image"]["name"]);
    $filetype=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


    if($conn->connect_error) {
        die('Connection Failed: '.$conn->connect_error);
    } else {
        if (in_array($filetype, $allowedTypes)){
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                $stmt = $conn->prepare("update malik set  malik_name=?,  image=? where role_id=? and malik_phone_number=?");
                $stmt->bind_param("ssis", $malik_name, $target_file ,$malik_role,$malik_phn);
                if ($stmt->execute()) {
                    
                    echo "success";
                    // exit();
                } else {
                    echo "Error: " . $stmt->error;
                }
                $stmt->close();
            }
            else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        else {
            echo "Only JPG, JPEG, PNG & GIF files are allowed.";
        }
        $conn->close();
    }

}
// echo $response;
?>
