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
    <style>
        body{
            margin: 0;
            padding: 0;
            font-family: 'Verdana';
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
                    font-size: 15px;
  font-weight: normal;
                }
        .bar{
            width: 80%;
            float: right;
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
            padding: 5px 0;
            font-size: 15px;
            font-weight: normal;
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
        width: 100%;
        float: left;
        margin: 20px 0;
    }
    input{
        padding: 10px;
  width: 20%;
  margin: 0 5px;   
    }      
    select{
        padding: 11px 10px ;
  width: 20%;
  background-color: white;
  border: 1px solid lightslategray;
  margin: 0 5px;
    }
    img{
        width: 100px;
        height: 100px;
        border-radius: 50%;
    }
        .all{
            margin-top: 20px;
            width: 100%;
            text-align: right;
        }
        #filter{
            padding: 10px 20px;
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

        <!-- search bar -->
<div class="search_bar">
        <input type="text" class="form-control" id="live_search" autocomplete="off" placeholder="Search...">
        <?php include('connection.php');   
        $slct_drpdn=$conn->prepare('select * from service');
        $slct_drpdn->execute();
        $res_ser= $slct_drpdn->get_result();?>

        <!-- select dropdown -->
        <select name="selected_service" id="drp_dwn">
        <option value="">Select services</option><?php
        while($ser_line =$res_ser -> fetch_assoc()){
            $id=$ser_line['service_id']?>
            <option value="<?=$id?>"><?=$ser_line['service_name']?></option>
        <?php
        }
        ?>
        </select>

        <!-- date filter -->
        <input id="from" type="date">
        <input id="to" type="date">
        <button id="filter">Filter</button>
</div>

     <!-- table of data -->
<div class="table_box" id="ajax_data">
                <h3>Messages</h3>
                <?php include('connection.php');    
                    $count = $conn->prepare("select * from customer where is_delete = false");
                    $count->execute();
                    $result = $count->get_result();
                    if ($result->num_rows>0) {
                        $total = $result->num_rows;
                    }
                    if(isset($total)){
                ?>
                <p><?= $total ?> messages found</p> <?php }?>
                <p id="resopnse"></p>
                <form action="" method="post">
                    <table id="messages_table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Message</th>
                                <th>Services</th>
                                <th>Date</th>
                                <th><button id="delete" type="button" name="delete" >Delete</button></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                    
                            $num_per_page=5;
                            if(isset($_GET['page'])){
                                $page=$_GET['page'];
                            }
                            else{
                                $page=1;
                            }
                            $start_from=($page-1)*$num_per_page;
                                $rows=$conn->prepare("select * from customer where is_delete = false limit $start_from, $num_per_page");
                            if($rows->execute()){
                            $result=$rows->get_result();
                            $x=1;
                            while($row =$result -> fetch_assoc()){
                            
                                $ser_id=$row['service_id'];
                                ?>
                                <tr>
                                <td><?= $x?></td>
                                <td><?= $row['customer_name']?></td>
                                <td><?= $row['email']?></td>
                                <td><?= $row['phone_number']?></td>
                                <td><?= $row['message']?></td>
                                <?php 
                                if(empty($ser_id)){?>
                                <td><?=  "None" ?></td>
                                <?php
                                }else{
                                    $query=$conn->prepare("select service_name from service where service_id=? ");
                                    $query->bind_param('i',$ser_id);
                                    $query->execute();
                                    $res=$query->get_result();
                                    $rw =$res -> fetch_assoc()?>
                                    <td><?= $rw['service_name']?></td>
                                <?php
                                }        
                                ?>
                            <td><?= $row['date']?></td>
                            <td><input type="checkbox" name="checkbox" class="checkbox" value="<?=$row['customer_id']?>" ></td>
                            </tr>
                                <?php
                                $x=$x+1;
                            }
                            }
                            ?>
                            </tbody>
                        </table>
                </form>

                <div class="all">
                            <button id="clear">Clear All</button>
                            <button id="select">Select All</button>
                </div>

                <div class="paging">
                        <?php if ($page> 1) {?>
                                        <a class="page-link" href="dashboard.php?page=<?=($page - 1) ?>">Prev</a>
                                    <?php }?>
                        <?php
                        $sql=$conn->prepare("select * from customer where is_delete=false ");
                        $sql->execute();
                        $result=$sql->get_result();
                        $total_records=$result->num_rows;
                        $total_pages=ceil($total_records/$num_per_page);
                        for($i=1; $i<=$total_pages;$i++){
                            if($i==$page){
                                $active="pageactive";
                            } else {
                            $active="";
                            }?>
                            <a class="<?=$active ?> page-link" href="dashboard.php?page=<?=$i ?>"><?=$i ?></a>  
                            <?php      
                            }
                        ?>
                        <?php if ($total_pages > $page) {?>
                        <a class="page-link" href="dashboard.php?page=<?=($page + 1) ?>">Next</a>
                        <?php }?>
                </div>

