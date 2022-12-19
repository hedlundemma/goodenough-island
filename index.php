<?php

require __DIR__ . '/calender.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <link rel="icon" href="/images/tree.png">
    <title>Albero</title>
</head>

<body>
    <header>
    </header>
    <main>
        <section class="calander">
            <?php echo $calendar->draw(date('2023-01-01')) ?>

            <form method="POST" action="">
                <label for="name">Full name:</label>
                <input type="text" name="name" class="form">
                <label for="arriving">Date of arrival:</label>
                <input type="date" name="arriving" class="form" min="2023-01-01" max="2023-01-31">
                <label for="leaving">Date of departure:</label>
                <input type="date" name="leaving" class="form" min="2023-01-01" max="2023-01-31">

            </form>
        </section>
    </main>
    <footer>
    </footer>
</body>

</html>
