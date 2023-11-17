$(document).ready(() => {
    $('#loginform').submit((e) => {
        e.preventDefault();

        // Check if the input is empty
        if ($('.input #username').val() === '') {
            $('.input #username').addClass('border-red-500')
            $('#userError').removeClass('hidden')
            return;
        }
        if ($('.input #password').val() === '') {
            $('.input #password').addClass('border-red-500')
            $('#passError').removeClass('hidden')
            return;
        }

        
        $.ajax({
            type: 'POST',
            url: 'php/authentication.php',
            data: $('#loginform').serialize(),
            success: (response) => {
                if (response !== 'match') {
                    Swal.fire({
                        title: 'Error',
                        icon: 'error',
                        text: response,
                    })
                    return
                }

                location.href = "blog_list.php";
            }
        })
    })
})