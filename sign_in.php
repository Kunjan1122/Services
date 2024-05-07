<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #signup{
            width: 500px;
            border: 1px solid lightgray;
            padding: 30px;
            margin: auto;
            margin-top: 100px;
            text-align: center;
        }
        input{
            padding: 10px ;
            width: 470px;
            border: 1px solid lightgray;
        }
        #signup button{
            padding: 10px 30px;
            border: none;
            background-color: none;
            outline: none;
        }
    </style>
</head>
<body>
    <?php  include ('connection.php'); 
    session_start();
    $malik_phn=isset($_POST['phone_number'])?$_POST['phone_number']:'';
    $malik_pass=isset($_POST['password'])?$_POST['password']:'';
if(isset( $_POST["signup-btn"])) {  
    if($conn->connect_error){
        die('Connection Failed: '.$conn->connect_error);
    } else {
        $stmt = $conn->prepare("select * from malik  where malik_phone_number=?");
        $stmt->bind_param("s", $malik_phn);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0){
            $data = $result->fetch_assoc();
            $hashpwd=$data['password'];
            if (password_verify($malik_pass,$hashpwd)) {
                $_SESSION["malik_number"]=$malik_phn;
                header( "Location: dashboard.php" );
            }
        }
    }}
    ?>
    <form id="signup" action="" method="post">
        <input type="text" maxlength="10" name="phone_number" placeholder="Enter phone number"><br><br>
        <input type="text" name="password" placeholder="password"><br><br>
        <button name="signup-btn" type="submit">Sign Up</button>
    </form>
</body>
</html>