$(document).ready(() => {
    $('#comment_form').submit((e) => {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            data: $('#comment_form').serialize(),
            url: 'php/comment.php',
            success: (response) => {
                $('.comments').html(response);
                $('#comment').val('');
            }
        })
    })
})