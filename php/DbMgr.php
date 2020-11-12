<?php
class DbMgr {
    private $pdo;

    function __construct() {
        try {
        $base = $this->pdo = new PDO("mysql:host=tm258672-001.privatesql:35353;dbname=lalastacomputer", "lc", "LalastaComputer2018LC");
        //$base = $this->pdo = new PDO("mysql:host=localhost;dbname=lalasta-computer", "root", "");
            if (1==1) {
                echo "";
            }
            else{
                echo "";
            }
        } catch (Exception $e) {
            echo "la connecion a echoué";
        }
       
    }

    public function execute($sql, $param = null) {
        $prepareState = $this->pdo->prepare($sql);
        if (!is_null($param)) {
            foreach ($param as $key => $value) {
                $prepareState->bindValue(":$key", $value);
            }
        }
        $prepareState->execute();
        return $prepareState;
    }
    
    public function get_lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

}
