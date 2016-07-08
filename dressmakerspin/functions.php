<?php

$blockquote_paragraph = get_option( 'pu_theme_options' );
$blockquote_link = get_option( 'pu_theme_options' );
$blockquote_link_text = get_option( 'pu_theme_options' );

$facebook_link = get_option( 'pu_theme_options' );
$twitter_link = get_option( 'pu_theme_options' );
$instagram_link = get_option( 'pu_theme_options' );

$author_photo_link = get_option( 'pu_theme_options' );
$author_description = get_option( 'pu_theme_options' );

$post_display_length = get_option( 'pu_theme_options' ); // Wyświetlana ilość znaków przy każdym poście na stronie głównej i w menu kategorii

// !!! Więcej już nic nie edytujemy :-) !!!


define('FACEBOOK_LINK', $facebook_link['facebook_link']);
define('TWITTER_LINK', $twitter_link['twitter_link']);
define('INSTAGRAM_LINK', $instagram_link['instagram_link']);
define('AUTHOR_PHOTO_LINK', $author_photo_link['author_photo_link']);
define('AUTHOR_DESCRIPTION', $author_description['author_description']);
define('POST_DISPLAY_LENGTH', $post_display_length['post_display_length']);
define('BLOCKQUOTE_PARAGRAPH', $blockquote_paragraph['blockquote_paragraph']);
define('BLOCKQUOTE_LINK', $blockquote_link['blockquote_link']);
define('BLOCKQUOTE_LINK_TEXT', $blockquote_link_text['blockquote_link_text']);


//Add thumbnail, automatic feed links and title tag support
add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'title-tag' );

//Add content width (desktop default)
if ( ! isset( $content_width ) ) {
	$content_width = 768;
}

// filter the Gravity Forms button type
add_filter('gform_submit_button', 'form_submit_button', 10, 2);
function form_submit_button($button, $form){
    return "<button class='button btn' id='gform_submit_button_{$form["id"]}'><span>{$form['button']['text']}</span></button>";
}

// Register sidebar
add_action('widgets_init', 'theme_register_sidebar');
function theme_register_sidebar() {
	if ( function_exists('register_sidebar') ) {
		register_sidebar(array(
			'id' => 'sidebar-1',
		    'before_widget' => '<div id="%1$s" class="widget %2$s">',
		    'after_widget' => '</div><br>',
		    'before_title' => '<h4>',
		    'after_title' => '</h4>',
			'name'        => 'Instagram Widget',
		 ));
		register_sidebar( array(
			'id'          => 'adwords-widget',
			'name'        => 'AdWords Widget',
			'description' => __( 'Miejsce na reklamę', 'text_domain' ),
		));
	}
}

// Bootstrap_Walker_Nav_Menu setup

add_action( 'after_setup_theme', 'bootstrap_setup' );

