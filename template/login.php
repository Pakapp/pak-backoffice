<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) && $_POST['username'] != '' && isset($_POST['password']) && $_POST['password'] != '') {
        if ($_POST['username'] == 'admin' && $_POST['password'] == '1234') {
            $_SESSION['PAK_ID'] = 'admin';
        }
    }
}
if (isset($_SESSION['PAK_ID'])) {
    redirect(HOST);
}
?>
  <form name="login" method="post">
    <div class="form-group">
      <label class="control-label">Username</label>
      <div>
        <input type="text" class="form-control" id="username" name="username" placeholder="username">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label">Password</label>
      <div>
        <input type="password" class="form-control" id="password" name="password" placeholder="password">
      </div>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
