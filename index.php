<?php

require __DIR__ . '/calender.php';
require __DIR__ . '/connection-db.php';

use GuzzleHttp\Client;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" type="text/css" href="header.css">
    <link rel="icon" href="/images/tree.png">
    <title>Albero</title>
</head>

<body>
    <header>
        <section class="header-text">
            <h1> Tree Hotel</h1>
            <p> Alberos finest place to stay</p>
        </section>
        <nav>

            <a href="#">Hem</a>
            <a href="#"> Kontakt</a>
            <a href="#"> Erbjudanden </a>



        </nav>

    </header>
    <main>
        <section class="room-section">
            <section class="room-one">
                <h2>Cheapskate</h2>
                <img src="/images/treehousebad.jpeg" width="500px" alt="cheap tree house, just some planks in a tree">
                <p> Heres a room for the one with not as much cash in their pockets, who still wants to enjoy a
                    night or more in the tree-tops. You get acces to a roof, walls, floor and even a window! Theres
                    no room to lie down but we have made sure there is a nice and comfy pillow for you to sit on!

                    How do I get up you there you might think? You just climb. </p>



            </section>
            <?php echo $calendar->draw(date('2023-01-01')); ?>
            <section class="room-two">
                <h2> Budget-queen</h2>
                <img src="/images/treehousebudget.jpeg">
                <p>Wanna get some comfort and a nice bed to sleep in? Our budget room is for you!</p>

            </section>


            <section class="room-three">
                <h2>Luxury</h2>
                <img src="/images/treehouselux1.jpeg">
                <p>You got some cash and you aint afraid to spend it! Our luxury option gives you more space then you
                    probably need. </p>
            </section>
            <section class="calander">


                <!--
                <form method="POST" action="/index.php">
                    <h3>Select what room you want:</h2>
                        <select name="rooms" id="rooms" class="form-input">
                            <option value="1">Cheapskate</option>
                            <option value="2">Budget-queen</option>
                            <option value="3">Luxury</option>

                        </select> <br><br>
                        <label for="fName">First name:</label>
                        <input type="text" id="fName" name="fName" class="form-input">
                        <label for="lName">Last name:</label>
                        <input type="text" id="lName" name="lName" class="form-input">
                        <label for="transferCode"> Transfer Code:</label>
                        <input type="text" id="transferCode" name="transferCode">
                        <label for="dateArraving">Date of arrival:</label>
                        <input type="date" id="dateArraving" name="dateArraving" class="form-input" max="2023-01-31"
                            min="2023-01-01">
                        <label for="dateLeaving">Date of departure:</label>
                        <input type="date" id="dateLeaving" name="dateLeaving" class="form-input" max="2023-01-31"
                            min="2023-01-01">
                        <input type="submit" value="submit">



                </form>
            </section> -->
    </main>
    <footer>
    </footer>
</body>




















































</html>
