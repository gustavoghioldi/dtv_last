<?php 
/*
 * This is the page users will see logged out. 
 * You can edit this, but for upgrade safety you should copy and modify this file into your template folder.
 * The location from within your template folder is plugins/login-with-ajax/ (create these directories if they don't exist)
*/
?>
	<div class="lwa lwa-default"><?php //class must be here, and if this is a template, class name should be that of template directory ?>
        <form class="lwa-form" action="<?php echo esc_attr(LoginWithAjax::$url_login); ?>" method="post">
        	<span class="lwa-status"></span>

            <table>
                <tr class="lwa-username">                    
                    <td class="lwa-username-input">
                        <input type="text" name="log" placeholder="<?php esc_html_e( 'Username','bapz' ) ?>" />
                    </td>
                    <td class="lwa-password-input">
                        <input type="password" name="pwd" placeholder="<?php esc_html_e( 'Password','bapz' ) ?>" />
                        <?php do_action('login_form'); ?>
                    </td>
                    <td class="lwa-submit-button">
                        <input type="submit" name="wp-submit" id="lwa_wp-submit" value="<?php esc_attr_e('Log In', 'bapz'); ?>" tabindex="100" />
                        <input type="hidden" name="lwa_profile_link" value="<?php echo esc_attr($lwa_data['profile_link']); ?>" />
                        <input type="hidden" name="login-with-ajax" value="login" />
                    </td>
                </tr>
                
               <tr class="lwa-submit">
                    
                    <td class="lwa-submit-links" colspan="3">
                        <ul class="list-inline">
                        <li><input name="rememberme" type="checkbox" class="lwa-rememberme" value="forever" /> <span><?php esc_html_e( 'Remember Me','bapz' ) ?></span></li>
                      
						<?php if( !empty($lwa_data['remember']) ): ?>
						<li><a class="lwa-links-remember" href="<?php echo esc_attr(LoginWithAjax::$url_remember); ?>" title="<?php esc_attr_e('Password Lost and Found','bapz') ?>"><?php esc_attr_e('Lost your password?','bapz') ?></a></li>
						<?php endif; ?>
                      
                        <?php if ( get_option('users_can_register') && !empty($lwa_data['registration']) ) : ?>						
						<li><a href="<?php echo esc_attr(LoginWithAjax::$url_register); ?>" class="lwa-links-register lwa-links-modal"><?php esc_html_e('Register','bapz') ?></a></li>
                        <?php endif; ?>
                    </ul>
                    </td>
                </tr>
            </table>
        </form>
        <?php if( !empty($lwa_data['remember']) ): ?>
        <form class="lwa-remember" action="<?php echo esc_attr(LoginWithAjax::$url_remember) ?>" method="post" style="display:none;">
        	<span class="lwa-status"></span>
            <table>
                <tr>
                    <td>
                        <strong><?php esc_html_e("Forgotten Password", 'bapz'); ?></strong>         
                    </td>
                </tr>
                <tr>
                    <td class="lwa-remember-email">  
                        <?php $msg = __("Enter username or email", 'bapz'); ?>
                        <input type="text" name="user_login" class="lwa-user-remember" value="<?php echo esc_attr($msg); ?>" onfocus="if(this.value == '<?php echo esc_attr($msg); ?>'){this.value = '';}" onblur="if(this.value == ''){this.value = '<?php echo esc_attr($msg); ?>'}" />
                        <?php do_action('lostpassword_form'); ?>
                    </td>
                </tr>
                <tr>
                    <td class="lwa-remember-buttons">
                        <input type="submit" value="<?php esc_attr_e("Get New Password", 'bapz'); ?>" class="lwa-button-remember" />
                        <a href="#" class="lwa-links-remember-cancel"><?php esc_html_e("Cancel", 'bapz'); ?></a>
                        <input type="hidden" name="login-with-ajax" value="remember" />
                    </td>
                </tr>
            </table>
        </form>
        <?php endif; ?>
		<?php if( get_option('users_can_register') && !empty($lwa_data['registration']) ): ?>
		<div class="lwa-register lwa-register-default lwa-modal" style="display:none;">
			<h4><?php esc_html_e('Register For This Site','bapz') ?></h4>
			<p><em class="lwa-register-tip"><?php esc_html_e('A password will be e-mailed to you.','bapz') ?></em></p>
			<form class="lwa-register-form" action="<?php echo esc_attr(LoginWithAjax::$url_register); ?>" method="post">
				<span class="lwa-status"></span>
				<p class="lwa-username">
					<label><?php esc_html_e('Username','bapz') ?><br />
					<input type="text" name="user_login" id="user_login" class="input" size="20" tabindex="10" /></label>
				</p>
				<p class="lwa-email">
					<label><?php esc_html_e('E-mail','bapz') ?><br />
					<input type="text" name="user_email" id="user_email" class="input" size="25" tabindex="20" /></label>
				</p>
				<?php do_action('register_form'); ?>
				<?php do_action('lwa_register_form'); ?>
				<p class="submit">
					<input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="<?php esc_attr_e('Register', 'bapz'); ?>" tabindex="100" />
				</p>
		        <input type="hidden" name="login-with-ajax" value="register" />
			</form>
		</div>
		<?php endif; ?>
	</div>