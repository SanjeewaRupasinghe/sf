<div class="wrap" id="gaw">
<h2>Analytics for WP Settings</h2>

<?php

    $options = get_option('gaw_analytics_id');    
   
if( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true'):
    echo '<div class="updated notice notice-success is-dismissible"> 
            <p><strong>Settings saved.</strong></p>
        </div>';
    
endif;
?>

    
   <form method="post" action="options.php">
       <?php settings_fields( 'gaw-settings-group' ); ?>
       <?php do_settings_sections( 'gaw-settings-group' ); ?>
       <table class="form-table">
          <tr valign="top">
            <th scope="row">Tracking Code</th>
            <td>
               <input type="text" style="width:50%" name="gaw_analytics_id" value="<?php echo get_option('gaw_analytics_id', ''); ?>" placeholder="UA-XXXXXXXX-1" />
               <br/><small>Example: UA-XXXXXXXX-1  /  G-XXXXXXXXX</small><br/><small>If you  don't have tracking code <a href="https://analytics.google.com/" target="_blank">click here to generate.</a></small>
            </td>
          </tr>
          <tr valign="top">
             <th scope="row">Place Google Analytics Code</th>
             <td>
               <select name="gaw_position">
                   <option value="wp_head" <?php if( get_option('gaw_position') == "wp_head" ): echo 'selected'; endif;?> >Header (recommended)</option>
                   <option value="wp_footer" <?php if( get_option('gaw_position') == "wp_footer" ): echo 'selected'; endif;?> >Footer</option>
               </select>
            </td>
          </tr>  
          <tr valign="top">
             <th scope="row">Disable Tracking</th>
             <td>
               <select name="gaw_disable_track">
                   <option value="No" <?php if( get_option('gaw_disable_track') == "No" ): echo 'selected'; endif;?> >No</option>
                   <option value="Yes" <?php if( get_option('gaw_disable_track') == "Yes" ): echo 'selected'; endif;?> >Yes</option>
               </select>
               <br/><small>Temporarily disable trackng your website.</small>
            </td>
          </tr> 

       </table>
       <?php submit_button(); ?>

       <p>For any help <a href="https://everythingwoocommerce.com/how-to-add-google-analytics-tracking-code-in-wordpress-website/?ref=wp-analytics" target="_blank">click here</a></p>
   </form>
    <div>
        <h3><a href="https://wordpress.org/support/plugin/analytics-for-wp/reviews/?filter=5#new-post">Please review us</a> if you like the plugin.</h3>
    </div>
</div>