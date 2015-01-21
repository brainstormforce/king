<?php

global $post;
?>

<div class="ultimate-page-header">

  <div class="ultimate-row">

    <div class="ultimate-container imd-pagetitle-container">

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-left ultimate-title">

        <?php

			if(is_404()){

				$title = '404 - Page Not Found!';

			} elseif(is_search()){

				$title = 'Search Results -';

			} elseif(is_archive()){

				$title = 'Archives';

			} else {

				if( is_home() && get_option('page_for_posts') ) {

					$blog_page_id = get_option('page_for_posts');

					$title = get_page($blog_page_id)->post_title;

				} else {

					$title = $post->post_title;

				}

			}

				echo '<div class="ultimate-breadcrumb-title">';

				echo '<h3>'.$title.'</h3>';

				echo '</div>';

		?>

      </div>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right ultimate-breadcrumb">

        <?php

		if( function_exists('ultimate_breadcrumb')) {

			ultimate_breadcrumb();

		}

		?>

      </div>

    </div>

    <!-- row --> 

  </div>

</div>