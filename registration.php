<?php
require 'views/header.php';
 ?>


<div class="container py-2">
<article>
    <h1>Registration</h1>

    <p style="color: red; margin: 0; position: absolute; right: 0;"class="deniedUsername small"></p>
    <form action="app/auth/registration.php" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input id="usernameInput" class="form-control" placeholder="Please choose a username." type="text" name="username" " required>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" placeholder="Please provide your email address." required>

        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" placeholder="Please choose your password " required>

        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Repeat password</label>
            <input class="form-control" type="password" name="passwordRep" required placeholder="Please repeat your password">

        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</article>
</div>

<?php require __DIR__.'/views/footer.php'; ?>
