  <?php if(get_field('disclosures_page','option')) { 
    $disc_page = get_field('disclosures_page', 'option');
    if(get_field('visible_disclosure', $disc_page->ID)) {
    ?>
      <div class="bg-secondary text-white d-flex justify-content-center align-items-center text-center pt-3" id="pre-footer">
        <div class="container">
          <?php echo(get_field('visible_disclosure', $disc_page->ID)); ?>
        </div>
      </div>
    <?php }
  }
  ?>
  <footer id="sp-footer" class="bg-secondary text-white d-flex justify-content-center align-items-center">
    <div class="container text-center">
      <a href="#" class="disc-show">Disclosures <span class="fa-sharp fa-angle-down"></span></a>
    </div>
   </footer>
  
  <?php 
    if(get_field('disclosures_page', 'option')) {
      $page = get_field('disclosures_page', 'option');
      ?>
        <section id="disc-section" class="sp-section <?php echo $page->post_name; ?>" data-slug="<?php echo $page->post_name; ?>">
          <div class="sp-main-content">
            <div class="container">
              <h2><?php echo $page->post_title; ?></h2>
              
              <?php
                content_builder($page->ID);
              ?>
            </div>
          </div>
        </section>
      <?php
    }
  ?>
  <?php wp_footer(); ?>
</body>
</html>
