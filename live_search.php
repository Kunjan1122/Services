<?php include('connection.php'); 
$search_value=$_POST["search"];?>
<?php 
    $count = $conn->prepare("select * from customer 
    where customer_name LIKE '%$search_value%' and is_delete = false");
    $count->execute();
    $result = $count->get_result();
    if ($result->num_rows>0) {
        $total = $result->num_rows;
    ?><?php
    }
    ?>
    <div class="table_box" id="ajax_data">
    <h3>Messages</h3>
    <?php if(isset($total)){?>
        <p><?= $total ?> messages found</p><?php
    }
    ?>
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
                <th><button id="delete" type="button" name="delete">Delete</button></th>
            </tr>
            </thead>
            <tbody>
            <?php 
            $num_per_page=7;
            if(isset($_GET['page'])){
                $page=$_GET['page'];
            }
            else{
                $page=1;
            }
            $start_from=($page-1)*$num_per_page;
            $rows=$conn->prepare("select * from customer 
            where customer_name LIKE '%$search_value%'and  is_delete = false limit $start_from, $num_per_page");
            if($rows->execute()){
            $result=$rows->get_result();
            if ($result->num_rows>0) {
                $i=1;
                while($row =$result -> fetch_assoc()){
                    $ser_id=$row['service_id']; ?>
                    <tr>
                    <td><?= $i?></td>
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
                    <td><?= $rw['service_name']?></td><?php } ?>
                    <td><?= $row['date']?></td>
                    <td><input type="checkbox"  name="checkbox" value="<?=$row['customer_id']?>" ></td>
                    </tr>
                    <?php
                    $i++;
                 }
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
        
    </div>
  
