<?php
/*
Plugin Name: Category Visibility-iPeat Rev
Plugin URI: http://ipeat.com/?page_id=91
Description: Alter the visibility settings for categories, for WordPress 2.3. Based on an earlier Category Visibility by Rich Hamilton, Keith McDuffee, and Projekt Seven.
Author: iPeat
Version: 1.0.8
Author URI: http://ipeat.com
*/

/*

Original authors: Keith McDuffee http://www.gudlyf.com/
http://www.gudlyf.com/archives/2005/03/08/wordpress-plugin-category-visibility/
Rich Hamilton http://ryowebsite.com/
http://ryowebsite.com/wp-plugins/category-visibility/
Projekt Seven his site is now down was tastycornbread.com

   * 1.0.1 Modified Projekt Seven's work to include Front, Search, Feed, Archives features for WP 2.3
   * 1.0.2 Fixed bugs that would cause Archives and Feeds to blow up
   * 1.0.3 Fixed Duplicate post on Archives, Home, and Feeds when containing multiple Categories and added Tag support
   * 1.0.4 Fixed empty search results and Ghost categories in the wp_list_categories function
   * 1.0.5 Fixed broken install code and title_li option for wp_list_categories (FYI: wp_list_cats tag is deprecated and no longer supported by this plugin.)
   * 1.0.6 Fixed an additional title_li option related bug and duplication on Search
   * 1.0.7 Fixed empty frontpage on 2.5.1
   * 1.0.8 Dropped tag and links support for 2.7 compatibility
*/

$cat_visibility = $table_prefix . 'cat_visibility';

function cv_category_vis_menu () {

    add_submenu_page('edit.php', 'Category Visibility', 'Category Visibility', 'manage_categories', basename(__FILE__), 'category_visibility');

}

function category_visibility () {

    global $wpdb;
    global $cat_visibility;
	global $wp_roles;

?>
<?php if ($_POST["action"] == "editcatvis"): ?>
<div class="updated"><p><strong><?php _e('Changes Submitted.'); ?></strong></p></div>
<?php endif; ?>
<div class="wrap">
<?php if ( current_user_can('manage_categories') ) { ?>
    <h2><?php _e('Category Visibility') ?> </h2>
<?php } ?>
<form name="catvis" id="catvis" action="edit.php?page=<?php echo basename(__FILE__); ?>" method="post">
<table width="100%" cellpadding="3" cellspacing="3">
        <tr>
        <th scope="col"><?php _e('ID') ?></th>
        <th scope="col"><?php _e('Name') ?></th>
        <th scope="col"><?php _e('Visibility') ?></th>
        </tr>
<?php
if ($_POST["action"] == "editcatvis") {
    cv_edit_cat_vis();
}

cv_my_cat_rows();
?>
</table>
<p>
<strong>Front:</strong> Visibility on the front/main page.<br />
<strong>List:</strong> Visibility on the list of categories on the sidebar.<br />
<strong>Search:</strong> Visibility in search results.<br />
<strong>Feed:</strong> Visibility in RSS/RSS2/Atom feeds.<br />
<strong>Archive:</strong> Visibility in archive links (i.e., calendar links).<br />
<strong>User Level:</strong> Visibility on user level basis. All users this level and higher can see categories as checked. Does not affect feed visibility, obviously.<br />
<strong>Numeric User Levels:</strong> <?php
	// Get Role List
	$userlist = '';
	foreach($wp_roles->role_objects as $key => $role) {
		foreach($role->capabilities as $cap => $grant) {
			//$capnames[$cap] = $cap;
			$role_user_level = array_reduce(array_keys($role->capabilities), array('WP_User', 'level_reduction'), 0);
		}
		$userlist .= ucfirst($role->name).': '.$role_user_level.', ';
	}
	echo rtrim($userlist,' ,');
?><br />

</p>
<p class="submit"><input type="hidden" name="action" value="editcatvis" /><input type="submit" name="submit" value="<?php _e('Submit Changes &raquo;') ?>" />
</p>
</form>

</div>
<?php
}

