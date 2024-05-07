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
            /* padding: 20px;    */
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
            border: 1px solid lightgray;
            padding: 30px;
            margin: auto;
            margin-top: 50px;
            text-align: center;
        }
        input{
            padding: 10px ;
            /* width: 470px; */
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

        /* service list  */
        .service_image{
        width: 100px;
        height: 60px
    }
   
    #service_table td{
        padding: 10px;
        background-color: lightgray;
text-align: center;
    }
    #service_table #desc{
        width: 300px;
    }
    #service_table th{
        /* width: 200px; */
        background-color: gray;
        padding: 20px 10px;
    }
    .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgb(105, 104, 104);
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}
.sidebar img{
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
        <table id="service_table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th id="desc">Small description</th>
                <th>Price</th>
                <th>Is Active</th>
                <th>Edit</th>
            </tr>
            </thead>
            <tbody>
            <?php  include('connection.php'); 
            $start_from=1;
            $num_per_page=2;
            $rows=$conn->prepare("select * from service");
            if($rows->execute()){
            $result=$rows->get_result();
            $x=1;
            while($row =$result -> fetch_assoc()){
                $ser_price=$row['price'];
                $is_active=$row['is_delete'];
                $service_id=$row['service_id'];
                $service_image=$row['image'];
                $ser_image = json_decode($service_image);
                ?>
                <tr>
                <td><?= $x?></td>
                <td><?= $row['service_name']?></td>
                <td><img class="service_image" src="<?=$ser_image[0]?>" alt=""></td><?php ?>
                <td><?= $row['small_desc']?></td>
                <?php 
                if(empty($ser_price)){?>
                <td><?= "5000"?></td>
                   <?php
                }else{?>
                    <td><?= $ser_price?></td><?php
                }?>
            <td><?php
            if($is_active == 0){?>
                <label class="switch"><input class="checkbox" type="checkbox" value="<?=$service_id?>"><span class="slider"></span></label><?php
            }
            else{?>
                <label class="switch"><input  class="checkbox" type="checkbox" value="<?=$service_id?>" checked><span class="slider"></span></label><?php
            }
            ?>
            </td>
            <td><a href="edit_service.php?service_name=<?=$row['service_name']?>">Edit</a></td>
            </tr>
            <tr class="add">
            </tr>
                <?php
                $x++;
            }}
            ?>
            </tbody>
    </table> 
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
            $(".checkbox").on('change', function() {
                var service_id = $(this).val();
                console.log(service_id);
                $.ajax({
                    url:"update_service_status.php",
                    type:'POST',
                    data:{service_id:service_id},
                    success:function(data){
                        console.log(data);
                    }
                });
            });
        });
    </script>
</body>
</html>