if ( ! function_exists( 'bootstrap_setup' ) ):

	function bootstrap_setup(){

		add_action( 'init', 'register_menu' );

		function register_menu(){
			register_nav_menu( 'top-bar', 'Bootstrap Top Menu' ); 
		}

		class Bootstrap_Walker_Nav_Menu extends Walker_Nav_Menu {


			function start_lvl( &$output, $depth = 0, $args = array() ) {

				$indent = str_repeat( "\t", $depth );
				$output	   .= "\n$indent<ul class=\"dropdown-menu\">\n";

			}

			function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

				if (!is_object($args)) {
					return; // menu has not been configured
				}

				$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

				$li_attributes = '';
				$class_names = $value = '';

				$classes = empty( $item->classes ) ? array() : (array) $item->classes;
				$classes[] = ($args->has_children) ? 'dropdown' : '';
				$classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
				$classes[] = 'menu-item-' . $item->ID;


				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
				$class_names = ' class="' . esc_attr( $class_names ) . '"';

				$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
				$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

				$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

				$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
				$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
				$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
				$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
				$attributes .= ($args->has_children) 	    ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';

				$item_output = $args->before;
				$item_output .= '<a'. $attributes .'>';
				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
				$item_output .= ($args->has_children) ? ' <b class="caret"></b></a>' : '</a>';
				$item_output .= $args->after;

				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			}

			function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

				if ( !$element )
					return;

				$id_field = $this->db_fields['id'];

				//display this element
				if ( is_array( $args[0] ) )
					$args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
				else if ( is_object( $args[0] ) )
					$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
				$cb_args = array_merge( array(&$output, $element, $depth), $args);
				call_user_func_array(array(&$this, 'start_el'), $cb_args);

				$id = $element->$id_field;

				// descend only when the depth is right and there are childrens for this element
				if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

					foreach( $children_elements[ $id ] as $child ){

						if ( !isset($newlevel) ) {
							$newlevel = true;
							//start the child delimiter
							$cb_args = array_merge( array(&$output, $depth), $args);
							call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
						}
						$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
					}
						unset( $children_elements[ $id ] );
				}

				if ( isset($newlevel) && $newlevel ){
					//end the child delimiter
					$cb_args = array_merge( array(&$output, $depth), $args);
					call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
				}

				//end this element
				$cb_args = array_merge( array(&$output, $element, $depth), $args);
				call_user_func_array(array(&$this, 'end_el'), $cb_args);
			}
		}
 	}
endif;


// START THEME OPTIONS
// custom theme options for user in admin area - Appearance > Theme Options
function pu_theme_menu()
{
  add_theme_page( 'Theme Option', 'Edycja danych motywu', 'manage_options', 'pu_theme_options.php', 'pu_theme_page');  
}
add_action('admin_menu', 'pu_theme_menu');

function pu_theme_page()
{
?>
    <div class="section panel">
      <h1>Edycja danych motywu</h1>
      <form method="post" enctype="multipart/form-data" action="options.php">
      <hr>
        <?php 

          settings_fields('pu_theme_options'); 
        
          do_settings_sections('pu_theme_options.php');
          echo '<hr>';
        ?>
            <p class="submit">  
                <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />  
            </p>
      </form>
    </div>
    <?php
}

add_action( 'admin_init', 'pu_register_settings' );

/**
 * Function to register the settings
 */
