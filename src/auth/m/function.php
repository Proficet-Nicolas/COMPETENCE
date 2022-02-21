<?php 
    function connectDB() {
        // Connexion à la base de données
        try { $bdd = new PDO('mysql:host=localhost;dbname=competences;charset=utf8', '20poutres', 'student'); }
        catch(Exception $e) { die('Erreur : '.$e->getMessage()); }

        return $bdd;
    }
 
    function login($login, $pwd) {
        // Check login & Retourne les valeurs du user
        $bdd = connectDB();

        $connect = $bdd->query('SELECT * FROM utilisateur'); // Requête SQL : on selectionne tout les users
        $found = false;

        while ($data = $connect->fetch()) {
            if ($login == $data['id_EGNOM'] and $pwd == $data['mdp']) {
                // Si le login et le mdp sont bon alors :
                $found = true; // Un utilisateur a été trouvé
                return $data; // On retourne les données
            }
        }

        if (!$found) {
            // Si a un utilisateur n'a été trouvé :
            echo "Login ou mot de passe incorrect <br>";
            echo "<a href='index.php'> Retour à l'accueil </a>";
            unset($_SESSION["login"]);

            return NULL;
        }
    }

    function getContexte() {
        // Récupération des valeurs dans la table contexte
        $db = connectDB();
        $contexte = $db->query('SELECT * FROM contexte');
                
        return $contexte;
    }

    function getSituations() {
        // Récupérations des situations
        $db = connectDB();
        $currentUser = new login($_SESSION["login"], $_SESSION["pwd"]);

        $situations = $db->prepare("SELECT * FROM situation
        INNER JOIN contexte ON situation.id_contexte = contexte.id_contexte WHERE situation.id_user = ?");
        $situations->execute(array(
            $currentUser->id()
        ));
        
        return $situations;
    } 

    function getSituationData() {
        // Récuparation des données de la situation à partir de son ID
        $db = connectDB();
        

    }
?>