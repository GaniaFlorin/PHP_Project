<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: admin.php?page=login');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            margin: 50px auto;
        }
        h2 {
            text-align: center;
        }
        .admin-only-message {
            text-align: center;
            font-size: 1.5em;
            color: #5cb85c;
        }
        label {
            font-size: 1.1em;
            margin-bottom: 5px;
            display: block;
        }
        input[type="text"], input[type="date"], input[type="time"], input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #5cb85c;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 1.1em;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
        .logout {
            margin-top: 20px;
            text-align: center;
        }
        .logout a {
            text-decoration: none;
            color: #d9534f;
            font-size: 1.1em;
        }
        .logout a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Dashboard</h2>
        <p class="admin-only-message">Acesta este un formular pentru admin!</p>

        <form action=index.php" method="post">
            <label for="nume">Nume:</label>
            <input type="text" id="nume" name="nume" required>

            <label for="data">Data programării:</label>
            <input type="date" id="data" name="data" required>

            <label for="ora">Ora programării:</label>
            <input type="time" id="ora" name="ora" required>

            <label for="locatie">Locație:</label>
            <input type="text" id="locatie" name="locatie" required>

            <input type="submit" value="Salvează programarea">
        </form>

        <div class="logout">
            <a href="logout.php">Deconectează-te</a>
        </div>
    </div>
</body>
</html>
