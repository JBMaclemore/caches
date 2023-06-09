(function( $ ) {

    // Helper function to build a widget field selector
    function gamipress_transfers_widget_field_selector( shortcode, field ) {
        return '[id^="widget-gamipress_' + shortcode + '"][id$="[' + field + ']"]';
    }

    // On change select recipient
    $('body').on('change', gamipress_transfers_widget_field_selector( 'points_transfer', 'select_recipient' ) + ', '
        + gamipress_transfers_widget_field_selector( 'achievement_transfer', 'select_recipient' ) + ', '
        + gamipress_transfers_widget_field_selector( 'rank_transfer', 'select_recipient' ), function() {
        // Get the recipient placeholder and autocomplete checkbox wrap
        var target = $(this).closest('.cmb-row').nextAll(':lt(2)');

        if( $(this).prop('checked') ) {
            target.slideDown().removeClass('cmb2-tab-ignore');
        } else {
            target.slideUp().addClass('cmb2-tab-ignore');
        }
    });

    $( gamipress_transfers_widget_field_selector( 'points_transfer', 'select_recipient' ) + ', '
        + gamipress_transfers_widget_field_selector( 'achievement_transfer', 'select_recipient' ) + ', '
        + gamipress_transfers_widget_field_selector( 'rank_transfer', 'select_recipient' ) ).trigger('change');

    // On change points form type
    $('body').on('change', 'select[id^="widget-gamipress_points_transfer"][id$="[transfer_type]"]', function() {
        var type = $(this).val();

        var amount = $(this).closest('.cmb2-metabox').find( gamipress_transfers_widget_field_selector('points_transfer', 'amount') ).closest('.cmb-row');
        var options = $(this).closest('.cmb2-metabox').find( '.cmb-row[class*="gamipress-points-transfer"][class*="options"]' );
        var allow_user_input = $(this).closest('.cmb2-metabox').find( gamipress_transfers_widget_field_selector('points_transfer', 'allow_user_input') ).closest('.cmb-row');
        var initial_amount = $(this).closest('.cmb2-metabox').find( gamipress_transfers_widget_field_selector('points_transfer', 'initial_amount') ).closest('.cmb-row');

        amount.hide().addClass('cmb2-tab-ignore');

        options.hide().addClass('cmb2-tab-ignore');
        allow_user_input.hide().addClass('cmb2-tab-ignore');

        initial_amount.hide().addClass('cmb2-tab-ignore');

        if( type === 'fixed' ) {
            amount.show().removeClass('cmb2-tab-ignore');
        } else if( type === 'custom' ) {
            initial_amount.show().removeClass('cmb2-tab-ignore');
        } else if( type === 'options' ) {
            options.show().removeClass('cmb2-tab-ignore');
            allow_user_input.show().removeClass('cmb2-tab-ignore');

            allow_user_input.find('input').trigger('change');
        }
    });

    $( 'select[id^="widget-gamipress_points_transfer"][id$="[transfer_type]"]' ).trigger('change');

    // On change points allow user input
    $('body').on('change', 'input[id^="widget-gamipress_points_transfer"][id$="[allow_user_input]"]', function() {
        var target = $(this).closest('.cmb2-metabox').find( gamipress_transfers_widget_field_selector('points_transfer', 'initial_amount') ).closest('.cmb-row');
        var type = $(this).closest('.cmb2-metabox').find( gamipress_transfers_widget_field_selector('points_transfer', 'transfer_type') ).val();

        if( $(this).prop('checked') && type === 'options' ) {
            target.show().removeClass('cmb2-tab-ignore');
        } else if( type !== 'custom' ) {
            target.hide().addClass('cmb2-tab-ignore');
        }

    });

    $( 'input[id^="widget-gamipress_points_transfer"][id$="[allow_user_input]"]' ).trigger('change');

    // Initialize on widgets area
    $(document).on('widget-updated widget-added', function(e, widget) {

        widget.find(
            gamipress_transfers_widget_field_selector( 'points_transfer', 'select_recipient' ) + ', '
            + gamipress_transfers_widget_field_selector( 'achievement_transfer', 'select_recipient' ) + ', '
            + gamipress_transfers_widget_field_selector( 'rank_transfer', 'select_recipient' )
        ).trigger('change');

        widget.find( 'select[id^="widget-gamipress_points_transfer"][id$="[transfer_type]"]' ).trigger('change');

        widget.find( 'input[id^="widget-gamipress_points_transfer"][id$="[allow_user_input]"]' ).trigger('change');
    });

})( jQuery );