<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mumbai Indians</title>
    <style>
        /* .background */
        body {
            margin: 0;
            /* font-family: Arial, sans-serif; */
        }
        .background {
            width: 100%;
            height: 600px;
            position: relative;
            color: #fff;
            background: url(./images/mi.jpg) no-repeat center center/cover;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 100px;
        }
        .background::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: linear-gradient(#083f88, #001848);
            opacity: 0;
            z-index: 1;
            transition: opacity 0.5s ease-in-out;
        }
        .background:hover::after {
            opacity: 0.7;
        }
        .background h1 {
            position: relative;
            z-index: 2; 
            font-size: 60px;
            opacity: 0;
        }
        .background:hover h1 {
            display: block;
            opacity: 1;
            transition: opacity 1s ease-in-out;
        }

        /* players */
        .players{
            width: 100%;
            
        }
        .player{
            float: left;
            width: 25%;
        }
        .player img{
            width: 100%;
        }
        h3{
            font-size: 12px;
            text-align: center;
        }
        p{
            text-align: center;
            font-size: 12px;
        }
        .player{
            position: relative;
        }
        .player::after{
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: linear-gradient(#083f88, #001848);
            opacity: 0;
            z-index: 1;
            transition: opacity 0.5s ease-in-out;
        }
        .player:hover::after {
            opacity: 0.7;
        }
        .player h1 {
            position: absolute;
            z-index: 2; 
            font-size: 30px;
            /* opacity: 0; */
            color: white;
            text-align: center;
            display: none;
            top: 180px;
            left: 90px;
        }
        .player:hover h1 {
            display: block;
            opacity: 1;
            transition: opacity 1s ease-in-out;
        }


        /* responsive */

        @media (max-width: 1920px) {
            .player{
            float: left;
            width: 14.28%;
        }
        }
        @media (max-width: 1600px) {
            .player{
            float: left;
            width: 16.6%;
        }
        }
        @media  (max-width: 1366px) {
            .player{
            float: left;
            width: 20%;
        }
        }
        @media  (max-width: 1299px) {
            .player{
            float: left;
            width: 25%;
        }
        }@media  (max-width: 991px) {
            .player{
            float: left;
            width: 33.33%;
        }
        }
        @media  (max-width: 767px) {
            .player{
            float: left;
            width: 50%;
        }
        }
        @media  (max-width: 576px) {
            .player{
            float: left;
            width: 100%;
        }
        }

    </style>
</head>
<body>
    <div class="background">
        <h1>Mumbai Indians</h1>
    </div>
    <div class="players">
        <div class="player">
            <img src="./images/hardik.png" alt="">
            <h1>Mumbai Indians</h1>
            <h3>HARDIK PANDYA</h3>
            <p>Batter</p>
        </div>
        <div class="player">
            <img src="./images/rohit.webp" alt="">
            <h1>Mumbai Indians</h1>
            <h3>ROHIT SHARMA</h3>
            <p>Batter</p>
        </div>
        <div class="player">
            <img src="./images/aakash.png" alt="">
            <h1>Mumbai Indians</h1>
            <h3>AKASH MADHWAL</h3>
            <p>Batter</p>
        </div>
        <div class="player">
            <img src="./images/dewald.png" alt="">
            <h1>Mumbai Indians</h1>
            <h3>DEWALD BREWIS</h3>
            <p>Batter</p>
        </div>
        <div class="player">
            <img src="./images/hardik.png" alt="">
            <h1>Mumbai Indians</h1>
            <h3>ARJUN TENDULKAR</h3>
            <p>Batter</p>
        </div>
        <div class="player">
            <img src="./images/rohit.webp" alt="">
            <h1>Mumbai Indians</h1>
            <h3>ANSHUL KAMBHOJ</h3>
            <p>Batter</p>
        </div>
        <div class="player">
            <img src="./images/aakash.png" alt="">
            <h1>Mumbai Indians</h1>
            <h3>GERALD COETZEE</h3>
            <p>Batter</p>
        </div>
        <div class="player">
            <img src="./images/dewald.png" alt="">
            <h1>Mumbai Indians</h1>
            <h3>ISHAN KISHAN</h3>
            <p>Batter</p>
        </div>
    
        <div class="player">
            <img src="./images/hardik.png" alt="">
            <h1>Mumbai Indians</h1>
            <h3>JASPRIT BUMRAH</h3>
            <p>Batter</p>
        </div>
        <div class="player">
            <img src="./images/rohit.webp" alt="">
            <h1>Mumbai Indians</h1>
            <h3>NAMAN DHIR</h3>
            <p>Batter</p>
        </div>
        <div class="player">
            <img src="./images/aakash.png" alt="">
            <h1>Mumbai Indians</h1>
            <h3>PIYUSH CHAWLA</h3>
            <p>Batter</p>
        </div>
    </div>
</body>
</html>
