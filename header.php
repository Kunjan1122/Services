<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
         #topbar{
            background-color: rgb(105, 104, 104);
    /* display: flex; */
    width:100%;
    position: fixed;
    /* justify-content: space-between; */
    top: 0;
    left: 0;
    z-index:9;
    /* margin: auto; */
}
.left{
    /* display:flex;    */
    /* gap:100px; */
    color: rgb(131, 124, 124);
    text-decoration: none;
    float: left;
    /* padding-left: 80px; */
}
.left img{
    width: 80px;
}
.right{
    display:flex;
    /* gap:100px; */
    color: rgb(131, 124, 124);
    text-decoration: none;
    float: right;
    padding-top: 25px;
    padding-bottom: 25px;
    /* padding-right: 40px; */
}
.right a{
    text-decoration: none;
    color: wheat;
    font-size: 17px;
    padding: 5px 10px;
    margin-right: 40px;
    background-color: rgb(105, 104, 104);
    border-radius: 3px;
    /* margin: auto; */
}

.right span{
 padding: 6px 20px;
 border-radius: 3px;
 /* display: inline-block; */
 /* width: 70px; */
}
.active {
    background-color: wheat ;
    color: rgb(49, 47, 47) ; 

}

           
    </style>
</head>
<body>
<div id="topbar">
    <div class="container">
        <span class="left">
        <img src="./images/logo.png" alt="">
        </span>
        <span class="right">
            <a  href="home.php" >
                <span id="home">Home</span>
            </a>
            <a href="about.php">
                <span id="about">About Us </span>
            </a>
            <a href="services.php">
                <span id="services">Services</span>
            </a>
            <a href="contact.php" >
                <span id="contact">Contact Us</span>
            </a>
        </span>
        </div>
    </div>