function cv_my_cat_rows($parent = 0, $level = 0, $categories = 0) {

    global $wpdb, $class;
    global $cat_visibility;

	// $pagenow is edit.php

	if (!$categories)
		$categories = $wpdb->get_results("SELECT * FROM $wpdb->terms LEFT JOIN $wpdb->term_taxonomy ON ($wpdb->terms.term_id = $wpdb->term_taxonomy.term_id) WHERE $wpdb->term_taxonomy.taxonomy = 'category' ORDER BY name");

	if ($categories) {
		foreach ($categories as $category) {
			if ($category->category_parent == $parent) {
				$category->name = wp_specialchars($category->name);
				$pad = str_repeat('&#8212; ', $level);
				if ( current_user_can('manage_categories') ) {
					$catvis = $wpdb->get_results("SELECT * FROM $cat_visibility WHERE cat_ID=$category->term_id LIMIT 1");
					$catvis = $catvis[0];
					if ($catvis->front == 1 || $catvis == 0) $catvis_front = "checked"; else $catvis_front = "";
					if ($catvis->list == 1 || $catvis == 0) $catvis_list = "checked"; else $catvis_list = "";
					if ($catvis->search == 1 || $catvis == 0) $catvis_search = "checked"; else $catvis_search = "";
					if ($catvis->feed == 1 || $catvis == 0) $catvis_feed = "checked"; else $catvis_feed = "";
					if ($catvis->archives == 1 || $catvis == 0) $catvis_archives = "checked"; else $catvis_archives = "";
                    $catvis_user_level = ($catvis->cv_user_level) ? $catvis->cv_user_level : 0;
					$edit  = "<label for='" . $category->term_id . "_front'>Front:</label> <input name='" . $category->term_id . "_front' id='" . $category->term_id . "_' class='edit' type='checkbox' $catvis_front />&nbsp;&nbsp;";
					$edit .= "<label for='" . $category->term_id . "_list'>List:</label> <input name='" . $category->term_id . "_list' id='" . $category->term_id . "_list' class='edit' type='checkbox' $catvis_list />&nbsp;&nbsp;";
					$edit .= "<label for='" . $category->term_id . "_search'>Search:</label> <input name='" . $category->term_id . "_search' id='" . $category->term_id . "_search' class='edit' type='checkbox' $catvis_search />&nbsp;&nbsp;";
					$edit .= "<label for='" . $category->term_id . "_feed'>Feed:</label> <input name='" . $category->term_id . "_feed' id='" . $category->term_id . "_feed' class='edit' type='checkbox' $catvis_feed />&nbsp;&nbsp;";
					$edit .= "<label for='" . $category->term_id . "_archives'>Archives:</label> <input name='" . $category->term_id . "_archives' id='" . $category->term_id . "_archives' class='edit' type='checkbox' $catvis_archives />&nbsp;&nbsp;";
                    $edit .= "<label for='" . $category->term_id . "_cv_user_level'>User Level:</label> <input name='" . $category->term_id . "_cv_user_level' id='" . $category->term_id . "_cv_user_level' class='edit' type='text' size='3' value='" . $catvis_user_level . "' />";
				} else
					$edit = '';
				$class = ('alternate' == $class) ? '' : 'alternate';
				echo "<tr class='$class'><th scope='row'>$category->term_id</th><td>$pad $category->name</td>
	 					<td style='text-align: center'>$edit</td>
						</tr>";
				cv_my_cat_rows($category->term_id, $level + 1, $categories);
			}
		}
	} else {
		return false;
	}
}

function cv_edit_cat_vis () {

    global $wpdb;
    global $cat_visibility;

	if (!$categories)
			$categories = $wpdb->get_results("SELECT term_id FROM $wpdb->terms");

	if ($categories) {
		foreach ($categories as $category) {
			$front = $category->term_id . "_front";
			$list = $category->term_id . "_list";
			$search = $category->term_id . "_search";
			$feed = $category->term_id . "_feed";
			$archives = $category->term_id . "_archives";
            $cv_user_level = $category->term_id . "_cv_user_level";

			if ($_POST["$front"] == "on") $front = 1; else $front = 0;
			if ($_POST["$list"] == "on") $list = 1; else $list = 0;
			if ($_POST["$search"] == "on") $search = 1; else $search = 0;
			if ($_POST["$feed"] == "on") $feed = 1; else $feed = 0;
			if ($_POST["$archives"] == "on") $archives = 1; else $archives = 0;
            $cv_user_level = $_POST["$cv_user_level"];

            if (empty($cv_user_level)) $cv_user_level = 0;
            if(!is_numeric($cv_user_level)) $cv_user_level = 0;

			if ( $front==1 && $list==1 && $search==1 && $feed==1 && $archives==1 && $cv_user_level==0 ) {
				$wpdb->query("DELETE FROM $cat_visibility WHERE cat_ID=$category->term_id LIMIT 1");
			} else {
				$wpdb->query("REPLACE INTO $cat_visibility SET cat_ID=$category->term_id, front=$front, list=$list, search=$search, feed=$feed, archives=$archives, cv_user_level=$cv_user_level");
			}
		}
	}
}


