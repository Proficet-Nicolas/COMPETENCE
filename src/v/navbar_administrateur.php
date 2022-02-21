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
    Ressources humaines
</div>

<br>

<button onclick="window.location.href = '?avancement_situation';"> 
    <strong> Avancement situation </strong>
</button> <br>

<button onclick="window.location.href = '?statistique_detaille';"> 
    <strong> Statistiques détaillés </strong>
</button> <br> <br>

<div class="box">
    Divers
</div>

<br>

<a href="mailto:prof@trionfini.com"> 
    <button> 
        <strong>Envoyer</strong>
    </button>
</a>

</div>