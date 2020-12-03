<?php
    /**
     * Connexion à la base de données
     * @return myPdo
     */
    function init_db(){

        $DB_DEFAULT_USERNAME = "siteN2i";
        $DB_DEFAULT_PASSWORD = "JF9x8Bs38xpTcHgs";
        $DB_DEFAULT_HOST = "pma.auzelou.com";
        $DB_DEFAULT_PORT = "3306";
        $DB_DEFAULT_BDD = "siteN2i";

        try {
            $myPDO = new PDO('mysql:host='.$DB_DEFAULT_HOST.';dbname='.$DB_DEFAULT_USERNAME, $DB_DEFAULT_USERNAME, $DB_DEFAULT_PASSWORD);
        }catch(PDOException $e){
            echo $e->getMessage();
            return null;
        }
        return $myPDO;
    }

    /**
     * Envoie d'une requête SQL 
     * @param id pointeur de la base de données
     * @param query requête SQL envoyée au serveur
     * @return res resultat de la requete
     */
    function query($db, $query){
    $res = $db->query($query);
    if (!$res) {
        echo "\nPDO::errorInfo():\n";
        print_r($db->errorInfo());
        return [];
    }
    return $res->fetchAll();
}

?>