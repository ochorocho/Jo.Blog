$(document).ready(function () {

    $('textarea').wysihtml5({
        stylesheets: [],
        toolbar: {
            speech: '<li>' +
            '<a class="btn" data-wysihtml5-command="insertSpeech" title="Voice input" href="javascript:;" unselectable="on"><i class="icon-volume-up"></i></a>' +
            '</li>',
        },
        "font-styles": false,
        "emphasis": true,
        "lists": false,
        "speech": true,
        "html": false,
        "link": true,
        "image": false,
        "color": false
    });

    $(document).foundation();

    $("[data-toggle=lightboxImage]").click(function() {
        var src = $(this).attr('data-image');
        $('#lightboxImage img').attr('src', src);
    });

});
