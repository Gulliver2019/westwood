<div class="insta-gallery-image-card">
  <?php if ($instagram_feed['card']['info']): ?>
    <div class="ig-card-info">
      <div class="ig-card-date"><?php echo esc_attr($item['date']); ?></div>  
      <div class="ig-card-likes">
        <i class="qligg-icon-heart"></i>
        <?php echo esc_attr($item['likes']); ?>
      </div>
      <div class="ig-card-comments">
        <i class="qligg-icon-comment"></i>
        <?php echo esc_attr($item['comments']); ?>
      </div>    
    </div>
  <?php endif; ?>
  <?php if ($instagram_feed['card']['caption']): ?>
    <div class="ig-card-caption">
      <?php echo wp_trim_words(apply_filters('get_the_excerpt', $item['caption']), $instagram_feed['card']['length']); ?>
    </div>
  <?php endif; ?>
</div>

