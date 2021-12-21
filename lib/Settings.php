<?php

namespace Friendly\Analytics;

class Settings {

  /**
   * Add an options page under 'Settings'
   *
   * @since 1.0
   * @see https://codex.wordpress.org/Function_Reference/add_options_page
   *
   */
  function settings_page() {
    add_options_page(
      'Friendly Analytics',
      'Friendly Analytics',
      'manage_options',
      'friendly_analytics',
      array( $this, "settings_content" )
    );
  }


  /**
   * Ouputs the markup for the options page
   *
   * @since 1.0
   *
   */
  function settings_content() {

    if ( ! isset( $_REQUEST['settings-updated'] ) )
      $_REQUEST['settings-updated'] = false;
    ?>

    <div class="wrap">
       <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>



    <div class="wk-left-part">
      <form id="friendly_analytics_wp-settings" method="post" action="options.php">
        <?php settings_fields( 'friendly_analytics_wp' ); ?>
        <?php do_settings_sections('friendly_analytics'); ?>

        <?php submit_button(); ?>
      </form>
    </div>

    </div>

  <?php

  }


  /**
   * Registers all the settings separately
   *
   * @since 1.0
   * @see https://codex.wordpress.org/Function_Reference/register_setting
   * @see https://codex.wordpress.org/Function_Reference/add_settings_section
   * @see https://codex.wordpress.org/Function_Reference/add_settings_field
   *
   */
  function register_settings() {

    add_settings_section(
      'friendly_analytics',
      __('Settings', 'friendly-analytics'), 
      array( $this, 'settings_header'),
      'friendly_analytics'
    );

    /**
     * @since 1.0
     */
    register_setting(
      'friendly_analytics_wp',
      'fa_tracking_code'
    );

    add_settings_field(
      'fa_tracking_code',
      __('Friendy Analytics Site ID ', 'friendly-analytics'),
      array( $this, 'tracking_code_field' ),
      'friendly_analytics',
      'friendly_analytics'
    );

    /**
     * @since 1.0
     */
    register_setting(
      'friendly_analytics_wp',
      'track_logged_in'
    );



    add_settings_field(
      'track_logged_in',
      __('Track logged in users', 'friendly_analytics_wp'),
      array( $this, 'track_logged_in_field' ),
      'friendly_analytics',
      'friendly_analytics'
    );



    /**
     * @since 1.2
     */
    register_setting(
      'friendly_analytics_wp',
      'fa_tag_manager_id'
    );

    add_settings_field(
      'fa_tag_manager_id',
      __('Friendly Analytics Tag Manager ID', 'friendly_analytics_wp'),
      array( $this, 'tag_manager_id_field' ),
      'friendly_analytics',
      'friendly_analytics'
    );


    /**
     * @since 1.2
     */
    register_setting(
      'friendly_analytics_wp',
      'fa_server'
    );

    add_settings_field(
      'fa_server',
      __('Friendly Analytics Custom Server', 'friendly_analytics_wp'),
      array( $this, 'fa_server_field' ),
      'friendly_analytics',
      'friendly_analytics'
    );

    register_setting(
      'friendly_analytics_wp',
      'fa_server_2'
    );

  }


  /**
   * Renders the header text for the settings page
   *
   * @since 1.6.2
   *
   */
  function settings_header() {
    ?>

    <p><?php _e('Please enter your Friendy Analytics Site ID below. You can also active the Friendly Tag Manager by entering its ID below.', 'friendly_analytics_wp'); ?></p>

    <?php
  }
 
  /**
   * Renders text input for the Google Analytics tracking code
   *
   * @since 1.6.2
   *
   */
  function tracking_code_field() {

    $field = 'fa_tracking_code';
    $value = esc_attr( get_option( $field ) );

    ?>

    <input type="text" name="<?php echo $field; ?>" placeholder="123" value="<?php echo $value; ?>" />

    <?php
  }



  /**
   * Renders checkbox for the track logged in users option
   *
   * @since 1.6.2
   *
   */
  function track_logged_in_field() {

    $field = 'track_logged_in';
    $value = get_option( $field );

    ?>

    <input type="checkbox" name="<?php echo $field; ?>" value="1" <?php checked( $value ); ?> />

    <?php

  }



  /**
   * Renders text field for the Friendly Tag Manager ID
   *
   *
   */
  function tag_manager_id_field() {

    $field = 'fa_tag_manager_id';
    $value = esc_attr( get_option( $field ) );

    ?>

    <input type="text" name="<?php echo $field; ?>" placeholder="XXXXXX" value="<?php echo $value; ?>" />

    <p>Optional.</p>

    <?php

  }


  /**
   * Renders text field for the Server
   *
   *
   */
  function fa_server_field() {

    $field = 'fa_server';
    $value = esc_attr( get_option( $field ) );
    $value_name = "";
    if ($value == "app.friendlyanalytics.ch") { 
      $value_name = "Switzerland";
    }
    else {
      $value_name = "Germany/EU";
    };
    ?>

    <label for="fa_server">Choose your server location:</label>
    <select name="fa_server" id="fa_server">
      <option value="app.friendlyanalytics.ch" name="Switzerland">Switzerland</option>
      <option value="app.friendlyanalytics.com" name="Germany/EU">Germany/EU</option>
    </select>

    <p>Optional. Your current server is in <?php echo $value_name ?>.</p>

    <?php

  }

}
