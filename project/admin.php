<?php
$message = '';
$page = isset($_GET['page']) ? $_GET['page'] : 'login';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $page === 'login') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $admin_username = 'admin';
    $admin_password = 'admin123';

    if ($username === $admin_username && password_verify($password, password_hash($admin_password, PASSWORD_DEFAULT))) {
        header('Location: admin_dashboard.php');
        exit;
    } else {
        $message = 'Username sau parola incorectă!';
    }
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logare Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        h2 {
            text-align: center;
        }
        label {
            font-size: 1.1em;
            margin-bottom: 5px;
            display: block;
        }
        input[type="text"], input[type="password"] {
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
        .message {
            text-align: center;
            color: #d9534f;
            font-size: 1em;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Logare Admin</h2>
        <?php if (!empty($message)): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
        <form action="?page=login" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required autocomplete="off">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required autocomplete="off">
            <input type="submit" value="Log In">
        </form>
    </div>
</body>
</html>
