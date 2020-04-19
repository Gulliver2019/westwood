<?php
/**
 * Plugin Name:       Instagram Feed Gallery PRO
 * Plugin URI:        https://quadlayers.com/portfolio/instagram-gallery/
 * Description:       Display beautifull and responsive galleries on your website from your Instagram feed account.
 * Version:           1.1.1
 * Author:            QuadLayers
 * Author URI:        https://quadlayers.com
 * Copyright:         2019 QuadLayers (https://quadlayers.com)
 * Text Domain:       insta-gallery-pro
 * Domain Path:       /languages
 */
if (!defined('ABSPATH'))
  exit;
if (!defined('QLIGG_PLUGIN_NAME')) {
  define('QLIGG_PLUGIN_NAME', 'Instagram Feed Gallery');
}
if (!defined('QLIGG_PRO_PLUGIN_VERSION')) {
  define('QLIGG_PRO_PLUGIN_VERSION', '1.1.1');
}
if (!defined('QLIGG_PRO_PLUGIN_NAME')) {
  define('QLIGG_PRO_PLUGIN_NAME', 'Instagram Feed Gallery PRO');
}
if (!defined('QLIGG_PRO_PLUGIN_FILE')) {
  define('QLIGG_PRO_PLUGIN_FILE', __FILE__);
}
if (!defined('QLIGG_PRO_PLUGIN_DIR')) {
  define('QLIGG_PRO_PLUGIN_DIR', __DIR__ . DIRECTORY_SEPARATOR);
}
if (!defined('QLIGG_PRO_DEMO_URL')) {
  define('QLIGG_PRO_DEMO_URL', 'https://quadlayers.com/instagram/?utm_source=qligg_admin');
}
if (!defined('QLIGG_PRO_LICENSES_URL')) {
  define('QLIGG_PRO_LICENSES_URL', 'https://quadlayers.com/account/licenses/?utm_source=qligg_admin');
}
if (!defined('QLIGG_PRO_SUPPORT_URL')) {
  define('QLIGG_PRO_SUPPORT_URL', 'https://quadlayers.com/account/support/?utm_source=qligg_admin');
}

