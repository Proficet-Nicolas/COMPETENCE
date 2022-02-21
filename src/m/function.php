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

    function getSituations($id_user) {
        // Récupérations des situations
        $db = connectDB();

        $situations = $db->prepare("SELECT * FROM situation
        INNER JOIN contexte ON situation.id_contexte = contexte.id_contexte WHERE situation.id_user = ?");
        $situations->execute(array(
            $id_user
        ));
        
        return $situations;
    } 

    function getSituationData($id_situation) {
        $db = connectDB();

        $situationData = $db->prepare("SELECT * FROM situation WHERE id_situation = ?");
        $situationData->execute(array(
            $id_situation
        ));

        return $situationData;
    }

    function getBloc() {
        $db = connectDB();

        return $db->query("SELECT * FROM bloc");
    }

    function getActivites() {
        $db = connectDB();

        return $db->query("SELECT * FROM activite");
    }

    function getCompetences($id_activite, $id_bloc) {
        $db = connectDB();

        $competences = $db->prepare("SELECT competences.nom, competences.drawID, competences.id_competence FROM competences
        INNER JOIN activite ON activite.id_activite = competences.id_activite
        WHERE activite.id_bloc = :id_bloc AND competences.id_activite = :id_activite");
        $competences->execute(array(
            ":id_activite" => $id_activite,
            ":id_bloc" => $id_bloc
        ));

        return $competences;
    }

    function CheckCompetenceUse($id_activite, $id_bloc,$id_situation) { // competence mobilisée : voir les competences coché par l'eleves
        $db = connectDB();

        $CheckCompetenceUse = $db->prepare("SELECT competences.nom as nom_competence, competences.drawID as drawID_competence, competences.id_competence as id_competence
                                            FROM situation 
                                            INNER JOIN viser ON viser.id_situation = situation.id_situation 
                                            INNER JOIN competences ON competences.id_competence = viser.id_competence 
                                            INNER JOIN activite ON activite.id_activite = competences.id_activite 
                                            INNER JOIN bloc ON bloc.id_bloc = activite.id_bloc
                                            WHERE situation.id_situation = :id_situation AND activite.id_bloc = :id_bloc AND competences.id_activite = :id_activite ");
        $CheckCompetenceUse->execute(array(
            ":id_activite" => $id_activite,
            ":id_bloc" => $id_bloc,
            ":id_situation" => $id_situation
        ));

        return $CheckCompetenceUse;

    }

    function getAllSituation() {
        // Récupérations de toutes les situations
        $db = connectDB();
        $AllSituation = $db->query("SELECT utilisateur.nom as nom_user, utilisateur.prenom as prenom_user, situation.nom as nom_situation,  situation.date_creation as date_creation  
                                    FROM situation 
                                    INNER JOIN utilisateur ON utilisateur.id = situation.id_user");
    
        return $AllSituation;
    } 

    function getCollaborateur(){
        // recupere tout les Collaborateur
        $db = connectDB();
        $AllSituation = $db->query("SELECT utilisateur.nom as utilisateu_nom, utilisateur.prenom as utilisateur_prenom, utilisateur.id as id, utilisateur.id_EGNOM 
                                    FROM utilisateur 
                                    WHERE type_de_compte = 'collaborateur' " );
    
        return $AllSituation;

    }
    function Situation_recemment_ajouter(){
        $db = connectDB();
        $Situation_recemment = $db->query("SELECT utilisateur.nom as nom_user, utilisateur.prenom as prenom_user, situation.nom as nom_situation, situation.date_creation as date_creation, situation.etat as etat, situation.id_situation as id_situation
                                            FROM situation 
                                            INNER JOIN utilisateur ON utilisateur.id = situation.id_user 
                                            WHERE situation.etat = '0' 
                                            ORDER BY situation.date_creation 
                                            DESC LIMIT 5");
    
        return $Situation_recemment;
    }
    function Situation_Avancement(){        // recherche ciblé (Page : Avancement_Situation)
        // recupere tout les Collaborateur

        if(!isset($_POST['etat']) && !isset($_POST['selectCollaborateur'])){

            $db = connectDB();
            $AllSituation = $db->query("SELECT situation.id_situation as id_situation, utilisateur.nom as nom_user, utilisateur.prenom as prenom_user, situation.nom as nom_situation,  situation.date_creation as date_creation, situation.etat as etat 
                                        FROM situation 
                                        INNER JOIN utilisateur ON utilisateur.id = situation.id_user");
        
            return $AllSituation;
        }elseif($_POST['etat'] === "tous" && $_POST['selectCollaborateur'] === "tous"){
            // afficher les situation de tout les collab
            $db = connectDB();
            $AllSituation = $db->query("SELECT situation.id_situation as id_situation, utilisateur.nom as nom_user, utilisateur.prenom as prenom_user, situation.nom as nom_situation,  situation.date_creation as date_creation, situation.etat as etat 
                                        FROM situation 
                                        INNER JOIN utilisateur ON utilisateur.id = situation.id_user");
        
            return $AllSituation;
        }elseif($_POST['etat'] == "tous" && $_POST['selectCollaborateur'] !== "tous"){
            // afficher les situation dun collab

            $id_EGNOM = $_POST['selectCollaborateur'];

            $db = connectDB();
            $AllSituation = $db->prepare("SELECT situation.id_situation as id_situation, utilisateur.nom as nom_user, utilisateur.prenom as prenom_user, situation.nom as nom_situation,  situation.date_creation as date_creation, situation.etat as etat  
                                            FROM situation 
                                            INNER JOIN utilisateur ON utilisateur.id = situation.id_user 
                                            WHERE utilisateur.id_EGNOM = :id_egnom" );
            $AllSituation->execute(array(
                ":id_egnom" => $id_EGNOM 
            ));
        
            return $AllSituation;
        }elseif($_POST['etat'] == "0" && $_POST['selectCollaborateur'] == "tous"){
            //afficher les situation en cours de tout le monde

            $db = connectDB();
            $AllSituation = $db->query("SELECT situation.id_situation as id_situation, utilisateur.nom as nom_user, utilisateur.prenom as prenom_user, situation.nom as nom_situation,  situation.date_creation as date_creation, situation.etat as etat 
                                        FROM situation 
                                        INNER JOIN utilisateur ON utilisateur.id = situation.id_user 
                                        WHERE situation.etat = '0' ");
            
            return $AllSituation;
        }elseif($_POST['etat'] == "0" && $_POST['selectCollaborateur'] !== "tous"){
            //afficher les situation en cours dun collab
            
            $id_EGNOM = $_POST['selectCollaborateur'];
            $etat = $_POST['etat'];

            $db = connectDB();
            $AllSituation = $db->prepare("SELECT situation.id_situation as id_situation, utilisateur.nom as nom_user, utilisateur.prenom as prenom_user, situation.nom as nom_situation, situation.date_creation as date_creation, situation.etat as etat 
                                            FROM situation 
                                            INNER JOIN utilisateur ON utilisateur.id = situation.id_user
                                            WHERE situation.etat = :etat 
                                            AND utilisateur.id_EGNOM = :id_egnom" );
            $AllSituation->execute(array(
                ":id_egnom" => $id_EGNOM, 
                ":etat" => $etat
            ));

            return $AllSituation;
        }elseif($_POST['etat'] == "1" && $_POST['selectCollaborateur']  !== "tous"){
            //afficher les situation terminer dun collab

            $id_EGNOM = $_POST['selectCollaborateur'];
            $etat = $_POST['etat'];

            $db = connectDB();
            $AllSituation = $db->prepare("SELECT situation.id_situation as id_situation, utilisateur.nom as nom_user, utilisateur.prenom as prenom_user, situation.nom as nom_situation, situation.date_creation as date_creation, situation.etat as etat 
                                            FROM situation 
                                            INNER JOIN utilisateur ON utilisateur.id = situation.id_user 
                                            WHERE utilisateur.id_EGNOM = :id_egnom 
                                            AND situation.etat = :etat" );
            $AllSituation->execute(array(
                ":id_egnom" => $id_EGNOM, 
                ":etat" => $etat
            ));

            return $AllSituation;
        }elseif($_POST['etat'] == "1" && $_POST['selectCollaborateur'] = "tous"){
            //afficher les situation terminer de tous

            $db = connectDB();
            $AllSituation = $db->query("SELECT situation.id_situation as id_situation, utilisateur.nom as nom_user, utilisateur.prenom as prenom_user, situation.nom as nom_situation,  situation.date_creation as date_creation, situation.etat as etat
                                        FROM situation 
                                        INNER JOIN utilisateur ON utilisateur.id = situation.id_user 
                                        WHERE situation.etat = '1' ");
            
            return $AllSituation;
        }else{
            echo 'Une erreur est survenu';
        }

    }

    function Etat_convertion($etat){        // Change une valeur decimal en texte (Page : Avancement_Situation)
        if($etat == "0"){
            $resultat = 'En cours';
        }elseif($etat == "1"){
            $resultat = 'Terminé';
        }

        return $resultat;
    }


    /////////////////// adminRH_statistique_avancer ///////////////////

    function Situation_tous_terminer(){   // statistique_collab
        $db = connectDB();
            $situation_tous_terminer = $db->query("SELECT * FROM situation where situation.etat = '1'");

            $count = 0;

            while ($data = $situation_tous_terminer->fetch()) {
                $count = $count + 1;
            }

            return $count;
    }
    function Situation_tous_encour(){       // statistique_collab
        $db = connectDB();
            $situation_tous_terminer = $db->query("SELECT * FROM situation where situation.etat = '0'");

            $count = 0;

            while ($data = $situation_tous_terminer->fetch()) {
                $count = $count + 1;
            }

            return $count;
    }

    function Situation_tous(){          // statistique_collab
        $db = connectDB();
            $situation_tous_terminer = $db->query("SELECT * FROM situation");

            $count = 0;

            while ($data = $situation_tous_terminer->fetch()) {
                $count = $count + 1;
            }

            return $count;
    }
    function statistique_avancer_cibler_encours(){
        if(isset($_POST['selectCollaborateur_statistique'])){

            $id_EGNOM = $_POST['selectCollaborateur_statistique'];
            $count = 0;

            $db = connectDB();
            $situation_tous_terminer = $db->prepare("SELECT utilisateur.nom as nom_user, utilisateur.prenom as prenom_user, situation.nom as nom_situation, situation.date_creation as date_creation, situation.etat as etat 
                                            FROM situation 
                                            INNER JOIN utilisateur ON utilisateur.id = situation.id_user
                                            WHERE utilisateur.id_EGNOM = :id_egnom AND situation.etat = '0'" );
            $situation_tous_terminer->execute(array(
                ":id_egnom" => $id_EGNOM, 
            ));
          

            while ($data = $situation_tous_terminer->fetch()) {
                $count = $count + 1;
            }

            return $count;
        }     
    }

    function Contribution_sur_situationAll(){
        $count = Situation_tous();

        if(isset($_POST['selectCollaborateur_statistique'])){

            $id_EGNOM = $_POST['selectCollaborateur_statistique']; 
            $result = 0; 
            $resultat = 0;

            $db = connectDB();
            $Contribution_sur_situationAll = $db->prepare("SELECT * 
                                                    FROM situation 
                                                    INNER JOIN utilisateur ON utilisateur.id = situation.id_user
                                                    WHERE utilisateur.id_EGNOM = :id_egnom " );
            $Contribution_sur_situationAll->execute(array(
                ":id_egnom" => $id_EGNOM, 
            ));
          

            while ($data = $Contribution_sur_situationAll->fetch()) {
                $result = $result + 1;
            }

            $resultat = ($result * 100) / $count ;

            return $resultat;
        }
    }

    function statistique_avancer_cibler_terminer(){
        if(isset($_POST['selectCollaborateur_statistique'])){

            $id_EGNOM = $_POST['selectCollaborateur_statistique'];
            $count = 0;
            
            $db = connectDB();
            $situation_tous_terminer = $db->prepare("SELECT utilisateur.nom as nom_user, utilisateur.prenom as prenom_user, situation.nom as nom_situation, situation.date_creation as date_creation, situation.etat as etat 
                                            FROM situation 
                                            INNER JOIN utilisateur ON utilisateur.id = situation.id_user
                                            WHERE utilisateur.id_EGNOM = :id_egnom AND situation.etat = '0'" );
            $situation_tous_terminer->execute(array(
                ":id_egnom" => $id_EGNOM, 
            ));
          

            while ($data = $situation_tous_terminer->fetch()) {
                $count = $count + 1;
            }

            return $count;
        }     
    }

    function isCompetencesUsed($id_competences, $id_user) {
        $db = connectDB();

        $isUsed = $db->prepare("SELECT * FROM viser
        INNER JOIN situation ON situation.id_situation = viser.id_situation
        WHERE situation.id_user = :id_user AND viser.id_competence = :id_competence");
        $isUsed->execute(array(
            ":id_user" => $id_user,
            ":id_competence" => $id_competences
        ));

        return $isUsed;
    }

    function isCompetencesUsedSituation($id_competences, $id_situation) {       // cibles les competences utilisé dans une situation
        $db = connectDB();

        $isUsed = $db->prepare("SELECT * FROM viser
        INNER JOIN situation ON situation.id_situation = viser.id_situation
        WHERE situation.id_situation = :id_situation AND viser.id_competence = :id_competence");
        $isUsed->execute(array(
            ":id_situation" => $id_situation,
            ":id_competence" => $id_competences
        ));

        return $isUsed;
    }

    function getLiens($id_situation) {
        $db = connectDB();

        $req = $db->prepare("SELECT * FROM liens WHERE id_situation = ?");
        $req->execute(array($id_situation));

        return $req;
    }
?>