function pu_register_settings()
{
    // Register the settings with Validation callback
    register_setting( 'pu_theme_options', 'pu_theme_options' );

	// Add settings section
    add_settings_section( 'pu_text_section2', 'Treść sekcji "Polecam"', '', 'pu_theme_options.php' );
	
	 $field_args = array(
      'type'      => 'text',
      'id'        => 'blockquote_paragraph',
      'name'      => 'blockquote_paragraph',
      'std'       => '',
      'label_for' => 'blockquote_paragraph',
      'class'     => 'css_class'
    );

    add_settings_field( 'blockquote_paragraph', 'Swój tekst', 'pu_display_setting', 'pu_theme_options.php', 'pu_text_section2', $field_args );

    $field_args = array(
      'type'      => 'text',
      'id'        => 'blockquote_link',
      'name'      => 'blockquote_link',
      'desc'      => 'Na przykład: http://www.complex.com',
      'std'       => '',
      'label_for' => 'blockquote_link',
      'class'     => 'css_class'
    );

    add_settings_field( 'blockquote_link', 'Link', 'pu_display_setting', 'pu_theme_options.php', 'pu_text_section2', $field_args );   
	
    $field_args = array(
      'type'      => 'text',
      'id'        => 'blockquote_link_text',
      'name'      => 'blockquote_link_text',
      'std'       => '',
      'label_for' => 'blockquote_link_text',
      'class'     => 'css_class'
    );

    add_settings_field( 'blockquote_link_text', 'Wyświetlany tekst linku', 'pu_display_setting', 'pu_theme_options.php', 'pu_text_section2', $field_args );
	
    // Add settings section two
    add_settings_section( 'pu_text_section', 'Linki do Social Media', '', 'pu_theme_options.php' );

    $field_args = array(
      'type'      => 'text',
      'id'        => 'facebook_link',
      'name'      => 'facebook_link',
      'desc'      => 'Facebook Link - Na przykład: http://facebook.com/username',
      'std'       => '',
      'label_for' => 'facebook_link',
      'class'     => 'css_class'
    );

    // Add facebook field
    add_settings_field( 'facebook_link', 'Facebook', 'pu_display_setting', 'pu_theme_options.php', 'pu_text_section', $field_args );

    $field_args = array(
      'type'      => 'text',
      'id'        => 'twitter_link',
      'name'      => 'twitter_link',
      'desc'      => 'Twitter Link -  Na przykład: http://twitter.com/username',
      'std'       => '',
      'label_for' => 'twitter_link',
      'class'     => 'css_class'
    );

    // Add twitter field
    add_settings_field( 'twitter_link', 'Twitter', 'pu_display_setting', 'pu_theme_options.php', 'pu_text_section', $field_args );   
	
    $field_args = array(
      'type'      => 'text',
      'id'        => 'instagram_link',
      'name'      => 'instagram_link',
      'desc'      => 'Instagram Link -  Na przykład: http://instagram.com/username',
      'std'       => '',
      'label_for' => 'instagram_link',
      'class'     => 'css_class'
    );

    // Add Instagram field
    add_settings_field( 'instagram_link', 'Instagram', 'pu_display_setting', 'pu_theme_options.php', 'pu_text_section', $field_args );
	
	// Add settings section three
    add_settings_section( 'pu_text_section3', 'Zdjęcie i opis autorki w sidebarze', '', 'pu_theme_options.php' );
	
	 $field_args = array(
      'type'      => 'text',
      'id'        => 'author_photo_link',
      'name'      => 'author_photo_link',
	  'desc'      => 'Do znalezienia w Media --> Biblioteka i kliknięciu na dane zdjęcie. Na przykład: http://michaldevelopwp.azurewebsites.net/wp-content/uploads/2016/06/autorka-profilowe.png',
      'std'       => '',
      'label_for' => 'author_photo_link',
      'class'     => 'css_class'
    );

    add_settings_field( 'author_photo_link', 'Link do zdjęcia', 'pu_display_setting', 'pu_theme_options.php', 'pu_text_section3', $field_args );

    $field_args = array(
      'type'      => 'text',
      'id'        => 'author_description',
      'name'      => 'author_description',
      'std'       => '',
      'label_for' => 'author_description',
      'class'     => 'css_class'
    );

    add_settings_field( 'author_description', 'Opis autorki', 'pu_display_setting', 'pu_theme_options.php', 'pu_text_section3', $field_args );
	
	// Add settings section four
    add_settings_section( 'pu_text_section4', 'Inne', '', 'pu_theme_options.php' );
	
	 $field_args = array(
      'type'      => 'text',
      'id'        => 'post_display_length',
      'name'      => 'post_display_length',
	  'desc'      => 'Wyświetlana ilość znaków przy każdym poście na stronie głównej i w menu kategorii. Wpisujemy na przykład: 35',
      'std'       => '',
      'label_for' => 'post_display_length',
      'class'     => 'css_class'
    );

    add_settings_field( 'post_display_length', 'Ilość znaków postów w formie skróconej', 'pu_display_setting', 'pu_theme_options.php', 'pu_text_section4', $field_args );  
}


// allow wordpress post editor functions to be used in theme options
function pu_display_setting($args)
{
    extract( $args );

    $option_name = 'pu_theme_options';

    $options = get_option( $option_name );

    switch ( $type ) {  
          case 'text':  
              $options[$id] = stripslashes($options[$id]);  
              $options[$id] = esc_attr( $options[$id]);  
              echo "<input class='regular-text$class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";  
              echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
          break;
          case 'textarea':  
              $options[$id] = stripslashes($options[$id]);  
              //$options[$id] = esc_attr( $options[$id]);
              $options[$id] = esc_html( $options[$id]); 

              printf(
              	wp_editor($options[$id], $id, 
              		array('textarea_name' => $option_name . "[$id]",
              			'style' => 'width: 200px'
              			)) 
				);
              // echo "<textarea id='$id' name='" . $option_name . "[$id]' rows='10' cols='50'>".$options[$id]."</textarea>";  
              // echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";  
          break; 
    }
}

