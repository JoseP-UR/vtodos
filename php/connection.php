<?php 

    class Connection {
        private $link = '';

        public function __construct($server, $user, $pass, $database)
        {
            $this->link = mysqli_connect($server, $user, $pass, $database);
        }

        public function getLink() {
            return $this->link;
        }

        public function newUser($data) { 
            $query = "INSERT INTO users( username, email, pass ) VALUES ('".$data['user']."','".$data['email']."','".$data['pass']."')";
            $result = mysqli_query($this->link, $query);

            return $result;
        }
    }
