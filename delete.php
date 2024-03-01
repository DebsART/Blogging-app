<?php

/*******w******** 
    
    Name:Deborah Ekpeneidua
    Date: feb 13, 2024
    Description: blogging application | edit post markup

****************/
require('authenticate.php');
require('connect.php');

//delete row with GET url id parameter
 if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        
        // Build the parameterized SQL query and bind to the above sanitized values.
        $query     = "DELETE FROM blog WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        
        // Execute the INSERT.
        $statement->execute();
        
        // Redirect after update.
        header("Location: indexx.php?id={$id}");
        exit;
    } 



?>


