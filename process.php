<?php
session_start();

include('conn.php');


//update users
if(isset($_POST['update_users_btn'])) {
  $u_id = $_POST['u_id'];
  $u_fname = $_POST['u_fname'];
  $u_lname = $_POST['u_lname'];
  $u_email = $_POST['u_email'];
  $u_pass = $_POST['u_pass'];

  // Hash the password
  $hashed_password = password_hash($u_pass, PASSWORD_DEFAULT);

  try {
      $query = "UPDATE users SET u_fname=:u_fname, u_lname=:u_lname, u_email=:u_email, u_pass=:u_pass WHERE u_id=:u_id LIMIT 1";
      $statement = $conn->prepare($query);
      $data = [
          ':u_fname' => $u_fname,
          ':u_lname' => $u_lname,
          ':u_email' => $u_email,
          ':u_pass' => $hashed_password, // Use the hashed password here
          ':u_id' => $u_id,
      ];

      $query_execute = $statement->execute($data);

      if($query_execute) {
          $_SESSION['message'] = "Updated Users Successfully";
          header('location: edituser.php');
          exit(0);
      } else {
          $_SESSION['message'] = "Not Updated";
          header('location: edituser.php');
          exit(0);
      }

  } catch (PDOException $e) {
      echo $e->getMessage();
  }
}

if (isset($_POST['registerUser'])) {
  $u_id = $_POST['u_id'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $pass = $_POST['pass1'];
  $confirmPass = $_POST['pass2'];

  if ($pass == $confirmPass) {
      $hash = password_hash($pass, PASSWORD_DEFAULT);
      $addUser = $conn->prepare("INSERT INTO users (u_id, u_fname, u_lname, u_email, u_pass) VALUES(?, ?, ?, ?)");
      $addUser->execute([
          $u_id,
          $fname,
          $lname,
          $email,
          $pass,
          $hash
      ]);

      $msg = "User registered succesfully!";
      header("Location: register.php?msg=$msg");
  } else {
      $msg = "Password do not match!";
      header("Location: register.php?msg=$msg");
  }
}



if(isset($_POST['delete_student']))
{
    $personal_info_id = $_POST['delete_student'];

  try {

    $query = "DELETE FROM personal_info WHERE personal_info_id=:personal_info_id";
    $statement = $conn->prepare($query);
    $data = [':personal_info_id' => $personal_info_id
    ];
    $query_execute = $statement->execute($data);

    if($query_execute)
    {
      $_SESSION['message'] = "Deleted Successfully";
      header('location: index.php');
      exit(0);
    }
    else 
    {
      $_SESSION['message'] = "Not Deleted";
      header('location: index.php');
      exit(0);
    }

  }catch(PDOException $e){
    echo $e->getMessage();
  }
}

if(isset($_POST['update_student_btn']))
{
  $personal_info_id = $_POST['personal_info_id'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $address = $_POST['address'];
  $age = $_POST['age'];

  try {
    $query = "UPDATE personal_info SET fname = ?, lname = ?, address = ?, age = ? WHERE personal_info_id = ?";
    $statement = $conn->prepare($query);
    $statement->execute([$fname, $lname, $address, $age, $personal_info_id]);

    $_SESSION['message'] = "Updated Successfully";
    header('location: index.php');
    exit;
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}
}

if(isset($_POST['add_student_btn']))
{
    $personal_info_id = $_POST['personal_info_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $age = $_POST['age'];

    $query = "INSERT INTO personal_info (personal_info_id, fname, lname, address, age) VALUES (:personal_info_id, :fname, :lname, :address, :age)";
    $query_run = $conn->prepare($query);

    $data = [
        ':personal_info_id' => $personal_info_id,
        ':fname' => $fname,
        ':lname' => $lname,
        ':address' => $address,
        ':age' => $age,
    ];
    $query_execute = $query_run->execute($data);

    if($query_execute)
    {
        $_SESSION['message'] = "Added Successfully";
        header('location: index.php');
        exit(0);
    }
    else 
    {
        $_SESSION['message'] = "Not Added";
        header('location: index.php');
        exit(0);
    }
}

if (isset($_POST['login'])) {
  $u_email = $_POST['email'];
  $u_pass = $_POST['pass'];

  $getData = $conn->prepare("SELECT * FROM users WHERE u_email = ?");
  $getData->execute([$u_email]);

  foreach ($getData as $data) {
      if ($data['u_email'] == $u_email && password_verify($u_pass, $data['u_pass'])) {
        session_start();  
          $_SESSION['logged_in'] = true;
          $_SESSION['u_id'] = $data['u_id'];

          $msg = "User logged-in successfully!";
          header("Location: index.php");
      } else {
          $msg = "Email or Password do not match";
          header("Location: login.php?msg=$msg");
      }
  }
}
// for logout
if (isset($_GET['logout'])) {
  session_start();
  unset($_SESSION['logged_in']);
  unset($_SESSION['user_id']); 
  
  header("Location: login.php");
}
?>