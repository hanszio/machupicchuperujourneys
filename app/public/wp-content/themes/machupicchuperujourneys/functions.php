<?php
//
//Cambiar la página de login para el wordpress
/* function redirect_to_nonexistent_page(){
    $new_login=  'ingreso-seguro';
    if(strpos($_SERVER['REQUEST_URI'], $new_login) === false){
        //wp_safe_redirect( home_url( '404' ), 302 );
    exit(); 
    }
}
add_action( 'login_head', 'redirect_to_nonexistent_page'); */

/* function redirect_to_actual_login(){
    $new_login =  'newlogin';
    if(parse_url($_SERVER['REQUEST_URI'],PHP_URL_QUERY) == $new_login&& ($_GET['redirect'] !== false)){     
        wp_safe_redirect(home_url("wp-login.php?$new_login&redirect=false"));
    exit();
}
}
add_action( 'init', 'redirect_to_actual_login'); */
/* LINK PARA INGRESAR A WP-ADMIN: www.paginaweb.com/wp-login.php?ingreso-seguro&redirect=false */

//
// Registrar Menu
if (function_exists('register_nav_menu')) {
    add_action('init', 'register_my_menu');
    function register_my_menu()
    {
        register_nav_menu('menu-principal', __('PRINCIPAL'));
        /* Aqui puedes registrar un Menu nuevo */
    }
}

