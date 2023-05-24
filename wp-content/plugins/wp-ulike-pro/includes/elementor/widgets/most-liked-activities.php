<?php
namespace WpUlikePro\Includes\Elementor\Elements;

use Elementor\Plugin;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Group_Control_Border;
use Elementor\Icons_Manager;


if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

/**
 * Elementor 'MostLikedActivities' widget.
 *
 * Elementor widget that displays an 'MostLikedActivities' with lightbox.
 *
 * @since 1.0.0
 */
class MostLikedActivities extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve 'MostLikedActivities' widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'wp_ulike_top_activities';
    }

    /**
     * Get widget title.
     *
     * Retrieve 'MostLikedActivities' widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__('Top Activities', WP_ULIKE_PRO_NAME );
    }

    /**
     * Get widget icon.
     *
     * Retrieve 'MostLikedActivities' widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-posts-ticker';
    }

    /**
     * Get widget categories.
     *
     * Retrieve 'MostLikedActivities' widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_categories() {
        return array( WP_ULIKE_PRO_DOMAIN );
    }

    /**
     * Register 'MostLikedActivities' widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {

        /*-----------------------------------------------------------------------------------*/
        /*  Content TAB
        /*-----------------------------------------------------------------------------------*/

        $this->start_controls_section(
            'general_section',
            array(
                'label'      => esc_html__('General', WP_ULIKE_PRO_NAME ),
            )
        );

        $this->add_control(
            'number',
            array(
                'label'       => esc_html__('Number of items', WP_ULIKE_PRO_NAME),
                'type'        => Controls_Manager::NUMBER,
                'default'     => '8',
                'min'         => 1,
                'step'        => 1
            )
        );

        $this->add_control(
            'peroid_limit',
            array(
                'label'   => esc_html__( 'Peroid Limit', WP_ULIKE_PRO_NAME ),
                'type'    => Controls_Manager::SELECT,
                'options' => array(
					'all'       => esc_html__( 'All', WP_ULIKE_PRO_NAME ),
					'today'     => esc_html__( 'Today', WP_ULIKE_PRO_NAME ),
					'yesterday' => esc_html__( 'Yesterday', WP_ULIKE_PRO_NAME ),
					'week'      => esc_html__( 'Week', WP_ULIKE_PRO_NAME ),
					'month'     => esc_html__( 'Month', WP_ULIKE_PRO_NAME ),
					'year'      => esc_html__( 'Year', WP_ULIKE_PRO_NAME ),
					'past_days' => esc_html__( 'Last X Days', WP_ULIKE_PRO_NAME )
                ),
                'default'   => 'all',
            )
        );

		$this->add_control(
			'past_days_num',
			array(
				'label' => esc_html__( 'Past Days Number', WP_ULIKE_PRO_NAME ),
				'type' => Controls_Manager::NUMBER,
				'default' => 30,
                'condition' => array(
                    'peroid_limit' => 'past_days'
                )
            )
        );
        $this->add_control(
            'display_info',
            array(
                'label'        => esc_html__('Display info',WP_ULIKE_PRO_NAME ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', WP_ULIKE_PRO_NAME ),
                'label_off'    => esc_html__( 'Off', WP_ULIKE_PRO_NAME ),
                'return_value' => 'yes',
                'default'      => 'yes'
            )
        );

        $this->end_controls_section();

        /*-----------------------------------------------------------------------------------*/
        /*  pagination_section
        /*-----------------------------------------------------------------------------------*/

        $this->start_controls_section(
            'pagination_section',
            array(
                'label'      => esc_html__('Pagination', WP_ULIKE_PRO_NAME ),
            )
        );

        $this->add_control(
            'enable_pagination',
            array(
                'label'        => esc_html__('Enable Pagination',WP_ULIKE_PRO_NAME ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', WP_ULIKE_PRO_NAME ),
                'label_off'    => esc_html__( 'Off', WP_ULIKE_PRO_NAME ),
                'return_value' => 'yes',
                'default'      => 'no'
            )
        );

		$this->add_control(
			'prev_text',
			array(
				'label'       => esc_html__( 'Previous Text', WP_ULIKE_PRO_NAME),
				'type'        => Controls_Manager::TEXT,
                'default'     => 'Prev',
				'condition' => array(
                    'enable_pagination' => 'yes'
                )
			)
        );

		$this->add_control(
			'next_text',
			array(
				'label'       => esc_html__( 'Next Text', WP_ULIKE_PRO_NAME),
				'type'        => Controls_Manager::TEXT,
                'default'     => 'Next',
				'condition' => array(
                    'enable_pagination' => 'yes'
                )
			)
        );

        $this->end_controls_section();

        /*-----------------------------------------------------------------------------------*/
        /*  custom_text_section
        /*-----------------------------------------------------------------------------------*/

        $this->start_controls_section(
            'custom_text_section',
            array(
                'label'      => esc_html__('Custom Text', WP_ULIKE_PRO_NAME ),
            )
        );

		$this->add_control(
			'not_found_text',
			[
				'label'       => esc_html__( 'Not Found Text', WP_ULIKE_PRO_NAME),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'No activity found!',
				'placeholder' => esc_html__( 'Type your text here', WP_ULIKE_PRO_NAME ),
			]
        );

		$this->add_control(
			'by_text',
			[
				'label'       => esc_html__( 'By Text', WP_ULIKE_PRO_NAME),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'By',
				'placeholder' => esc_html__( 'Type your text here', WP_ULIKE_PRO_NAME ),
			]
        );

		$this->add_control(
			'ago_text',
			[
				'label'       => esc_html__( 'Ago Text', WP_ULIKE_PRO_NAME),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Ago',
				'placeholder' => esc_html__( 'Type your text here', WP_ULIKE_PRO_NAME ),
			]
        );

		$this->add_control(
			'visit_text',
			[
				'label'       => esc_html__( 'Visit Text', WP_ULIKE_PRO_NAME),
				'type'        => Controls_Manager::TEXT,
				'default'     => '[Visit]',
				'placeholder' => esc_html__( 'Type your text here', WP_ULIKE_PRO_NAME ),
			]
        );

        $this->end_controls_section();

        /*-----------------------------------------------------------------------------------*/
        /*  item_style_section
        /*-----------------------------------------------------------------------------------*/

        $this->start_controls_section(
            'item_style_section',
            array(
                'label'     => esc_html__( 'Items', WP_ULIKE_PRO_NAME ),
                'tab'       => Controls_Manager::TAB_STYLE
            )
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'item_border',
				'label' => esc_html__( '', WP_ULIKE_PRO_NAME ),
				'selector' => '{{WRAPPER}} .wp-ulike-item',
			]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'      => 'item_shadow',
                'selector'  => '{{WRAPPER}} .wp-ulike-item'
            )
        );

        $this->add_responsive_control(
            'item_padding',
            array(
                'label'      => esc_html__( 'Padding', WP_ULIKE_PRO_NAME ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px' ),
                'selectors'  => array(
                    '{{WRAPPER}} .wp-ulike-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                )
            )
        );

        $this->add_responsive_control(
            'item_margin',
            array(
                'label'      => esc_html__( 'Margin', WP_ULIKE_PRO_NAME ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px' ),
                'selectors'  => array(
                    '{{WRAPPER}} .wp-ulike-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                )
            )
        );

		$this->add_control(
			'alignment',
			array(
				'label' => esc_html__( 'Alignment', WP_ULIKE_PRO_DOMAIN ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => array(
					'left' => array(
						'title' => esc_html__( 'Left', WP_ULIKE_PRO_DOMAIN ),
						'icon' => 'fa fa-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', WP_ULIKE_PRO_DOMAIN ),
						'icon' => 'fa fa-align-center',
					),
					'right' => array(
						'title' => esc_html__( 'Right', WP_ULIKE_PRO_DOMAIN ),
						'icon' => 'fa fa-align-right',
					),
				),
				'prefix_class' => 'wp-ulike-posts--align-',
			)
		);

        $this->end_controls_section();

        /*-----------------------------------------------------------------------------------*/
        /*  content_style_section
        /*-----------------------------------------------------------------------------------*/

        $this->start_controls_section(
            'content_style_section',
            array(
                'label'     => esc_html__( 'Content', WP_ULIKE_PRO_NAME ),
                'tab'       => Controls_Manager::TAB_STYLE
            )
        );

        $this->add_control(
            'content_color',
            array(
                'label' => esc_html__( 'Color', WP_ULIKE_PRO_NAME ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .wp-ulike-entry-content' => 'color: {{VALUE}};',
                )
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'content_typography',
                'scheme' => '1',
                'selector' => '{{WRAPPER}} .wp-ulike-entry-content'
            )
        );

        $this->add_responsive_control(
            'content_margin_bottom',
            array(
                'label' => esc_html__( 'Bottom space', WP_ULIKE_PRO_NAME ),
                'type' => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array(
                        'max' => 100,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .wp-ulike-entry-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                )
            )
        );

        $this->end_controls_section();

        /*-----------------------------------------------------------------------------------*/
        /*  info_style_section
        /*-----------------------------------------------------------------------------------*/

        $this->start_controls_section(
            'info_style_section',
            array(
                'label'     => esc_html__( 'Meta Info', WP_ULIKE_PRO_NAME ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => array(
                    'display_info' => 'yes'
                )
            )
        );

        $this->start_controls_tabs( 'info_colors' );

        $this->start_controls_tab(
            'info_color_normal',
            array(
                'label' => esc_html__( 'Normal' , WP_ULIKE_PRO_NAME )
            )
        );

        $this->add_control(
            'info_color',
            array(
                'label' => esc_html__( 'Color', WP_ULIKE_PRO_NAME ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .wp-ulike-entry-info a, {{WRAPPER}} .wp-ulike-entry-info' => 'color: {{VALUE}};',
                )
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'info_color_hover',
            array(
                'label' => esc_html__( 'Hover' , WP_ULIKE_PRO_NAME )
            )
        );

        $this->add_control(
            'info_hover_color',
            array(
                'label' => esc_html__( 'Color', WP_ULIKE_PRO_NAME ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .wp-ulike-entry-info a:hover' => 'color: {{VALUE}};',
                )
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'info_typography',
                'scheme' => '1',
                'selector' => '{{WRAPPER}} .wp-ulike-entry-info, {{WRAPPER}} .wp-ulike-entry-info a'
            )
        );

        $this->add_responsive_control(
            'info_margin_bottom',
            array(
                'label' => esc_html__( 'Bottom space', WP_ULIKE_PRO_NAME ),
                'type'  => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array(
                        'max' => 100
                    )
                ),
                'selectors' => array(
                    '{{WRAPPER}} .wp-ulike-entry-info' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                )
            )
        );

        $this->add_responsive_control(
            'info_spacing_between',
            array(
                'label' => esc_html__( 'Space between metas', WP_ULIKE_PRO_NAME ),
                'type'  => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array(
                        'max' => 30
                    )
                ),
                'selectors' => array(
                    '{{WRAPPER}} .wp-ulike-entry-info [class^="wp-ulike-entry-"]:after' =>
                    'margin-right: {{SIZE}}{{UNIT}}; margin-left: {{SIZE}}{{UNIT}};'
                )
            )
        );

        $this->add_control(
            'date_icon',
            array(
                'label'        => esc_html__('Date Icon', WP_ULIKE_PRO_NAME ),
                'type'         => Controls_Manager::ICONS,
				'default'      => array(
					'value' => 'fas fa-clock',
					'library' => 'fa-solid',
                )
            )
        );
        $this->add_control(
            'user_icon',
            array(
                'label'        => esc_html__('User Icon', WP_ULIKE_PRO_NAME ),
                'type'         => Controls_Manager::ICONS,
				'default'      => array(
					'value' => 'fas fa-user',
					'library' => 'fa-solid',
                )
            )
        );
        $this->add_control(
            'like_icon',
            array(
                'label'        => esc_html__('Like Icon', WP_ULIKE_PRO_NAME ),
                'type'         => Controls_Manager::ICONS,
				'default'      => array(
					'value' => 'fas fa-thumbs-up',
					'library' => 'fa-solid',
                )
            )
        );
        $this->add_control(
            'dislike_icon',
            array(
                'label'        => esc_html__('Dislike Icon', WP_ULIKE_PRO_NAME ),
                'type'         => Controls_Manager::ICONS,
				'default'      => array(
					'value' => 'fas fa-thumbs-down',
					'library' => 'fa-solid',
                )
            )
        );

        $this->end_controls_section();

        /*-----------------------------------------------------------------------------------*/
        /*  pagination_style_section
        /*-----------------------------------------------------------------------------------*/

        $this->start_controls_section(
            'pagination_style_section',
            array(
                'label'     => esc_html__( 'Pagination', WP_ULIKE_PRO_NAME ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => array(
                    'enable_pagination' => 'yes'
                )
            )
        );

        $this->start_controls_tabs( 'pagination_colors' );

        $this->start_controls_tab(
            'pagination_color_normal',
            array(
                'label' => esc_html__( 'Normal' , WP_ULIKE_PRO_NAME )
            )
        );

        $this->add_control(
            'pagination_color',
            array(
                'label' => esc_html__( 'Color', WP_ULIKE_PRO_NAME ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .wp-ulike-pro-pagination .page-numbers' => 'color: {{VALUE}};',
                )
            )
        );

        $this->add_control(
            'pagination_bg_color',
            array(
                'label' => esc_html__( 'Background', WP_ULIKE_PRO_NAME ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .wp-ulike-pro-pagination .page-numbers' => 'background-color: {{VALUE}};',
                )
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pagination_color_hover',
            array(
                'label' => esc_html__( 'Hover' , WP_ULIKE_PRO_NAME )
            )
        );

        $this->add_control(
            'pagination_hover_color',
            array(
                'label' => esc_html__( 'Color', WP_ULIKE_PRO_NAME ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .wp-ulike-pro-pagination .page-numbers:hover' => 'color: {{VALUE}};',
                )
            )
        );

        $this->add_control(
            'pagination_bg_hover_color',
            array(
                'label' => esc_html__( 'Background', WP_ULIKE_PRO_NAME ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .wp-ulike-pro-pagination .page-numbers:hover' => 'background-color: {{VALUE}};',
                )
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pagination_color_active',
            array(
                'label' => esc_html__( 'Current' , WP_ULIKE_PRO_NAME )
            )
        );

        $this->add_control(
            'pagination_active_color',
            array(
                'label' => esc_html__( 'Color', WP_ULIKE_PRO_NAME ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .wp-ulike-pro-pagination .page-numbers.current' => 'color: {{VALUE}};',
                )
            )
        );

        $this->add_control(
            'pagination_bg_active_color',
            array(
                'label' => esc_html__( 'Background', WP_ULIKE_PRO_NAME ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .wp-ulike-pro-pagination .page-numbers.current' => 'background-color: {{VALUE}};',
                )
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'pagination_margin',
            array(
                'label'      => esc_html__( 'Margin', WP_ULIKE_PRO_NAME ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px' ),
                'selectors'  => array(
                    '{{WRAPPER}} .wp-ulike-pro-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                )
            )
        );

        $this->add_responsive_control(
            'pagination_padding',
            array(
                'label'      => esc_html__( 'Padding', WP_ULIKE_PRO_NAME ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px' ),
                'selectors'  => array(
                    '{{WRAPPER}} .wp-ulike-pro-pagination .page-numbers' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                )
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'      => 'pagination_shadow',
                'selector'  => '{{WRAPPER}} .wp-ulike-pro-pagination .page-numbers'
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'pagination_typography',
                'scheme' => '1',
                'selector' => '{{WRAPPER}} .wp-ulike-pro-pagination .page-numbers'
            )
        );

        $this->end_controls_section();

    }

    /**
    * Render top activities widget output on the frontend.
    *
    * Written in PHP and used to generate the final HTML.
    *
    * @since 1.0.0
    * @access protected
    */
    protected function render() {
        // Check whether required resources are available
        if( ! function_exists('bp_activity_get_permalink') ) {
            wp_ulike_pro_plugin_missing_notice( array( 'plugin_name' => esc_html__( 'BuddyPress', WP_ULIKE_PRO_NAME) ) );
            return;
        }

        $settings   = $this->get_settings_for_display();

        // Update peroid limit value
        if( $settings['peroid_limit'] === 'past_days' ){
            $settings['peroid_limit'] = array(
                'interval_value' => $settings['past_days_num'],
                'interval_unit'  => 'DAY'
            );
        }

        $paged      = wp_ulike_is_true( $settings['enable_pagination'] ) ? max( 1, get_query_var('paged'), get_query_var('page') ) : 1;
        $activities = wp_ulike_get_most_liked_activities( $settings['number'], $settings['peroid_limit'], array( 'like', 'dislike' ), $paged );

        $this->add_render_attribute( 'wrapper', 'class', 'wp-ulike-most-liked-widget wp-ulike-most-liked-activities-wrapper' );

        if( empty( $activities ) ){
            $output = sprintf( '<p>%s<p>', $settings['not_found_text'] );
        } else {
            // widget output -----------------------
            ob_start();
            foreach ( $activities as $activity ):
            $activity_permalink = bp_activity_get_permalink( $activity->id );
            $activity_action    = ! empty( $activity->content ) ? $activity->content : $activity->action;
        ?>
            <div id="wp-ulike-activity-<?php echo esc_attr( $activity->id ); ?>" class="wp-ulike-activity wp-ulike-item">
                <div class="wp-ulike-entry-content">
                    <p><?php echo $activity_action; ?></p>
                    <span class="wp-ulike-visit-url"><a href="<?php echo esc_url( $activity_permalink ); ?>"><?php echo sprintf( '<strong>%s</strong>', $settings['visit_text'] ); ?></a></span>
                </div>
                <?php if( isset( $settings['display_info'] ) && wp_ulike_is_true( $settings['display_info'] ) ) : ?>
                <div class="wp-ulike-entry-info">
                    <div class="wp-ulike-entry-date">
                        <?php
                        Icons_Manager::render_icon( $settings['date_icon'], [ 'aria-hidden' => 'true' ] );
                        echo human_time_diff( strtotime( $activity->date_recorded ) ) . ' ' . $settings['ago_text'];
                        ?>
                    </div>
                    <div class="wp-ulike-entry-author">
                        <?php
                        Icons_Manager::render_icon( $settings['user_icon'], [ 'aria-hidden' => 'true' ] );
                        $user = get_user_by( 'id', $activity->user_id );
                        echo $settings['by_text']; ?> <?php echo esc_html( $user->display_name );
                        ?>
                    </div>
                    <div class="wp-ulike-entry-votes">
                    <?php
                        $is_distinct = \wp_ulike_setting_repo::isDistinct('activity');
                        $likes       = wp_ulike_get_counter_value( $activity->id, 'activity', 'like', $is_distinct  );
                        $dislikes    = wp_ulike_get_counter_value( $activity->id, 'activity', 'dislike', $is_distinct );

                        if( ! empty( $likes ) ){
                        ?>
                        <span class="wp-ulike-up-votes">
                        <?php
                            Icons_Manager::render_icon( $settings['like_icon'], [ 'aria-hidden' => 'true' ] );
                            echo $likes;
                        ?>
                        </span>
                        <?php
                        }
                        if( ! empty( $dislikes ) ){
                            ?>
                        <span class="wp-ulike-down-votes">
                        <?php
                            Icons_Manager::render_icon( $settings['dislike_icon'], [ 'aria-hidden' => 'true' ] );
                            echo $dislikes;
                        ?>
                        </span>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        <?php
            endforeach;
            $output = ob_get_clean();
        }

        // Pagination
        $pagination  = '';
        if( wp_ulike_is_true( $settings['enable_pagination'] ) ){
            $total_items = wp_ulike_get_popular_items_total_number(array(
                "type"     => 'activity',
                "rel_type" => '',
                "period"   => $settings['peroid_limit'],
                "status"   => array( 'like', 'dislike' )
            ));

            $pagination  = wp_ulike_pro_pagination( array(
                "total_pages" => $total_items,
                "per_page"    => $settings['number'],
                "prev_text"   => $settings['prev_text'],
                "next_text"   => $settings['next_text']
            ) );
        }

        echo sprintf( '<div %s>%s</div>%s', $this->get_render_attribute_string( 'wrapper' ), $output, $pagination );
    }

}