if (!class_exists('QLIGG_PRO')) {

  class QLIGG_PRO {

    protected static $instance;
    var $free = 'insta-gallery';

    function add_action_links($links) {

      $links[] = '<a target="_blank" href="' . QLIGG_PRO_SUPPORT_URL . '">' . esc_html__('Support', 'insta-gallery-pro') . '</a>';

      $links[] = '<a target="_blank" href="' . QLIGG_PRO_LICENSES_URL . '">' . esc_html__('License', 'insta-gallery-pro') . '</a>';

      return $links;
    }

    function add_admin_notices() {

      $screen = get_current_screen();

      if (isset($screen->parent_file) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id) {
        return;
      }

      $plugin = "{$this->free}/{$this->free}.php";

      if (is_plugin_active($plugin)) {
        return;
      }

      if ($this->is_installed($plugin)) {

        if (!current_user_can('activate_plugins')) {
          return;
        }
        ?>
        <div class="error">
          <p>
            <a href="<?php echo wp_nonce_url('plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1', 'activate-plugin_' . $plugin); ?>" class='button button-secondary'><?php printf(esc_html__('Activate %s', 'insta-gallery-pro'), QLIGG_PLUGIN_NAME); ?></a>
            <?php printf(esc_html__('%s not working because you need to activate the %s plugin.', 'insta-gallery-pro'), QLIGG_PRO_PLUGIN_NAME, QLIGG_PLUGIN_NAME); ?>   
          </p>
        </div>
        <?php
      } else {
        if (!current_user_can('install_plugins')) {
          return;
        }
        ?>
        <div class="error">
          <p>
            <a href="<?php echo wp_nonce_url(self_admin_url("update.php?action=install-plugin&plugin={$this->free}"), "install-plugin_{$this->free}"); ?>" class='button button-secondary'><?php printf(esc_html__('Install %s', 'insta-gallery-pro'), QLIGG_PLUGIN_NAME); ?></a>
            <?php printf(esc_html__('%s not working because you need to install the %s plugin.', 'insta-gallery-pro'), QLIGG_PRO_PLUGIN_NAME, QLIGG_PLUGIN_NAME); ?>
          </p>
        </div>
        <?php
      }
    }

    function add_license_page() {
      remove_submenu_page(QLIGG_DOMAIN, QLIGG_DOMAIN . '_premium');
      add_submenu_page(QLIGG_DOMAIN, esc_html__('License', 'insta-gallery-pro'), esc_html__('License', 'insta-gallery-pro'), 'manage_options', QLIGG_DOMAIN . '_license', array($this, 'settings_license'));
    }

    function settings_license() {

      global $qligg, $qligg_token, $qligg_updater;
      ?>
      <?php QLIGG_Settings::instance()->settings_header(); ?>
      <div class="wrap about-wrap full-width-layout qlwrap">
        <?php include_once('includes/pages/license.php'); ?>
      </div>
      <?php
    }

    function add_admin_js() {
      if (isset($_GET['page']) && strpos($_GET['page'], QLIGG_DOMAIN) !== false) {
        ?>
        <script>
          (function ($) {
            $('div,tr,li').removeClass('premium');
            $('.premium').hide();
          })(jQuery);
        </script>
        <?php
      }
    }

    function is_installed($path) {

      $installed_plugins = get_plugins();

      return isset($installed_plugins[$path]);
    }


    function add_updater() {

      global $qligg, $qligg_updater;

      if (include_once 'includes/updater.php') {

        $qligg_updater = qlwdd_updater(array(
            'api_url' => 'https://quadlayers.com/wc-api/qlwdd/',
            'plugin_url' => QLIGG_PRO_DEMO_URL,
            'plugin_file' => __FILE__,
            //'license_market' => 'quadlayers',
            'license_key' => @$qligg['insta_license']['key'],
            'license_email' => @$qligg['insta_license']['email'],
            'license_url' => admin_url('admin.php?page=qligg_license'),
            'product_key' => 'dc9213682a2360ae82d0d03ea09a9f83',
                //'envato_key' => 'Gn46hMOIcvz8uyVvpe0jB2ge7A1RdH5T',
                //'envato_id' => '23125935',
                //'emp_id' => '843823'
        ));
      }
    }

    function add_activation() {

      global $qligg, $qligg_updater;

      if (isset($_REQUEST['option_page']) && $_REQUEST['option_page'] == QLIGG_DOMAIN . '-group' && isset($_REQUEST['insta_license'])) {

        $qligg_updater->request_activation($_REQUEST['insta_license']['key'], $_REQUEST['insta_license']['email']);

        $keys = array(
            'insta_license' => 0,
            'insta_flush' => 0,
            'insta_spinner_image_id' => 0
        );

        $qligg = wp_parse_args(array_intersect_key($_REQUEST, $keys), $qligg);

        update_option('insta_gallery_settings', $qligg, false);
      }
    }

    function i18n() {
      load_plugin_textdomain('insta-gallery-pro', false, QLIGG_PRO_PLUGIN_DIR . '/languages/');
    }

    function update_insta_gallery_token($token = null, $id = null) {

      global $qligg_token;

      // Fix compatibility between PHP 7.0 and 5.2
      if (is_array($qligg_token) && count($qligg_token)) {
        return $qligg_token + $token;
      }

      return $token;
    }

    function update_insta_gallery_items($instagram_feeds = array(), $item_id = null) {

      if (isset($instagram_feeds[$item_id])) {
        // Highlight
        // ---------------------------------------------------------------------
        $instagram_feeds[$item_id]['insta_highlight-tag'] = @$_REQUEST['insta_highlight-tag'];
        $instagram_feeds[$item_id]['insta_highlight-id'] = @$_REQUEST['insta_highlight-id'];
        $instagram_feeds[$item_id]['insta_highlight-position'] = @$_REQUEST['insta_highlight-position'];
        // Box
        // ---------------------------------------------------------------------
        $instagram_feeds[$item_id]['insta_box'] = @$_REQUEST['insta_box'];
        $instagram_feeds[$item_id]['insta_box-padding'] = @$_REQUEST['insta_box-padding'];
        $instagram_feeds[$item_id]['insta_box-radius'] = @$_REQUEST['insta_box-radius'];
        $instagram_feeds[$item_id]['insta_box-background'] = @$_REQUEST['insta_box-background'];
        $instagram_feeds[$item_id]['insta_box-profile'] = @$_REQUEST['insta_box-profile'];
        $instagram_feeds[$item_id]['insta_box-desc'] = @$_REQUEST['insta_box-desc'];
        // Popup
        // ---------------------------------------------------------------------
        $instagram_feeds[$item_id]['insta_popup-profile'] = @$_REQUEST['insta_popup-profile'];
        $instagram_feeds[$item_id]['insta_popup-caption'] = @$_REQUEST['insta_popup-caption'];
        $instagram_feeds[$item_id]['insta_popup-likes'] = @$_REQUEST['insta_popup-likes'];
        $instagram_feeds[$item_id]['insta_popup-align'] = @$_REQUEST['insta_popup-align'];
        // Card
        // ---------------------------------------------------------------------
        $instagram_feeds[$item_id]['insta_card'] = @$_REQUEST['insta_card'];
        $instagram_feeds[$item_id]['insta_card-radius'] = @$_REQUEST['insta_card-radius'];
        $instagram_feeds[$item_id]['insta_card-font-size'] = @$_REQUEST['insta_card-font-size'];
        $instagram_feeds[$item_id]['insta_card-background'] = @$_REQUEST['insta_card-background'];
        $instagram_feeds[$item_id]['insta_card-padding'] = @$_REQUEST['insta_card-padding'];
        $instagram_feeds[$item_id]['insta_card-caption'] = @$_REQUEST['insta_card-caption'];
        $instagram_feeds[$item_id]['insta_card-info'] = @$_REQUEST['insta_card-info'];
        $instagram_feeds[$item_id]['insta_card-length'] = @$_REQUEST['insta_card-length'];
        // Button
        // ---------------------------------------------------------------------
        $instagram_feeds[$item_id]['insta_button_load'] = @$_REQUEST['insta_button_load'];
        $instagram_feeds[$item_id]['insta_button_load-text'] = trim(esc_html(@$_REQUEST['insta_button_load-text']));
        $instagram_feeds[$item_id]['insta_button_load-background'] = sanitize_text_field(@$_REQUEST['insta_button_load-background']);
        $instagram_feeds[$item_id]['insta_button_load-background-hover'] = sanitize_text_field(@$_REQUEST['insta_button_load-background-hover']);
      }

      return $instagram_feeds;
    }

    function add_template_style($item_selector, $instagram_feed) {
      if (!empty($instagram_feed['insta_button_load-background'])) {
        echo "#{$item_selector} .insta-gallery-actions .insta-gallery-button.load {background-color: {$instagram_feed['insta_button_load-background']};}";
      }
      if (!empty($instagram_feed['insta_button_load-background-hover'])) {
        echo "#{$item_selector} .insta-gallery-actions .insta-gallery-button.load:hover {background-color: {$instagram_feed['insta_button_load-background-hover']};}";
      }

      if (!empty($instagram_feed['insta_button_load-background'])) {
        echo "#{$item_selector} .insta-gallery-actions .insta-gallery-button.load {background-color: {$instagram_feed['insta_button_load-background']};}";
      }
      if (!empty($instagram_feed['insta_box'])) {
        if (!empty($instagram_feed['insta_box-padding'])) {
          echo "#{$item_selector} {padding: {$instagram_feed['insta_box-padding']}px;}";
        }
        if (!empty($instagram_feed['insta_box-radius'])) {
          echo "#{$item_selector} {border-radius: {$instagram_feed['insta_box-radius']}px;}";
        }
        if (!empty($instagram_feed['insta_box-background'])) {
          echo "#{$item_selector} {background-color: {$instagram_feed['insta_box-background']};}";
        }
      }
      if (!empty($instagram_feed['insta_card'])) {
        if (!empty($instagram_feed['insta_card-font-size'])) {
          echo "#{$item_selector} .insta-gallery-list .insta-gallery-item .insta-gallery-item-wrap {font-size: {$instagram_feed['insta_card-font-size']}px;}";
        }
        if (!empty($instagram_feed['insta_card-padding'])) {
          echo "#{$item_selector} .insta-gallery-list .insta-gallery-item .insta-gallery-item-wrap {padding: {$instagram_feed['insta_card-padding']}px;}";
        }
        if (!empty($instagram_feed['insta_card-padding'])) {
          echo "#{$item_selector} .insta-gallery-list .insta-gallery-item .insta-gallery-image-card {margin: 0 -1em -1em -1em;}";
        }
        if (!empty($instagram_feed['insta_card-radius'])) {
          echo "#{$item_selector} .insta-gallery-list .insta-gallery-item .insta-gallery-item-wrap {border-radius: {$instagram_feed['insta_card-radius']}px;}";
        }
        if (!empty($instagram_feed['insta_card-background'])) {
          echo "#{$item_selector} .insta-gallery-list .insta-gallery-item .insta-gallery-item-wrap {background-color: {$instagram_feed['insta_card-background']};}";
          echo "#{$item_selector} .insta-gallery-list .insta-gallery-item .insta-gallery-image-card {background-color: {$instagram_feed['insta_card-background']};}";
        }
      }
    }

    function add_template_file($template_file, $template_name) {

      if (file_exists(QLIGG_PRO_PLUGIN_DIR . "templates/{$template_name}")) {
        return QLIGG_PRO_PLUGIN_DIR . "templates/{$template_name}";
      }

      return $template_file;
    }

    function init() {
      add_action('admin_notices', array($this, 'add_admin_notices'));
      add_filter('plugin_action_links_' . plugin_basename(QLIGG_PRO_PLUGIN_FILE), array($this, 'add_action_links'));
      if (class_exists('QLIGG')) {
        add_action('admin_init', array($this, 'add_updater'));
        add_action('admin_init', array($this, 'add_activation'));
        add_action('admin_menu', array($this, 'add_license_page'));
        add_action('admin_footer', array($this, 'add_admin_js'));
      }
      add_filter('qligg_template_file', array($this, 'add_template_file'), 10, 2);
      add_filter('qligg_template_style', array($this, 'add_template_style'), 10, 2);
      add_filter('qligg_update_insta_gallery_token', array($this, 'update_insta_gallery_token'), 10);
      add_filter('qligg_update_insta_gallery_items', array($this, 'update_insta_gallery_items'), 10, 2);
    }

    public static function instance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
        //self::$instance->includes();
        self::$instance->init();
      }
      return self::$instance;
    }

    public static function do_activation() {
      //set_transient('qligg-first-rating', true, MONTH_IN_SECONDS);
    }

  }

  add_action('plugins_loaded', array('QLIGG_PRO', 'instance'), 99);

  register_activation_hook(QLIGG_PRO_PLUGIN_FILE, array('QLIGG_PRO', 'do_activation'));
}