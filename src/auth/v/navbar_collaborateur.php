<div class="navbar">
<div class="header2">
    <div class="right">

        <a href="index.php"><img src="https://www.freepnglogos.com/uploads/logo-home-png/chimney-home-icon-transparent-1.png"  alt="Image Retour au Menu" width="50" height="50"></a>
    </div>
    <div style="text-align: right;">
        <a href="?deconnectUser=true"><img src="https://image.flaticon.com/icons/png/512/130/130925.png"  alt="Image Retour au Menu" width="50" height="50"></a>

    </div>
</div>

<h2 class="center">
    <?php 
        $currentUser = new login($_SESSION["login"], $_SESSION["pwd"]); // Récupération du currentUser via la session
        echo $currentUser->Login() . "<br><strong>" . $currentUser->Nom() . " " . $currentUser->Prenom() . "</strong>"; // Affichage du login, nom & prénom du user
    ?>
</h2>

<div class="box">
    Situation professionnelle
</div>

<br>

<button onclick="window.location.href = '?';"> 
    <strong> Créer une nouvelle situation </strong>
</button>

<br>

<button onclick="window.location.href = '?Gestion_Situation=true';"> 
    <strong> Gestion Situation </strong>
</button> <br> <br>

<div class="box">
    Synthese
</div> <br>

<button onclick="window.location.href = '?collaborateur_competence=true';"> 
    <strong> Competences </strong>
</button> <br>
<button onclick="window.location.href = '?collaborateur_tableau_synthese=true';"> 
    <strong> Tableau Synthese  </strong>
</button> <br> <br>

<div class="box">
    Divers
</div> <br>
<button onclick="window.location.href = '?collaborateur_parametres=true';"> 
    <strong> Parametres </strong>
</button> <br>
<!-- <button onclick="window.location.href = '?collaborateur_contact_admin=true';"> 
    <strong> Contact admin </strong>
</button> -->

<button> 
    <a href="mailto:prof@trionfini.com">Envoyer </a>
</button>

</div>