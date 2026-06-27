<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: qcm.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Application QCM</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            background:#f4f4f4;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
            margin:0;
        }

        .container{
            background:#fff;
            padding:40px;
            border-radius:10px;
            text-align:center;
            box-shadow:0 0 10px rgba(0,0,0,0.2);
        }

        h1{
            color:#333;
        }

        p{
            color:#666;
            margin-bottom:25px;
        }

        .btn{
            display:inline-block;
            padding:12px 25px;
            margin:10px;
            text-decoration:none;
            color:white;
            border-radius:5px;
            background:#007bff;
        }

        .btn:hover{
            background:#0056b3;
        }

        .btn2{
            background:#28a745;
        }

        .btn2:hover{
            background:#1e7e34;
        }
    </style>
</head>

<body>

<div class="container">
    <h1>Bienvenue à l'application QCM</h1>

    <p>Testez vos connaissances en répondant aux différents QCM.</p>

    <a href="../connexion.php" class="btn">Connexion</a>

    <a href="../inscription.php" class="btn btn2">Inscription</a>

</div>

</body>
</html>
