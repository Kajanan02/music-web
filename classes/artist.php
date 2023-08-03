<?php

namespace classes;

require_once "../classes/db-connector.php";

use classes\DBConnector;
use Exception;
use PDO;

class Artist{
    public function getAvailableUsernames(){
        $con = DBConnector::getConnection();

        $usernames = array();

        $query = "SELECT username FROM artist";

        try{
            $pstmt = $con->prepare($query);
            $pstmt->execute();
            $artists = $pstmt->fetchAll(PDO::FETCH_NUM);

            foreach($artists as $a){
                array_push($usernames, $a[0]);
            }

            return $usernames;
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }
}