


    <?php if (stripos($_SERVER['REQUEST_URI'], 'registration')): ?>
      <script src="/assets/scripts/userAuth.js"></script>
    <?php endif; ?>
    <?php if (stripos($_SERVER['REQUEST_URI'], 'index')): ?>
      <?php if (isset($_SESSION['user']['name'])) : ?>
      <script src="/assets/scripts/votes.js"></script>
      <script src="/assets/scripts/generalui.js"></script>
      <?php endif; ?>
    <?php endif; ?>
    <?php if (stripos($_SERVER['REQUEST_URI'], 'profile')): ?>
        <?php if (isset($_SESSION['user']['name'])) : ?>
          <script src="/assets/scripts/profile.js"></script>
        <?php endif; ?>
    <?php endif; ?>
    <?php if (stripos($_SERVER['REQUEST_URI'], 'comments')): ?>
      <?php if (isset($_SESSION['user']['name'])) : ?>
      <script src="/assets/scripts/comments.js"></script>
      <?php endif; ?>
    <?php endif; ?>
  


</body>
</html>
