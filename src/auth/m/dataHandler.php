<?php 
    // Création de situation
    if(isset($_POST["createSituation"])) {
        $db = connectDB();

        // Récupération des données de bases
        $nom = $_POST["nom_s"];
        $contexte = $_POST["contexte_s"];
        $datedebut = $_POST["datedebut_s"];
        $duree = $_POST["duree_s"];
        $type_duree = $_POST["type_duree_s"];
        $details = $_POST["details_s"];
        $itemNum = $_POST["itemNum"];

        // Récupération ID à partir du contexte
        $req = $db->prepare("SELECT id_contexte FROM contexte WHERE contexte = ?");
        $req->execute(array(
            $contexte
        ));

        while ($data = $req->fetch()) {
            $id_contexte = $data["id_contexte"];
        };

        // Envois des données dans la table situation
        $req = $db->prepare("INSERT INTO situation(nom, date_debut, date_creation, duree, type_duree, details, id_contexte, id_user) VALUES 
        (:nom, :date_debut, :date_creation, :duree, :type_duree, :details, :id_contexte, :id_user) ");
        $req->execute(array(
            ":nom" => $nom,
            ":date_debut" => $datedebut,
            ":date_creation" => date('Y-m-d'),
            ":duree" => $duree,
            ":type_duree" => $type_duree,
            ":details" => $details,
            ":id_contexte" => $id_contexte,
            ":id_user" => $currentUser->id()
        ));        

        // Récupération de l'ID de la situation via le nom
        $req = $db->prepare("SELECT id_situation FROM situation WHERE nom = ?");
        $req->execute(array(
            $nom
        ));

        while ($data = $req->fetch()) {
            $currentID = $data["id_situation"];
        }
        
        // Pour chaque élements on insert dans la table liens
        for ($i = 1; $i <= $itemNum; $i++) {
            $currentURL = $_POST["url_" . $i];
            $currentDetail = $_POST["detail_" . $i];
            if (isset($currentURL) and isset($currentDetail)) {
                $req = $db->prepare("INSERT INTO liens(URI, details, id_situation) VALUES (:URI, :details, :id_situation)");
                $req->execute(array(
                    ":URI" => $currentURL,
                    ":details" => $currentDetail,
                    ":id_situation" => $currentID
                ));
            }
        }
    };

    // Suppression de situation
    if (isset($_GET["situationToDelete"])) {
        $db = connectDB();

        $req = $db->prepare("DELETE FROM liens WHERE id_situation = ?");
        $req->execute(array(
            $_GET["situationToDelete"]
        ));
        
        $req = $db->prepare("DELETE FROM situation WHERE id_situation = ?");
        $req->execute(array(
            $_GET["situationToDelete"]
        ));

        header("Location: index.php?Gestion_Situation=true");
    }

    // Modification de situation
    if(isset($_GET["situationToEdit"]))
?>