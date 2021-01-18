    <div class="modal-dialog" role="document" style="max-width:540px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="linkCreatedModalLabel">Link Created!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-0" style="border-radius: 0 0 9px 9px;">
                <div class="px-3 mb-4">
                    <div class="signup-cta my-4">
                        <span class="text-dark">You can visit your link at:</span>
                        <div>
                            <p class="modal-link-created__url"><a class="modal-link-created__link" href="/preview/{{$data['link']}}" target="_blank"> {{config('constants.site_url')}}{{$data['link']}}</a></p>
                            <span class="badge badge-sm badge-success copied-text"></span>
                        </div>
                        <div>
                            <a href="/dashboard" class="btn btn-sm btn-outline-secondary">View Link on Dashboard</a>
                        </div>

                        <style>
                            .bypass-links__title {
                                font-size: 1em;
                                font-weight: 500;
                            }

                            .bypass-links__link-platform-image {
                                width: 4em;
                            }

                            .bypass-links__link-url {
                                font-size: 0.65em;
                                font-weight: 500;
                            }

                            .bypass-links__link {
                                display: flex;
                                justify-content: space-between;
                                padding: 0.5em;
                                border-bottom: 1px solid #dcdcdc;
                            }

                            @media(max-width: 520px) {
                                .bypass-links__link {
                                    flex-direction: column;
                                }
                            }

                        </style>
                        <script>
                            toSave = {!!json_encode($data) !!};
                            var a = JSON.parse(localStorage.getItem('links')) || [];
                            a.push(toSave);
                            console.log(a);
                            localStorage.setItem('links', JSON.stringify(a));
                            $('#dynamic-temp-link').html("");
                                a.forEach(function(data) {
                                    $('#dynamic-temp-link').append(`
                <div class="presignup-link" style="overflow:hidden" id="dynamic-temp-link">
                <a class="mr-2" target="_blank" style="display:inline-block;font-weight:bold;color:#1a436d" href="preview/${data.link}">
                    {{config('constants.site_title')}}/${data.link}
                </a>
                <span style="color:#888;font-size:0.85em">${data.title}</span>
                <div class="presignup-link__buttons" style="float:right">

                <a href="/dashboard" class="btn btn-sm btn-secondary mr-1">Edit</a><a target="_blank" href="preview/${data.link}" class="btn btn-sm btn-secondary ">View
                    </a></div>
            </div>
                `);
                                });

                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
