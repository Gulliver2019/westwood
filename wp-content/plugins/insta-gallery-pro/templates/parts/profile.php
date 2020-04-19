<div class="insta-gallery-profile">
  <div class="avatar">
    <img src="<?php echo esc_html($profile_info['picture']); ?>">
  </div>
  <div class="info">
    <div>
      <span class="user"><?php echo esc_html($profile_info['user']); ?></span><span class="separator">•</span><a class="follow" href="<?php echo esc_url($profile_info['link']); ?>" title="<?php echo esc_html($profile_info['name']); ?>" target="_blank" rel="noopener"><?php esc_html_e('Follow', 'insta-gallery'); ?></a>
      <?php if ($instagram_feed['insta_box-desc']): ?>
        <div class="description"><?php echo esc_html($instagram_feed['insta_box-desc']); ?></div>
      <?php endif; ?>
    </div>
  </div>
</div>