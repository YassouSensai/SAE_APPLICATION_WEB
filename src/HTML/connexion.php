<!DOCTYPE html>
<html>
<head>
    <title>Page de Connexion</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-image: linear-gradient(rgba(4, 9, 30, 0.7), rgba(4, 9, 30, 0.7)), url(images/gros-plan-main-tenant-billets-avion.jpg);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgb(130, 183, 196);
            padding: 20px;
            width: 300px;
            text-align: center;
            display: inline-block; /* Afficher en ligne côte à côte */
            margin-right: 20px; /* Ajout de la marge entre les conteneurs */
        }
        h2 {
            color: #333;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #16a0b6;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #16a0b6;
        }
        .form-group {
            margin: 10px 0;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Connexion</h2>
    <form method="post" action="action1.php">
        <div class="form-group">
            <input type="text" name="pseudo" placeholder="Pseudo" required>
        </div>
        <div class="form-group">
            <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
        </div>
        <div class="form-group">
            <input type="submit" value="Se connecter">
        </div>
    </form>
</div>

<div class="container">
    <h2>Inscription</h2>
    <form method="post" action="action2.php">
        <div class="form-group">
            <input type="text" name="nouveau_pseudo" placeholder="Nouveau Pseudo" required>
        </div>
        <div class="form-group">
            <input type="password" name="nouveau_mot_de_passe" placeholder="Nouveau Mot de passe" required>
        </div>
        <div class="form-group">
            <input type="submit" value="S'inscrire">
        </div>
    </form>
</div>
</body>
</html>
<?php
if (isset($_GET['message'])){
    echo "<p>Nouveau utilisateur crée avec succès</p>";
}
