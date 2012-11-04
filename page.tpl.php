<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/garland.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 */
?>

<div id="page" class="body">

	<header id="header" role="banner">
	
		<div id="header-menu">
			<div id="logo">
				<a id="logo-link" href=""></a>
			</div>
			<nav id="navigation">
				<?php print render($main_menu); ?>
				<div class="clear"></div>
			</nav>
			<?php if(!empty($page['header_menu'])) print render($page['header_menu']); ?>
			<div class="clear"></div>
		</div>
		
		<?php if(!empty($page['header'])) : ?>
			<div id="header-content" class="container">
			<?php print render($page['header']); ?>
			</div>
		<?php endif; ?>
		<div class="clear"></div>
		
	</header><!-- /#header -->
	
	<div id="main" class="container" role="main">
		<!-- Messages -->
		<?php if(!empty($messages)) : ?>
			<div id="console">
				<?php print $messages; ?>
			</div>
		<?php endif; ?>
		
		<!-- Help Messages -->
		<?php if ($page['help']): ?>
			<div id="help">
				<?php print render($page['help']); ?>
			</div>
		<?php endif; ?>
		
		<!-- Content Top Region -->
		<?php if(!empty($page['content_top'])) : ?>
			<div id="content-top">
				<?php print render($page['content_top']); ?>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		<?php endif; ?>
		
		<!-- Left Sidebar Region -->
		<?php if(!empty($page['sidebar_first'])) : ?>
			<div id="sidebar-first">
				<?php print render($page['sidebar_first']); ?>
			</div>
		<?php endif; ?>
		
		<!-- Jump Anchor -->
		<div class="hidden"><a id="main-content"></a></div>
		
		<!-- Main Content Region -->
		<div id="content">
			<?php print render($page['content']); ?>
		</div>
		
		<!-- Right Sidebar Region -->
		<?php if(!empty($page['sidebar_second'])) : ?>
			<div id="sidebar-second">
				<?php print render($page['sidebar_second']); ?>
			</div>
		<?php endif; ?>
		
		<div class="clear"></div>
		
		<!-- Bottom Content Region -->
		<?php if(!empty($page['content_bottom'])) : ?>
			<div id="content-bottom">
				<?php print render($page['content_bottom']); ?>
			</div>
		<?php endif; ?>
		
		<div class="clear"></div>
		
	</div><!-- /#main -->
	
	<footer id="footer">
		<div id="footer-inner" class="container">
		
			<!-- Footer Region -->
			<?php if(!empty($page['content_bottom'])) : ?>
				<div id="content-bottom">
					<?php print render($page['content_bottom']); ?>
				</div>
			<?php endif; ?>
			
			<div class="clear"></div>
		</div>
	</footer><!-- /#footer -->
	
</div><!-- /#page -->