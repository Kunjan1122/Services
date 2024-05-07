<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="website.css">
</head>
<?php
include 'connection.php';
$nameErr= "";
$phone_number_Err="";
$email_Err="";

$form_submit = false;
$isFormValid = true;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name=$_POST['name'];
    $phone_number=$_POST['phone_number'];
    $email=$_POST['email'];
    $comment=$_POST['comment'];

    if(empty($name)){
        $nameErr="Name is required";
        $isFormValid = false;
    }
    else{
        if(!preg_match("/^[a-zA-Z ]+$/",$name)){
            $nameErr="<br/>name should contain only character and space";
            $isFormValid = false;
        }
    }
    
    if(empty($phone_number)){
        $phone_number_Err="Phone number is required";
        $isFormValid = false;
    }else{
        if(!preg_match("/^[0-9]{10}+$/",$phone_number)){
            $phone_number_Err="<br/>invalid phone number";
            $isFormValid = false;
        }
    }
    
    if(empty($email)){
        $email_Err="Email is required";
        $isFormValid = false;
    }
    else{
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $isFormValid = false;
          }
        }

        if($isFormValid){
            if($conn->connect_error) {
                die('Connection Failed: '.$conn->connect_error);
            }else{
                $insert=$conn->prepare('insert into xportsoft(fullname,email,phone_number,comment) values (?,?,?,?)');
                $insert->bind_param('ssss',$name,$email,$phone_number,$comment);
                if($insert->execute()){
                    echo "yeyyyy";?>
                    <script>
                        if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                    }
                    </script>
                    <?php
                }
                else{
                    echo "oopss";
                }
                $insert->close();
                $form_submit = true;
            }
        }
}
?>
<?php
if($form_submit) {
?>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
    text: "We will contact you shortly!",
    title: "Thank you!",
    icon: "success"
});
</script>
<?php
}
?>
<style>
    .right_divs p{
    color: #1b4a63;
    font-size: 18px;
    font-weight: 400;
    line-height: 1.5;
    text-align: left;
}
.request{
    width: 100%;
    float: left;
    background: #e3f1fc;
}
.request_container{
    width: 100%;
    float: left;
    margin: auto;
    padding: 40px 0;
}
.req_one{
    width:75%;
    float: left;
}
.req_one p{
    font-size: 32px;
  font-weight: 700;
  color: #18408c;
  margin: 0 90px 0 0;
  line-height: 40px;
}
.req_two{
    width: 25%;
    float: left;
    
}
.color-blue-1{
    color: #46c0ec;
}
.req_two p{
    background-color: #002379 ;
    color:  white;
    padding: 15px 10px;
    text-align: center;
    transition:  0.5s ease-out; 
    background: linear-gradient(to right, #002379 50%, #cd0001 50%);
    background-size: 200% 100%;
}
.req_two p:hover{
    background-position: -100% 0;
}
.req_two a{
    color: #fff;
  text-decoration: none;
  font-size: 16px;
}
.req_two i{
    font-size: 16px;
  position: relative;
  top: 2px;
}


/* pop up  */
       
#popupOverlay { 
            display: none; 
            position: fixed; 
            top: 0; 
            left: 0; 
            width: 100%; 
            z-index: 12;
            height: 100%; 
            background: rgba(0, 0, 0, 0.6); 
            transition: opacity 0.3s ease; 
        } 
        .popup-box {
            width: 30%;
            position: fixed; 
            z-index: 15;
            margin-top: 40px;
            left: 530px;
            background:#002379;
        }
        .title{
            position: relative;
        }
        .title i{
            position: absolute;
            color: white;
            background-color: #002379;
            right: 0;
            font-size: 20px;
            top: 0;
        }
        .pop_form_container{
            width: 90%;
           margin: auto;
            text-align: center;
        }
        .pop_form_container form{
            margin-top: 50px;
            margin-bottom: 30px;
        }
.pop_form_container h4{
  
    color: #46c0ec;
    font-weight: bold;
    font-size: 18px;
    margin-top: -15px;
}
.pop_form_container h3{
    color: white;
    font-weight: bold;
    font-size: 18px;
    margin-top: -15px;
}
.pop_form_container title{
    margin-top: 50px;
}
.pop_form_container button{
    margin-top: 25px;
    margin-bottom: 40px;
    background-color: #46c0ec;
    color: white;
    padding: 10px 20px;
    font-size: 16px;
    border: none;
}
.pop_form_container input{
    margin-top: 10px;
    width: 75%;
    padding: 20px;
}
.pop_form_container textarea{
    margin-top: 10px;
    width: 75%;
    padding: 20px;
}

    .body{
        z-index: 50;
        color: black;
    }
   
