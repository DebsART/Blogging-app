<?php

/*******w******** 
    
    Name:Deborah Ekpeneidua
    Date: feb 13, 2024
    Description: blogging application | new post markup

****************/

require('connect.php');
require('authenticate.php');



 if (isset($_POST['title']) && isset($_POST['content'])) {

        //validation for title and content length
        if(strlen(trim($_POST['title'])) == 0){
            $errors[] = "Please enter title with more than one character";
        }

        if(strlen(trim($_POST['content'])) == 0){
            $errors[] = "Please enter content with more than one character";
        }


        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        //with a query, adding to table columns parameters representing form values
        $query = "INSERT INTO blog (title, content) VALUES (:title, :content)";
        $statement = $db->prepare($query);

        //bind form values to parameters
        $statement->bindValue(':title', $title);
        $statement->bindValue(':content', $content);

        //execute the insert into table
        $statement->execute();

         //redirect back to indexx.php
        header("Location:indexx.php?");
        exit;

}

    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>My Blog Post!</title>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
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
                        <label for="title">Title</label><br/>
                        <input required type="text" id="title" name="title" size="50" /> <br/>

                        <label for="content">Content</label>
                        <textarea required cols="50" rows="10" id="content" name="content"></textarea>

                        <button type="submit">Create</button>
                    </fieldset>
                </form>
            </div>
            <h3>Copyright 2024 - No Rights Reserved</h3>
        </div>
   
    
</body>
</html>