
$(document).ready(function () {
    $(".novalidate-form").submit(function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                $(".submitBtn").attr('disabled', true);
                $(".spin").removeClass('d-none');
            },
            success: function (xhr) {
                if (xhr.response) {
                    $(".modal").modal('hide');
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: xhr.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    //   console.log(xhr);
                      $(".error-box").html('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+ xhr.message +'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button></div>')
                }
            },
            error: function (response) {
                //console.log(response.responseJSON);
                $(".error-box").html('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+ response.responseJSON.message +'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button></div>')
                $(".submitBtn").attr('disabled', false);
                $(".spin").addClass('d-none');
            }
        })


    })
})