</style>


   
<body>
    <header class="logobar">
        <div class="container">
            <div class="row">
                <div class="col_1">
                    <a href=""><img src="https://xportsoft.com/assets/img/logo-footer.png" alt=""></a>
                </div>
                <div class="col_2">
                    <div class="span">
                        <div class="sub">
                            <i class="fa-solid fa-envelope"></i></div>
                        <h4>Drop a line <br> services@xportsoft.com </h4>
                    </div>
                    <div class="span">
                        <div class="sub">
                            <i class="fa-solid fa-headphones"></i></div>
                            <h4>Drop a line <br> services@xportsoft.com </h4>
                    </div>
                    <div class="span" id="btn" onclick="openPopup()" >
                        <button id="myBtn">Request A Quote</button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="banner_content">
        <div class="container">
            <div class="heading">
                <h1 id="heading_one">CRAFTING END-TO-END</h1>
                <h1 id="heading_two">#eCommerceForYou</h1>
            </div>
            <div class="heading">
                <h1 id="heading_three">WE DEVELOP, YOU SELL; LET ‘VISITORS’ HAPPILY BUY! </h1>
            </div>
        </div>
    </div>

    <!-- banner -->
    <div class="banner">
        <div class="container">
            <div class="image">
                <img src="https://xportsoft.com/custom-ecommerce-development-service/images/banner_img.svg" alt="">
            </div>
            <div class="form">
                <div class="form_container">
                    <div class="title">
                    <h3>Make Smart Sales with</h3>
                    <h4>Smarter eCommerce Solution!</h4>
                    </div>
                    <form id="form" action="" method="post">
                        <input maxlength="30" type="text" name="name"  placeholder="Full Name"><br>
                        <span style="color:red" ><?php echo $nameErr ?></span><br>

                        <input  maxlength="50" type="text" name="email" placeholder="Email"><br>
                        <span style="color:red" ><?php echo $email_Err ?></span><br>

                        <input  maxlength="10" type="text" name="phone_number" placeholder="Phone Number"><br>
                        <span style="color:red" ><?php echo $phone_number_Err ?></span><br>

                        <textarea  maxlength="100" name="comment" id="" cols="30" rows="3" placeholder="Comment"></textarea><br>
                        <button name="submit-btn" type="submit" >Get A Quote</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- #! section -->

    <div class="last">
        <div class="container">
        <div class="lines">
            <h1>#1 eCommerce Development Company in UK</h1>
            <h2>Custom eCommerce Solution, #BuiltForYou</h2>
        </div>
        <div class="checks">
            <div class="one">
                <div><i class="fa-solid fa-square-check"></i>Customisation and Branding</div>
                <div><i class="fa-solid fa-square-check"></i>Robust Security</div>
                <div><i class="fa-solid fa-square-check"></i>Scalable and User-Friendly</div>
                <div><i class="fa-solid fa-square-check"></i>Powered by MERN Stack Technology</div>
                <div><i class="fa-solid fa-square-check"></i>Diverse Payment Methods</div>
                <div><i class="fa-solid fa-square-check"></i>Endless Integration Capabilities</div>
                <div><i class="fa-solid fa-square-check"></i>End-to-End Support</div>
            </div>  
        </div>      
        <div class="down">
            <div class="start">
                <h3><a href="">Start Your eCommerce Journey Risk Free!</a></h3>
            </div>
            <div class="contact" onclick="openPopup()" >
                <h3><i class="fa-solid fa-cart-shopping"></i>Contact Now</h3>
            </div>
        </div>
        </div>
    </div>

    <!-- skilled in  -->

    <div class="skills">
        <div class="contain">
            <div class="skill_content">
                <h1>As a Top Custom <span class="color_red">eCommerce Solution Provider </span> </h1>
                <p>We’re skilled in</p>
                <div class="devide">
                    <div class="first">
                        <div class="left_divs">
                            <h4>Customising Your Unique Needs </h4>
                            <p>Your business is one-of-a-kind, and so is our approach to
                                eCommerce. We suss out your needs, industry quirks, and target
                                 audience to craft a bespoke MERN Stack-powered eCommerce platform that 
                                captures your brand and caters to your customers' tastes.</p>
                        </div>
                        <div class="left_divs">
                            <h4>Customising Your Unique Needs </h4>
                            <p>Your business is one-of-a-kind, and so is our approach to
                                eCommerce. We suss out your needs, industry quirks, and target
                                 audience to craft a bespoke MERN Stack-powered eCommerce platform that 
                                captures your brand and caters to your customers' tastes.</p>
                        </div>
                        <div class="left_divs">
                            <h4>Supporting Seamless Integrations </h4>
                            <p>Efficiency is key in eCommerce. Our custom
                                 eCommerce solution seamlessly integrates with
                                  your existing tools, from inventory management 
                                  to payment gateways. Hence, you can say goodbye to
                                   manual data entry and hello to efficiency.</p>
                        </div>
                        <div class="left_divs">
                            <h4>MERN Stack Technology </h4>
                            <p>Experience modern, efficient, and scalable
                                 eCommerce with our MERN stack-powered solution.
                                  We’ll bloom your e-store with all essentials,
                                   including MongoDB – Known for flexibility, 
                                   Express.js – simplifying things, React – creating stunning UI 
                                   options, and Node.js – needs no explanation!</p>
                        </div>
                    </div>
                       

                    <div class="second">
                    <img class="middle-img" src="https://xportsoft.com/custom-ecommerce-development-service/images/Group-579078.png" alt="">
                    </div>


                    <div class="third">
                        <div class="right_divs">
                            <h4>Facilitating SEO Excellence  </h4>
                            <p>With the amalgamation of various tools 
                                and SEO strategies, our eCommerce solution makes it possible
                                 for you to scale and expand the reach and potential of your business, 
                                 from a simple web solution to a sophisticated eCommerce portal.</p>
                        </div>
                        <div class="right_divs">
                            <h4>Low Maintenance Costs </h4>
                            <p>We value cost-effectiveness in addition to all of our extensive
                                 eCommerce offerings. Because of the low maintenance expenses of 
                                 our custom eCommerce solution, you can run your eCommerce business
                                  profitably and without breaking the bank.</p>
                        </div>
                        <div class="right_divs">
                            <h4>Mobile-friendly Interface </h4>
                            <p>Our eCommerce solution's mobile adaptability lets customers 
                                shop hassle-free. This means that potential customers may browse
                                 your online store and make purchases here, there, and everywhere – no
                                  matter whether they're at home or on the move.</p>
                        </div>
                        <div class="right_divs">
                            <h4>Finally, Helping You Grow</h4>
                            <p>Your growth is the driving force behind our unique custom
                                 eCommerce solution. We architect your success rather than merely
                                  creating websites. With our specialised strategy, you can confidently 
                                  grow your business since you know that your online store is prepared for the road ahead.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Request -->

    <section class="request">
        <div class="container">
            <div class="request_container">
                <div class="req_one">
                    <p>Get Your Full-fledged eCommerce Website Ready, Just <span class="color-blue-1">in 2 WEEKS!</span></p>
                </div>
                <div class="req_two">
                    <p onclick="openPopup()">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    Request a Call Back Now 
                    </p>
                </div>
            </div>
        </div>
    </section>

    <div id="popupOverlay">
    <div class="popup-box"> 
        <div class="pop_form_container">
        <div class="title">
        <i class="fa-sharp fa-solid fa-xmark"  onclick="closedform()"></i>

        <h3>Make Smart Sales with</h3>
        <h4>Smarter eCommerce Solution!</h4>
        <h3>Get Started Today!</h3>
        </div>
    </div>
    <hr style="color:white">
    <div class="pop_form_container">
        <form action="">
            <input maxlength="30" type="text" placeholder="Full Name"><br>
            <input  maxlength="30" type="text" placeholder="Email"><br>
            <input  maxlength="10" type="text" placeholder="Phone Number"><br>
            <textarea name="" id="" cols="30" rows="3" placeholder="Comment"></textarea><br>
            <button>Get A Quote</button>
        </form>
        </div>
    </div>
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script type="text/javascript">
    window.onload= ()=>{
        modal.style.display="none";
    }
var modal = document.getElementById("popupOverlay");
function openPopup(){
    modal.style.display = "block";
    modal.style.background = rgba(0,0,0,0.5);
}
function closedform() {
    modal.style.display = "none";  
}


$(document).ready(function(){
    $('#form').validate({
        rules:{
            name:{
                required:true,
                maxlength:20
            },
            email:{
                required:true,
                email:true,
                maxlength:50
            },
            phone_number:{
                required:true,
                digits: true,
                maxlength:10,
                minlength:10
            },
            comment:{
                required:true,
                maxlength:100
            }
        } 
    }); 
});

</script>
</body>
</html>