<?php
    header("Cache-Control: no-cache, must-revalidate");
    header('Content-Type: text/html;charset=utf-8');

    // CONDITIONS PRENOM
    if ( (isset($_POST["contact_name"])) && (strlen(trim($_POST["contact_name"])) > 0) ) {
        $contact_name = stripslashes(strip_tags($_POST["contact_name"]));
    } else {
        echo "Merci d'écrire votre nom !<br />";
        $contact_name = "";
    }

    // CONDITIONS telephone
    if ( (isset($_POST["contact_phone"])) && (strlen(trim($_POST["contact_phone"])) > 0) ) {
        $contact_phone = stripslashes(strip_tags($_POST["contact_phone"]));
    } else {
        echo "Merci d'écrire votre numéro de téléphone ! <br />";
        $contact_phone = "";
    }
    // nom du projet
    if ( (isset($_POST["contact_subject"])) && (strlen(trim($_POST["contact_subject"])) > 0) ) {
        $contact_subject = stripslashes(strip_tags($_POST["contact_subject"]));
    } else {
        echo "Merci d'écrire le nom de votre projet ! <br />";
        $contact_subject = "";
    }

    // CONDITIONS contact_email
    if ( (isset($_POST["contact_email"])) && (strlen(trim($_POST["contact_email"])) > 0) && (filter_var($_POST["contact_email"], FILTER_VALIDATE_contact_email)) ) {
        $contact_email = stripslashes(strip_tags($_POST["contact_email"]));
    } else if (empty($_POST["contact_email"])) {
        echo "Merci d'écrire une adresse contact_email valide<br />";
        $contact_email = "";
    } else {
        echo "contact_email invalide :(<br />";
        $contact_email = "";
    }

    // CONDITIONS MESSAGE
    if ( (isset($_POST["contact_message"])) && (strlen(trim($_POST["contact_message"])) > 0) ) {
        $contact_message = stripslashes(strip_tags($_POST["contact_message"]));
    } else {
        echo "Merci d'écrire quelques mots sur votre projet <br />";
        $contact_message = "";
    }
    // condition chechbox
    // condition answer
    if ( (isset($_POST["contact_answer"])) && (strlen(trim($_POST["contact_answer"])) != 22) ) {
        $contact_answer = stripslashes(strip_tags($_POST["contact_answer"]));
    } else {
        echo "Merci d'écrire quelques mots sur votre projet <br />";
        $contact_answer = "";
    }
    // Les messages d'erreurs ci-dessus s'afficheront si Javascript est désactivé

    // PREPARATION DES DONNEES
    $ip           = $_SERVER["REMOTE_ADDR"];
    $hostname     = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
    $destinataire = "messaneyipatricia@gmail.com";
    $objet        = "[Agence web] " . $contact_subject;
    $contenu      = "Nom de l'expéditeur : " . $contact_name . "\r\n";
    $contenu     .= $contact_phone . "\r\n\n";
    $contenu     .= $contact_message . "\r\n\n";
    $contenu     .= "Adresse IP de l'expéditeur : " . $ip . "\r\n";
    $contenu     .= "DLSAM : " . $hostname;

    $headers  = "CC: " . $contact_email . " \r\n"; // ici l'expediteur du mail 
    $headers .= "Content-Type: text/plain; charset=\"ISO-8859-1\"; DelSp=\"Yes\"; format=flowed /r/n";
    $headers .= "Content-Disposition: inline \r\n";
    $headers .= "Content-Transfer-Encoding: 7bit \r\n";
    $headers .= "MIME-Version: 1.0";


    // SI LES CHAMPS SONT MAL REMPLIS
    if ( (empty($contact_name )) &&  (empty($contact_subject)) && (empty($contact_phone)) && (empty($contact_email)) && (!filter_var($contact_email, FILTER_VALIDATE_contact_email)) && (empty($contact_message )) ) {
        echo 'echec :( <br /><a href="index.html">Retour au formulaire</a>';
    } else {
        // ENCAPSULATION DES DONNEES
        mail($destinataire, $objet, utf8_decode($contenu), $headers);
        echo 'Votre message à été bien envoyé. Merci!';
    }

    // Les messages d'erreurs ci-dessus s'afficheront si Javascript est désactivé
?>