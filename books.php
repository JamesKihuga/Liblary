<?php
include 'protect.php';
if (isset($_REQUEST["subject"]) )
{
    $subject = $_REQUEST["subject"];
    $title = $_REQUEST["title"];
    $serial_no = $_REQUEST["serial_no"];

    $target_dir = "uploads/";
    $target_file = $target_dir .rand(1000000,10000000). basename($_FILES["cover"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = ["png", "jpeg", "jpg", "gif",];
    $allowed = in_array($imageFileType, $allowed_types);

    require_once 'connect.php';
    $sql = "INSERT INTO `books`(`id`, `subject`, `title`, `serial_no`, `cover`) VALUES (null ,'$subject','$title','$serial_no','$target_file')";
    mysqli_query($con, $sql) or die( mysqli_error($con) );

    mysqli_close($con);
    setcookie("success","book Added", time()+3);
    header("location:books.php");
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>books</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body class="bg-info">
<?php include 'navbar.php'?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-5">
            <h4>Add books</h4>
            <form action="books.php" method="post">
                <div class="form-group">
                    <label>subject</label>
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
                    <input type="file" accept="image/*"  class="form-control-file border-info" name="cover" required>
                </div>

                <button class="btn btn-dark">Submit</button>
            </form>
        </div>
    </div>
</div>


</body>


<div class="container p-0">
    <div class="d-inline-block mt-3">
        <div class="row">
            <div class="col-sm-4">
                <h2>Liblary front</h2>
                <p>This  liblary is for public, observe covid 19 protocals
                </p>
                <img src="images/libentry.jpg"class="mx-auto d-block" height="220" alt="">
            </div>
            <div class="col-sm-4">
                <h2>liblary sitting</h2>
                <p>launched  by  his exellency walter on 16th feb 2021</p>
                <img src="images/liblary2.jpg"class="mx-auto d-block" height="220"  alt="">
            </div>
            <div class="col-sm-4">
                <h2>Reserch shelfs</h2>
                <p>The principal
                  <br>
                    mr James kameri</p>
                <img src="images/liblary%203.jpg" class="mx-auto d-block" height="220"  alt="">

            </div>
        </div>
    </div>
</div>
//footer

</html>
