<?php
include 'header.php'; 
include('conn.php');

// Pagination
$limit = 5; // Number of info per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Search functionality
$search = isset($_GET['search']) ? $_GET['search'] : '';
$where = $search ? "WHERE fname LIKE '%$search%' OR lname LIKE '%$search%' OR address LIKE '%$search%' OR age LIKE '%$search%'" : '';

// Fetch student info with pagination and search
$query = "SELECT * FROM personal_info $where LIMIT $start, $limit";
$result = $conn->query($query);

// Total number of info
$totalQuery = "SELECT COUNT(*) AS total FROM personal_info $where";
$totalResult = $conn->query($totalQuery);
$totalData = $totalResult->fetch(PDO::FETCH_ASSOC)['total'];
$totalPages = ceil($totalData / $limit);

// Display message if set
if (isset($_SESSION['message'])) {
    echo '<div class="alert alert-info">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
    <title>Home</title>
</head>
<body>
    <div class="container">
        <div class="row">
              <div class="col-md-8 mt-4">

                <?php if(isset( $_SESSION['message'])): ?>
                      <h5 class="alert alert-success"> <?= $_SESSION['message']; ?></h5>
                <?php 
                unset($_SESSION['message']);
                endif; ?>

              <div class="card">
                <div class="card-header">
                <h3>Student Information
                <a href="personalinfo-add.php" class="btn btn-primary float-end">Add Student</a></h3>
                </div>
                <form action="" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search by name or address" name="search" value="<?= $search ?>">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </div>
        </form>

                <div class="card-body">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Address</th>
                        <th>Age</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                      <tbody>
                        <?php  
                         $query =  "SELECT * FROM personal_info";
                         $statement = $conn->prepare($query);
                         $statement->execute();
                         $statement->setFetchMode(PDO::FETCH_OBJ);
                         $result = $statement->fetchAll();
                         if($result)
                         {
                            foreach($result as $row)
                            {
                                ?>
                                <tr>
                            <td><?= $row->personal_info_id;?></td>
                            <td><?= $row->fname;?></td>
                            <td><?= $row->lname;?></td>
                            <td><?= $row->address;?></td>
                            <td><?= $row->age;?></td>
                            <td>
                              <a href="edit.php?id=<?= $row->personal_info_id;?>" class="btn btn-primary">Edit</a>
                            </td>
                          <td>
                            <form action="process.php" method="POST">
                              <button type="submit" name="delete_student" value="<?=$row->personal_info_id;?>" class="btn btn-danger">Delete</button>
                            </form>
                          </td>
                                </tr>
                                <?php 
                            }
                         }
                         else
                         {
                          ?>
                          <tr>
                            <td colspan="5">No Record Found</td>
                          </tr>
                          <?php
                          
                         }
                        ?>
                        <tr>
                          <td></td>
                        </tr>
                      </tbody>
                  </table>
                   <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>&search=<?= $search ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>
    <a href="edituser.php" class="btn btn-primary float-end">Users</a></h3>
</body>
</html>