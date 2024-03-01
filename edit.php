<?php

/*******w******** 
    
    Name:Deborah Ekpeneidua
    Date: feb 13, 2024
    Description: blogging application | edit post markup

****************/
require('authenticate.php');
require('connect.php');



//retrieve database data with GET url id paramater 
if (isset($_GET['id'])) {
        $id = intval($_GET['id']);

        $query = "SELECT * FROM blog WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);

        $statement->execute();

        $row = $statement->fetch();

    } else {
        $id = false; // False if we are not UPDATING or SELECTING.
    }


//query to insert updated post
if ($_POST && isset($_POST['title']) && isset($_POST['content']) && isset($_POST['id'])) {
        // Sanitize user input to escape HTML entities and filter out dangerous characters.
        $title  = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $id      = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        
        // Build the parameterized SQL query and bind to the above sanitized values.
        $query     = "UPDATE blog SET title = :title, content = :content WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':title', $title);        
        $statement->bindValue(':content', $content);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        
        // Execute the INSERT.
        $statement->execute();
        
        // Redirect after update.
        header("Location: edit.php?id={$id}");
        exit;
    } 

//redirect if id in GET url is not a number
if(!is_numeric($_GET['id'])){
    header("Location:indexx.php");
    exit;
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Edit this Post!</title>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
        <?php if($id):?>
            <div id="container">
            <div id="header">
                <img id="img" src="images/blog.png" alt="blog icon">
                <h1>My Amazing Blog - New Post</h1>
            </div>

            <button id="home" class="topButtons" onclick="location.href = 'indexx.php' ">Home</button>
            <button id="newPost" class="topButtons" onclick="location.href = 'post.php' ">New Post</button>

            <div id="formBorder">
                <form id="blogForm" name="blogForm" method="post">
                    <fieldset>
                        <legend>New Blog Post</legend>
                        <!-- Hidden input for the quote primary key. -->
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">

                        <label for="title">Title</label><br/>
                        <input type="text" id="title" name="title" value="<?= $row['title']?>" size="50" /> <br/>

                        <label for="content">Content</label>
                        <textarea cols="50" rows="10" id="content" name="content" ><?=$row['content']?></textarea>

                        <button type="submit">Update</button>

                        <button type="submit" onclick="location.href = 'delete.php?id=<?=$row['id']?>' "> Delete</button>
                    </fieldset>
                </form>
            </div>
            <h3>Copyright 2024 - No Rights Reserved</h3>
        </div>
    <?php endif ?>

</body>
</html>