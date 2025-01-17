<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programare la doctor</title>
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
            flex-direction: column;
        }


        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }


        h2 {
            text-align: center;
            color: #5cb85c;
        }


        label {
            font-size: 1.1em;
            margin-bottom: 5px;
            display: block;
        }


        input[type="text"],
        input[type="date"],
        input[type="time"] {
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


        .img-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .pop-up-message {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #5cb85c;
            color: white;
            padding: 15px 25px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-size: 1.1em;
            display: none;
            animation: slide-in 0.5s ease-in-out forwards;
        }

        .pop-up-message.error {
            background-color: #d9534f;
        }

        @keyframes slide-in {
            from {
                right: -300px;
                opacity: 0;
            }
            to {
                right: 20px;
                opacity: 1;
            }
        }

        .pop-up-message.show {
            display: block;
        }
    </style>
</head>
<body>
    <div class="img-container">
        <img src="images/A_simple_and_clean_web_design_for_a_doctor's_appoi.png" alt="Design formular programare" width="80%">
    </div>

    <div class="container">
        <h2>Formular de programare la doctor</h2>
        <form action="index.php" method="post" autocomplete="off">
            <label for="nume">Nume:</label><br>
            <input type="text" id="nume" name="nume" autocomplete="off" required><br><br>

            <label for="data">Data programării:</label><br>
            <input type="date" id="data" name="data" required><br><br>

            <label for="ora">Ora programării:</label><br>
            <input type="time" id="ora" name="ora" required><br><br>

            <input type="submit" value="Salvează programarea">
        </form>
    </div>


    <?php
$filename = 'programari.txt';
$fwrite = " programat\n";

if (is_writable($filename)) {

    if (!$fp = fopen($filename, 'a')) {
        echo "Nu mai avem programari ($filename)";
        exit;
    }

    if (fwrite($fp, $somecontent) === FALSE) {
        echo "Nu am putut face programari ($filename)";
        exit;
    }

    echo "Multumim, ai ($somecontent) pe ($filename)";

    fclose($fp);

} else {
    echo "The file $filename is not writable";
}
?>
    
    <script>
        setTimeout(function() {
            document.getElementById('pop-up-message').classList.remove('show');
        }, 5000);
    </script>
</body>
</html>
