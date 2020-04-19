<?php if ($instagram_feed['insta_button']) : ?>
  <div class="insta-gallery-actions">
    <a href="<?php echo esc_url($profile_info['link']); ?>" target="blank" class="insta-gallery-button follow"><i class="qligg-icon-instagram-o"></i><?php echo esc_html($instagram_feed['insta_button-text']); ?></a>
  </div>
<?php endif; ?>