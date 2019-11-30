<?php 

    class Connection {
        private $message = '';
        private $pdo;

        public function __construct($server, $user, $pass, $database)
        {
            try {
                $data_src_name = "mysql:host=".$server.";dbname=".$database;
                $this->pdo = new PDO($data_src_name, $user, $pass);
                $this->message = 'success';
            } catch(PDOException $e) {
                $this->message = 'failed: '.$e->getMessage();
            }
        }

        public function getMessage() {
            return $this->message;
        }

        public function newUser($data) { 
            $sql = "INSERT INTO users( username, email, pass ) VALUES (:name, :email, :pass)";
            $statement = $this->pdo->prepare($sql);

            $statement->execute(['name' => $data['name'], 'email' => $data['email'], 'pass' => $data['pass']]);
        }
    }
