
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

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
            display: inline-block;
            color: white;
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
            height: 800px;
        }
        .bar h4{
            text-align:  right;
        }
       
      
        .bar_container{
            width: 90%;
            margin: auto;
            margin-top: 20px;
            height: 100%;
            position: relative;
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
        table{
            margin: auto;
            margin-top: 20px;
            width: 100%;
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
    #create_service{
            width: 900px;
            border: 1px solid rgb(105, 104, 104);
            padding: 30px;
            margin: auto;
            margin-top: 50px;
            text-align: center;
            height: 550px;
        }
        input{
            padding: 10px ;
            width: 388px;
            border: 1px solid lightgray;
            float: left;
            margin: 20px;
        }
        textarea{
            padding: 10px ;
            width: 388px;
            border: 1px solid lightgray;
            resize: none;
            float: left;
            margin: 20px;
        }
        select{
            padding: 12px ;
            width: 491px;
            border: 1px solid lightgray;
            background-color: white;
            /* color: lightgray; */
        }
        #create_service button{
            padding: 10px 30px;
            border: none;
            background: none;
            outline: none;
            background-color: rgb(105, 104, 104);
            color: white;
            margin-top: 20px;
        }  
        img{
        width: 100px;
        height: 100px;
        border-radius: 50%;
    }
    .checkbox{
        width: 328px;
        margin: 20px;
    }
    .input_image{
        width: 50px;
        height: 50px;
        float: left;
        margin-top: 15px;
        border-radius: 0px;
        
    }
    #btn{
        width: 100%;
        float: left;
    }
    #back{
        text-decoration: none;
  background-color: white;
  color: black;
  margin-top: ;
  position: absolute;
  left: 0px;
  top: 35px;
  font-size: 30px;
    }
    </style>
</head>
<body>
    <!-- left side  -->
    <div class="sidebar">
        <div class="sidebar_container">
            <!-- name -->
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
                    $role_table=$conn->prepare('select permission from role where role_id= ? ');
                    $role_table->bind_param('i',$role_id);
                    $role_table->execute();
                    $res=$role_table->get_result();
                    $permision=$res->fetch_assoc();
                    
                    $permision_arr = json_decode($permision['permission']);
                    for($i=1;$i<=6;$i++){
                        if (in_array($i, $permision_arr)) {
                            $put_values=$conn->prepare('select * from navigation where nav_id= ?');
                            $put_values->bind_param('i',$i);
                            $put_values->execute();
                            $rslt=$put_values->get_result();
                            $line=$rslt->fetch_assoc();
                            ?>
                            <a href="<?=$line['link']?>"><h3 id="<?=$line['nav_id']?>"><?=$line['title']?></h3></a>
                            <?php
                            $service_name = $_GET['service_name'];
                        }
                    }
                    
                    ?>
                </div>
        </div>
    </div>
    <?php 
    $service=$conn->prepare('select * from service where service_name=?');
    $service->bind_param('s',$service_name);
    $service->execute();
    $rslt=$service->get_result();
    $row=$rslt->fetch_assoc();

    $image= $row['image'];
    $ser_image = json_decode($image);

    $small_desc=$row['small_desc'];
    $large_desc=$row['large_desc'];
    $price=$row['price'];
    ?>

    <!-- right side  -->
    <div class="bar">
        <div class="bar_container">
        <h4><?= $m_name?><a href="?logout">Sign out</a></h4>
        <hr/>
        <a id="back" href="service_list.php"><i class="fa-solid fa-arrow-left"></i></a>
        <div class="content">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<form id="create_service" action="" method="post" enctype="multipart/form-data">
    <h2>Edit service</h2>
    <input id="name" type="text" value="<?=$service_name?>" name="name" placeholder="Enter service name" required>
    <input type="number" id="price" value="<?=$price?>" name="price" placeholder="Enter price">
    <textarea name="small_desc" value="<?=$small_desc?>" id="s_desc" cols="30" rows="7"><?=$small_desc?></textarea>
    <textarea name="large_desc" value="<?=$large_desc?>" id="l_desc" cols="30" rows="7"><?=$large_desc?></textarea>
    <?php $x=0;
                foreach ($ser_image as $i){?>   <?=$ser_image[$x]?>
                <input type="checkbox" name="checkbox[]" class="checkbox" value="<?=$ser_image[$x]?>" ><img class="input_image" src="<?=$i?>" alt=""><?php $x++;
                }
                ?>
                
    <input type="file" name="image[]" class="image"  accept="image/png, image/gif, image/jpeg" multiple><br><br>
    <div id="btn"><button name="create_service-btn" type="button" id="submitForm" value="button">Update Service</button></div>
</form>

    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){

        $('#submitForm').click(function(e) {
        e.preventDefault();
        var form = $('#create_service')[0];
        var formData = new FormData(form);

        $.ajax({
            url: 'update_service.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {

                console.log(response);
                if(response==="success"){
                    Swal.fire({
                    title: "success",
                    text: 'You have Successfully updated the service',
                    icon: 'success',
                    confirmButtonText: '<a href="service_list.php">OK</a>'
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
        // console.log(name);
    });

  

});

    </script>
</body>
</html>