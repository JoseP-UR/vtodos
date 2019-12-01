<?php 

    class Connection {
        private $message;
        private $server;
        private $user;
        private $pass;
        private $database;
        private $data_src_name;

        public function __construct($server, $user, $pass, $database)
        {
            $this->server = $server;
            $this->user = $user;
            $this->pass = $pass;
            $this->database = $database;

            $this->data_src_name = "mysql:host=".$server.";dbname=".$database;

            try {
                $pdo = new PDO($this->data_src_name, $this->user, $this->pass);
                $this->message = ['message' => 'success'];
            } catch(PDOException $e) {
                $this->message = ['error' => $e->getMessage()];
            }
        }

        public function getMessage() {
            return $this->message;
        }

        public function setMessage($message) {
            $this->message = $message;
        }

        public function newUser($data) { 
            $pdo = new PDO($this->data_src_name, $this->user, $this->pass);

            try {
                $pdo = new PDO($this->data_src_name, $this->user, $this->pass);
            } catch(PDOException $e) {
                die('failed: '.$e->getMessage());
            }
            
            $sql = "INSERT INTO users( name, email, pass ) VALUES (:name, :email, :pass)";

            $statement = $pdo->prepare($sql);

            $email = $data['email'];
            $name = $data['name'];
            $pass = $data['pass'];

            if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                $this->setMessage(['error' => 'invalid email']);
                return;
            }

            if(strlen($name) > 20 || strlen($name) < 3) {
                $this->setMessage(['error' => 'invalid name']);
                return;
            }

            if(strlen($pass) > 20 || strlen($pass) < 3) {
                $this->setMessage(['error' => 'invalid pass']);
                return;
            }

            $statement->execute(['name' => $name, 'email' => $email, 'pass' => $pass]);
            $this->setMessage(['message' => "{$name} succesfully registered"]);
        }
    }
