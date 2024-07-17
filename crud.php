<?php 
    require_once "myslconnection.php";
    
    class crud extends myslconnection
    {
        public $id,$name, $age, $email, $gender;
        public $listid, $listname, $listage, $listemail, $listgender;

        public function __construct()
        {
            $this->listid = array();
            $this->listname = array();
            $this->listage = array();
            $this->listemail = array();
            $this->listgender = array();
        }

        public function save($name, $age, $email, $gender)
        {
            $this->opened();
            $sqlinsert = "INSERT INTO student_tbl (name, age, email, gender) VALUES ('$name', '$age', '$email', '$gender')";
            if ($this->conn->query($sqlinsert) === TRUE) {
                echo "Record Successfully Save of ";
            } else {
                echo "Error: " . $sqlinsert . "<br>" . $this->conn->error;
            }
            $this->closed();
        }

        public function searchid($id)
        {
            $this->opened();
            $sqlselect = "SELECT * FROM student_tbl WHERE id = '$id'";
            $result = $this->conn->query($sqlselect);
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $this->id = $row['id'];
                $this->name = $row['name'];
                $this->age = $row['age'];
                $this->email = $row['email'];
                $this->gender = $row['gender'];
            } else {
                echo "No data found for the given ID.";
            }

            $this->closed();
        }

        public function getList($id=null)
        {
            $this->clearlist();
            $this->opened();
            if ($id !== null) {
                $selectQuery = "SELECT * FROM student_tbl WHERE id = '$id'";
            } else {
                $selectQuery = "SELECT * FROM student_tbl";
            }
            $result = $this->conn->query($selectQuery);
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $this->listid[] = $row['id'];
                    $this->listname[] = $row['name'];
                    $this->listage[] = $row['age'];
                    $this->listemail[] = $row['email'];
                    $this->listgender[] = $row['gender'];
                }
            } else {
                echo "Student Not Found";
            }
            $this->closed();
        }

        public function update($id, $name, $age, $email, $gender)
        {
            $this->opened();
            $sqlupdate = "UPDATE student_tbl SET name ='$name',age='$age',email='$email',gender='$gender' WHERE id = '$id'";
            if ($this->conn->query($sqlupdate) === TRUE) {
                echo "Record Successfully Updated";
            } else {
                echo "Error: " . $sqlupdate . "<br>" . $this->conn->error;
            }
            $this->closed();
        }

        public function delete($id)
        {
            $this->opened();
            $sqldelete = "DELETE FROM student_tbl WHERE id = '$id'";
            if ($this->conn->query($sqldelete) === TRUE) {
                echo "Record Successfully Deleted ";
            } else {
                echo "Error: " . $sqldelete . "<br>" . $this->conn->error;
            }
            $this->closed();
        }

        public function clearlist()
        {
            $this->listid = array();
            $this->listname = array();
            $this->listage = array();
            $this->listemail = array();
            $this->listgender = array();
        }

        //This code is working but for testing only (Trash Code)
        public function getdata()
        {
            $this->opened();
            $selectQuery = "SELECT * FROM student_tbl";
            $result = $this->conn->query($selectQuery);
            
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $this->listid[] = $row['id'];
                    $this->listname[] = $row['name'];
                    $this->listage[] = $row['age'];
                    $this->listemail[] = $row['email'];
                    $this->listgender[] = $row['gender'];
                }
            } else {
                echo "Student Not Found";
            }
            $this->closed();
        }

        public function loadrecord()
        {
            $this->opened();
            $sqlselect = "SELECT * FROM student_tbl";
            $result = $this->conn->query($sqlselect);
            $data = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
            }
            $this->closed();
            return $data;
        }
        //Trash Code End ----------------------------------------------------------------
    }
?>
