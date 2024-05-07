<style>
    .footer_logo{
     width: 100%;
    /* text-align: center;  */
}
.footer_logo img{
    width: 70px;
    text-align: left;
}
.footer_things{
    display: flex;
    flex-wrap: wrap;
    gap: 33px;
    /* text-align: center; */
    margin: auto;
    justify-content: center;
    /* color: white; */
}
.t{
    width: 200px;
    padding: 20px 50px;
    /* border: 1px solid white; */
  
}
.t h2{
    margin-bottom: 40px;
    margin-top: 20px;
}

footer{
    padding: 20px;
    color:  white;
    background-color: rgb(105, 104, 104);
    /* margin-left: -1px; */
  /* margin-bottom: -1px; */
  width: 100%;
}
.t a{
    font-size: 15px;
    text-decoration: none;
    color: white;
    position: relative;
    display: inline-block;
}
.t a::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: 0;
    left: 0%;
    background: white;
    transition: width 1.5s ease-out, left 1.5s ease-out;
}

.t a:hover::after {
    width: 100%;
    left: 0;
}
.fa-phone{
    display: inline-block;
    margin-right: 5px;
    margin-top: -12px;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<footer>
    <div class="container">
        <div class="footer_things">
        <div class="t" >
            <div class="footer_logo">
                <img src="./images/logo.png" alt="">
            </div>
            <p style="text-align: left; font-size: 15px;">L
            Ready to make your Dubai escape unforgettable? Dive into luxury
            and comfort with Aya Boutique. We’re not just about places to stay; 
            we’re about crafting moments that make your getaway special. 
            Drive yourself to the 
            ultimate relaxation zone and curate experiences that last!
            </p>
        </div>
        <div class="t">
            <h2 style="text-align:left">Useful Links</h2>
                <a href="about.php">About Us</a><br>
                <a  href="about.php">Contact Us</a><br>
                <a>Careers</a><br>
                <a>Preferred Partner</a><br>
                <a>Frequently Asked Questions</a><br>
                <a>Privacy Policy</a><br>
                <a>Term & Condition</a>
        </div>
        <div class="t">
            <h2>Address</h2>
            <p style="text-align:left; font-size: 15px;">Downtown, Dubai</p>
            <a href="https://maps.app.goo.gl/ueoAeVzoX3QwuQzRA" target="_blank" style="text-decoration:none; color:white; font-size: 15px;" href="">View Map</a>
        </div>
        <div class="t  social_media">
            <h2>Contact Us</h2>
            <i class="fa-solid fa-phone"></i>
            <p style="margin-top: -12px;displaytext-align:right; display: inline-block;font-size: 15px;">+971 565 086 244</p>
        </div>
        </div>

<hr style="color:white">
<p style="text-align:center; font-size: 15px;">Copyright 2024 Aya Holding Group. All Rights Reserved.</p>
</div>
</footer>
</body>
</html>