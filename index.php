<?php
require (__DIR__ . '/formValidation.php');
require (__DIR__ . '/calender.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/main.css">
    <link rel="stylesheet" type="text/css" href="style/header.css">
    <link rel="icon" href="images/tree.png">

    <title>Albero</title>
</head>

<body>
    <header>
        <section class="header-text">
            <h1> Tree Hotel</h1>
            <p> Alberos finest place to stay</p>
        </section>
    </header>
    <main>
        <!-- Budget room -->
        <section class="room-section">
            <section class="room-one">
                <img src="images/treehousebad.jpeg" alt="cheap tree house, just some planks in a tree">
                <p class="price">Budget 1€</p>
                <?php echo $cheapskateCalendar->draw(date('Y-m-d')); ?>
            </section>
            <!-- Standard room-->
            <section class="room-two">
                <p class="price-two">Standard 2€</p>
                <?php echo $budgetCalendar->draw(date('Y-m-d')); ?>
                <img src="images/treehousebudget.jpeg" alt="budget tree house for the hotel">
            </section>
            <!-- Luxury room-->
            <section class="room-three">
                <p class="price">Luxury 3€</p>
                <img src="images/treehouselux1.jpeg" alt="luxury tree house for the hotel">
                <?php echo $luxuryCalendar->draw(date('Y-m-d')); ?>
            </section>
            <!-- Form -->
            <form method="POST" class="form" action="index.php">
                <h3>Select what room you want:</h2>
                    <select name="rooms" id="rooms" class="form-input">
                        <option value="1">Budget</option>
                        <option value="2">Standard</option>
                        <option value="3">Luxury</option>
                        <section class="calander">
                    </select><br>
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
                    <input type="submit" value="submit" class="button">
                    <br><br><br>
            </form>
            <!-- Getting the receipt -->
            <div class="json-receipt">
                <?php echo validateForm(); ?>
            </div>
        </section>

    </main>
    <script src="script.js"></script>


</body>










</html>
