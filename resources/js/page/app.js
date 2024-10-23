
$(function(){
    $('table.dataTable tbody').on('click', 'tr td .btn-delete', function(){
        const t = $(this)
        const form = t.closest('td').find('form.form-delete')

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: form.attr('action'),
                    data: form.serialize(),
                    beforeSend: function() {
                        t.html('<div class="spinner-border spinner-border-sm" role="status"></div>').prop('disabled', true)
                    },
                    success: function(response) {
                        $.each(window.LaravelDataTables, function(i, item) {
                            item.ajax.reload()
                        })
                        
                        toastr.success(`${response.message}`, "Success");
                    },
                    complete: function() {
                        t.html('<i class="ti ti-trash"></i>').prop('disabled', false)
                    },
                    error: function(xhr, status, error) {
                        if (xhr.responseJSON) {
                            if (!xhr.responseJSON.errors) {
                                toastr.error(`${xhr.responseJSON.message}`, "Oops");
                            }
                        } else {
                            toastr.error(``, "Oops");
                        }
                    }
                })
            }
        })
    })
})