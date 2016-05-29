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
