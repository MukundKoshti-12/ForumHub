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
    <?php 

    include 'partials/_dbconnect.php';
    if(isset($email)){

        $email = $_POST['email'];
        $name = $_POST['name'];
        $contact = $_POST['contact'];
        $desc = $_POST['desc'];
        $sql = "INSERT INTO `contacts` (`email`, `name`, `contact`, `desc`) VALUES ('$email', '$name', '$contact', '$desc');";

        $result = mysqli_query($conn,$sql);
    }

    ?>
    <?php include 'partials/header.php' ?>
    <div class="container my-3" id="ques">
        <h1 class="text-center">Contact Us</h1>
        <form action="contact.php" method="post" class="my-4">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="contact">Contact No.</label>
                <input type="tel" class="form-control" id="contact" name="contact">
            </div>
            <div class="form-group">
                <label for="desc">Elaborate Your Concern</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            </div>
            <button class="btn btn-success my-3">Submit</button>
        </form>
    </div>
    <?php include 'partials/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>