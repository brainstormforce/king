<?php
/*
 *
 * Include Breadcrumbs
 *
 * @package King
 * @since King 1.0
 */


if(!function_exists("king_breadcrumb")){
	function king_breadcrumb() {
	
		/* Set up the arguments for the breadcrumb. */
	
		$opts = get_option("rdfa_options");	
	
		$args = array(
			'prefix' 		=> $opts['prefix'],
			'suffix' 		=> $opts['suffix'],
			'title' 		=> $opts['title'], //__( ' ', 'rdfa-breadcrumb' ),
			'home_title' 		=> $opts['home_title'], //__( 'Home', 'rdfa-breadcrumb' ),
			'separator'		=> $opts['separator'],
			'front_page' 		=> false,
			'show_blog' 		=> false,
			'singular_post_taxonomy'=> 'category',
			'echo' 			=> true
		);
	
		if ( is_front_page() && !$args['front_page'] )
			return apply_filters( 'rdfa_breadcrumb', false );
	
		/* Format the title. */
		$title = ( !empty( $args['title'] ) ? '<span class="breadcrumbs-title">' . $args['title'] . '</span>': '' );
	
		$separator = ( !empty( $args['separator'] ) ) ? "<span class='separator'>{$args['separator']}</span>" : "<span class='separator'>/</span>";
	
		/* Get the items. */
		$items = rdfa_breadcrumb_get_items( $args );
		
		$breadcrumbs = '<!-- RDFa Breadcrumbs start -->';
		$breadcrumbs .= '<div class="breadcrumbs"><div xmlns:v="http://rdf.data-vocabulary.org/#">';
		$breadcrumbs .= $args['prefix'];
		$breadcrumbs .= $title;
		$breadcrumbs .= join( " {$separator} ", $items );
		$breadcrumbs .= $args['suffix'];
		$breadcrumbs .= '</div></div>';
		$breadcrumbs .= '<!-- RDFa breadcrumbs end -->';
	
		$breadcrumbs = apply_filters( 'rdfa_breadcrumb', $breadcrumbs );
	
		if ( !$args['echo'] )
			return $breadcrumbs;
		else
			echo $breadcrumbs;
	}
	
	/**
	 * Gets the items for the RDFa Breadcrumb.
	 *
	 * @since 0.4
	 */
	function rdfa_breadcrumb_get_items( $args ) {
		global $wp_query;
	
		$item = array();
	
		$show_on_front = get_option( 'show_on_front' );
	
		/* Front page. */
		if ( is_front_page() ) {
			$item['last'] = $args['home_title'];
		}
	
		/* Link to front page. */
		if ( !is_front_page() )
			$item[] = '<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="'. home_url( '/' ) .'" class="fa fa-home">' . $args['home_title'] . '</a></span>';
	
		/* If bbPress is installed and we're on a bbPress page. */
		if ( function_exists( 'is_bbpress' ) && is_bbpress() )
			$item = array_merge( $item, rdfa_breadcrumb_get_bbpress_items() );
	
		/* If viewing a home/post page. */
		elseif ( is_home() ) {
			$home_page = get_page( $wp_query->get_queried_object_id() );
			$item = array_merge( $item, rdfa_breadcrumb_get_parents( $home_page->post_parent ) );
			$item['last'] = get_the_title( $home_page->ID );
		}
	
		/* If viewing a singular post. */
		elseif ( is_singular() ) {
	
			$post = $wp_query->get_queried_object();
			$post_id = (int) $wp_query->get_queried_object_id();
			$post_type = $post->post_type;
	
			$post_type_object = get_post_type_object( $post_type );
	
			if ( 'post' === $wp_query->post->post_type && $args['show_blog'] ) {
				$item[] = '<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_permalink( get_option( 'page_for_posts' ) ) . '">' . get_the_title( get_option( 'page_for_posts' ) ) . '</a></span>';
			}
	
			if ( 'page' !== $wp_query->post->post_type ) {
	
				/* If there's an archive page, add it. */
				if ( function_exists( 'get_post_type_archive_link' ) && !empty( $post_type_object->has_archive ) )
					$item[] = '<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_post_type_archive_link( $post_type ) . '" title="' . esc_attr( $post_type_object->labels->name ) . '">' . $post_type_object->labels->name . '</a></span>';
	
				if ( isset( $args["singular_{$wp_query->post->post_type}_taxonomy"] ) && is_taxonomy_hierarchical( $args["singular_{$wp_query->post->post_type}_taxonomy"] ) ) {
					$terms = wp_get_object_terms( $post_id, $args["singular_{$wp_query->post->post_type}_taxonomy"] );
					$item = array_merge( $item, rdfa_breadcrumb_get_term_parents( $terms[0], $args["singular_{$wp_query->post->post_type}_taxonomy"] ) );
				}
	
				elseif ( isset( $args["singular_{$wp_query->post->post_type}_taxonomy"] ) )
					$item[] = get_the_term_list( $post_id, $args["singular_{$wp_query->post->post_type}_taxonomy"], '', ', ', '' );
			}
	
			if ( ( is_post_type_hierarchical( $wp_query->post->post_type ) || 'attachment' === $wp_query->post->post_type ) && $parents = rdfa_breadcrumb_get_parents( $wp_query->post->post_parent ) ) {
				$item = array_merge( $item, $parents );
			}
	
			$item['last'] = get_the_title();
		}
	
		/* If viewing any type of archive. */
		else if ( is_archive() ) {
	
			if ( is_category() || is_tag() || is_tax() ) {
	
				$term = $wp_query->get_queried_object();
				$taxonomy = get_taxonomy( $term->taxonomy );
	
				if ( ( is_taxonomy_hierarchical( $term->taxonomy ) && $term->parent ) && $parents = rdfa_breadcrumb_get_term_parents( $term->parent, $term->taxonomy ) )
					$item = array_merge( $item, $parents );
	
				$item['last'] = $term->name;
			}
	
			else if ( function_exists( 'is_post_type_archive' ) && is_post_type_archive() ) {
				$post_type_object = get_post_type_object( get_query_var( 'post_type' ) );
				$item['last'] = $post_type_object->labels->name;
			}
	
			else if ( is_date() ) {
	
				if ( is_day() )
					$item['last'] = __( 'Archives for ', 'rdfa-breadcrumb' ) . get_the_time( 'F j, Y' );
	
				elseif ( is_month() )
					$item['last'] = __( 'Archives for ', 'rdfa-breadcrumb' ) . single_month_title( ' ', false );
	
				elseif ( is_year() )
					$item['last'] = __( 'Archives for ', 'rdfa-breadcrumb' ) . get_the_time( 'Y' );
			}
	
			else if ( is_author() )
				$item['last'] = __( 'Archives by: ', 'rdfa-breadcrumb' ) . get_the_author_meta( 'display_name', $wp_query->post->post_author );
		}
	
		/* If viewing search results. */
		else if ( is_search() )
			$item['last'] = __( 'Search results for "', 'rdfa-breadcrumb' ) . stripslashes( strip_tags( get_search_query() ) ) . '"';
	
		/* If viewing a 404 error page. */
		else if ( is_404() )
			$item['last'] = __( 'Page Not Found', 'rdfa-breadcrumb' );
	
		return apply_filters( 'rdfa_breadcrumb_items', $item );
	}
	
	/**
	 * Gets the items for the breadcrumb item if bbPress is installed.
	 *
	 * @since 0.4
	 *
	 * @param array $args Mixed arguments for the menu.
	 * @return array List of items to be shown in the item.
	 */
	function rdfa_breadcrumb_get_bbpress_items( $args = array() ) {
	
		$item = array();
	
		$post_type_object = get_post_type_object( bbp_get_forum_post_type() );
	
		if ( !empty( $post_type_object->has_archive ) && !bbp_is_forum_archive() )
			$item[] = '<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_post_type_archive_link( bbp_get_forum_post_type() ) . '">' . bbp_get_forum_archive_title() . '</a></span>';
	
		if ( bbp_is_forum_archive() )
			$item[] = bbp_get_forum_archive_title();
	
		elseif ( bbp_is_topic_archive() )
			$item[] = bbp_get_topic_archive_title();
	
		elseif ( bbp_is_single_view() )
			$item[] = bbp_get_view_title();
	
		elseif ( bbp_is_single_topic() ) {
	
			$topic_id = get_queried_object_id();
	
			$item = array_merge( $item, rdfa_breadcrumb_get_parents( bbp_get_topic_forum_id( $topic_id ) ) );
	
			if ( bbp_is_topic_split() || bbp_is_topic_merge() || bbp_is_topic_edit() )
				$item[] = '<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . bbp_get_topic_permalink( $topic_id ) . '">' . bbp_get_topic_title( $topic_id ) . '</a></span>';
			else
				$item[] = bbp_get_topic_title( $topic_id );
	
			if ( bbp_is_topic_split() )
				$item[] = __( 'Split', 'rdfa-breadcrumb' );
	
			elseif ( bbp_is_topic_merge() )
				$item[] = __( 'Merge', 'rdfa-breadcrumb' );
	
			elseif ( bbp_is_topic_edit() )
				$item[] = __( 'Edit', 'rdfa-breadcrumb' );
		}
	
		elseif ( bbp_is_single_reply() ) {
	
			$reply_id = get_queried_object_id();
	
			$item = array_merge( $item, rdfa_breadcrumb_get_parents( bbp_get_reply_topic_id( $reply_id ) ) );
	
			if ( !bbp_is_reply_edit() ) {
				$item[] = bbp_get_reply_title( $reply_id );
	
			} else {
				$item[] = '<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . bbp_get_reply_url( $reply_id ) . '">' . bbp_get_reply_title( $reply_id ) . '</a></span>';
				$item[] = __( 'Edit', 'rdfa-breadcrumb' );
			}
	
		}
	
		elseif ( bbp_is_single_forum() ) {
	
			$forum_id = get_queried_object_id();
			$forum_parent_id = bbp_get_forum_parent( $forum_id );
	
			if ( 0 !== $forum_parent_id)
				$item = array_merge( $item, rdfa_breadcrumb_get_parents( $forum_parent_id ) );
	
			$item[] = bbp_get_forum_title( $forum_id );
		}
	
		elseif ( bbp_is_single_user() || bbp_is_single_user_edit() ) {
	
			if ( bbp_is_single_user_edit() ) {
				$item[] = '<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . bbp_get_user_profile_url() . '">' . bbp_get_displayed_user_field( 'display_name' ) . '</a></span>';
				$item[] = __( 'Edit', 'king');
			} else {
				$item[] = bbp_get_displayed_user_field( 'display_name' );
			}
		}
	
		return apply_filters( 'rdfa_breadcrumb_get_bbpress_items', $item, $args );
	}
	
	/**
	 * Gets parent pages of any post type.
	 *
	 * @since 0.1
	 * @param int $post_id ID of the post whose parents we want.
	 * @param string $separator.
	 * @return string $html String of parent page links.
	 */
	function rdfa_breadcrumb_get_parents( $post_id = '', $separator = '/' ) {
	
		$parents = array();
	
		if ( $post_id == 0 )
			return $parents;
	
		while ( $post_id ) {
			$page = get_page( $post_id );
			$parents[]  = '<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '">' . get_the_title( $post_id ) . '</a></span>';
			$post_id = $page->post_parent;
		}
	
		if ( $parents )
			$parents = array_reverse( $parents );
	
		return $parents;
	}
	
	/**
	 * Searches for term parents of hierarchical taxonomies.
	 *
	 * @since 0.1
	 * @param int $parent_id The ID of the first parent.
	 * @param object|string $taxonomy The taxonomy of the term whose parents we want.
	 * @return string $html String of links to parent terms.
	 */
	function rdfa_breadcrumb_get_term_parents( $parent_id = '', $taxonomy = '', $separator = '/' ) {
	
		$html = array();
		$parents = array();
	
		if ( empty( $parent_id ) || empty( $taxonomy ) )
			return $parents;
	
		while ( $parent_id ) {
			$parent = get_term( $parent_id, $taxonomy );
			$parents[] = '<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_term_link( $parent, $taxonomy ) . '" title="' . esc_attr( $parent->name ) . '">' . $parent->name . '</a></span>';
			$parent_id = $parent->parent;
		}
	
		if ( $parents )
			$parents = array_reverse( $parents );
	
		return $parents;
	}
}