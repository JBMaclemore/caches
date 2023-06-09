(function( $ ) {

    var prefix = 'gamipress-buddyboss-notifications-';
    var _prefix = 'gamipress_buddyboss_notifications_';

    var settings = [
        'achievement',
        'step',
        'points_award',
        'points_deduct',
        'rank',
        'rank_requirement',
    ];

    // Register change listeners to all settings sections
    settings.forEach(function ( setting ) {

        var setting_name = setting.replace('_', '-');

        $('#' + _prefix + 'disable_' + setting + 's').on('change', function(e) {
            var target = $('.cmb2-id-' + prefix + setting_name + '-content');

            if( ! $(this).prop('checked') ) {
                target.slideDown().removeClass('cmb2-tab-ignore');
            } else {
                target.slideUp().addClass('cmb2-tab-ignore');
            }
        });

        if( $('#' + _prefix + 'disable_' + setting + 's').prop('checked') ) {
            $('.cmb2-id-' + prefix + setting_name + '-content').hide().addClass('cmb2-tab-ignore');
        }

    });

})( jQuery );