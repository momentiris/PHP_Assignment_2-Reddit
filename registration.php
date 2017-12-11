<?php require __DIR__.'/views/header.php'; ?>

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

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
