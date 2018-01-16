<?php require __DIR__.'/views/header.php'; ?>
<div class="container py-3">
 <h4>Login</h4>
</div>
<div class="container py-2 registrationWrap"
  <div class="loginform">
  <article>

      <form action="app/auth/login.php" method="post">
          <div class="form-group">
              <label for="email">Username:</label> </br>
              <input class="inputArea" type="text" name="username" placeholder="Pls dont hack" required>
          </div><!-- /form-group -->

          <div class="form-group">
              <label for="password">Password:</label></br>
              <input class="inputArea" type="password" name="password" required>
          </div><!-- /form-group -->
          <button type="submit">Login</button>
      </form>
  </article>
  </div>
</div>

<?php require __DIR__.'/views/footer.php'; ?>
