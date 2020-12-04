<?php 
    /**
     * Créer un compte utilisateur en base de données
     * @param username nom utilisateur
     * @param password mot de passe utilisateur
     * @param email email utilisateur
     * @return boolean true ou false
     */
    function create_account($username, $password, $email){
        $myPDO = init_db();
        $stmt = $myPDO->prepare('INSERT INTO account(userName, password, email,token) VALUES(?,?,?,0)');
        $stmt->execute(array($username,$password,$email));
        $stmt->closeCursor();
        if ($stmt){
            return true;
        }
        else {
            return false;
        }
    }

    /** 
     * Supprime le compte d'un utilisateur en base de données
     * @param id identifiant du compte
     */
    function delete_account($id){
        $bdd=init_db();
        $bdd->query("DELETE FROM account WHERE iduser=$id");
    }

?>