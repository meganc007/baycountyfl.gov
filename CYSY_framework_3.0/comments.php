<?
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to framework_comment which is
 * located in the functions.php file.
 * @package WordPress
 * @subpackage CYSY Framework 3
 * @since CYSY Framework 3.0
 */
?>
<!-- CYSY Framework  3 Copyright ©  2012-2013 - CYber SYtes,  Inc. All Rights Reserved -->


<? if ( post_password_required() ) : ?>
				<p class="nopassword"><? _e( 'This post is password protected. Enter the password to view any comments.', 'CYSY Framework 3' ); ?></p>
			
<?
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>
	
<?
	// You can start editing here -- including this comment!
?>

<? if ( have_comments() ) : ?>
			<h4 id="comments-title"><?
			printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'CYSY Framework 3' ),
			number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
			?></h4>

<? if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<section class="previous_next">
				<div class="nav-previous"><? previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'CYSY Framework 3' ) ); ?></div>
				<div class="nav-next"><? next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'CYSY Framework 3' ) ); ?></div>
                <div class="clear"></div>
			</section> <!-- .previous_next -->
<? endif; // check for comment previous_next ?>

			<ol class="commentlist">
				<?
					/* Loop through and list the comments. Tell wp_list_comments()
					 * to use framework_comment() to format the comments.
					 * If you want to overload this in a child theme then you can
					 * define framework_comment() and that will be used instead.
					 * See framework_comment() in framework/functions.php for more.
					 */
					wp_list_comments( array( 'callback' => 'framework_comment' ) );
				?>
			</ol>

<? if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="previous_next">
				<div class="nav-previous"><? previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'CYSY Framework 3' ) ); ?></div>
				<div class="nav-next"><? next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'CYSY Framework 3' ) ); ?></div>
                <div class="clear"></div>
			</div><!-- .previous_next -->
<? endif; // check for comment previous_next ?>

<? else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
	<p class="nocomments"><? _e( 'Comments are closed.', 'CYSY Framework 3' ); ?></p>
<? endif; // end ! comments_open() ?>

<? endif; // end have_comments() ?>

<? comment_form(); ?>
