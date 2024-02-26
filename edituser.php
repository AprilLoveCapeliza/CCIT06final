<?php
include('conn.php');

if(isset($_GET['u_id'])) {
    $users_id = $_GET['u_id'];
    $query = "SELECT * FROM users WHERE u_id=:users_id LIMIT 1";
    $statement = $conn->prepare($query);
    $data = [':users_id' => $users_id];
    $statement->execute($data);
    $result = $statement->fetch(PDO::FETCH_OBJ);
} else {
    // Initialize $result to prevent undefined variable error
    $result = new stdClass();
    $result->u_id = "";
    $result->u_fname = "";
    $result->u_lname = "";
    $result->u_email = "";
    $result->u_pass = "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Edit & Update User Information</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">

            <?php if(isset($_SESSION['message'])): ?>
                    <h5 class="alert alert-success"><?= $_SESSION['message']; ?></h5>
                    <?php unset($_SESSION['message']); ?>
                <?php endif; ?>

                <div class="card">
                    <div class="card-header">
                        <h1>EDIT & UPDATE USER INFORMATION
                            <a href="profile.php" class="btn btn-danger float-end">Back</a>
                        </h1>
                    </div>
                    <div class="card-body">
                        <form action="process.php" method="POST">
                            <input type="hidden" name="users_id" value="<?= $result->u_id ?>">
                            <div class="mb-3">
                                <label>Firstname</label>
                                <input type="text" name="u_fname" value="<?= $result->u_fname ?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Lastname</label>
                                <input type="text" name="u_lname" value="<?= $result->u_lname ?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="text" name="u_email" value="<?= $result->u_email ?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="text" name="u_pass" value="<?= $result->u_pass ?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="update_users_btn" class="btn btn-primary">Update Users</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
