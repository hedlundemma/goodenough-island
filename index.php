<?php

require __DIR__ . '/calender.php';

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
    </header>
    <main>
        <h1> Tree Hotel wow!</h1>

        <h2>Cheapskate</h2>
        <h2> Budget-queen</h2>
        <h2>Luxury</h2>

        <section class="calander">
            <h3>Select what room you want:</h2>
                <select name="room" id="room" class="form-input">

                    <option value="1">Cheapskate</option>
                    <option value="2">Budget-queen</option>
                    <option value="3">Luxury</option>
                </select> <br><br>
                <?php echo $calendar->draw(date('2023-01-01')) ?>
                <form method="POST" action="index.php">
                    <label for="fname">First name:</label>
                    <input type="text" id="fname" name="fname" class="form-input">
                    <label for="lname">Last name:</label>
                    <input type="text" id="lname" name="lname" class="form-input">
                    <label for="transferCode"> Transfer Code:</label>
                    <input type="text" id="transferCode" name="transferCode">
                    <label for="arriving">Date of arrival:</label>
                    <input type="date" id="dateArraving" name="dateArraving" class="form-input" max="2023-01-31"
                        min="2023-01-01">
                    <label for="leaving">Date of departure:</label>
                    <input type="date" id="dateDeparture" name="dateDeparture" class="form-input" max="2023-01-31"
                        min="2023-01-01">
                    <input type="submit" value="submit">

                </form>
        </section>
    </main>
    <footer>
    </footer>
</body>









</html>