//
function theme_scripts_method()
{
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'theme_scripts_method');
//Registro de Assets //Estilos y Fuentes exteriores
function add_theme_scripts()
{
    wp_enqueue_style('style', get_stylesheet_uri(), '', '1.0', 'all');
    wp_enqueue_style('style-tablet', get_template_directory_uri() . '/assets/css/tablet.css', array(), '1.0', 'screen and (min-width: 420px) and (max-width: 1199px)');
    wp_enqueue_style('style-desktop', get_template_directory_uri() . '/assets/css/desktop.css', array(), '1.0', 'screen and (min-width: 1200px)');
    wp_enqueue_style('work-sans', 'https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap', '', '1.0', 'all');
    wp_enqueue_style('caecilia', 'https://use.typekit.net/ikb5blt.css', '', '1.0', 'all');
    wp_enqueue_style('tiny-slider', 'https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.3/tiny-slider.css', '', '2.9.3', 'all');
    wp_enqueue_style('lightbox-style', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css', array(), '2.11.3');

    wp_enqueue_script('lightbox-script', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js', array('jquery'), '2.11.3', true);
    wp_enqueue_script('tiny-slider', 'https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js', '', '2.9.2', true);
    wp_enqueue_script('font-awesome', 'https://kit.fontawesome.com/3dddaedd28.js', '', '6.0', true);
    wp_enqueue_script('custom', get_template_directory_uri() . '/assets/js/custom.js', '', '1.0', true);
}
add_action('wp_enqueue_scripts', 'add_theme_scripts');
//

//Registro de Widgets
function sidebar()
{
    register_sidebar(
        array(
            'name'          => 'Pie de página',
            'id'            => 'footer',
            'description'   => 'Zona de Widgets para pie de página',
            'before_title'  => '<h3>', 'after_title'  => '</h3>',
            'before_widget' => '<div id="%1$s" class="footerItem %2$s">',
            'after_widget'  => '</div>',
        )
    );
    register_sidebar(
        array(
            'name'          => 'Encabezado',
            'id'            => 'header',
            'description'   => 'Zona de Widgets para el Encabezado',
            'before_title'  => '<h3>', 'after_title'  => '</h3>',
            'before_widget' => '<div id="%1$s" class="headerItem %2$s">',
            'after_widget'  => '</div>',
        )
    );
    register_sidebar(
        array(
            'name'          => 'Sidebar Right Tours',
            'id'            => 'tours_widgets',
            'description'   => 'Zona de Widgets para los Tours',
            'before_title'  => '<h3>', 'after_title'  => '</h3>',
            'before_widget' => '<div id="tours_widgets" class="section_sidebar %2$s">',
            'after_widget'  => '</div>',
        )
    );
    register_sidebar(
        array(
            'name'          => 'Sidebar Right Pages',
            'id'            => 'pages_widgets',
            'description'   => 'Zona de Widgets para las Paginas',
            'before_title'  => '<h3>', 'after_title'  => '</h3>',
            'before_widget' => '<div id="pages_widgets" class="section_sidebar %2$s">',
            'after_widget'  => '</div>',
        )
    );
}

add_action('widgets_init', 'sidebar');

//
// Registrar Miniaturas y Tags de Titulo en nuevo post type
add_theme_support('post-thumbnails');
add_theme_support('title-tag');
//

//Registro de nuevo post type //Solo cambiar el "Tours o Tour" por un nuevo nombre
function tours_type()
{
    $labels = array(
        'name'          => 'Tours',
        'singular_name' => 'Tour',
        'menu_name'     => 'Tours',
        'add_new_item'  => 'Agregar nuevo Tour',
        'add_new'       => 'Agregar nuevo',
    );
    $args = array(
        'label'             => 'Tours',
        'description'       => 'Tours disponibles',
        'labels'            => $labels,
        'supports'          => array('title', 'editor', 'thumbnail', 'revisions'),
        'public'            => true,
        'show_in_menu'      => true,
        'menu_position'     => 5,
        'menu_icon'         => 'dashicons-airplane',
        'can_export'        => true,
        'publicly_queryable' => true,
        'rewrite'           => true,
        'show_in_rest'      => true,
        'taxonomies'        => array('tipo-de-tour'),
    );
    register_post_type('tour', $args);
}
add_action('init', 'tours_type');


// Lo enganchamos en la acción init y llamamos a la función create_book_taxonomies() cuando arranque
add_action('init', 'create_tours_taxonomies', 0);

// Creamos dos taxonomías, género y autor para el custom post type "libro"
function create_tours_taxonomies()
{
    /* Configuramos las etiquetas que mostraremos en el escritorio de WordPress */
    $labels = array(
        'name'             => _x('Tipo de Tour', 'taxonomy general name'),
        'singular_name'    => _x('Tipo de Tours', 'taxonomy singular name'),
        'search_items'     => __('Buscar por Tour'),
        'all_items'        => __('Todos los Tours'),
        'parent_item'      => __('Tour padre'),
        'parent_item_colon' => __('Tour padre:'),
        'edit_item'        => __('Editar Tour'),
        'update_item'      => __('Actualizar Tour'),
        'add_new_item'     => __('Añadir nuevo Tour'),
        'new_item_name'    => __('Nombre del nuevo Tour'),
        'menu_name'        => __('Categorias Tours'),
    );

    /* Registramos la taxonomía y la configuramos como jerárquica (al estilo de las categorías) */
    register_taxonomy('tipo-de-tour', array('tour'), array(
        'hierarchical'       => true,
        'labels'             => $labels,
        'show_ui'            => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'tipo-de-tour'),
        'show_in_rest'       => true,
        'show_admin_column'  => true,
    ));

    /* Si quieres añadir la siguiente taxonomía del ejemplo, sustituye esta línea por la del código correspondiente */
}
/////////////////////////////////PERSONALIZACIÓN WP/////////////////////////////////
//Cambiar los estilos del Login de Wordpress
function my_login_stylesheet()
{
    wp_enqueue_style('custom-login', get_stylesheet_directory_uri() . '/assets/css/wp-login.css');
}
add_action('login_enqueue_scripts', 'my_login_stylesheet');

//
//* Cambia el logotipo de la página inicio de sesión de WordPress (usar imagen de 80x80px)
function mi_logo_personalizado_css() {
    $custom_css = '
        body.login div#login h1 a {
            background-image: url(' . get_stylesheet_directory_uri() . '/assets/images/login-logo.svg);
            background-size: 100%;
            width: 210px;
            height: 120px;
        }
    ';
    wp_add_inline_style('login', $custom_css);
}
add_action('login_enqueue_scripts', 'mi_logo_personalizado_css');


