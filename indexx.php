<?php

/*******w******** 
    
    Name:Deborah Ekpeneidua
    Date: feb 13, 2024
    Description: blogging application markup

****************/

require('connect.php');

//query to display latest blog
$query = "SELECT id, title, content, DATE_FORMAT(date_time, '%M %d, %Y, %h:%i %p') AS new_date FROM blog ORDER BY id DESC LIMIT 7";
$statement = $db->prepare($query);

$statement->execute();


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
    <div id="container">
        <div id="header">
            <img id="img" src="images/blog.png" alt="blog icon">
            <h1>My Amazing Blog </h1>
            <p><a href="post.php">New Blog</a></p>
        </div>

        <h2>Recently Posted Blog Entries</h2>
        <ul>
            <?php while($row = $statement->fetch()) :?>
                    <?php if ($row > 0):?>
                        <li>
                            <div class="blogHeaders">
                                <h2><a id="titleLink" href="fullpost.php?id=<?= $row['id']?>"><?= $row['title']?></a></h2>
                                <a href="edit.php?id=<?=$row['id']?>">edit</a>
                            </div>  

                            <h5><?= $row['new_date']?></h5>
                           
                            <?php if (strlen($row['content']) > 200):?> 
                               <?php $truncate = substr($row['content'], 0, 200);
                               echo "<p>" . $truncate . "..." . "</p>" ;
                               ?>
                               <a href="fullpost.php?id=<?= $row['id']?>">Read Full Post...</a>
                            <?php else :?>
                                <p><?=$row['content']?></p>
                            <?php endif ?>

                        </li>
                    <?php else:?>
                        <li>No blogs to display at this time</li>
                    <?php endif?>
               
            <?php endwhile ?>
        </ul>
    </div>
    
</body>
</html>