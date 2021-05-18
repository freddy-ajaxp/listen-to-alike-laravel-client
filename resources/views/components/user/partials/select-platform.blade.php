
@if(isset($emptyLayout) && $emptyLayout)
<div class="form-group">
    <input type="hidden" name="id_platforms[]" value='0'/>
    <div class="form-row" style="text-align:center">
        <div class="col-sm-2 col-md-2 col-2">
                <label for="form-control form-control"> Platform
                    @php
                    @endphp
                </label>
                <div id="logoContainer">
               </div>
        </div>

        <div class="col-sm-7 col-md-7 col-5">
            <div class="form-group" style="text-align:center">
                    <div>
                        <label>URL</label>
                    </div>
                    <input required type="text" id="platform0" name="data_url_platform[]" class="form-control form-control" placeholder="Enter Platform link">
                </div>
        </div>


        <div class="col-sm-2 col-md-2 col-3" >
                <div style="text-align:center">
                    <label>Text</label>
                </div>
                <select name="data_text[]" class="custom-select">
                    @foreach($texts as $index => $text)
                    <option value="{{$text['id']}}">{{$text['text']}}</option>
                    @endforeach
                </select>
        </div>


        <div class="col-sm-1 col-md-1 col-2">
            <div class="music-link__reposition">
                <button type="button" name="remove" id="" class="btn btn-danger remove">X</button>
            </div>
        </div>
    </div>
</div>



@else
@foreach ($result as $index =>$dt)
<div class="form-group">
        @if($dt['id'] !== 0)
            <input type="hidden" name="id_platforms[]" value="{{$dt['id']}}" />
        @else
            <input type="hidden" name="id_platforms[]" value='0'/>
        @endif
    <div class="form-row">
        <div class="col-sm-2">
            <div class="platform-div">
                <label for="form-control form-control"> Platform</label>
                <div id="logoContainer">
                    <img name="data_platform[]" src="https://res.cloudinary.com/dfpmdlf8l/image/upload/{{$dt->list_platform->logo_image_path}}"  data-value="{{$dt->list_platform->id}}" data-id-platform="0" data-platform="{{$dt->list_platform->id}}" style="max-width: 100%;max-height: 100%;height: 41px;">
                </div>
            </div>
        </div>

        <div class="col-sm-7">
            <div class="form-group">
                <div class="platform-div">
                    <div>
                        <label>URL</label>
                    </div>
                    <input required type="text" name="data_url_platform[]" class="form-control form-control" placeholder="URL dari platform" value="{{ $dt['url_platform'] }}" />
                </div>
            </div>
        </div>


        <div class="col-sm-2">
            <div class="">
                <div>
                    <label>Text</label>
                </div>
                <select name="data_text[]" class="custom-select">
                    @foreach($texts as $index => $text)
                    <option 
                    @php
                        if ($text['text'] ===  $dt->list_text->text) echo 'selected="selected"';
                    @endphp  
                    value="{{$text['id']}}">{{$text['text']}}  </option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="col-sm-1">
            <div class="music-link__reposition">
            <div class="icon-inner"title="delete"><button type="button" name="remove" id="" class="btn btn-danger btn-sm remove">X</button></div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif
