<?php 
class ULT_Theme_Menu_Walker extends Walker_Nav_Menu
{
	/**
	 * Start the element output.
	 *
	 * @see Walker::start_el()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 * @param int    $id     Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		if($depth == 0 && get_mega_menu_meta($item->ID, 'enabled')){
			$new_args = new stdClass;
			$new_args->mega_menu_item = 'yes';
			//$args = array_merge((array)$args,(array)$new_args);
			//print_r($args);
			$classes[] = 'mega-menu-item';
		}
		/**
		 * Filter the CSS class(es) applied to a menu item's <li>.
		 *
		 * @since 3.0.0
		 *
		 * @see wp_nav_menu()
		 *
		 * @param array  $classes The CSS classes that are applied to the menu item's <li>.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of wp_nav_menu() arguments.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
		/**
		 * Filter the ID applied to a menu item's <li>.
		 *
		 * @since 3.0.1
		 *
		 * @see wp_nav_menu()
		 *
		 * @param string $menu_id The ID that is applied to the menu item's <li>.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of wp_nav_menu() arguments.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
		$output .= $indent . '<li' . $id . $class_names .'>';
		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
		/**
		 * Filter the HTML attributes applied to a menu item's <a>.
		 *
		 * @since 3.6.0
		 *
		 * @see wp_nav_menu()
		 *
		 * @param array $atts {
		 *     The HTML attributes applied to the menu item's <a>, empty strings are ignored.
		 *
		 *     @type string $title  Title attribute.
		 *     @type string $target Target attribute.
		 *     @type string $rel    The rel attribute.
		 *     @type string $href   The href attribute.
		 * }
		 * @param object $item The current menu item.
		 * @param array  $args An array of wp_nav_menu() arguments.
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}
# BEGIN - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		 $item_output = $args->before;
		 $item_output .= '<a'. $attributes .'>';
//		 print_r($item);
		 /** This filter is documented in wp-includes/post-template.php */
		 $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		 $item_output .= '</a>';
		 $item_output .= $args->after;
# END - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		/**
		 * Filter a menu item's starting output.
		 *
		 * The menu item's starting output only includes $args->before, the opening <a>,
		 * the menu item's title, the closing </a>, and $args->after. Currently, there is
		 * no filter for modifying the opening and closing <li> for a menu item.
		 *
		 * @since 3.0.0
		 *
		 * @see wp_nav_menu()
		 *
		 * @param string $item_output The menu item's starting HTML output.
		 * @param object $item        Menu item data object.
		 * @param int    $depth       Depth of menu item. Used for padding.
		 * @param array  $args        An array of wp_nav_menu() arguments.
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		if ( !$element )
			return;
		$id_field = $this->db_fields['id'];

		//display this element
		if ( isset( $args[0] ) && is_array( $args[0] ) )
			$args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array($this, 'start_el'), $cb_args);
		$id = $element->$id_field;
		// descend only when the depth is right and there are childrens for this element
		if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {
			foreach( $children_elements[ $id ] as $child ){
# BEGIN - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
				if ($depth == 0 && get_mega_menu_meta($id, 'enabled') && get_mega_menu_meta($child, 'new-row')) {
					if (isset($newlevel) && $newlevel) {
						$cb_args = array_merge( array(&$output, $depth), $args);
						call_user_func_array(array($this, 'end_lvl'), $cb_args);
						unset($newlevel);
					}
				}
# END - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
				if ( !isset($newlevel) ) {
					$newlevel = true;
# BEGIN - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
					if (!isset($mega_menu_container) && $depth == 0 && get_mega_menu_meta($id, 'enabled')) {
						$mega_menu_container = true;
						$output .= '<div class="mega-menu">';
					}
					$class = 'sub-menu';
					if (isset($mega_menu_container)) {
						$class .= ' mega-menu-row';
					}
# END - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
					//start the child delimiter
					//print_r($args);
					$cb_args = array_merge( array(&$output, $depth), $args, array($class));
					call_user_func_array(array($this, 'start_lvl'), $cb_args);
				}
				$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
			}
			unset( $children_elements[ $id ] );
		}
		if ( isset($newlevel) && $newlevel ){
			//end the child delimiter
			$cb_args = array_merge( array(&$output, $depth), $args);
			call_user_func_array(array($this, 'end_lvl'), $cb_args);
		}
# BEGIN - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		if (isset($mega_menu_container)) {
			$output .= '</div>';
		}
# END - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		//end this element
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array($this, 'end_el'), $cb_args);
	}
	function start_lvl( &$output, $depth = 0, $args = array(), $class = 'sub-menu' ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"$class\">\n";
	}
}
add_filter('wp_nav_menu_args', 'ult_theme_filter_wp_nav_menu_args');
/**
 * @internal
 */
function ult_theme_filter_wp_nav_menu_args($args)
{
	if(has_nav_menu( 'primary' )){
		$args['walker'] = new ULT_Theme_Menu_Walker();
	}
	$args['fallback_cb'] = 'wp_page_menu';
	return $args;
}
