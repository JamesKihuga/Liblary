<?php
include 'protect.php';
if ( isset($_REQUEST["title"]) )
{
    //Get our form data
    $subject = $_REQUEST["subject"];
    $title = $_REQUEST["title"]; //$_GET $_POST
    $serial_no = $_REQUEST["serial_no"];

    $target_dir = "uploads/";
    $target_file = $target_dir .rand(1000000,10000000). basename($_FILES["cover"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = ["png", "jpeg", "jpg", "gif",];
    $allowed = in_array($imageFileType, $allowed_types);

    if ($allowed and move_uploaded_file($_FILES["cover"]["tmp_name"], $target_file)) {
// echo "Uploaded";
        $status = 1;
    } else {
//echo "Failed";
        $status = 2;
    }

    require_once 'connect.php';
    $sql = "INSERT INTO `books`(`id`, `subject`, `title`, `serial_no`)
                        VALUES (null,'$subject','$title','$serial_no')";
    mysqli_query($con, $sql) or die( mysqli_error($con) );

    mysqli_close($con);
    setcookie("success","book Added", time()+3);
    header("location:add-books.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Product</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<?php include 'navbar.php' ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8 col-md-5">
            <h4>New book</h4>

            <?php include 'alert.php' ?>

            <form action="add_books.php" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="subject" required>
                </div>
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" required>
                </div>
                <div class="form-group">
                    <label>serial_no</label>
                    <input type="number" class="form-control" name="serial_no" required>
                </div>

                <div class="form-group">
                    <label>cover</label>
                    <input type="file" accept="*/*" max-size="2024" class="form-control-file border" name="cover" required>
                </div>


                <button class="btn btn-danger">Add book</button>

            </form>
        </div>
    </div>
</div>


</body>
</html>