function pu_validate_settings($input)
{
  foreach($input as $k => $v)
  {
    $newinput[$k] = trim($v);
    
    // Check the input is a letter or a number
    if(!preg_match('/^[A-Z0-9 _]*$/i', $v)) {
      $newinput[$k] = '';
    }
  }

  return $newinput;
}

// Add custom styles to theme options area
add_action('admin_head', 'custom_style');

function custom_style() {
  echo '<style>
    .appearance_page_pu_theme_options .wp-editor-wrap {
      width: 75%;
    }
    .regular-textcss_class {
    	width: 50%;
    }
    .appearance_page_pu_theme_options h3 {
    	font-size: 2em;
    	padding-top: 40px;
    }
  </style>';
}

// END THEME OPTIONS


/**
 * Load site scripts.
 */
function bootstrap_theme_enqueue_scripts() {
	$template_url = get_template_directory_uri();

	// jQuery.
	wp_enqueue_script( 'jquery' );

	// Bootstrap
	wp_enqueue_script( 'bootstrap-script', $template_url . '/js/bootstrap.min.js', array( 'jquery' ), null, true );

	wp_enqueue_style( 'bootstrap-style', $template_url . '/css/bootstrap.min.css' );

	//Main Style
	wp_enqueue_style( 'main-style', get_stylesheet_uri() );

	// Load Thread comments WordPress script.
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'bootstrap_theme_enqueue_scripts', 1 );



add_filter( 'wp_title', 'wpdocs_hack_wp_title_for_home' );
 
/**
 * Customize the title for the home page, if one is not set.
 *
 * @param string $title The original title.
 * @return string The title to use.
 */
function wpdocs_hack_wp_title_for_home( $title )
{
  if ( empty( $title ) && ( is_home() || is_front_page() ) ) {
    $title = __( '', 'textdomain' ) . '' . get_bloginfo( 'description' );
  }
  return $title;
}



// Decrease excerpt length
function my_excerpt_length($length) {
	return POST_DISPLAY_LENGTH; // Or whatever you want the length to be.
}
add_filter('excerpt_length', 'my_excerpt_length');



function short_title($after = '', $length) {
	$mytitle = get_the_title();
	if ( strlen($mytitle) > $length ) {
	$mytitle = substr($mytitle,0,$length);
	echo $mytitle . $after;
	} else {
	echo $mytitle;
	}
}



add_action('admin_notices', 'showAdminMessages');

function showAdminMessages()
{
	$plugin_messages = array();

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

	// Download the Instagram image gallery plugin
	if(!is_plugin_active( 'instagram-image-gallery/plugin.php' ))
	{
		$plugin_messages[] = 'Ten motyw wymaga instalacji oraz włączenia wtyczki Instagram image gallery do poprawnego działania, możesz ją pobrać klikając <a href="https://wordpress.org/plugins/instagram-image-gallery/">tutaj</a>.';
	}

	// Download the Disqus Comment System
	if(!is_plugin_active( 'disqus-comment-system/disqus.php' ))
	{
		$plugin_messages[] = 'Ten motyw wymaga instalacji oraz włączenia wtyczki Disqus Comment System do poprawnego działania, możesz ją pobrać klikając <a href="http://wordpress.org/extend/plugins/disqus-comment-system/">tutaj</a>.';
	}

	if(count($plugin_messages) > 0)
	{
		echo '<div id="message" class="error">';

			foreach($plugin_messages as $message)
			{
				echo '<p><strong>'.$message.'</strong></p>';
			}

		echo '</div>';
	}
}



?>
