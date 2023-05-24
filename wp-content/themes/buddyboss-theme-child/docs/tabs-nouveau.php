<div class="item-body-inner">
<nav id="subnav" class="bp-navs bp-subnavs no-ajax user-subnav bb-subnav-plain" role="navigation" aria-label="<?php esc_html_e( 'Directory menu', 'buddypress-docs' ); ?>">
	<ul class="subnav">
		<li<?php if ( bp_docs_is_global_directory() ) : ?> class="bp-personal-sub-tab current"<?php endif; ?>><a href="<?php bp_docs_archive_link() ?>"><?php _e( 'All Docs', 'buddypress-docs' ) ?></a></li>

		<?php if ( is_user_logged_in() ) : ?>
			<?php if ( function_exists( 'bp_is_group' ) && bp_is_group() ) : ?>
				<li<?php if ( bp_is_current_action( BP_DOCS_SLUG ) ) : ?> class="bp-personal-sub-tab current"<?php endif ?>><a href="<?php bp_group_permalink( groups_get_current_group() ) ?><?php bp_docs_slug() ?>"><?php printf( __( "%s's Docs", 'buddypress-docs' ), bp_get_current_group_name() ) ?></a></li>
			<?php else : ?>
				<li class="bp-personal-sub-tab current"><a href="<?php bp_docs_mydocs_started_link() ?>"><?php _e( 'Started By Me', 'buddypress-docs' ) ?></a></li>
				<li class="bp-personal-sub-tab current"><a href="<?php bp_docs_mydocs_edited_link() ?>"><?php _e( 'Edited By Me', 'buddypress-docs' ) ?></a></li>

				<?php if ( bp_is_active( 'groups' ) ) : ?>
					<li<?php if ( bp_docs_is_mygroups_docs() ) : ?> class="bp-personal-sub-tab current"<?php endif; ?>><a href="<?php bp_docs_mygroups_link() ?>"><?php _e( 'My Groups', 'buddypress-docs' ) ?></a></li>
				<?php endif ?>
			<?php endif ?>

		<?php endif ?>

		<?php if ( $show_create_button ) : ?>
			<?php bp_docs_create_button() ?>
		<?php endif ?>

	</ul>
</nav>
</div>
