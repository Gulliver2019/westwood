<form method="post">
  <?php settings_fields(sanitize_key(QLIGG_DOMAIN . '-group')); ?>
  <?php do_settings_sections(sanitize_key(QLIGG_DOMAIN . '-group')); ?>
  <table class="widefat striped">
    <thead>
      <tr>
        <th colspan="2"><b><?php esc_html_e('License', 'insta-gallery-pro'); ?></b></th>
      </tr>
    </thead>
    <tbody>
      <!--<tr>
        <th scope="row"><?php //esc_html_e('Market', 'insta-gallery-pro');        ?></th>
        <td>
          <select name="<?php //echo esc_attr(QLIGG_DOMAIN);        ?>[insta_license][market]" style="width:350px">
            <option <?php //selected(@$qligg['insta_license']['market'], '');        ?> value="">QuadLayers</option>
            <option <?php //selected(@$qligg['insta_license']['market'], 'envato');        ?> value="envato">Envato</option>
            <option <?php //selected(@$qligg['insta_license']['market'], 'emp');        ?> value="emp">Elegant Market Place</option>
          </select>
          <p class="description"><?php //esc_html_e('Enter the market where you\'ve purchased the license.', 'insta-gallery-pro');        ?></p>  
        </td>
      </tr>-->
      <tr>
        <th scope="row"><?php esc_html_e('Key', 'insta-gallery-pro'); ?></th>
        <td>
          <input type="password" name="insta_license[key]" placeholder="<?php esc_html_e('Enter your license key.', 'insta-gallery-pro'); ?>" value="<?php echo esc_attr(@$qligg['insta_license']['key']); ?>" class="qligg-input"/>
        </td>
      </tr>
      <tr>
        <th scope="row"><?php esc_html_e('Email', 'insta-gallery-pro'); ?></th>
        <td>
          <input type="password" name="insta_license[email]" placeholder="<?php esc_html_e('Enter your order email.', 'insta-gallery-pro'); ?>" value="<?php echo esc_attr(@$qligg['insta_license']['email']); ?>" class="qligg-input"/>
        </td>
      </tr>
    </tbody>
  </table>
  <?php wp_nonce_field('qligg_save_settings', 'ig_nonce'); ?>
  <?php submit_button() ?>
</form>
<table class="widefat striped" cellspacing="0">
  <thead>
    <tr>
      <th colspan="2"><b><?php esc_html_e('Status', 'insta-gallery-pro'); ?></b></th>
    </tr>
  </thead>
  <tbody>
    <?php
    //var_dump($qligg_updater->get_activation());
    if ($activation = $qligg_updater->get_activation()) :
      ?>
      <?php if (!empty($activation->success)) : ?>
        <tr>
          <td><?php esc_html_e('Created', 'qlwdd') ?></td>
          <td><?php echo date(get_option('date_format'), strtotime($activation->license_created)) ?></td>
        </tr>
        <tr>
          <td><?php esc_html_e('Limit', 'qlwdd') ?></td>
          <td><?php echo $activation->license_limit ? esc_attr($activation->license_limit) : esc_html__('Unlimited', 'qlwdd'); ?></td>
        </tr>
        <tr>
          <td><?php esc_html_e('Activations', 'qlwdd') ?></td>
          <td><?php echo esc_attr($activation->activation_count); ?></td>
        </tr>
        <tr>
          <td><?php esc_html_e('Updates', 'qlwdd') ?></td>
          <td><?php echo ($activation->license_expiration != '0000-00-00 00:00:00' && $activation->license_updates) ? sprintf(esc_html__('Expires on %s', 'qlwdd'), $activation->license_expiration) : esc_html__('Unlimited', 'qlwdd'); ?></td>
        </tr>
        <tr>
          <td><?php esc_html_e('Support', 'qlwdd') ?></td>
          <td><?php echo ($activation->license_expiration != '0000-00-00 00:00:00' && $activation->license_support) ? sprintf(esc_html__('Expires on %s', 'qlwdd'), $activation->license_expiration) : esc_html__('Unlimited', 'qlwdd'); ?></td>
        </tr>
        <!--<tr>
          <td><?php esc_html_e('Expiration', 'qlwdd') ?></td>
          <td><?php echo ($activation->license_expiration != '0000-00-00 00:00:00') ? date_i18n(get_option('date_format'), strtotime($activation->license_expiration)) : esc_html__('Unlimited', 'qlwdd'); ?></td>
        </tr>-->
      <?php endif; ?>
      <tr>
        <td><?php esc_html_e('Status', 'insta-gallery-pro'); ?></td>
        <td><?php echo esc_html($activation->message); ?></td>
      </tr>
    <?php endif; ?>
    <tr>
      <td><?php esc_html_e('Message', 'insta-gallery-pro'); ?></td>
      <td>
        <span class="description">
          <?php if (empty($activation->activation_instance)): ?>
            <?php printf(__('Before you can receive plugin updates, you must first authenticate your license. To locate your License Key, <a href="%s" target="_blank">log in</a> to your account and navigate to the <strong>Account > Licenses</strong> page.', 'insta-gallery-pro'), QLIGG_PRO_LICENSES_URL); ?>
          <?php else: ?>
            <?php printf(__('Thanks for register your license! If you have doubts you can request <a href="%s" target="_blank">support</a> through our ticket system.', 'insta-gallery-pro'), QLIGG_PRO_SUPPORT_URL); ?>
          <?php endif; ?>
        </span>
      </td>
    </tr>
  </tbody>
</table>