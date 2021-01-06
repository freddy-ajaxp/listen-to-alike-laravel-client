    //img preview add
    $(document).on('change','#image-add',function(e){
        e.preventDefault();
        let reader = new FileReader();
        reader.onload = (evt) => {
            $('#image-preview-container-add').attr('src', evt.target.result);
        }
        reader.readAsDataURL(this.files[0]);
        $("#clear-image-add").attr("hidden", false);
        $("#upload-text").attr("hidden", true);
    });
    

        //img remove preview add
        $(document).on('click','#clear-image-add',function(e){
            e.preventDefault();
            $('#image-preview-container-add').attr('src', '');
            $("#form-add-link")[0].reset();
            $("#clear-image-add").attr("hidden", true);    
            $("#upload-text").attr("hidden", false);    
        });

            //clear form modal add link
    $('#modal-add-link').on('hidden.bs.modal', function(e) {
        $('#modal-dynamic-form-add').html('');
        $(this).find('form').trigger('reset');
        $('#image-preview-container-add').attr('src', "");
        $('#form-platform-add').attr('src', "");
        $('#form-custom-add').attr('src', "");
        counter = 0;
    })

        //add and remove platform new link
        $(document).on('click', '#add-link-platform', function() {
            dynamic_field(counter, '#modal-dynamic-form-add');
            counter++;
        });
        $(document).on('click', '.remove', function() {
            $(this).closest('.form-group').remove();
        });


        $(document).on('submit', '#form-add-link' , function(event) {
            event.preventDefault();
            var files = $('#image-add').get(0).files;
            formData = new FormData();
            link_title = $('input[name="link_title"]').val()
            video_embed_url = $('input[name="video_embed_url"]').val()
    
            // getting data
            var data_platform = $("select[name='data_platform[]']")
                .map(function() {
                    return ' ' + $(this).val();
                }).get();
    
            var data_url_platform = $("input[name='data_url_platform[]']")
                .map(function() {
                    return ' ' + $(this).val();
                }).get();
    
            var data_text = $("select[name='data_text[]']")
                .map(function() {
                    return ' ' + $(this).val();
                }).get();
    
            //log for debug purpose
            //appending data to sent
            formData.append('link_title', link_title);
            formData.append('image', files[0]); //only 1 image, the first index     
            formData.append('video_embed_url', video_embed_url);
            formData.append('data_platform', data_platform);
            formData.append('data_url_platform', data_url_platform);
            formData.append('data_text', data_text);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , enctype: 'multipart/form-data'
                , url: '{{ route("dynamic-field.insert") }}'
                , method: 'post'
                , data: formData
                , dataType: 'json'
                , contentType: false
                , processData: false
                , beforeSend: function() {
                    toggleSpinner(true, "Submitting Your Data");
                }
                , success: function(data) {
                    $('#example').DataTable().ajax.reload();
                }
                , error: function(xhr, ajaxOptions, thrownError) {
                    let returnMessage = JSON.parse(xhr.responseText)
                    Swal.fire({
                        title: ajaxOptions + '!'
                        , text: returnMessage.failed
                        , icon: 'error'
                        , confirmButtonText: 'Confirm'
                    })
    
                    toggleSpinner(false, ""); 
                }
            })
        });
        