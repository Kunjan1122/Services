<?php include('connection.php');

$dropdown_service = isset($_POST['dropdown_value']) ?$_POST['dropdown_value']: '';
$from = isset($_POST['from']) ?$_POST['from']: '';
$to = isset($_POST['to'])?$_POST['to']: '';


echo $dropdown_service;
echo $from;
echo $to;
    ?>
<h3>Messages</h3>
<?php 
if ($from != '' && $to != '' && $dropdown_service != '') {
    $count = $conn->prepare("SELECT * FROM customer WHERE service_id = ? AND is_delete = FALSE AND date BETWEEN ? AND ? ");
    $count->bind_param('iss', $dropdown_service, $from, $to);
} else if ($dropdown_service != '' && $from == '' && $to == '') {
    $count = $conn->prepare("SELECT * FROM customer WHERE service_id = ? AND is_delete = FALSE ");
    $count->bind_param('i', $dropdown_service);
} else if ($dropdown_service == '' && $from != '' && $to != '') {
    $count = $conn->prepare("SELECT * FROM customer WHERE service_id is null and is_delete = FALSE AND date BETWEEN ? AND ? ");
    $count->bind_param('ss', $from, $to);
} else if($dropdown_service == '' && $from == '' && $to == ''){
    $count = $conn->prepare("SELECT * FROM customer where is_delete = FALSE");
}
else{
    echo "nhi h kuj";
}
if(isset($count)){
    if($count->execute()){
    $count_result=$count->get_result();
    $total=$count_result->num_rows;?>
    <p><?= $total ?> messages found</p><?php
    }
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
            $num_per_page=5;
            if(isset($_POST['page'])){
                $page=$_POST['page'];
                echo $page;
            }
            else if(isset($_GET['page'])) {
                $page=$_GET['page'];
                echo $page;
            }
            else{
                $page=1;
            }
            $start_from=($page-1)*$num_per_page;

            if ($from != '' && $to != '' && $dropdown_service != '') {
                $message_query = $conn->prepare("SELECT * FROM customer WHERE service_id = ? AND is_delete = FALSE AND date BETWEEN ? AND ? LIMIT ?, ?");
                $message_query->bind_param('issii', $dropdown_service, $from, $to, $start_from, $num_per_page);
            } else if ($dropdown_service != '' && $from == '' && $to == '') {
                $message_query = $conn->prepare("SELECT * FROM customer WHERE service_id = ? AND is_delete = FALSE LIMIT ?, ?");
                $message_query->bind_param('iii', $dropdown_service, $start_from, $num_per_page);
            } else if ($dropdown_service == '' && $from != '' && $to != '') {
                $message_query = $conn->prepare("SELECT * FROM customer WHERE service_id is null and is_delete = FALSE AND date BETWEEN ? AND ? LIMIT ?, ?");
                $message_query->bind_param('ssii', $from, $to, $start_from, $num_per_page);
            } else if($dropdown_service == '' && $from == '' && $to == ''){
                $message_query = $conn->prepare("SELECT * FROM customer where is_delete = FALSE LIMIT ?, ?");
                $message_query->bind_param('ii',$start_from, $num_per_page);
            }else{
                echo "nhi h hor";
            }
            if(isset($message_query)){
            if($message_query->execute()){
            $result=$message_query->get_result();
            $i=1;
                while($row =$result -> fetch_assoc()){
                    $ser_id=$row['service_id'];
                    ?>
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
                    <td><?= $rw['service_name']?></td>
<?php
                }
        ?>
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
        <div class="paging">
        <?php
         if(isset($total)){
        if ($page> 1) {?>
            <a class="filter-page-link" href="dashboard.php?page=<?=($page - 1) ?>">Prev</a>
            <?php }?><?php
            $total_pages=ceil($total/$num_per_page);
            for($i=1; $i<=$total_pages;$i++){
                if($i==$page){
                    $active="pageactive";
                } else {
                   $active="";
                }?>
            <a class="<?=$active ?> filter-page-link" href="dashboard.php?page=<?=$i ?>"><?=$i ?></a><?php      
                }
            ?><?php if ($total_pages > $page) {?>
            <a class="filter-page-link" href="dashboard.php?page=<?=($page + 1) ?>">Next</a><?php
            }
        }
        
       
     ?>
        </div>
    </div>
    