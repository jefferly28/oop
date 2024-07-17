<?php 
    require_once "crud.php";
    $c = new crud();
    $c->getList();

    if (isset($_POST['btnsubmit']))
    {
        $iname = $_POST['txtname'];
        $iage = $_POST['txtage'];
        $iemail = $_POST['txtemail'];
        $igender = $_POST['txtgender'];
        
        $c->save($iname,$iage,$iemail,$igender);
        echo "$iname $iage $iemail $igender";
        $c->getList();
    }

    if (isset($_POST['btnsearch']))
    {
        $id = $_POST['txtid'];
        $c->searchid($id);
        $c->getList($id);
    }

    if (isset($_POST['btnupdate']))
    {
        $id = $_POST['txtidhide'];
        $iname = $_POST['txtname'];
        $iage = $_POST['txtage'];
        $iemail = $_POST['txtemail'];
        $igender = $_POST['txtgender'];
        $c->update( $id,$iname,$iage,$iemail,$igender);
        $c->getList();
    }

    if (isset($_POST['btndelete']))
    {
        $id = $_POST['txtidhide'];
        $c->delete( $id);
        $c->getList();
    }

?>
<!DOCTYPE html>
<html>
<head>
<title>PHP OOP</title>
</head>
<body>
<div align = "center">
    <form action = "index.php" method = "post">
    <table>
        <tr>
            <td>Name:</td>
            <input type = "hidden" name = "txtidhide" value="<?php echo $c->id; ?>">
            <td><input type = "text" name = "txtname" value="<?php echo $c->name; ?>"></td>
        </tr> 
        <tr>
            <td>Age:</td>
            <td><input type = "text" name = "txtage" value="<?php echo $c->age; ?>"></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><input type = "text" name = "txtemail" value = "<?php echo $c->email; ?>"></td>
        </tr>  
        <tr>
            <td>Gender:</td>
            <td><input type = "text" name = "txtgender" value = "<?php echo $c->gender; ?>"></td>
        </tr> 
        <tr>
            <td></td>
            <td>
                <input type = "submit" name = "btnsubmit" value = "Save">
                <input type = "submit" name = "btnupdate" value = "Update">
                <input type = "submit" name = "btndelete" value = "Delete">
            </td>
        </tr>
    </table>
    </form>
</br>
    <table border = '1'>

    <form action = "index.php" method = "post">
        <tr>
            <td colspan = "5" align = "right">
                <input type = "submit" name = "btnsearch" value = "Seach ID">
                <input type = "text" name = "txtid">
            </td>
        </tr>
        </form>

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Email</th>
            <th>Gender</th>
        </tr>
        <?php
            
            for($i = 0; $i < count($c->listid); $i++)
            {
                echo'
                    <tr>
                        <td>'.$c->listid[$i].'</td>
                        <td>'.$c->listname[$i].'</td>
                        <td>'.$c->listage[$i].'</td>
                        <td>'.$c->listemail[$i].'</td>
                        <td>'.$c->listgender[$i].'</td>
                    </tr>
                ';
            }

            /*$data = $c->loadrecord();
            foreach($data as $row)
            $data = $c->loadrecord();
            foreach ($data as $row) 
            {
                echo'
                    <tr>
                        <td>'.$row['id'].'</td>
                        <td>'.$row['name'].'</td>
                        <td>'.$row['age'].'</td>
                        <td>'.$row['email'].'</td>
                        <td>'.$row['gender'].'</td>
                    </tr>
                ';
            }*/
        ?>
    </table>
</div>
</body>
</html>