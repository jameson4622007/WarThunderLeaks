<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="Style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> All the War Thunder Leaks </title>
    <link rel="stylesheet" href="SingUp.css">
</head>

<body>
<header>
<nav>
<div class="top-header">
        <a href="https://warthunder.com/es/">
            <img src="images\War-Thunder-Logo.png" width="300px">
        </a>
    <ul>
        <li><a href="index.php">Main</a></li>
        <li><a href="TanksLeaks.php">Tanks leaks</a></li>
        <li><a href="AirLeaks.php">Air Leaks</a></li>
        <li><a href="misc.php">other Leaks</a></li>
    </ul>
</nav>
</header>
<body>
    <div class="SingUp-container">
        <h2>Sing Up</h2>
        <form action="SingUp.php" method="POST">

            <label for="Fullname">Full name</label>
            <input type="text" id="Fullname" name="Fullname" required>

            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
            
            <label for="Gmail">Gmail</label>
            <input type="text" id="Gmail" name="Gmail" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Submit</button>
        </form>

    <h3>⬇ ¿You already have an account? ⬇</h3>
    <a href="Login.php">
        <?php echo '<button class="custom-btn">Click aquí</button>';?>
    </a>
    <br>
</div>
</main>

<footer>
    <?php include_once "includes/footer.php" ?>
</footer>

</body>
</html>