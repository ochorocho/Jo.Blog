$(document).ready(function () {
    $(document).foundation();


    $("[data-toggle=lightboxImage]").click(function() {
        var src = $(this).attr('data-image')
        $('#lightboxImage img').attr('src', src);
    });

});


tinymce.init({
    selector: 'textarea',
    menubar:false,
    statusbar: false,
    height: 200,
    theme: 'modern',
    skin : "mobile",
    plugins: [
        'autolink lists link charmap print preview hr',
        'wordcount visualblocks visualchars code fullscreen',
        'insertdatetime nonbreaking directionality',
        'emoticons template paste textpattern'
    ],
    toolbar1: 'bold italic emoticons | bullist numlist | undo redo',
    image_advtab: true,
});