<div class="collab">
    <?php 
        include("navbar_collaborateur.php");
    ?>

    <div class="mainscreen">  
        <h1> Paramètres</h1>
        
        <form action="index.php?collaborateur_parametres=true" method="post">
            Votre option : <br>
            <select name="options">
                <option selected>SLAM</option>
                <option>SISR</option>
            </select>

            <br> <br><br> <br>

            Votre prénom : <input type="text"> 
            <br> <br>
            Votre nom : <input type="text">
        </form>
    </div>
</div>