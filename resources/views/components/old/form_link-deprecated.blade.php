<div id="music-link__create" class="music-link__create" style="margin-top:3em">
    <div class="presignup-links p-3 mb-3">
        <span style='font-family:"Rubik";font-size:1.4em;margin-right:0.5em;display:inline-block;color:#444;'>Your Links</span>
        <div class="presignup-links__list" id="dynamic-temp-link">
        </div>
    </div>

    <div class="music-link__inputs-container" style='border-radius:1px;padding:4.5em 1em 1em 1em;'>
        <form method="post" id="dynamic_form" enctype="multipart/form-data">
            <div class="music-link__top-block">
                <div class="music-link__top-block-left">
                    <div class="music-link__artwork-card">
                        <div class="music-link__artwork-delete">&times;</div>
                        <img class="music-link__artwork">
                        <div>
                            <label>
                                <input class="music-link__artwork-checkbox" type="checkbox" style='margin:0.5em 0.5em 0 0;font-size:0.75em'>Embed artwork
                            </label>    
                        </div>
                    </div>
                    <!-- <form method="post" id="dynamic_form"> -->


                    <div class="music-link__upload-art" >
                        <ion-icon name="download-outline" />
                        <b style=" font-weight: 500; margin-bottom: '0.5em'">
                            Upload Image
                        </b>
                        <p style="font-size: '0.8em'; opacity: '0.8' ">
                            jpg | jpeg | png
                        </p>
                        <p style="font-size: '0.8em'; opacity: '0.8' ">Max 10MB</p>
                        <p style="font-size: '0.8em'; opacity: '0.8' ">
                            Drop file here.
                        </p>
                        <img id="image-preview-container" src="" style="max-height: 150px;">
                        <input id="image" class="music-link__upload-input" type="file" name="image" accept="image/*" />
                        <button id="clear-image" hidden> clear</button>
                    </div>                    
                </div>
                <div class="music-link__top-block-right">
                    <div class="form-group">
                        <div class='music-link__platform__input'>
                            <label class='d-block' style='color:#444'>Link Title</label>
                            <input type="text" name="link_title" class="music-link__name" placeholder='Song, album, or artist title'>
                        </div>
                    </div>
                    <div class='music-link__platform__input'>
                        <div>
                            <label>
                                <input class="music-link__youtube-embed-checkbox" type="checkbox" id="checkbox" style='margin-right:1em;width:auto'>Embed YouTube Video
                            </label>
                        </div>
                        <div class="music-link__youtube-embed ">
                            <input disabled type="text" name="embed_url_video" id="embedVideo" class="music-link__youtube" placeholder='E.g. youtube.com/watch?v=dQw4w9WgXcQ'>

                            <div class="music-link__youtube-card">
                                <img class="music-link__youtube-thumbnail" height="75" width="110">
                                <div>
                                    <p class="music-link__youtube-title"></p>
                                    <small class="music-link__youtube-description"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <label class='d-block' style='color:#444'>Your platforms:</label>
            <div class="music-link__platforms" id="dynamic_platform">
                <div class="table-responsive">
                    <button type="button" name="add" id="add" class="btn btn-outline-secondary">Add New Row</button>
                    <span id="result"></span>
                    <div id="modal-dynamic-form-add">
                    </div>
                    <table class="table table-borderless " id="user_table">
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div>
                <p class="music-link__error"></p>
                {{-- <input type="submit" name="save" id="save" class="btn btn-red mr-1 music-link__create-btn music-link__create-btn--landing py-3" value="Create Link"> --}}
                <button type="submit" class="btn btn-danger btn-lg btn-block">Create Link</button>
                <!-- <button class='btn btn-red mr-1 music-link__create-btn music-link__create-btn--landing py-3'></button> -->
        </form>
        <div style='padding:0.5em;text-align:center'>
            <p style='font-size:0.8em;color:#a5a5a5'>By using this service, you agree to
                ListenTo's
                <a href="#" style='color:#a5a5a5'>Terms of Service</a> and <a href="#" style='color:#a5a5a5'>Privacy Policy.</a></p>
        </div>
    </div>
</div>
</div>