//
//* Personaliza el enlace y título de la imagen de inicio de sesión de WordPress
function mi_logo_personalizado_url()
{
    return get_bloginfo('url');
}
add_filter('login_headerurl', 'mi_logo_personalizado_url');

function mi_logo_personalizado_url_titulo()
{
    return 'Construtecnia';
}
add_filter('login_headertitle', 'mi_logo_personalizado_url_titulo');

/////////////////////////////////PERSONALIZACIÓN WP/////////////////////////////////


//Habilitar Logo Personalizado
add_theme_support('custom-logo');


//*** Activar el soporte para archivos de imagen *.webp ***/
function webp_upload_mimes($existing_mimes)
{
    $existing_mimes['webp'] = 'image/webp';
    return $existing_mimes;
}
add_filter('mime_types', 'webp_upload_mimes');

//
//*** Activar previsualización / miniaturas para archivos de imagen *.webp ***/
function webp_is_displayable($result, $path)
{
    if ($result === false) {
        $displayable_image_types = array(IMAGETYPE_WEBP);
        $info = @getimagesize($path);

        if (empty($info)) {
            $result = false;
        } elseif (!in_array($info[2], $displayable_image_types)) {
            $result = false;
        } else {
            $result = true;
        }
    }

    return $result;
}
add_filter('file_is_displayable_image', 'webp_is_displayable', 10, 2);
//
// Funcion que limita el estracto
function excerpt($limit)
{
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt) . '...';
    } else {
        $excerpt = implode(" ", $excerpt);
    }
    $excerpt = preg_replace('`[[^]]*]`', '', $excerpt);
    return $excerpt;
}

// Funcion que Evita que CF7 ponga etiquetas p automaticamente
add_filter('wpcf7_autop_or_not', '__return_false');
//
/*Llamar extracto en template con:
<?php echo excerpt(25); ?>

/* Declarar Widget
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Logo') ) : endif; ?>

/*
Template Name: Full-width layout
Template Post Type: post, page, product
Single Post Template: [Descriptive Template Name]
Description: This part is optional, but helpful for describing the Post Template
*/

