<?php
include 'connection.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $desc = $_POST['desc'] ?? '';
    $price = $_POST['price'] ?? '';
    $service_name = $_POST['name'] ?? '';
    $large_desc = $_POST['large_desc'] ?? '';

    $target_directory="images/";
    $allowedTypes = ['jpg', 'png', 'jpeg', 'gif'];

    $gallery_paths = array();
    foreach ($_FILES['image']['name'] as $key => $value){
        $target_file=$target_directory.basename($_FILES['image']['name'][$key]);
        $filetype=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if (in_array($filetype, $allowedTypes)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"][$key], $target_file)) {
       
                $gallery_paths[] = $target_file;
            } else {
                echo "Sorry, there was an error uploading file: $filename";
                exit;
            }
        } else {
            echo "Invalid file type: $filetype. Only JPG, JPEG, PNG & GIF files are allowed.";
            exit;
        }
    }
    $gallery_json = json_encode($gallery_paths);
    
    if($conn->connect_error) {
        die('Connection Failed: '.$conn->connect_error);
    } else {
                $stmt = $conn->prepare("INSERT INTO service (service_name, image, small_desc, large_desc, price) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $service_name, $gallery_json, $desc, $large_desc, $price);
                if ($stmt->execute()){
                    echo "success";
                } else {
                    echo "Error: " . $stmt->error;
                }
                $stmt->close();
            }
        $conn->close();   
}
?>
