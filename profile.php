<?php
include 'header.php'; 
include('conn.php');
if(!isset($_SESSION['logged_in'])){
    header("Location: login.php");
}
// Pagination variables
$records_per_page = 5; // Change this to set the number of records per page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$start_from = ($page - 1) * $records_per_page;

// Search query
$search = isset($_GET['search']) ? $_GET['search'] : '';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Home</title>
</head>
<style>
        body{
            background-color: yellowgreen;
        }
        h3{
            text-align: center;
            color: darkgoldenrod;
        }
</style>
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
                        <h3>Users Profile
                            <a href="index.php" class="btn btn-primary float-end">Back</a>
                    </div>

                    <div class="card-body">
                        <form method="GET" action="">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Search" name="search" value="<?= htmlspecialchars($search) ?>">
                                <button class="btn btn-outline-secondary" type="submit">Search</button>
                            </div>
                        </form>

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  
                                $query = "SELECT * FROM users WHERE u_fname LIKE :search OR u_lname LIKE :search LIMIT $start_from, $records_per_page";
                                $statement = $conn->prepare($query);
                                $statement->bindValue(':search', '%' . $search . '%');
                                $statement->execute();
                                $statement->setFetchMode(PDO::FETCH_OBJ);
                                $result = $statement->fetchAll();
                                if($result) {
                                    foreach($result as $row) {
                                ?>
                                <tr>
                                    <td><?= $row->u_id;?></td>
                                    <td><?= $row->u_fname;?></td>
                                    <td><?= $row->u_lname;?></td>
                                    <td><?= $row->u_email;?></td>
                                    <td><?= $row->u_pass;?></td>
                                    <td>
                                        <a href="edituser.php?u_id=<?= $row->u_id;?>" class="btn btn-primary">Edit</a>
                                    </td>
                                </tr>
                                <?php 
                                    }
                                } else {
                                ?>
                                <tr>
                                    <td colspan="5">No Record Found</td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>

                        <?php
                        // Pagination links
                        $query = "SELECT COUNT(*) AS total_records FROM users WHERE u_fname LIKE :search OR u_lname LIKE :search";
                        $statement = $conn->prepare($query);
                        $statement->bindValue(':search', '%' . $search . '%');
                        $statement->execute();
                        $result = $statement->fetch(PDO::FETCH_ASSOC);
                        $total_records = $result['total_records'];
                        $total_pages = ceil($total_records / $records_per_page);

                        echo "<ul class='pagination'>";
                        for ($i=1; $i<=$total_pages; $i++) {
                            echo "<li class='page-item'><a class='page-link' href='?page=$i&search=$search'>$i</a></li>";
                        }
                        echo "</ul>";
                        ?>
                    </div>
            </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>