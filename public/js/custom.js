$(document).ready(function () {
    $('.cancel-alert').on('click', function () {
        $(this).parents().find('.alert-container').first().addClass('invisible');
    })
})