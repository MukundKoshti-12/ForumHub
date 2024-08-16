<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to ForumHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
    #ques {
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
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `categories` WHERE category_id = $id ;";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $catName = $row['category_name'];
            $catDesc = $row['category_desc'];
        };
    ?>

    <?php 
        $method =  $_SERVER['REQUEST_METHOD'];
        $showAlert = false;
        // Inserting data of thread in database
        if($method == "POST"){
            $th_title = $_POST['title'];
            $th_desc = $_POST['desc'];

            $th_title = str_replace("<","&lt",$th_title);
            $th_title = str_replace(">","&gt",$th_title);

            $th_desc = str_replace("<","&lt",$th_desc);
            $th_desc = str_replace(">","&gt",$th_desc);

            $sno = $_POST['sno'];
            $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp());";
            $result = mysqli_query($conn,$sql);
            $showAlert = true;
            
            if($showAlert){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                       <strong>Success!</strong> Your thread has been added.Please wait for community to react.
                       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>';
            }
        }
    ?>

    <div class="p-5 my-4 container bg-body-tertiary border rounded-3">
        <div class="jumbotron py-4">
            <h1 class="display-4 mb-5">Welcome to <?php echo $catName; ?> forums</h1>
            <p class="lead"><?php echo $catDesc; ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do not
                post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post
                questions. Remain respectful of other members at all times.</p>
        </div>
    </div>
    <!-- $_SERVER['REQUEST_URI'] IS GET THE PROPER URI OF THE CURRENT WEB PAGE WITH PARAMETERS PASSED AS WELL -->
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        echo '<div class="container">
            <h1 class="py-2">Start a Discussion</h1>
            <form action="'.  $_SERVER['REQUEST_URI'] . '" method="post">
                
                <div class="form-group my-4">
                    <label for="exampleInputEmail1">Problem Title</label>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">Keep your title as short and crisp as
                        possible</small>
                </div>
                <div class="form-group my-4">
                    <label for="exampleFormControlTextarea1">Elaborate Your Concern</label>
                    <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                </div>
                <input type="hidden" name="sno" value="' . $_SESSION['sno'] . '">
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
            </div>';
    }   
    
    else{
        echo '<div class="container">
                <h1 class="py-2">Start a Discussion</h1>
                <p class="lead">You are not logged in.Please login to start a discussion.</p>
             </div>';
    }
    ?>
    
    <div class="container" id="ques">
        <h1 class="py-2">Browse Questions</h1>
        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
        $result = mysqli_query($conn,$sql);
        $noResult = true;
        while($row = mysqli_fetch_assoc($result)){
            $noResult = false;
            $id = $row['thread_id'];
            $title= $row['thread_title'];
            $desc= $row['thread_desc'];
            $thread_time = $row['timestamp'];
            $thread_user_id = $row['thread_user_id'];
            $sql2 = "Select user_email from `users` where sno = '$thread_user_id'";
            $result2 = mysqli_query($conn,$sql2);
            $row2 = mysqli_fetch_assoc($result2);
            
            
            echo '<div class="media my-3">
            <img src="images/userdefault.png" width="54px" class="mr-3" alt="...">
            <div class="media-body mx-4" style="display: inline-block">'. 
            '<h5 class="mt-0"><a class="text-dark" href="thread.php?threadid=' . $id . '">' . $title . '</a></h5>
            ' . $desc .
            '</div>'. '<div class="font-weight-bold my-0">Asked by : '. $row2['user_email'] . ' at ' . $thread_time . '</div>'.
            '</div>';
            
        }

        if($noResult){
            echo '<div class="jumbotron jumbotron-fluid bg-primary">
                    <div class="container py-4">
                        <p class="display-4">No Threads Found</p>
                        <p class="lead"> Be the first person to ask a question</p>
                    </div>
                 </div> ';
        }

        ?>



    </div>

    <?php include 'partials/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>