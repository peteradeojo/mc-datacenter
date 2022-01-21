<?php


use Patient\Database;

require 'init.php';

if ($_POST) {
  $username = trim(htmlspecialchars(strip_tags($_POST['username'])));
  $password = trim(htmlspecialchars(strip_tags($_POST['password'])));
  $password = sha1($password);

  try {
    $db = new Database();
    $db->connect();
    $user = $db->select('login', '*', "username='$username' and password='$password'")[0];
    if ($user) {
      print_r($user);
      exit();
      $_SESSION['login'] = true;
      $_SESSION['user'] = $user;
      // print_r($_SESSION);
    }
    header("Location: /");
  } catch (Exception $e) {
    echo $e->getMessage();
    flash(['message' => $e->getMessage(), 'mode' => 'danger', 'title' => 'Login']);
  }

  exit();
}

require 'header.php';
?>
<main>
  <div class="container mt-4">
    <div class="col-md-6 m-auto border rounded p-3">
      <h3>Login</h3>

      <form action="" method="post">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" required="required" class="form-control">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" required="required" class="form-control">
        </div>
        <div class="form-group mt-3">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</main>
<?php
require 'footer.php';
