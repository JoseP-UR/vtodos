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
                $this->message = ['result' => 'success'];
            } catch(PDOException $e) {
                $this->message = ['failed' => $e->getMessage()];
            }
        }

        public function getMessage() {
            return $this->message;
        }

        public function setMessage($type, $message) {
            $this->message = [(string) $type => $message];
        }

        public function getUserByName($name) {
            try {
                $pdo = new PDO($this->data_src_name, $this->user, $this->pass);
            } catch(PDOException $e) {
                $this->setMessage('failed', $e->getMessage());
                return;
            }

            $query = "SELECT * FROM users WHERE name=:name";

            $statement = $pdo->prepare($query);
            $statement->execute(['name' => $name]);

            return $statement->fetch();
        }

        public function getUserByEmail($email) {
            try {
                $pdo = new PDO($this->data_src_name, $this->user, $this->pass);
            } catch(PDOException $e) {
                $this->setMessage('failed', $e->getMessage());
                return;
            }

            $query = "SELECT * FROM users WHERE email=:email";

            $statement = $pdo->prepare($query);
            $statement->execute(['email' => $email]);

            return $statement->fetch();
        }

        public function newUser($data) { 
            
            $email = $data['email'];
            $name = $data['name'];
            $pass = $data['pass'];

            //validate data
            
            if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                $this->setMessage('error', 'invalid email');
                return;
            }

            if(strlen($name) > 20 || strlen($name) < 3) {
                $this->setMessage('error', 'invalid name');
                return;
            }

            if(strlen($pass) > 20 || strlen($pass) < 3) {
                $this->setMessage('error', 'invalid pass');
                return;
            }

            //setup PDO
            try {
                $pdo = new PDO($this->data_src_name, $this->user, $this->pass);
            } catch(PDOException $e) {
                $this->setMessage('failed', $e->getMessage());
                return;
            }

            //check if user and email exists
            if ($user = $this->getUserByName($name)) {
                $this->setMessage('error', $user['name'].' is already registered');
                return;
            }

            if ($user = $this->getUserByEmail($email)) {
                $this->setMessage('error', $user['email'].' is already in use');
                return;
            }


            //insert new user
            $query = "INSERT INTO users( name, email, pass ) VALUES (:name, :email, :pass)";

            $pass = password_hash($pass, PASSWORD_DEFAULT);

            $statement = $pdo->prepare($query);
            $statement->execute(['name' => $name, 'email' => $email, 'pass' => $pass]);
            $this->setMessage('success', "{$name} succesfully registered");
        }
    }
