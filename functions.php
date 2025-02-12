<?php
/**
 * Handles loading all the necessary files
 *
 * @package Tutorowl
 */

defined( 'ABSPATH' ) || exit;

/**
 * Require all constants variable
 *
 * @package Tutorowl
 */
require_once __DIR__ . '/constants.php';

/**
 * Tutorowl spl_autoloader
 *
 * @param String $class_name description.
 *
 * @return void
 */
function tutorowl_spl_autoloader( $class_name ) {
	if ( ! class_exists( $class_name ) ) {
		$class_name = preg_replace(
			array( '/([a-z])([A-Z])/', '/\\\/' ),
			array( '$1$2', DIRECTORY_SEPARATOR ),
			$class_name
		);
		$class_name = str_replace( 'Tutorowl' . DIRECTORY_SEPARATOR, '/inc' . DIRECTORY_SEPARATOR, $class_name );
		$file_name  = TUTOROWL_PATH . $class_name . '.php';

		if ( file_exists( $file_name ) ) {
			require_once $file_name;
		}
	}
}

spl_autoload_register( 'tutorowl_spl_autoloader' );

new Tutorowl\Init();

require_once 'inc/template-functions.php';

/**
 * Function for get thumbnail image
 */
if ( ! function_exists( 'tutorowl_post_thumbnail' ) ) {
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function tutorowl_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}
		if ( is_singular() ) :
			?>
			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->
		<?php else : ?>
			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>
			<?php
		endif; // End is_singular().
	}
}


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function tutorowl_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'tutorowl' ),
			'id'            => 'tutorowl-sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'tutorowl' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'tutorowl_widgets_init' );