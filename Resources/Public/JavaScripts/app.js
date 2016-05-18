$(document).ready(function () {

    $('textarea').wysihtml5({
        "font-styles": false,
        "emphasis": true,
        "lists": false,
        "html": false,
        "link": false,
        "image": false,
        "color": true
    });

    $(document).foundation();

    $("[data-toggle=lightboxImage]").click(function() {
        var src = $(this).attr('data-image');
        $('#lightboxImage img').attr('src', src);
    });


});