/* Oculta actualizaciones en WordPress
function wp_hide_update() {
    remove_action('admin_notices', 'update_nag', 3);
}
add_action('admin_menu','wp_hide_update');

/*Temporalmente en mantenimiento con - http response 503 (Service Temporarily Unavailable) Bloquea la vista de la web a los usuarios no administradores.
function wp_maintenance_mode(){
    if(!current_user_can('edit_themes') || !is_user_logged_in()){
        wp_die('En mantenimiento, disculpe las molestias. Vuelva  a intentarlo más tarde.', 'En mantenimiento, disculpe las molestias. Vuelva  a intentarlo más tarde.'', array('response' => '503'));
    }
}
add_action('get_header', 'wp_maintenance_mode');

/*Permitir PHP en los widgets de texto de WordPress
function php_text($text) {
 if (strpos($text, '<' . '?') !== false) {
 ob_start();
 eval('?' . '>' . $text);
 $text = ob_get_contents();
 ob_end_clean();
 }
 return $text;
}
add_filter('widget_text', 'php_text', 99);

/*Agregar .js escritorio wordpress
function custom_register_admin_scripts() {

wp_register_script( 'custom-javascript', get_template_directory_uri() . '/custom.js' );
wp_enqueue_script( 'custom-javascript' );

}
add_action( 'admin_enqueue_scripts', 'custom_register_admin_scripts' );

/*---
if ( ! is_super_admin() ) {} // diferente a super administrador
if (! current_user_can( 'manage_options' )) {}  // diferente a manage_options  

/*Agregar .css escritorio wordpress
function load_custom_wp_admin_style() {
        wp_register_style( 'custom_wp_admin_css', get_template_directory_uri() . '/admin-style.css', false, '1.0.0' );
        wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );

/*Agregar estilo administración wordpress
add_action('admin_head', 'my_custom_fonts');
function my_custom_fonts() {
  echo '<style>
    body, td, textarea, input, select {
      font-family: "Lucida Grande";
      font-size: 12px;
    } 
  </style>';
}

/*Eliminar elementos no deseados del panel
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
function my_custom_dashboard_widgets() {
global $wp_meta_boxes;
 //Right Now - Comments, Posts, Pages at a glance
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
//Recent Comments
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
//Incoming Links
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
//Plugins - Popular, New and Recently updated Wordpress Plugins
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);

//Wordpress Development Blog Feed
unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
//Other Wordpress News Feed
unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
//Quick Press Form
unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
//Recent Drafts List
unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
}

/*Extracto EDITOR -----------------------------
class TinyMceExcerptCustomization{
	const textdomain = '';
	const custom_exceprt_slug = '_custom-excerpt';
	var $contexts;

	 // Set the feature up
	 // @param array $contexts a list of context where you want the wysiwyg editor in the excerpt field. Defatul array('post','page')
	function __construct($contexts=array('post', 'page')){
		
		$this->contexts = $contexts;
		
		add_action('admin_menu', array($this, 'remove_excerpt_metabox'));
		add_action('add_meta_boxes', array($this, 'add_tinymce_to_excerpt_metabox'));
		add_filter('wp_trim_excerpt',  array($this, 'custom_trim_excerpt'), 10, 2);
		add_action('save_post', array($this, 'save_box'));
	}
	 // Removes the default editor for the excerpt
	function remove_excerpt_metabox(){
		foreach($this->contexts as $context)
			remove_meta_box('postexcerpt', $context, 'normal');
	}
	 // Adds a new excerpt editor with the wysiwyg editor
	function add_tinymce_to_excerpt_metabox(){
		foreach($this->contexts as $context)
		add_meta_box(
			'tinymce-excerpt', 
			__('Excerpt', self::textdomain), 
			array($this, 'tinymce_excerpt_box'), 
			$context, 
			'normal', 
			'high'
		);
	}
	 // Manages the excerpt escaping process
	 // @param string $text the default filtered version
	 // @param string $raw_excerpt the raw version
	function custom_trim_excerpt($text, $raw_excerpt) {
		global $post;
		$custom_excerpt = get_post_meta($post->ID, self::custom_exceprt_slug, true);
		if(empty($custom_excerpt)) return $text;
		return $custom_excerpt;
	}
	 // Prints the markup for the tinymce excerpt box
	 // @param object $post the post object
	function tinymce_excerpt_box($post){
		$content = get_post_meta($post->ID, self::custom_exceprt_slug, true);
		if(empty($content)) $content = '';
		wp_editor(
			$content,
			self::custom_exceprt_slug,
			array(
				'wpautop'		=>	true,
				'media_buttons'	=>	false,
				'textarea_rows'	=>	10,
				'textarea_name'	=>	self::custom_exceprt_slug
			)
		);
	}
	 // Called when the post is beeing saved
	 // @param int $post_id the post id
	function save_box($post_id){
		update_post_meta($post_id, self::custom_exceprt_slug, $_POST[self::custom_exceprt_slug]);
	}
}

global $tinymce_excerpt;
$tinymce_excerpt = new TinyMceExcerptCustomization();

//-------------------------------------------------------------------------------------------------

/*Taxonomias en Entradas
function tax_propias() {
        register_taxonomy('artista', 'post', array('hierarchical' => false, 'label' => 'Artista', 'query_var' => true, 'rewrite' => true));
    }
add_action('init', 'tax_propias', 0);

/*Taxonomias en Páginas
register_taxonomy( 'people', 'page', array( 'hierarchical' => false, 'label' => 'People', 'query_var' => true, 'rewrite' => true ) );
add_action( 'admin_menu', 'my_page_taxonomy_meta_boxes' );
function my_page_taxonomy_meta_boxes() {
    foreach ( get_object_taxonomies( 'page' ) as $tax_name ) {
        if ( !is_taxonomy_hierarchical( $tax_name ) ) {
            $tax = get_taxonomy( $tax_name );
            add_meta_box( "tagsdiv-{$tax_name}", $tax->label, 'post_tags_meta_box', 'page', 'side', 'core' );
        }
    }
}

/*Para crear nuevo Menu
    if (function_exists('register_nav_menu')) {
        register_nav_menu('menu-1', 'Menú Left 1');
        register_nav_menu('menu-2', 'Menú Left 2');
        register_nav_menu('menu-3', 'Menú Left 3');
        register_nav_menu('menu-4', 'Menú Left 4');
        register_nav_menu('menu-5', 'Menú Left 5');
    }

/*Declarar menu en header, page, single, footer, etc.
    <?php wp_nav_menu( array( 'theme_location' => 'menu-1' ) ); ?>
    <?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'container_id' => 'menu', 'link_before' => '<span>', 'link_after' => '</span>')); ?>

    PARAMETROS
    'theme_location'  => '',
    'menu'            => '',
    'container'       => 'div',
    'container_class' => '',
    'container_id'    => '',
    'menu_class'      => 'menu',
    'menu_id'         => '',
    'echo'            => true,
    'fallback_cb'     => 'wp_page_menu',
    'before'          => '',
    'after'           => '',
    'link_before'     => '',
    'link_after'      => '',
    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
    'depth'           => 0,
    'walker'          => ''

/*Añadir un favicon a tu blog
function blog_favicon() {
echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo('wpurl').'/favicon.ico" />';
}
add_action('wp_head', 'blog_favicon');

/*Scripts de Contact Form 7 sólo en las páginas seleccionadas
function add_wpcf7_scripts() {
    if ( is_page('33') )
    wpcf7_enqueue_scripts();
}
if ( ! is_admin() && WPCF7_LOAD_JS )
    remove_action( 'init', 'wpcf7_enqueue_scripts' );
    add_action( 'wp', 'add_wpcf7_scripts' );
    
/*
Crear imagen miniatura determinada
if ( function_exists( 'add_image_size' ) ) {
    add_image_size('directorio', 150, 200, true);
}
function hmuda_image_sizes($sizes) {
    $addsizes = array(
        "directorio" => __( "Directorio institucional"),
    );
    $newsizes = array_merge($sizes, $addsizes);
    return $newsizes;
}
add_filter('image_size_names_choose', 'hmuda_image_sizes');

/*DATOS DE CATEGORIA
<?php echo single_cat_title("", false); ?>
<?php echo category_description(ID); ?>
<?php echo get_cat_name(ID);?>
<?php get_category_link(ID); ?>
remove_filter('term_description','wpautop');
*/

/* Activar Comments -----------------------------
function widget_mytheme_search() {
?>
<li><h2>Search</h2>
<form id="searchform" method="get" action="<?php bloginfo('home'); ?>/"> <input type="text" value="Buscar..." onfocus="if (this.value == 'Buscar...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Buscar...';}" size="18" maxlength="50" name="s" id="s" /> </form> </li>
<?php
}
if ( function_exists('register_sidebar_widget') )
    register_sidebar_widget(__('Search'), 'widget_mytheme_search');
?>
<?php
function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>">
      <div class="comment-author vcard">
         <?php echo get_avatar($comment,$size='32',$default='<path_to_url>' ); ?>

         <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
      </div>
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Tu comentario está pendiente de moderación.') ?></em>
         <br />
      <?php endif; ?>

      <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?></div>

      <?php comment_text() ?>

      <div class="reply">
         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </div>
     </div>
<?php
        }
/* Eliminar URL del cuadro de comentarios
function remove_comment_fields($fields) {
    unset($fields['url']);
    return $fields;
}
add_filter('comment_form_default_fields',remove_comment_fields);

//Llamar a COMMENTS <?php comments_template(); ?> 
*/
?>