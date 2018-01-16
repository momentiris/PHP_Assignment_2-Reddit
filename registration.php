<?php
require 'views/header.php';
 ?>

<div class="container py-3">
 <h4>Registration</h4>
</div>
<div class="container py-2 registrationWrap">
<article class="">
    <form class="registrationForm" action="app/auth/registration.php" method="post">
      <!-- /form-group -->
        <div class="form-group">
          <p class="deniedUsername small"></p>
            <label for="username">Username:</label></br>
            <input class="inputArea" id="usernameInput" class="form-control" placeholder="Please choose a username." type="text" name="username" required>
        </div>
        <!-- /form-group -->
        <div class="form-group">
            <label for="email">Email:</label></br>
            <input class="inputArea" type="email" name="email" placeholder="Please provide your email address." required>
        </div>
        <!-- /form-group -->
        <div class="form-group">
            <label for="password">Password:</label></br>
            <input class="inputArea" type="password" name="password" placeholder="Please choose your password " required>
        </div>
        <!-- /form-group -->
    
        <button class="submit" type="submit">Register</button>
    </form>
</article>
</div>

<?php require __DIR__.'/views/footer.php'; ?>
