<?php
include('conn.php');

if(isset($_GET['id'])) {
    $personal_info_id = $_GET['id'];

    $query = "SELECT * FROM personal_info WHERE personal_info_id=:personal_info_id LIMIT 1";
    $statement = $conn->prepare($query);
    $data = [':personal_info_id' => $personal_info_id];
    $statement->execute($data);

    $result = $statement->fetch(PDO::FETCH_OBJ);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Edit & Update Student Information</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h1> EDIT & UPDATE CLIENT INFORMATION
                            <a href="index.php" class="btn btn-danger float-end">Back</a>
                        </h1>
                    </div>
                    <div class="card-body">
                        <form action="process.php" method="POST">
                            <input type="hidden" name="personal_info_id" value="<?= $result->personal_info_id ?>">
                            <div class="mb-3">
                                <label>Firstname</label>
                                <input type="text" name="fname" value="<?= $result->fname ?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Lastname</label>
                                <input type="text" name="lname" value="<?= $result->lname ?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Address</label>
                                <input type="text" name="address" value="<?= $result->address ?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Age</label>
                                <input type="text" name="age" value="<?= $result->age ?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="update_student_btn" class="btn btn-primary">Update Student</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
