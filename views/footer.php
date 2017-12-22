    </div><!-- /container -->

    <?php if (stripos($_SERVER['REQUEST_URI'], 'registration')): ?>
      <script src="/assets/scripts/userAuth.js"></script>
    <?php endif; ?>
    <?php if (stripos($_SERVER['REQUEST_URI'], 'index')): ?>
      <script src="/assets/scripts/main.js"></script>
      <script src="/assets/scripts/votes.js"></script>

    <?php endif; ?>
</body>
</html>