function cv_posts_join($join) {
	global $wpdb;
	global $cat_visibility;
	global $wp_query;
	global $pagenow;
	
	if ($pagenow == 'post.php' || $pagenow == 'edit.php') return $join;
	//if (! (isset($wp_query->query_vars['terms.name']) || isset($wp_query->query_vars['cat'])) ) //this is the ONEEEIHFHEUHFUHDI
	if (is_home()) {  // Testing this line
		$join .= " LEFT JOIN $wpdb->term_relationships ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id)";
		$join .= " LEFT JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)";
		$join .= " LEFT JOIN $cat_visibility ON ($wpdb->term_taxonomy.term_id = $cat_visibility.cat_ID)";
	}
	if (is_feed()) {
		if (!is_category() || !is_tag()) {
			$join .= " LEFT JOIN $wpdb->term_relationships ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id)";
			$join .= " LEFT JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)";
		}
		$join .= " LEFT JOIN $cat_visibility ON ($wpdb->term_taxonomy.term_id = $cat_visibility.cat_ID)";
	}
	elseif (is_category() || is_tag())   {
		$join .= " LEFT JOIN $cat_visibility ON ($wpdb->term_taxonomy.term_id = $cat_visibility.cat_ID)";
	}
	elseif (is_archive())   {
		$join .= " LEFT JOIN $wpdb->term_relationships ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id)";
		$join .= " LEFT JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)";
		$join .= " LEFT JOIN $cat_visibility ON ($wpdb->term_taxonomy.term_id = $cat_visibility.cat_ID)";
	}
	elseif (is_search())   {
		$join .= " LEFT JOIN $wpdb->term_relationships ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id)";
		$join .= " LEFT JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)";
		$join .= " LEFT JOIN $cat_visibility ON ($wpdb->term_taxonomy.term_id = $cat_visibility.cat_ID)";
	}
		//echo '<br>'.$join.'<br>';
	return $join;
} 


function cv_posts_groupby($groupby) {
	global $wpdb;
	global $cat_visibility;
	global $wp_query;
	global $pagenow;
	
	if ($pagenow == 'post.php' || $pagenow == 'edit.php') return $groupby;
	//if (! (isset($wp_query->query_vars['terms.name']) || isset($wp_query->query_vars['cat'])) ) //this is the ONEEEIHFHEUHFUHDI
	if (is_home()) {  // Testing this line
		$groupby .= " $wpdb->posts.ID ";
	}
	if (is_feed()) {
		$groupby .= " $wpdb->posts.ID ";
	}
	elseif (is_search())   {
		$groupby .= " $wpdb->posts.ID ";
	}
	elseif (is_archive() && !is_category() && !is_tag())   {
		$groupby .= " $wpdb->posts.ID ";
	}	
		//echo '<br>'.$join.'<br>';
	return $groupby;
} 

function cv_posts_where($where) {
	global $user_level;
	global $wp_query;
	global $cat_visibility;
	global $pagenow;
	global $wpdb;
	
	/* If we're in the admin menu, return unfiltered */
	if ($pagenow == 'post.php' || $pagenow == 'edit.php')
	   return $where;

	get_currentuserinfo();
	if (!is_numeric($user_level)) $user_level = 0;

	$q = $wp_query->query_vars;

	$lc = "$cat_visibility.cv_user_level<=$user_level) OR post_status='static' OR $cat_visibility.cat_ID IS NULL)";
	
	if (is_home()) {
      	$where .= " AND $wpdb->term_taxonomy.taxonomy='category'";
		$where .= " AND ($cat_visibility.front=1  OR post_status='static' OR $cat_visibility.cat_ID IS NULL)";
}
	elseif (is_feed())
		$where .= " AND ($cat_visibility.feed=1 OR $cat_visibility.cat_ID IS NULL)";
	elseif (is_category() || is_tag())
		$where .= " AND (($cat_visibility.archives=1 AND $lc";
	elseif (is_archive() && (!is_category() || !is_tag()))
		$where .= " AND (($cat_visibility.archives=1 AND $lc";
	elseif (is_search())
		$where .= " AND (($cat_visibility.search=1 AND $lc";

	return $where;


}

function cv_visible_cats($visibleto = 'front') {
   global $wpdb, $user_level, $cat_visibility;
    static $cv_cats = 0;
	if ($cv_cats == 0) {
		get_currentuserinfo();
		if (empty($user_level)) $user_level = 0;
		if (!is_numeric($user_level)) $user_level = 0;
		$my_query  = "SELECT * FROM $wpdb->terms";
		$my_query .= " LEFT JOIN $cat_visibility ON ($wpdb->terms.term_id = $cat_visibility.cat_ID)";
		$my_query .= " ORDER BY $wpdb->terms.name";
		$cv_cats = ($wpdb->get_results($my_query));
	}
	$callback = create_function('$obj', 'return (('
	. (  ($visibleto == 'none') ? '' : ('$obj->'.$visibleto.'==1 && '))
	. '$obj->cv_user_level<='.$user_level.') || $obj->cat_ID==0 );');
	return array_filter( $cv_cats,$callback );
}

