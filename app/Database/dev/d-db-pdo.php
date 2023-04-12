<?php

    # DB Credentials
    define('DB_HOST', 'localhost');
    define('DB_LOGIN', 'phpAPIRest');
    define('DB_PASS', '123');
    define('DB_DBNAME', 'phpAPIRest');

    # DB Class
    class Database {
        private $host = DB_HOST;
        private $user = DB_LOGIN;
        private $pass = DB_PASS;
        private $dbname = DB_DBNAME;

        private $dbh;
        private $r;
        private $error;

        # DB Connection
        public function __construct() {
            # Set DSN
            $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname.';charset=utf8'.'';
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];

            # PDO Instance
            try {
                $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
            } catch(PDOException $e) {
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        # Prepare Statement
        public function query($q) {
            $this->r = $this->dbh->prepare($q);
        }

        # Bind Values
        public function bind($param, $data, $type = null) {
            if(is_null($type)) {
                switch(true) {
                    case is_int($data):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($data):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($data):
                        $type = PDO::PARAM_NULL;
                        break;
                    default:
                        $type = PDO::PARAM_STR;
                }
            }

            $this->r->bindValue($param, $data, $type);
        }

        # Execute Statement
        public function execute() {
            return $this->r->execute();
        }

        # Get result -> Multiple Rows
        public function q() {
            $this->execute();
            return $this->r->fetchAll(PDO::FETCH_OBJ);
        }

        # Get result -> Single Row
        public function q1() {
            $this->execute();
            return $this->r->fetch(PDO::FETCH_OBJ);
        }

        # Row Count
        public function rowCount() {
            return $this->r->rowCount();
        }

    }

    $db = new Database();
    