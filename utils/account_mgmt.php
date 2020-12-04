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
        $bdd->query("DELETE FROM account WHERE iduser=$id;");
    }

    /** 
     * Créer un token d'identification
     * @param id identifiant du compte
     * @return token retourne le token ou 0 en cas d'erreur
     */
    function create_token($id){
        $token = bin2hex(random_bytes(16));
        print($token);
        $bdd=init_db();
        $res = $bdd->query("UPDATE account SET token='$token' WHERE iduser=$id;");
        if ($res){
            return $token;
        }
        return 0;
    }

    /** 
     * Change le mot de passe de l'utilisateur
     * @param id identifiant du compte
     * @param new_password nouveau mot de passe utilisateur
     * @return boolean 
     */
    function change_password($id, $new_password){
        $bdd=init_db();
        $res = $bdd->query("UPDATE account SET password='$new_password' WHERE iduser=$id;");
        if ($res){
            return 1;
        }
        return 0;

    }
?>