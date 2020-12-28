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
                        {{-- <script>
                            // bypassPlatformsDraw
                            function bypassPlatformsDraw(sHash, aPlatforms) {

                                var eContainer = document.querySelector('.bypass-links__container');

                                eContainer.innerHTML = "";

                                for (var i = 0; i < aPlatforms.length; i++) {

                                    var sPlatformType = aPlatforms[i].platform_type;

                                    // Skip custom platforms
                                    if ((sPlatformType === 'custom_platform') || (sPlatformType === 'custom_text')) continue;

                                    eContainer.innerHTML += `
                                            <div class="bypass-links__link">
                                                <span class="bypass-links__link-platform">
                                                    <img class="bypass-links__link-platform-image" src="/images/music-platforms/${aPlatforms[i].platform_type}.svg" alt="${aPlatforms[i].platform_type}">
                                                </span>
                                                <span class="bypass-links__link-url">
                                                    <a class="mr-2" href="//li.sten.to/${sHash}/${aPlatforms[i].platform_type}" target="_blank"><ion-icon class='mr-1' style='vertical-align:middle' name='link-outline'></ion-icon> li.sten.to/${sHash}/${aPlatforms[i].platform_type}</a>
                                                </span>
                                                 <div>
                                                    <button class='btn btn-sm bypass-links__link-copy btn-secondary mr-1' onclick='javascript:copyToClipboard("li.sten.to/${sHash}/${aPlatforms[i].platform_type}")'>Copy</button>
                                                    <a href="//li.sten.to/${sHash}/${aPlatforms[i].platform_type}" class="btn btn-sm bypass-links__link-copy btn-secondary" target="_blank">View</a>
                                                </div>
                                            </div>`;

                                }

                            }

                        </script> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
