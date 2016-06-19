$(document).ready(function () {

    $('textarea').wysihtml5({
        stylesheets: [],
        "font-styles": false,
        "emphasis": true,
        "lists": false,
        "speech": true,
        "html": false,
        "link": false,
        "image": false,
        "color": false
    });

    $(document).foundation();

    $("[data-toggle=lightboxImage]").click(function() {
        var src = $(this).attr('data-image');
        $('#lightboxImage img').attr('src', src);
    });

});

$(function() {
    $('.image-editor').each(function() {

        var minZoom = $(this).attr('data-minzoom');
        var imageState = $(this).attr('data-imagestate');

        $(this).cropit({
            imageState: {
                src: imageState,
            },
            minZoom: minZoom,
            maxZoom: 2.5,
            exportZoom: 0.5
        });
    });
    $('.rotate-cw').click(function() {
        $(this).closest('.image-editor').cropit('rotateCW');
    });
    $('.rotate-ccw').click(function() {
        $(this).closest('.image-editor').cropit('rotateCCW');
    });
    $('.export').click(function() {
        var imageData = $(this).closest('.image-editor').cropit('export', {
            type: 'image/jpeg',
            quality: .6
        });
        window.open(imageData);
    });

    $("#blogForm").submit(function(e) {
        //var self = this;
        $('.image-editor').each(function() {
            var imageData = $(this).cropit('export', {
                type: 'image/jpeg',
                quality: .6
            });
            $(this).find('label').find('input').val(imageData);
        });

        e.preventDefault();
        return false; //is superfluous, but I put it here as a fallback

    });

});