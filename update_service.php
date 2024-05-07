<?php
include 'connection.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $desc = $_POST['small_desc'] ?? '';
    $price = $_POST['price'] ?? '';
    $service_name = $_POST['name'] ?? '';
    $large_desc = $_POST['large_desc'] ?? '';

    
    $target_directory="images/";
    $allowedTypes = ['jpg', 'png', 'jpeg', 'gif'];

    $database=$conn->prepare('select image from service where service_name=?');
        $database->bind_param('s',$service_name);
        $database->execute();
        $result=$database->get_result();
        $row=$result->fetch_assoc();
        $image_json=$row['image'];
        $image_array = json_decode($image_json, true) ?? [];

        foreach ($_FILES['image']['name'] as $index => $value) {

            $target_file = $target_directory . basename($_FILES['image']['name'][$index]);
            $filetype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            
            if (in_array($filetype, $allowedTypes)) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"][$index], $target_file)) {
                    $image_array[] = $target_file; 
                } else {
                    echo "Error uploading file: $value";
                    exit;
                }
            } else {
                echo "Invalid file type: $filetype. Only JPG, JPEG, PNG & GIF files are allowed.";
                exit;
            }
        }

        
        if (isset($_POST['checkbox'])) {
            foreach ($_POST['checkbox'] as $del_image) {
                    if (in_array($del_image, $image_array)){
                        unlink($del_image);
                        $key = array_search($del_image, $image_array);
                        unset($image_array[$key]);
                    }
            }
            $image_array = array_values($image_array);
        }
       
           
    $gallery_json = json_encode($image_array);
    if($conn->connect_error) {
        die('Connection Failed: '.$conn->connect_error);
    } else {
                $stmt = $conn->prepare("update service set  image=?,small_desc=?,large_desc=?,price=? where service_name=?");
                $stmt->bind_param("sssss",  $gallery_json, $desc, $large_desc, $price,$service_name);
                if ($stmt->execute()) {
                    echo "success";
                } else {
                    echo "Error: " . $stmt->error;
                }
                $stmt->close();
            }
        $conn->close();
        }
?>
