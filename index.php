<?php

require __DIR__ . '/calender.php';
require __DIR__ . '/connection-db.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="icon" href="/images/tree.png">
    <title>Albero</title>
</head>

<body>
    <header>
        <nav>


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
                <h3>Select what room you want:</h2>
                    <select name="rooms" id="rooms" class="form-input">
                        <option value="1">Cheapskate</option>
                        <option value="2">Budget-queen</option>
                        <option value="3">Luxury</option>
                        <?php echo $calendar->draw(date('2023-01-01')) ?>
                    </select> <br><br>

                    <form method="POST" action="/index.php">
                        <label for="f_name">First name:</label>
                        <input type="text" id="f_name" name="f_name" class="form-input">
                        <label for="l_name">Last name:</label>
                        <input type="text" id="l_name" name="l_name" class="form-input">
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
            </section>
    </main>
    <footer>
    </footer>
</body>







































</html>