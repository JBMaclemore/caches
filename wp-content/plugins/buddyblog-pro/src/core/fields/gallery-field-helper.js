jQuery(document).ready(function($){
    var galleryItem = _.template('<li class="bbl-gallery-media-item" data-attachment-id="<%= item_id %>"><img src="<%= item_image %>" /><a href="#" class="delete" >x</a><input type="hidden" class="bblpro-gallery-hidden-media-id" name="<%= name %>" value="<%= item_id %>"></li>'
    );
    var $galleryFieldContainers = $( '.bbl-field-type-gallery-wrap' );

    $(document).on('click', '.bblpro-add-gallery-images-btn-wrap', function (e) {
        e.preventDefault();

        var $el = $(this),
            $parent = $el.parents('.bbl-field-type-gallery-wrap');

        if (!$el.galleryFrame) {
            $el.galleryFrame = createFrame($parent.find('.bblpro-field-type-gallery-images-list'), {
                labels: {
                    choose: $el.data('choose'),
                    update: $el.data('update')
                }
            });
        }

        $el.galleryFrame.open();
    });


    $galleryFieldContainers.each(function() {
        var $bblpro_gallery_images = $(this).find('ul.bblpro-field-type-gallery-images-list');
        // Image ordering.
        $bblpro_gallery_images.sortable({
            items: 'li.bbl-gallery-media-item',
            cursor: 'move',
            scrollSensitivity: 40,
            forcePlaceholderSize: true,
            forceHelperSize: false,
            helper: 'clone',
            opacity: 0.65,
            start: function( event, ui ) {
                ui.item.css( 'background-color', '#f6f6f6' );
            },
            stop: function( event, ui ) {
                ui.item.removeAttr( 'style' );
            },
            update: function () {
                $(this).find('li').each(function () {
                    var $this = $(this);

                    $this.find('.bblpro-gallery-hidden-media-id').val($this.attr('data-attachment-id'));
                });
            }
        });
    });

    // Remove images.
    $galleryFieldContainers.on( 'click', 'a.delete', function() {

        $(this).parents('li').remove();

        return false;
    });

    //Creates media frame for Gallery selection.
    function createFrame( $container,  config   ) {

        var settings = Object.assign({
            labels: {
                choose: 'Add images to gallery',
                update: 'Add to gallery'
            }
        }, config);

        // Create the media frame.
        var frame = wp.media.frames.bblpro_gallery_field = wp.media({
            // Set the title of the modal.
            title: settings.labels.choose,
            button: {
                text: settings.labels.update
            },
            states: [
                new wp.media.controller.Library({
                    title: settings.labels.choose,
                    filterable: 'uploaded',
                    multiple: true,
                })
            ]
        });

        var name = $container.data('gallery-field-name');

        // When an image is selected, run a callback.
        frame.on( 'select', function() {
            var selection = frame.state().get( 'selection' );

            selection.map( function( attachment ) {
                attachment = attachment.toJSON();

                if (attachment.id) {
                    var attachment_image = attachment.sizes && attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;

                    $container.append(
                        galleryItem({
                            item_id: attachment.id,
                            item_image: attachment_image,
                            name: name
                        })
                    );
                }
            });
        });

        return frame;
    }
});
