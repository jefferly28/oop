<?php 
    class myslconnection
    {
        private $servername = "localhost";
        private $username = "root";
        private $password = "";
        private $dbname = "zphpoop";
        public $conn; // This will hold the connection object
        
        // Create connection
        public function opened()
        {
            $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            
            // Check connection
            if ($this->conn->connect_error)
            {
                die("Connection failed: " . $this->conn->connect_error);
            }
            
            //echo "Connected successfully";
        }

        public function closed()
        {
            $this->conn->close();
        }
    }
?>
