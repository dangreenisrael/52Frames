     <?php get_header(); ?>

    <div id="content" class="narrowcolumn">

    <!� This sets the $curauth variable �>

    <?php
    if(isset($_GET['author_name'])) :
    $curauth = get_userdatabylogin($author_name);
    else :
    $curauth = get_userdata(intval($author));
    endif;
    ?>

    <h2>About: <?php echo $curauth->nickname; ?></h2>
    <dl>
    <dt>Website</dt>
    <dd><a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a></dd>
    <dt>Profile</dt>
    <dd><?php echo $curauth->user_description; ?></dd>
    </dl>
	<dt>Camera Type</dt>
    <dd><?php echo $curauth->custom_field_3; ?></dd>
    </dl>

    <h2>Posts by <?php echo $curauth->nickname; ?>:</h2>

    <ul>
    <!� The Loop �>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <li>
    <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>">
    <?php the_title(); ?></a>,
    <?php the_time('d M Y'); ?> in <?php the_category('&');?>
    </li>

    <?php endwhile; else: ?>
    <p><?php _e('No posts by this author.'); ?></p>

    <?php endif; ?>

    <!� End Loop �>

    </ul>
    </div>
    <?php get_sidebar(); ?>
    <?php get_footer(); ?> 