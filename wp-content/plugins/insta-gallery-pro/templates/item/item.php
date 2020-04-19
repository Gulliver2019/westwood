<div id="insta-gallery-item-<?php echo esc_attr($item['id']); ?>" class="insta-gallery-item insta-gallery-cols-<?php echo esc_attr($instagram_feed['columns']); ?> <?php echo in_array($instagram_feed['layout'], array('masonry', 'highlight')) && array_intersect(array_merge((array) $item['i'], (array) $item['id'], $item['hashtags']), $instagram_feed['highlight']) ? 'highlight' : ''; ?><?php echo ($instagram_feed['layout'] == 'carousel') ? ' swiper-slide nofancybox' : '' ?>" data-item="<?php echo htmlentities(json_encode($item), ENT_QUOTES, 'UTF-8'); ?>" data-elementor-open-lightbox="no">
  <div class="insta-gallery-item-wrap">
    <?php include($this->template_path('item/item-image.php')); ?>
    <?php if ($instagram_feed['card']['display'] && ($instagram_feed['card']['info'] || $instagram_feed['card']['caption'])): ?>
      <?php include($this->template_path('item/item-card.php')); ?>
    <?php endif; ?>
  </div>
</div>