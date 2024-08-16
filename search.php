<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to ForumHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        #main_container{
            min-height: 87vh;
        }
    </style>     
</head>

<body>
    <?php include 'partials/_dbconnect.php' ?>
    <?php include 'partials/header.php' ?>

    <!-- Search Results starts from here -->
    <div class="container" id="main_container">
        <h1>Search Results for <em>"<?php echo $_GET['search'];?>"</em></h1>

        <?php 
            $query = $_GET['search'];
            $sql = "SELECT * FROM threads WHERE MATCH(thread_title, thread_desc) AGAINST ('$query')";
            $result = mysqli_query($conn,$sql);
            $noResult = true;
            while($row = mysqli_fetch_assoc($result)){
                $noResult = false;
                $thread_id = $row['thread_id'];
                $title= $row['thread_title'];
                $desc= $row['thread_desc'];
                $url = "thread.php?threadid=". $thread_id;
                
                echo '<div class="result my-4">
                        <a href="' . $url . '" class="text-dark my-4"><h3>'. $title. '</h3></a>
                        <p>'. $desc . '</p>
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
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                crossorigin="anonymous">
            </script>
</body>

</html>