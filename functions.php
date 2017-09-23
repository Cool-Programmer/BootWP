<?php 
	require_once 'wp-bootstrap-navwalker.php';
	require_once 'widgets/class-wp-widget-categories.php';
	require_once 'widgets/class-wp-widget-recent-posts.php';
	require_once 'widgets/class-wp-widget-recent-comments.php';

	function bootwp_theme_setup()
	{
		// Featured images
		add_theme_support('post-thumbnails');

		// Navigation
		register_nav_menus([
			'primary' => __('Primary')
		]);
	}

	add_action('after_setup_theme', 'bootwp_theme_setup');

	// Widgets
	function init_widgets($id)
	{
		register_sidebar([
			'name' => 'Sidebar',
			'id' => 'sidebar',
			'before_widget' => '<div class="panel panel-default">',
			'after_widget' => '</div>',
			'before_title' => '<div class="panel-heading"><h3 class="panel-title">',
			'after_title' => '</h3></div><div class="panel-body">'
		]);
	}

	add_action('widgets_init', 'init_widgets');

	// Custom widgets
	function custom_register_widgets()
	{
		register_widget('WP_Widget_Categories_Custom');
		register_widget('WP_Widget_Recent_Posts_Custom');
		register_widget('WP_Widget_Recent_Comments_Custom');
	}

	add_action('widgets_init', 'custom_register_widgets');

	// Add list-group-item to li in category widget
	function add_new_class_li_cats($list)
	{
		$list = str_replace('cat-item', 'cat-item list-group-item', $list);
		return $list;
	}

	add_filter('wp_list_categories', 'add_new_class_li_cats');