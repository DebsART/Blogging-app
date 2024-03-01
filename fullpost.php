<?php

/*******w******** 
    
    Name:Deborah Ekpeneidua
    Date: feb 13, 2024
    Description: blogging application markup

****************/

require('connect.php');

//retrieving blog post with GET url
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $query = "SELECT id, title, content, DATE_FORMAT(date_time, '%M %d, %Y, %h:%i %p') AS new_date FROM blog WHERE id= :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);

    $statement->execute();

    $row =$statement->fetch();

    } 



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles2.css">
    <title>Welcome to my Blog!</title>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <?php if($id):?>

        <div id="container">
            <div id="header">
                <img id="img" src="images/blog.png" alt="blog icon">
                <h1>My Amazing Blog </h1>
                <p><a href="post.php">New Blog</a></p>
            </div>

             <div class="blogHeaders">
                <h2><?= $row['title']?></h2>
                <a href="edit.php?id=<?=$row['id']?>">edit</a>
            </div>  

            <h5><?= $row['new_date']?></h5>

            <p><?= $row['content']?></p>

        </div>
    <?php endif ?>
</body>
</html>
