<?php
    class login {
    // Création de l'objet user
    private $id;          // ID dans la BDD
    private $login;       // ID de connexion
    private $pwd;         // Mot de passe du user
    private $nom;         // Nom de famille
    private $prenom;      // Prénom
    private $type;        // Type de compte

    public function __construct($login, $pwd) {
        // Le construct permet de définir les variables lorsqu'on appelle l'objet (new login($login, $pwd))

        // Lorsque l'objet est créé, on l'hydrate
        $this->hydrate($login, $pwd);
    }

    public function hydrate($login, $pwd) {   
        $data = login($login, $pwd); // /!\ On appelle la fonction login()
        if ($data != NULL) { // Si $data est NULL, ça veux dire que le user a mis un login ou pwd incorrect ---> Permet donc d'éviter des erreurs
            $this->setID($data["id"]);
            $this->setLogin($data['id_EGNOM']);   
            $this->setPwd($data['mdp']);       
            $this->setPrenom($data['prenom']);   
            $this->setNom($data['nom']);   
            $this->setType($data['type_de_compte']);      
        }
    }

    // ------------------
    // Setters
    // ------------------

    public function setID($value) {
        $this->id = $value;
    }

    public function setLogin($value) {
        $this->login = $value;
    }

    public function setPwd($value) {
        $this->pwd = $value;
    }

    public function setNom($value) {
        $this->nom = $value;
    }

    public function setPrenom($value) {
        $this->prenom = $value;
    }

    public function setType($value) {
        $this->type = $value;
    }   

    // ------------------
    // Getters
    // ------------------

    public function Id() {
        return $this->id;
    }

    public function Login() {
        return $this->login;
    }

    public function Pwd() {
        return $this->pwd;
    }

    public function Nom() {
        return $this->nom;
    }

    public function Prenom() {
        return $this->prenom;
    }

    public function Type() {
        return $this->type;
    }
}
?>