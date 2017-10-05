<?php
/**
 *
 * Welcome Page for MashSocial
 *
 */

	$aa_plugin_version = VRC_VERSION;
 ?>


 <div class="wrap about-wrap">

 	<h1><?php printf( __( 'AA PLUGIN&nbsp;%s' ), $aa_plugin_version ); ?></h1>

 	<div class="about-text">
 		<?php printf( __( 'Let\'s get you started!' ), $aa_plugin_version ); ?>
 	</div>

 	<div class="aa_mash_logo"></div>


 	<!-- <div class="changelog point-releases">
 		<h3><?php echo _n( 'Maintenance and Security Release', 'Maintenance and Security Releases', 4 ); ?></h3>
 		<p><?php printf( _n( '<strong>Version %1$s</strong> addressed some security issues and fixed %2$s bug.',
 	         '<strong>Version %1$s</strong> addressed some security issues and fixed %2$s bugs.', 4 ), '4.2.4', number_format_i18n( 4 ) ); ?>
 			<?php printf( __( 'For more information, see <a href="%s">the release notes</a>.' ), 'http://codex.wordpress.org/Version_4.2.4' ); ?>
 		</p>

 	</div> -->


 	<div class="feature-section one-col">


		<h2>Steps Involved</h2>

		<ul>
			<li><strong>Step #1:</strong> <a href="/wp-admin/widgets.php" target="_blank">Go to &rarr; Widgets</a></code> and drag drop AA PLUGIN Pro to a widgetized area, click <code>Save</code>.</li>
			<li><strong>Step #2:</strong> <a href="/wp-admin/admin.php?page=wp_mashsocial&tab=0"  target="_blank" >Go to &rarr;  MashSocial</a> menu and configure the widget.</strong></li>
		</ul>

 	</div>


	<div class="feature-section two-col">
		<div class="col">
			<h3><?php _e( 'Add AA PLUGIN Pro to your site ' ); ?></h3>

			<p>Start using WP MashSocial right now. All you have to do is activate the plugin and the Go to <a href="/wp-admin/widgets.php" target="_blank">Widgets</a> where you will find a new widget named against <code>AA PLUGIN Pro</code>	just drag and drop this widget to your site's sidebar or any other  widgetized area of your theme, after that click <code>Save</code>.</p>

		</div>

		<div class="col">
			<img src="<?php echo VRC_URL . '/assets/admin/inc/welcome/assets/img/step1.gif'; ?>" />
		</div>
	</div>


	<div class="feature-section two-col">
		<div class="col">
			<img src="<?php echo VRC_URL . '/assets/admin/inc/welcome/assets/img/dragndrop.gif'; ?>" />
		</div>
		<div class="col">
			<h3><?php _e( 'Drag & Drop Social Blocks' ); ?></h3>
			<p>Here you can drag and drop the allignements of social blocks and put those social blocks in disable portion which you don't want to appear at your site.</p>

		</div>
	</div>


	<div class="changelog feature-section two-col">
		<div class="col">
			<img src="<?php echo VRC_URL . '/assets/admin/inc/welcome/assets/img/options.png'; ?>" />
			<h3><?php _e( 'Customizable Options' ); ?></h3>
			<p><?php _e( 'All Social blocks come with separate sub-menus where you can customize and add options as you desire.' ); ?></p>
		</div>

		<div class="col">
			<img src="<?php echo VRC_URL . '/assets/admin/inc/welcome/assets/img/design.png'; ?>" />
			<h3><?php _e( 'Even more styles' ); ?></h3>
			<p><?php _e( 'Easily change styles of every social block be it there color or background color.' ); ?></p>
		</div>
	</div>


 </div> <!-- Last Div -->
