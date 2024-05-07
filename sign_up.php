
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            margin: 0;
            padding: 0;
        }
        .sidebar{
            width:  20%;
            float: left;
            position: fixed;
            left: 0;
            height: 100%;
            background-color: rgb(105, 104, 104);
            /* margin-right: -5px; */
            display: inline-block;
            /* height: 800px; */
            color: white;
            /* padding: 20px; */
        }
        .sidebar_container{
            width: 80%;
            margin: auto;
            margin-top: 50px;
            margin-left: 70px;
        }
        .sidebar_container h1{
            text-align: left;
            font-size: 150%;
        }
        .sidebar_container h3{
            border-radius: 30px 0px 0px 30px;
            cursor: pointer;
        }
        .bar{
            width: 80%;
            float: right;
            /* background-color:  lightgray; */
            height: 600px;
        }
        .bar h4{
            text-align:  right;
        }
       
      
        .bar_container{
            width: 90%;
            margin: auto;
            margin-top: 20px;
            height: 500px;
        }
        hr{
            border: 1px solid lightgray;
        }
       
        a{
            text-decoration: none;
            padding: 10px;
            color: white;
            margin: 10px;
            background-color: rgb(105, 104, 104);
        }
        .active {
    background-color: white;
    
    color: rgb(105, 104, 104) ; 

}
    
.bar h3{
            text-align:  left;
        }
        .bar p{
            text-align:  left;
            color: lightslategray;
        }
        .table_box{
            /* height: 600px;    */
            /* position: relative; */
            /* overflow: auto; */
        }
        table{
            margin: auto;
            margin-top: 20px;
            width: 100%;
            /* position: absolute; */
            /* margin-bottom: 50px; */
        }
        th{
            padding: 20px;
            background-color: rgb(105, 104, 104);
            color: white;
            width: 100px;
        }
        td{
            border:1px solid lightgray ;
            background-color: lightgray;
            /* width: 100px; */
            text-align: center;
        }
        .paging{
            margin-top: 50px;
            text-align: center;
        }
        .pageactive{
            background-color: lightgray;
            color: black;
        }
        .search_bar {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
    input{
        padding: 10px;
  width: 40%;
    }      
    #signup{
            width: 500px;
            border: 1px solid rgb(105, 104, 104);
            padding: 30px;
            margin: auto;
            margin-top: 50px;
            text-align: center;
        }
        input{
            padding: 10px ;
            width: 470px;
            border: 1px solid lightgray;
            /* color: gray; */
        }
        select{
            padding: 12px ;
            width: 491px;
            border: 1px solid lightgray;
            background-color: white;
            /* color: lightgray; */
        }
        #signup button{
            padding: 10px 30px;
            border: none;
            background: none;
            outline: none;
            background-color: rgb(105, 104, 104);
            color: white;
        }  
        img{
        width: 100px;
        height: 100px;
        border-radius: 50%;
    }
    </style>
</head>
<body>
    <!-- left side  -->
    <div class="sidebar">
        <div class="sidebar_container">
            <!-- name -->
                <?php include('connection.php');
                 session_start();
                 if(!isset($_SESSION["malik_number"])){
                     header( "Location: sign_in.php" );
                     exit();
                 }
                 if(isset($_GET["logout"])){
                    session_destroy();
                     header( "Location: sign_in.php" );
                     exit();
                 }?>
                <?php
                $name=$conn->prepare("select * from malik where malik_phone_number=?");
                $name->bind_param("s",$_SESSION['malik_number']);
                $name->execute();
                $result=$name->get_result();
                $row = $result->fetch_assoc();
                $m_name=$row['malik_name'];
                $role_id=$row['role_id'];
                $img=$row['image'];
                ?>
                <img src="<?= $img?>" alt="">
                <!-- lists -->
                <div class="side_list">
                    <?php 
                    $role_table=$conn->prepare('select permission  from role where role_id= ? ');
                    $role_table->bind_param('i',$role_id);
                    $role_table->execute();
                    $res=$role_table->get_result();
                    $permision=$res->fetch_assoc();
                    $permision_arr = json_decode($permision['permission']);
                    for($i=1;$i<=6;$i++){
                        if (in_array($i, $permision_arr)) {
                            $put_values=$conn->prepare('select * from navigation where  nav_id= ? ');
                            $put_values->bind_param('i',$i);
                            $put_values->execute();
                            $rslt=$put_values->get_result();
                            $line=$rslt->fetch_assoc();?>
                            <a href="<?=$line['link']?>"><h3 id="<?=$line['nav_id']?>"><?=$line['title']?></h3></a>
                            <?php
                        }
                    }
                    ?>
                </div>
        </div>
    </div>
    <!-- right side  -->
<div class="bar">
        <div class="bar_container">
        <h4><?= $m_name?><a href="?logout">Sign out</a></h4>
        <hr/>
        <div class="content">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<form id="signup" action="" method="post" enctype="multipart/form-data">
    <h2>Create new admin</h2>
    <input id="name" type="text" name="name" placeholder="Enter name" required><br><br>
    <input id="p_no" maxlength="10" type="text" name="phone_number" placeholder="Enter phone number" required><br><br>
    <input type="file" name="image" id="image" accept="image/png, image/gif, image/jpeg"><br><br>
    <select name="role" id="role" required>
        <option value="Select" placeholder="select any role">select any role</option>
        <option value="1">Super Admin</option>
        <option value="2">Admin</option>
        <option value="3">Publisher</option>
    </select><br><br>
    <input id="pass" type="text" name="password" placeholder="password" required><br><br>
    <button name="signup-btn" type="button" id="submitForm" value="button">Create</button>
</form>
</div>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
        $('#submitForm').click(function(e) {
        e.preventDefault();
        var form = $('#signup')[0];
        var formData = new FormData(form);
        formData.append('btn', 'signup-btn');
        $.ajax({
            url: 'signup_data.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                if(response==="success"){
                    Swal.fire({
                    title: 'Success',
                    text: 'You have Successfully created new user',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
                }else{
                    Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                    footer: '<a href="#">Why do I have this issue?</a>'
                    });
                }
            }
        });
        console.log(name);
    });
});
</script>
</body>
</html>