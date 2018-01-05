  </div> <!-- !END .container -->
</div> <!-- !END #wrapper -->

<footer id="main-footer">
  <div class="container">
    <div class="row">
      <div class="col-sm-3">
        <h3>
          <a href="<?php echo home_url(); ?>">
              <?php bloginfo('name'); ?>
          </a>
        </h3>
        <p>&copy; <?php bloginfo('name'); ?> <?= date('Y'); ?></p>
      </div>
      <div class="col-sm-3">
        <div class="footer-widgets">
          <?php dynamic_sidebar( 'footer-widgets' ); ?>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="footer-widgets">
          <?php dynamic_sidebar( 'secondary-footer-widgets' ); ?>
        </div>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
