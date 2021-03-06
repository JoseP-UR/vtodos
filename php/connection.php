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
                $this->setMessage('message', 'connected succesfully');
            } catch(PDOException $e) {
                $this->setMessage('failed', $e->getMessage());
                die($this->message);
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



        public function createTask($data) {

            $userName = $data['user']['name'];
            $userPass = $data['user']['pass'];
            $userId = $data['user']['uid'];
            $duedate = $data['dueDate'];
            $description = $data['description'];
            $datecreated = date("Y-m-d");

            $user = $this->getUserByName($userName);
            if (!$user) {
                $this->setMessage('error', 'user: '.$user['name'].' was not found');
                return;
            }

            if ($user['pass'] != $userPass) {
                $this->setMessage('error', 'corrupt password');
                return;
            }

            try {
                $pdo = new PDO($this->data_src_name, $this->user, $this->pass);
            } catch(PDOException $e) {
                $this->setMessage('failed', $e->getMessage());
                return;
            }

            $query = "INSERT INTO tasks( userid, date_created, due_date, description ) VALUES (:userid, :datecreated, :duedate, :description)";

            $statement = $pdo->prepare($query);
            $statement->execute(['userid' => $userId, 'datecreated' => $datecreated, 'duedate' => $duedate, 'description' => $description]);
            $this->setMessage('success', true);
        }

        public function retrieveList($uid) {
        
                try {
                    $pdo = new PDO($this->data_src_name, $this->user, $this->pass);
                } catch(PDOException $e) {
                    $this->setMessage('failed', $e->getMessage());
                    return;
                }
    
                $query = "SELECT * FROM tasks WHERE userid=:uid";
    
                $statement = $pdo->prepare($query);
                $statement->execute(['uid' => $uid]);

                $data = $statement->fetchAll();

                $message = [];

                foreach($data as $task) {
                    $chunk = [
                        'id' => $task['id'],
                        'dateCreated' => $task['date_created'],
                        'dueDate' => $task['due_date'],
                        'description' => $task['description'],
                        'editing' => false
                    ];

                    array_push($message, $chunk);
                }
    
                return $message;
        }

        public function deleteTask ($id, $data) {
            try {
                $pdo = new PDO($this->data_src_name, $this->user, $this->pass);
            } catch(PDOException $e) {
                $this->setMessage('failed', $e->getMessage());
                return;
            }

            
            $uid = $data['user']['uid'];

            $query = "DELETE FROM tasks WHERE userid=:uid AND id=:id";

            $statement = $pdo->prepare($query);
            $statement->execute(['uid' => $uid, 'id' => $id]);
            $this->setMessage('success', true); 

        }

        public function editTask($id, $data) {
            try {
                $pdo = new PDO($this->data_src_name, $this->user, $this->pass);
            } catch(PDOException $e) {
                $this->setMessage('failed', $e->getMessage());
                return;
            }

            $uid = $data['user']['uid'];

            $query = "UPDATE tasks SET description=:description WHERE id=:id AND userid=:uid";

            $statement = $pdo->prepare($query);
            $statement->execute(['description' => $data['description'], 'uid' => $uid, 'id' => $id]);
            $this->setMessage('success', true); 
        }
    
    }
