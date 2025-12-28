<?php
/**
 * Cette function permat la connection à la base de données
 *
 * @return PDO
 */
    function connectToDb() : PDO {
        $dsn = 'mysql:dbname=mr-popcorn;host=127.0.0.1;port-3306';
        $user = 'root';
        $password = '';

        try {
        $db = new PDO($dsn, $user, $password); 
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(\PDOException $pdoException) {
            die("Error connection to database: {$pdoException->getMessage()}");
        }
        return $db; 
    }
/**
 * Cette function permet d'inserer le nouveau film en base de données
 *
 * @param null|float $ratingRounded
 * @param array $data
 * @return void
 */
    function insertFilm(null|float $ratingRounded, array $data = []): void {
        $db = connectToDb();
        try {
            $req = $db->prepare("INSERT INTO film (title, rating, comment, created_at, updated_at) VALUES (:title, :rating, :comment, now(), now() )");
            $req->bindValue(":title", $data['title']);
            $req->bindValue(":rating", $ratingRounded);
            $req->bindValue(":comment", $data['comment']);

            $req->execute();
            $req->closeCursor();
        } catch (\PDOException $pdoException) {
            throw $pdoException;
        }

        }

        function getfilms(): array {
            $db = connectToDb();
            try {
            $req = $db->prepare("SELECT * FROM film ORDER BY created_at DESC ");
            $req->execute();
            return $req->fetchAll();
            $req->closeCursor();
            } catch (\PDOException $pdoException){
                throw $pdoException;
            }
            
             return $films;
        }
        
    