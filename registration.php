<?php require __DIR__.'/views/header.php';

$user = $pdo->prepare("SELECT username from users");
$user->execute();
$usernamesGet = $user->fetchAll(PDO::FETCH_ASSOC);
$usernamesJSON = fopen("./assets/JSON/usernames.json", "w");

// $user = JSON_encode($user);

  foreach ($usernamesGet as $key => $value) {

    $usernamesClean = $value['username'];
    var_dump($usernamesJSON);
    fwrite($usernamesJSON,json_encode($usernamesClean));

  }

 ?>



<article>
    <h1>Registration</h1>

    <form action="app/auth/registration.php" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control" type="text" name="username" required>
            <small class="form-text text-muted">Please choose a username.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" required>
            <small class="form-text text-muted">Please provide the your email address.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" required>
            <small class="form-text text-muted">Please choose your password (passphrase).</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Repeat password</label>
            <input class="form-control" type="password" name="passwordRep" required>
            <small class="form-text text-muted">Please repeat your password (passphrase).</small>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
