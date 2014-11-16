<?php 
/*
 * This is the page users will see logged in. 
 * You can edit this, but for upgrade safety you should copy and modify this file into your template folder.
 * The location from within your template folder is plugins/login-with-ajax/ (create these directories if they don't exist)
*/
?>
<div class="lwa">
	<?php 
		global $current_user;
		 wp_get_current_user();
	?>
	
	<table class="loggedin">
		<tr><td colspan="2">
			<ul class="list-inline">
				<li>
					<?php
					//Admin URL
					if ( $lwa_data['profile_link'] == '1' ) {
						if( function_exists('bp_loggedin_user_link') ){
							?>
							<a href="<?php bp_loggedin_user_link(); ?>"><?php esc_html_e('Profile','bapz') ?></a><br/>
							<?php	
						}else{
							?>
							<a href="<?php echo trailingslashit(get_admin_url()); ?>profile.php"><?php esc_html_e('Profile','bapz') ?></a><br/>
							<?php	
						}
					}
					?>
				</li>
				<li><a id="wp-logout" href="<?php echo wp_logout_url() ?>"><?php esc_html_e( 'Log Out' ,'bapz') ?></a></li>
					<?php
					//Blog Admin
					if( current_user_can('list_users') ) {
						?>
						<li><a href="<?php echo get_admin_url(); ?>"><?php esc_html_e("blog admin", 'bapz'); ?></a></li>
						<?php
					}
				?>
				</ul>
		</td></tr>
		<tr>
			<td class="avatar" class="lwa-avatar">
				<?php echo get_avatar( $current_user->ID, $size = '100' );  ?>
			</td>
			<td class="lwa-info">
				<h4><?php echo $current_user->display_name;  ?></h4>
				<?php
					
					echo ($current_user->description != '')? '<p>'.$current_user->description.'</p>' : '';
					?>
					
			</td>
		</tr>
	</table>
</div>