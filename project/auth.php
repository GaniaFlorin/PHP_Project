<?php
// Variabile pentru mesaje
$message = '';
$page = isset($_GET['page']) ? $_GET['page'] : 'login';

// Procesare pentru Sign In
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $page === 'register') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $file = 'users.txt';
    $user_data = "$username:$hashed_password\n";

    if (file_exists($file)) {
        $existing_users = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($existing_users as $user) {
            list($existing_username) = explode(':', $user);
            if ($existing_username === $username) {
                $message = 'Acest username este deja folosit.';
                break;
            }
        }
    }

    if (empty($message)) {
        file_put_contents($file, $user_data, FILE_APPEND);
        $message = 'Cont creat cu succes! Te poți autentifica.';
        $page = 'login';
    }
}

// Procesare pentru Log In
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $page === 'login') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $file = 'users.txt';

    if (file_exists($file)) {
        $users = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($users as $user) {
            list($existing_username, $hashed_password) = explode(':', $user);
            if ($existing_username === $username && password_verify($password, $hashed_password)) {
                // Verifică dacă este admin
                if ($existing_username === 'admin') {
                    // Redirecționează adminul către pagina de admin
                    header('Location: admin_dashboard.php');
                    exit;
                } else {
                    // Redirecționează utilizatorul normal către index.php
                    header('Location: index.php');
                    exit;
                }
            }
        }
        $message = 'Username sau parola incorectă!';
    } else {
        $message = 'Nu există utilizatori înregistrați. Înregistrează-te mai întâi!';
    }
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page === 'register' ? 'Sign In' : 'Log In'; ?></title>
    <style>
        /* Stiluri generale pentru Light/Dark Mode */
        body {
            font-family: Arial, sans-serif;
            background-color: var(--bg-color, #f4f4f4);
            color: var(--text-color, #333);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: var(--container-bg, #fff);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        h2 {
            text-align: center;
            color: var(--primary-color, #5cb85c);
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
            background-color: var(--primary-color, #5cb85c);
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 1.1em;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: var(--primary-hover-color, #4cae4c);
        }
        .message {
            text-align: center;
            color: #d9534f;
            font-size: 1em;
            margin-bottom: 15px;
        }
        .switch {
            text-align: center;
            margin-top: 10px;
        }
        .switch a {
            color: var(--primary-color, #5cb85c);
            text-decoration: none;
        }
        .switch a:hover {
            text-decoration: underline;
        }

        .toggle-container {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .toggle-button {
            background-color: var(--primary-color, #5cb85c);
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }
        .toggle-button:hover {
            background-color: var(--primary-hover-color, #4cae4c);
        }

        body.dark {
            --bg-color: #121212;
            --text-color: #ffffff;
            --container-bg: #1e1e1e;
            --primary-color: #bb86fc;
            --primary-hover-color: #9a67ea;
        }
    </style>
</head>
<body>
    <div class="toggle-container">
        <button class="toggle-button" onclick="toggleDarkMode()">Switch Mode</button>
    </div>
    <div class="container">
        <?php if ($page === 'register'): ?>
            <h2>Sign In</h2>
            <?php if (!empty($message)): ?>
                <p class="message"><?php echo $message; ?></p>
            <?php endif; ?>
            <form action="?page=register" method="post" autocomplete="off">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required autocomplete="off">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required autocomplete="off">
                <input type="submit" value="Sign In">
            </form>
            <p class="switch">Ai deja un cont? <a href="?page=login">Log In</a></p>
        <?php else: ?>
            <h2>Log In</h2>
            <?php if (!empty($message)): ?>
                <p class="message"><?php echo $message; ?></p>
            <?php endif; ?>
            <form action="?page=login" method="post" autocomplete="off">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required autocomplete="off">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required autocomplete="off">
                <input type="submit" value="Log In">
            </form>
            <p class="switch">Nu ai un cont? <a href="?page=register">Sign In</a></p>
        <?php endif; ?>
    </div>

    <script>

        if (localStorage.getItem('darkMode') === 'enabled') {
            document.body.classList.add('dark');
        }


        function toggleDarkMode() {
            document.body.classList.toggle('dark');
            if (document.body.classList.contains('dark')) {
                localStorage.setItem('darkMode', 'enabled');
            } else {
                localStorage.setItem('darkMode', 'disabled');
            }
        }
    </script>
</body>
</html>
