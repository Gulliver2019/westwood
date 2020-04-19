<?php if ($instagram_feed['insta_button_load'] || $instagram_feed['insta_button']) : ?>
  <div class="insta-gallery-actions">
    <?php if ($instagram_feed['insta_button_load']) : ?>
      <a href="#" target="blank" class="insta-gallery-button load"><?php echo esc_html($instagram_feed['insta_button_load-text']); ?></a>
    <?php endif; ?>
    <?php if ($instagram_feed['insta_button']) : ?>
      <a href="<?php echo esc_url($profile_info['link']); ?>" target="blank" class="insta-gallery-button follow"><i class="qligg-icon-instagram-o"></i><?php echo esc_html($instagram_feed['insta_button-text']); ?></a>
      <?php endif; ?>
  </div>
<?php endif; ?>