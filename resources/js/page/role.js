$(function(){
    const dtTable = window.LaravelDataTables["role-table"]

    $('.btn-add-role').on('click', function(){
        $('.modal-title').text('Add Role')
    })

    $('table.dataTable tbody').on('click', 'tr td .btn-edit', function(){
        const t = $(this)

        $.ajax({
            type: 'POST',
            url: `${baseUrl}/role/${t.data('id')}/edit`,
            data: {id:t.data('id')},
            beforeSend: function() {
                t.html('<div class="spinner-border spinner-border-sm" role="status"></div>').prop('disabled', true)
            },
            success: function(response) {
                $('.modal-title').text('Edit Role')
                $('#modal-role').modal('show')

                $.each(response.data, function(i, item) {
                    $('.modal form').find(`input[name=${i}]`).val(item)
                    $('.modal-content').find(`.btn-save`).attr('data-id', t.data('id'))
                })
            },
            complete: function() {
                t.html('<i class="ti ti-pencil"></i>').prop('disabled', false)
            },
            error: function(xhr, status, error) {
                if (xhr.responseJSON) {
                    if (xhr.responseJSON.errors) {
                        $.each(xhr.responseJSON.errors, function(i, item) {
                            let attribute = `input[name="${i}"],select[name="${i}"],textarea[name="${i}"]`

                            if (i.match(/\./g)) {
                                attribute = `input[data-name="${i}"],select[data-name="${i}"],textarea[data-name="${i}"]`
                            }

                            $('form').find(attribute).closest('div').append(`<div class="w-100"><small class="error-message text-danger">${item}</small></div>`)
                            
                        })
                    } else {
                        toastr.error(`${xhr.responseJSON.message}`, "Oops");
                    }
                } else {
                    toastr.error(`${xhr.responseJSON.message}`, "Oops");
                }
            }
        });
    })

    $('.btn-save').on('click', function(){
        const t = $(this)
        const form = t.closest('div.modal-content').find('form')

        form.submit()
    })

    $('form').on('submit', function(e){
        e.preventDefault();
        
        const form = $(this)
        const saveBtn = form.closest('div.modal-content').find('.btn-save')
        const id = saveBtn.attr('data-id')
        const actionUrl = id ? `${baseUrl}/role/${id}/edit` : `${baseUrl}/role`
        let formData = new FormData(form[0]);

        if (id) {
            formData.append('_method', 'PUT')
        }

        if (!form[0].checkValidity()) {
            return form[0].reportValidity()
        }

        $.ajax({
            type: 'POST',
            url: actionUrl,
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                saveBtn.html('<div class="spinner-border spinner-border-sm" role="status"></div>').prop('disabled', true)
                form.find('.error-message').remove()
            },
            success: function(response) {
                dtTable.ajax.reload()
                $('.modal').modal('hide')

                toastr.success(`${response.message}`, "Success");
            },
            complete: function() {
                saveBtn.html('<i class="ti ti-device-floppy"></i> Save').prop('disabled', false)
            },
            error: function(xhr, status, error) {
                if (xhr.responseJSON) {
                    if (xhr.responseJSON.errors) {
                        $.each(xhr.responseJSON.errors, function(i, item) {
                            let attribute = `input[name="${i}"],select[name="${i}"],textarea[name="${i}"]`

                            if (i.match(/\./g)) {
                                attribute = `input[data-name="${i}"],select[data-name="${i}"],textarea[data-name="${i}"]`
                            }

                            form.find(attribute).closest('div').append(`<div class="w-100"><small class="error-message text-danger">${item}</small></div>`)
                            
                        })
                    } else {
                        toastr.error(`${xhr.responseJSON.message}`, "Oops");
                    }
                } else {
                    toastr.error(``, "Oops");
                }
            }
        })
    })

    $('.modal').on('hidden.bs.modal', function () {
        $('.modal form')[0].reset()
        $('.modal-content').find('.btn-save').removeAttr('data-id')
    })

    $('.search-datatable').on('keyup keydown change', function(){
        dtTable.search( this.value ).draw()
    })
})