</div> 
            
</div>
</div>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){

        // select all and clear all 
        $(document).on('click',' #select', function () {
            var checkboxes = document.querySelectorAll('.checkbox');
            checkboxes.forEach(function(checkbox){
            checkbox.checked = true;
            });
        });
        $(document).on('click',' #clear', function () {
            var checkboxes = document.querySelectorAll('.checkbox');
            checkboxes.forEach(function(checkbox){
            checkbox.checked = false;
            });
        });

// live search function
$('#live_search').keyup(function(){
    var searchText = $(this).val();
            $.ajax({
                url: 'live_search.php',
                type:'POST',
                data:{search:searchText },
                success: function(data){
                    $("#ajax_data").html(data);
                }
            });
        });                                             

// drop down service         
$("#drp_dwn").on('change', function(){
    var dropdown_service = $(this).val();
    var from = $('#from').val();
    var to = $('#to').val();
    $.ajax({
        url:"filter.php",
        type:'POST',
        data:{dropdown_value:dropdown_service,
            from:from,
            to:to},
        success:function(data){
            $("#ajax_data").html(data);
        }
    })
});

//  filter 
$("#filter").on('click', function(){
    var from = $('#from').val();
    var to = $('#to').val();
    var dropdown_service = $("#drp_dwn").val();
    // console.log(from);
    // console.log(to);
    // console.log(dropdown_service) ;
    $.ajax({
        url:"filter.php",
        type:'POST',
        data:{dropdown_value:dropdown_service,
            from:from,
            to:to},
        success:function(data){
            $("#ajax_data").html(data);
        }
    })
});

// delete row function
    $(document).on('click',' #delete', function () {
                var input_checked = []; 
                $('input[name="checkbox"]:checked').each(function() {
                    input_checked.push($(this).val()); 
                    var row = $(this).parents('tr').fadeOut();
                    console.log(row);
                });
                $.ajax({
                    type: 'POST',
                    url: 'delete_filter.php',
                    data: {
                        input_checked: input_checked
                    },
                    success: function (res) {
                        $('#resopnse').html(res);
                        if(res==1){
                            console.log("dsfse");

                        }
                        else if(res==0){
                            console.log("dsfse");
                        }
                    }
                })
                console.log(input_checked);
    });

    function loadMessages(page,from,to,dropdown_service) {
        console.log(from,to,dropdown_service,page);
        $.ajax({
            url: 'filter.php',
            type: 'POST', 
            data: {page: page,
                from:from,
                to:to,
                dropdown_value:dropdown_service
            },
            success: function(response){
                $('#ajax_data').html(response);
            }
        });
    }
    $(document).on("click",".filter-page-link",function(e){
        var from = $('#from').val();
        var to = $('#to').val();
        var dropdown_service = $("#drp_dwn").val();
            e.preventDefault(); 
            var pageNum = $(this).attr('href').match(/page=(\d+)/)[1]; 
            console.log(from,to,dropdown_service,pageNum);
            loadMessages(pageNum,from,to,dropdown_service);
        });

});
</script>
</body>
</html>