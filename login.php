<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1>Login</h1>

    <form action="app/auth/login.php" method="post">
        <div class="form-group">
            <label for="email">Username</label>
            <input class="form-control" type="text" name="username" placeholder="Pls dont hack" required>
            <small class="form-text text-muted">Please provide the your email address.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" required>
            <small class="form-text text-muted">Please provide the your password (passphrase).</small>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
