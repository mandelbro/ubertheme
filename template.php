<?php

/**
 * Override or insert variables into the maintenance page template.
 */
function ubertheme_preprocess_maintenance_page(&$vars) {
  // While markup for normal pages is split into page.tpl.php and html.tpl.php,
  // the markup for the maintenance page is all in the single
  // maintenance-page.tpl.php template. So, to have what's done in
  // ubertheme_preprocess_html() also happen on the maintenance page, it has to be
  // called here.
  ubertheme_preprocess_html($vars);
}

/**
 * Override or insert variables into the html template.
 */
function ubertheme_preprocess_html(&$vars) {
  // Add conditional CSS for IE8 and below.
  drupal_add_css(path_to_theme() . '/ie.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'lt IE 9', '!IE' => FALSE), 'weight' => 999, 'preprocess' => FALSE));
}

/**
 * Override or insert variables into the page template.
 */
function ubertheme_preprocess_page(&$vars) {
  global $user;
  $vars['primary_local_tasks'] = $vars['tabs'];
  unset($vars['primary_local_tasks']['#secondary']);
  $vars['secondary_local_tasks'] = array(
    '#theme' => 'menu_local_tasks',
    '#secondary' => $vars['tabs']['#secondary'],
  );
  // specify homepage for
  if($vars['is_front']) {
  	// add css
		drupal_add_css(path_to_theme() . '/css/home.css', array('every_page' => FALSE, 'preprocess' => FALSE));
		// swap the theme
		$vars['theme_hook_suggestions'][] = 'page__home'; //use the homepage template
  }
}

/**
 * Override or insert variables into the node template. Also creates optional
 * templates for each nodetype
 */
function ubertheme_preprocess_node(&$variables) {
	$node = $variables['node'];

	// define a template suggestion for the node type
	$variables['theme_hook_suggestions'][] = 'node__type__'. $node->type;

	if($variables['view_mode'] == 'full') {
		// define a template suggestion for the node type
		$variables['theme_hook_suggestions'][] = 'node__type__'. $node->type .'__full';
	}
}

/**
 * Display the list of available node types for node creation.
 */
function ubertheme_node_add_list($variables) {
  $content = $variables['content'];
  $output = '';
  if ($content) {
    $output = '<ul class="admin-list">';
    foreach ($content as $item) {
      $output .= '<li class="clearfix">';
      $output .= '<span class="label">' . l($item['title'], $item['href'], $item['localized_options']) . '</span>';
      $output .= '<div class="description">' . filter_xss_admin($item['description']) . '</div>';
      $output .= '</li>';
    }
    $output .= '</ul>';
  }
  else {
    $output = '<p>' . t('You have not created any content types yet. Go to the <a href="@create-content">content type creation page</a> to add a new content type.', array('@create-content' => url('admin/structure/types/add'))) . '</p>';
  }
  return $output;
}

/**
 * Overrides theme_admin_block_content().
 *
 * Use unordered list markup in both compact and extended mode.
 */
function ubertheme_admin_block_content($variables) {
  $content = $variables['content'];
  $output = '';
  if (!empty($content)) {
    $output = system_admin_compact_mode() ? '<ul class="admin-list compact">' : '<ul class="admin-list">';
    foreach ($content as $item) {
      $output .= '<li class="leaf">';
      $output .= l($item['title'], $item['href'], $item['localized_options']);
      if (isset($item['description']) && !system_admin_compact_mode()) {
        $output .= '<div class="description">' . filter_xss_admin($item['description']) . '</div>';
      }
      $output .= '</li>';
    }
    $output .= '</ul>';
  }
  return $output;
}

function clearfix() {
	print '<div class="clear"></div>';
}