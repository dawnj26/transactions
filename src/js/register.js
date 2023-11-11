$(document).ready(() => {
    $('#registerform').submit((e) => {
        e.preventDefault();

        // check if the inputs are empty
        if ($('.input #username').val() === '') {
            $('.input #username').addClass('border-red-500')
            $('#userError').removeClass('hidden')
            if ($('.input #password').val() === '') {
                $('.input #password').addClass('border-red-500')
                $('#passError').removeClass('hidden')
            }
            return;
        }

        $.ajax({
            type: 'POST',
            url: './php/registration.php',
            data: $('#registerform').serialize(),
            success: (response) => {


                if (!response.includes('exists')) {
                    let s = Swal.fire({
                        title: 'Success',
                        icon: 'success',
                        text: 'Registered Successfully'
                    }).then((_) => location.href = '.')
                    return;
                }

                // alert, username exists
                Swal.fire({
                    title: 'Error',
                    icon: 'error',
                    text: response,
                })
                
            },
            error: (xhr, status, response) => {
                alert(response);
            }
        })

    })
})