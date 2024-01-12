<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/css_site_statique.css">
    <style>
        body, h1, p, img {
            margin: 0;
            padding: 0;
        }

        .header {
            margin: 5em;
            text-align: center;
            color: white;
        }

        .wrap {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top : 8em;
            margin-bottom : 8em;
        }

        .member {
            background-color: transparent;
            border: 3px solid #ffcdb2;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 25px; /* Ajustement de l'espace entre les membres */
        }

        .member img {
            width: 100%;
            border-radius: 50%;
            max-width: 150px;
            border: 2px solid #ffcdb2;
        }

        .member-info p {
            margin: 10px 0;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

    </style>
    <title>Mentions Légales</title>
    <meta charset="UTF-8">
    <meta name="description" content="La page contact a pour but de présenter tout les membres de la SAE">
    <meta name="keywords" content="mails photos et numéros présentations">
    <meta name="author" content="TYMCHYSHYN Ostap, Elkhalki Yassine, Husleag Aaron">
</head>
<body>
<?php include('../HTML/entete_general.html'); ?>
<div class="header">
    <h1>Membres de la SAE</h1>
</div>
<div class="wrap">
    <div class="member">
        <img src="../images/image_ostap.jpeg" alt="Membre 1">
        <div class="member-info">
            <p>TYMCHYSHYN Ostap</p>
            <p>Email: ostap.tymchyshyn.92@gmail.com</p>
        </div>
    </div>
    <div class="member">
        <img src="../images/image_yassine.jpg" alt="Membre 2">
        <div class="member-info">
            <p>ELKHALKI Yassine</p>
            <p>Email: yassine.elkhalki@outlook.fr</p>
        </div>
    </div>
    <div class="member">
        <img src="../images/image_aaron.png" alt="Membre 3">
        <div class="member-info">
            <p>HUSLEAG Aaron</p>
            <p>Email: aaron.husleag.pv@gmail.com</p>
        </div>
    </div>
</div>
<?php include('../HTML/pied.html'); ?>
<?php include('../HTML/pied_lien.html'); ?>
</body>
</html>
