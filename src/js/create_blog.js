const fileInput = document.getElementById('image');
const fileUpload = document.getElementById('fileUpload')
const fileName = document.getElementById('fileName')
const removeFile = document.getElementById('removeFile')

fileInput.addEventListener("change", () => {
    const selectedFile = fileInput.files[0]
    if (fileInput.value != '') {
        fileUpload.classList.remove('hidden')
        fileName.innerText = selectedFile.name
    }
    
})

removeFile.addEventListener("click", (event) => {
    event.preventDefault();
    fileInput.value = ""
    fileUpload.classList.add('hidden')
})


$(document).ready(() => {
    $('#create_blog').submit((e) => {
        e.preventDefault();

        $.ajax({
            url: 'php/create_blog.php',
            type: 'POST',
            data: new FormData(document.getElementById('create_blog')),
            processData: false,
            contentType: false,
            success: (response) => {
                if (response.includes('Success')) {
                    Swal.fire({
                        title: 'Success',
                        icon: 'success',
                        text: 'Posted successfully',
                    }).then((_) => {
                        $('input, textarea').val('')
                        fileUpload.classList.add('hidden')
                    })
                    return;
                }
                Swal.fire({
                    title: 'Error',
                    icon: 'error',
                    text: response,
                }).then((_) => {
                    $('input, textarea').val('')
                    fileUpload.classList.add('hidden')
                })

            }
        })
    })
})