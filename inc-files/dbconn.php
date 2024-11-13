<?php 
        $host="localhost";
        $HostUser="root";
        $HostPass="";
        $dbName="fee_payment";
        $charset="utf8mb4";
        
        $dsn = "mysql:host=".$host.";dbname=".$dbName.";charset=".$charset;
        try {
            $dbh = new PDO ($dsn,$HostUser,$HostPass);
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
            $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
        
        } catch (PDOException $e) {
           die("MYSQL SERVER CONNECTION FAILED : ".$e->getMessage());
        }
?>