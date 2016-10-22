<?php
/**
 * Question list item template
 *
 * @link https://anspress.io
 * @since 0.1
 * @license GPL 2+
 * @package AnsPress
 */

if ( ! ap_user_can_view_post( get_the_ID() ) ) {
	return;
}

$clearfix_class = array( 'ap-questions-item clearfix' );

?>
<div id="question-<?php the_ID(); ?>" <?php post_class( $clearfix_class ); ?>>
	<div class="ap-questions-inner">
		<div class="ap-avatar ap-pull-left">
			<a href="<?php ap_profile_link(); ?>"<?php ap_hover_card_attr(); ?>>
				<?php ap_author_avatar( ap_opt( 'avatar_size_list' ) ); ?>
			</a>
		</div>
		<div class="ap-list-counts">
			<!-- Answer Count -->
			<a class="ap-questions-count ap-questions-acount" href="<?php ap_answers_link(); ?>">
				<?php printf( _n( '%s ans', '%s ans', ap_get_answers_count(), 'anspress-question-answer' ), '<span>'. ap_get_answers_count() .'</span>' ); ?>
			</a>

			<!-- Votes count -->
			<?php if ( ! ap_opt( 'disable_voting_on_question' ) ) : ?>
				<span class="ap-questions-count ap-questions-vcount">
					<span><?php ap_votes_net(); ?></span>
					<?php  _e( 'votes', 'anspress-question-answer' ); ?>
				</span>
			<?php endif; ?>
		</div>

		<div class="ap-questions-summery no-overflow">
			<span class="ap-questions-title entry-title" itemprop="title">
				<?php ap_question_status(); ?>
				<a class="ap-questions-hyperlink" itemprop="url" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			</span>
			<div class="ap-display-question-meta">
				<?php echo ap_question_metas() ?>
			</div>
		</div>
	</div>
</div><!-- list item -->
