<?php
include 'connection.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $malik_phn = $_POST['phone_number'] ?? '';
    $malik_pass = $_POST['password'] ?? '';
    $malik_name = $_POST['name'] ?? '';
    $malik_role = $_POST['role'] ?? '';

    $hashed_password = password_hash($malik_pass, PASSWORD_DEFAULT);
    $target_directory="images/";
    $target_file=$target_directory.basename($_FILES["image"]["name"]);
    $filetype=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'png', 'jpeg', 'gif'];

    if($conn->connect_error) {
        die('Connection Failed: '.$conn->connect_error);
    } else {
        if (in_array($filetype, $allowedTypes)){
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                $stmt = $conn->prepare("INSERT INTO malik (malik_phone_number, password, malik_name, role_id, image) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssis", $malik_phn, $hashed_password, $malik_name, $malik_role, $target_file);
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
