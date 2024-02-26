<?php
include('conn.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Add Student</title>
</head>
<body class="img js-fullheight" style="background-image: url(bg.jpg);">
    <div class="container">
        <div class="row">
              <div class="col-md-8 mt-4">

              <div class="card">
                <div class="card-header">
                <h1>ADD STUDENT
                <a href="index.php" class="btn btn-danger float-end">Back</a>
            </h1>
                </div>
                <div class="card-body">

                     <form action="process.php" method="POST">

                            <div class="mb-3">
                                <label>Firstname</label>
                                <input type="text" name="fname" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Lastname</label>
                                <input type="text" name="lname" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Age</label>
                                <input type="text" name="age" class="form-control">
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="add_student_btn" class="btn btn-primary">Add Student</button>
                            </div>
                            
                     </form>

                </div>
              </div>

              </div>
        </div>
    </div>


</body>
</html>