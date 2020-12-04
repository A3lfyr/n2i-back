<?php
    /**
     * Fonction d'authentification d'un utilisateur
     * @param id identifiant 
     * @param pass mot de passe
     * @return id de l'utilisateur ou 0 en cas d'échec de l'authentification
     */
    function account_auth($login, $pass){
        $bdd = init_db();
        if ($bdd==null){
            return false;
        }
        $query = 'SELECT iduser FROM account WHERE userName=? AND password=?';
        $stmt = $bdd->prepare($query);
        $stmt->execute(array($login, $pass));
        $result = $stmt->rowCount();
        $id = $stmt->fetch();
        $stmt->closeCursor();
        if ($result>0){
            return $id['iduser'];
        }
        return 0;
    }
    /**
     * Fonction d'authentification d'un utilisateur par token
     * @param id identifiant 
     * @param token token 
     * @return id de l'utilisateur ou 0 en cas d'échec de l'authentification
     */
    function account_auth_token($login, $token){
        $bdd = init_db();
        if ($bdd==null){
            return false;
        }
        $query = 'SELECT iduser FROM account WHERE userName=? AND token=?';
        $stmt = $bdd->prepare($query);
        $stmt->execute(array($login, $token));
        $result = $stmt->rowCount();
        $id = $stmt->fetch();
        $stmt->closeCursor();
        if ($result>0){
            return $id['iduser'];
        }
        return 0;
    }
?>