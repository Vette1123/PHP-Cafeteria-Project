<?php 

session_start();

if (!isset($_SESSION['name'])) {
    header("Location: sign in.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <?php echo "<h1>Welcome from user page</h1>"; ?>
    <a href="logout.php">logout</a>
    
</body>
</html>