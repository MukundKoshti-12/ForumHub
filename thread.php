<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to ForumHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>
        #ques{
            min-height: 87vh;
        }
        .font-weight-bold{
            font-weight : Bold;
        }
    </style>
</head>

<body>
    <?php include 'partials/_dbconnect.php' ?>
    <?php include 'partials/header.php' ?>

    <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `threads` WHERE thread_id = $id ;";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_user_id = $row['thread_user_id'];

            $sql2 = "Select user_email from `users` where sno = '$thread_user_id';";
            $result2 = mysqli_query($conn,$sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $posted_by = $row2['user_email'];
        };
    ?>

<?php 
        $method =  $_SERVER['REQUEST_METHOD'];
        $showAlert = false;
        // Inserting data of thread in database
        if($method == "POST"){
            $content = $_POST['content'];
            $sno = $_POST['sno'];

            $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$content', '$id', '$sno', current_timestamp());";
            $result = mysqli_query($conn,$sql);
            $showAlert = true;
            
            if($showAlert){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                       <strong>Success!</strong>Your Comment is successfully added.
                       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>';
            }
        }
    ?>


    <div class="p-5 my-4 container bg-body-tertiary border rounded-3">
        <div class="jumbotron">
            <h1 class="display-4 mb-5"><?php echo $title; ?></h1>
            <p class="lead"><?php echo $desc; ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do not
                post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post
                questions. Remain respectful of other members at all times.</p>

            <p>Posted By : <b><?php echo $posted_by ?></b></p>    
        </div>
    </div>
    <?php
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
            echo '<div class="container">
                <h1 class="py-2">Post a Comment</h1>
                <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
                    <div class="form-group my-4">
                        <label for="exampleFormControlTextarea1">Add a Comment</label>
                        <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                    </div>
                    <input type="hidden" name="sno" value="' . $_SESSION['sno'] . '">
                    <button type="submit" class="btn btn-success">Post Comment</button>
                </form>
            </div>';
        }

        else{
            echo '<div class="container">
                <h1 class="py-2">Post a Comment</h1>
                <p class="lead">You are not logged in.Please login to post a comment.</p>
             </div>';
        }
    
    ?>

    <div class="container" id="ques">
        <h1 class="py-2">Discussion</h1>

        <?php
        $noResult = true;
        $sql = "SELECT * FROM `comments` WHERE thread_id=$id;";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $content= $row['comment_content'];

            $content= str_replace("<","&lt",$content);
            $content= str_replace(">","&gt",$content);

            $comment_time= $row['comment_time'];
            $noResult = false;
            $comment_by = $row['comment_by'];
            $sql2 = "Select user_email from `users` where sno = '$comment_by'";
            $result2 = mysqli_query($conn,$sql2);
            $row2 = mysqli_fetch_assoc($result2);
            
            echo '<div class="media my-3">
            <img src="images/userdefault.png" width="54px" class="mr-3" alt="...">
            <div class="media-body mx-4" style="display: inline-block">
             <p class="font-weight-bold my-0">'. $row2['user_email'] . ' at '. $comment_time. '</p> 
            ' . $content . '
            </div>
            </div>';
            
        }

        if($noResult){
            echo '<div class="jumbotron jumbotron-fluid bg-primary">
                    <div class="container py-4">
                            <p class="display-4">No Comments Found</p>
                            <p class="lead"> Be the first person to Comment</p>
                    </div>
                  </div>';
        }

        ?>

    </div>
    <?php include 'partials/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>