function cv_alter_vis_catlist ($thelist) {
    global $wpdb;
    global $cat_visibility;

	$categories = cv_visible_cats('list');
    if (preg_match("/href/", $thelist)) {

        $newlist = "";
        $children = 0;
        $linklist = preg_split('/\t/', $thelist);
        foreach ($linklist as $link) {
            if(preg_match("/class.*categories/", $link)) {
                $children = 1;
                $newlist .= $link;
            } elseif(preg_match("/<\/ul>/", $link) && $children) {
                $children = 0;
                /* $newlist .= $link; */
                $thiscatname = strip_tags($link);
                $thiscatname = preg_replace("/\s+\(\d+\)\s+/", "", $thiscatname);
                $thiscatname = trim($thiscatname);
                if(!empty($thiscatname)) {
			$endlist = end($categories);
			foreach ($categories as $category) {
				if ($category->name == $thiscatname || wptexturize($category->name) == $thiscatname) {
					$newlist .= $link;
					break;
				} else if ($category->name == $endlist->name || wptexturize($category->name) == wptexturize($endlist->name)) {
					$newlist .= '</ul>';
					break;
				}
			}
		 } 
            } else {
                $thiscatname = strip_tags($link);
                $thiscatname = preg_replace("/\s+\(\d+\)\s+/", "", $thiscatname);
                $thiscatname = trim($thiscatname);
                if(!empty($thiscatname)) {
			foreach ($categories as $category) {
				if ($category->name == $thiscatname || wptexturize($category->name) == $thiscatname) {
				$newlist .= $link;
				break;
			}
		}
            }
        }
        }
        return $newlist;
    }
    $thiscatname = $thelist;
	foreach ($categories as $category) {
		if ($category->name == $thiscatname || wptexturize($category->name) == $thiscatname) {
			return $thelist;
		}
	}

	return;
}

function cv_delete_cat($term_id) {
	global $wpdb;
	global $cat_visibility;
	$wpdb->query("DELETE FROM $cat_visibility WHERE cat_ID=$term_id LIMIT 1");
}

// Installs the tables needed for Category Visibility on Activation
// Check the codex article for more info
// http://codex.wordpress.org/creating_tables_with_plugins
function cv_install () {
   global $wpdb, $cat_visibility;

	// Check to see if table exists, check for old column name, change if necessary
    foreach ($wpdb->get_col("SHOW TABLES",0) as $table ) {
        if ($table == $cat_visibility) {
			// Found table
			foreach ($wpdb->get_col("DESC $cat_visibility", 0) as $column ) {
				if ($column == 'term_id') {
					// Found column, run query to change column name
						$wpdb->query("ALTER TABLE `$cat_visibility` CHANGE `term_id` `cat_ID` BIGINT( 20 ) NOT NULL DEFAULT '0', DROP INDEX `term_id`");
				} elseif ($column == 'user_level') {
					// Found column, run query to change column name
						$wpdb->query("ALTER TABLE `$cat_visibility` CHANGE `user_level` `cv_user_level` INT( 4 ) NOT NULL DEFAULT '0'");
				}
			}
            break;
        }
    }

   // PRIMARY KEY has 2 spaces on purpose ... some weird dbDelta thing...

   $qry = "CREATE TABLE ".$cat_visibility." (
			cat_ID bigint(20) NOT NULL,
			front int(4) NOT NULL default 1,
			list int(4) NOT NULL default 1,
			search int(4) NOT NULL default 1,
			feed int(4) NOT NULL default 1,
			archives int(4) NOT NULL default 1,
			cv_user_level int(4) NOT NULL default 0,
			PRIMARY KEY  (cat_ID)
           ); ";

    require_once(ABSPATH . 'wp-admin/upgrade-functions.php');
    dbDelta($qry);

}

// Make sure WP is running
if (function_exists('add_action')) {

	add_filter('posts_join', 'cv_posts_join'); //HERE
	add_filter('posts_where', 'cv_posts_where'); //HERE
	add_filter('posts_groupby', 'cv_posts_groupby'); //HERE
	add_action('admin_menu', 'cv_category_vis_menu');
	add_filter('wp_list_categories', 'cv_alter_vis_catlist');
	add_action('delete_category', 'cv_delete_cat');

	/* These actions are run through 'init' for security */

    // Run the install script when/if the plugin is activated manually or through RYO Quick Start
    if (isset($_GET['activate']) && $_GET['activate'] == 'true')
       add_action('init', 'cv_install');
}?>