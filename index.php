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
    </style>     
</head>

<body>
    <?php include 'partials/_dbconnect.php' ?>
    <?php include 'partials/header.php' ?>

    <!-- Slider starts from here -->
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./images/1.jpg" class="d-block w-100" alt="..." height="400px" width="2400px">
            </div>
            <div class="carousel-item">
                <img src="./images/2.jpg" class="d-block w-100" alt="..." height="400px" width="2400px">
            </div>
            <div class="carousel-item">
                <img src="./images/3.jpg" class="d-block w-100" alt="..." height="400px" width="2400px">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Categories container starts from here -->
    <div class="container my-3" id="ques">
        <h1 class="text-center">ForumHub - Browse Catagories</h1>
        <div class="row my-3">

            <!-- Card items start from here , use for loop to iterate      -->
        <?php 
            $sql = "SELECT * FROM `categories`";
            $result = mysqli_query($conn , $sql);
       
            while($row = mysqli_fetch_assoc($result)){
                $id = $row['category_id'];
                $cat = $row['category_name'];
                $desc = $row['category_desc'];
                echo    '<div class="col-md-4 my-4">
                            <div class="card my-4" style="width: 18rem;">
                                <img src="./images/' . $cat . '.jpg" class="card-img-top" alt="..." width="600px" height="200px">
                                <div class="card-body">
                                    <h5 class="card-title"><a class="text-dark" href="threadlist.php?catid=' . $id . '">' . $cat . '</a></h5>
                                    <p class="card-text">' . substr($desc,0,50) . '...</p>
                                    <a href="threadlist.php?catid=' . $id . '" class="btn btn-primary">View Threads</a>
                                </div>
                            </div>
                        </div>';
            }
        ?>
        </div>
    </div>


            <?php include 'partials/footer.php' ?>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                crossorigin="anonymous">
            </script>
</body>

</html>