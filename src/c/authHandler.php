<?php
    if (isset($_SESSION["login"]) & isset($_SESSION["login"])) {
        // Si ce n'est pas pas la première connexion du user, on get le login et pwd via la session
        $currentUser = new login($_SESSION["login"], $_SESSION["pwd"]);

    } elseif (isset($_POST["login"]) & isset($_POST["pwd"])) {
        // Si c'est la première connexion du user, on get le login et pwd via le formulaire
        $_SESSION["login"] = $_POST["login"];
        $_SESSION["pwd"] = $_POST["pwd"];
        $currentUser = new login($_SESSION["login"], $_SESSION["pwd"]);

    } else {
        // Si il n'y a ni session, ni formulaire, alors on affiche la page de connexion
        include("src/v/authpage.php");
    }

    if ( isset($_GET['deconnectUser'])){  // Cliquer sur le bouton deconnecté - destruction de la session en cours.
        session_destroy();
        header('Location: index.php');
        echo 'Vous etes desormer deconnecté';
    }

    //////////////////////////////////////  PAGES  //////////////////////////////////////

    if (isset($currentUser) and $currentUser->Type() != NULL && !isset($_GET["Gestion_Situation"]) && !isset($_GET["collaborateur_competence"]) && !isset($_GET["collaborateur_tableau_synthese"]) && !isset($_GET["collaborateur_parametres"]) && !isset($_GET["collaborateur_contact_admin"]) && !isset($_GET["avancement_situation"]) && !isset($_GET["statistique_detaille"]) && !isset($_GET["Competence_mobiliser"])) { // Si l'objet currentUser est créé :
        $redirection = $currentUser->Type() . ".php"; // On get son type est on crée le lien avec
        include("src/v/" . $redirection); // On redirige avec la valeur qu'on a définie au dessus
    }
    
    if (isset($currentUser)) {
        if (isset($_GET['Gestion_Situation'])) {
            include("src/v/collaborateur_gestion_situation.php");
    
        } elseif (isset($_GET['collaborateur_competence'])) {
            include("src/v/collaborateur_competence.php");
            
        } elseif (isset($_GET['collaborateur_tableau_synthese'])) {  
            include("src/v/collaborateur_tableau_synthese.php");
            
        } elseif (isset($_GET['collaborateur_parametres'])) {
            include("src/v/collaborateur_settings.php");
            
        } elseif (isset($_GET['collaborateur_contact_admin'])) {
            include("src/v/collaborateur_contact_admin.php");
            
        } elseif (isset($_GET["avancement_situation"])) {
            include("src/v/administrateur_avancement_situation.php");
            
        } elseif (isset($_GET["statistique_detaille"])) {
            include("src/v/administrateur_statistique_detaille.php");

        }elseif(isset($_GET["Competence_mobiliser"])){
            include("src/v/administrateur_competence_mobiliser.php");
        }
    }
?>
