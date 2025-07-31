<?php
            // on créer une id qui sauvegarde la session ans un cookie 
            if($id_session){
                echo 'ID de session (récupéré via session_id()) : <br>'
                .$id_session. '<br>';
            }
            // 
            echo '<br><br>';
            if(isset($_COOKIE['PHPSESSID'])){
                echo 'ID de session (récupéré via $_COOKIE) : <br>'
                .$_COOKIE['PHPSESSID'];
            }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Document</title>
</head>
<body>
            <?php include "../includes/header1.php" ?>
    <main>
       <section class="formuContainer">
            
                <!-- on démarre une nouvelle session -->
                <?php session_start(); ?>
                    <!-- L'attribut action permet de définr la destination du formulaire -->
                    <!-- L'attribut method défini la méthode d'envoi des données -->
                <form action="" method="POST">
                    <label for="pseudo">Pseudo</label>
                    <input name="pseudo" id="pseudo" type="text"  placeholder="Entrer votre nom">
                 
                    <label for="sujet">Sujet</label>
                    <input id="sujet" type="text" name="sujet"  placeholder="Entrer le sujet de votre message">
                   
                    <label for="email">EMail</label>
                    <input id="email" type="email" name="email"  placeholder="Entrer votre E-Mail">

                    <label for="phone">Phone</label>
                    <input id="phone" type="phone" name="phone"  placeholder="Entrer votre Numéro de téléphone">

                    <label for="message">Message</label>
                    <textarea id="message" type="text" name="message" rows="5" cols="30" placeholder="Entrer votre message"></textarea>
            
                    <input class="subButton" type="submit" value="Envoyer">
                </form>

            <?php 
            
            // $_SESSION = [$pseudo] + [$sujet] + [$email] + [$phone] + [$message];
            // var_dump($_SESSION);
            ?>
    </main>
            <?php include "../includes/footer1.php" ?>
</body>
</html>

<?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                

                // 2 on récupère les données et avec $_SESSION on les sauvegarde
            $_SESSION["formu_data"] = [

                $pseudo = $_POST["pseudo"] ?? '',
                $sujet = $_POST["sujet"] ?? '',
                $email = $_POST["email"] ?? '',
                $phone = $_POST["phone"] ?? '',
                $message = $_POST["message"] ?? ''

            ];
            var_dump($_SESSION);

                // 3 valider les données
                $errors =[];
                if(empty($pseudo)){
                    $errors[] = "Votre Pseudo n'est pas renseigné";
                }
                if(empty($sujet)){
                    $errors[] = "Votre Sujet n'est pas renseigné";
                }
                if(empty($email)){
                    $errors[] = "Votre E-Mail n'est pas renseigné";
                }
                 if(empty($phone)){
                    $errors[] = "Votre Numéro de téléphone n'est pas renseigné";
                }
                if(empty($message)){
                    $errors[] = "Votre Message n'est pas renseigné";
                }
                             if (empty($errors)) {
                // $pseudo= trim($pseudo);
                // $pseudo= htmlspecialchars($pseudo); =

                $pseudo = htmlspecialchars(trim($pseudo));
                $sujet = htmlspecialchars(trim($sujet));
                $email = htmlspecialchars(trim($email));
                $phone = htmlspecialchars(trim($phone));
                $message = htmlspecialchars(trim($message));

                             }
                if (empty($errors)) {
                    // j'affiche le message
                    ?> <span><strong> Nous avons pris en compte votre demande avec succés </strong></span>
                    <?php

                }else{
                    // j'affiche un message d'erreur
                    foreach($errors as $error) {
                      ?>
                        <div class="error">
                            <span><?= $error ?></span>
                        </div>
                     <?php
                    }
                }
                // on ferme la session
                unset($_SESSION['formu_data']);
            }