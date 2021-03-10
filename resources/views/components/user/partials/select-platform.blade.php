@if(isset($emptyLayout) && $emptyLayout)
<div class="form-group">
    <input type="hidden" name="id_platforms[]" value='0'/>
    <div class="form-row">
        <div class="col-sm-2">
            <div class="">
                <label for="form-control form-control"> Platform
                    @php
                    @endphp
                </label>
                <select name="data_platform[]" class="custom-select ">
                    @foreach($platforms as $key => $platform)
                    <option value="{{$platform['id']}}">{{$platform['platform_name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-sm-7">
            <div class="form-group">
                <div class="">
                    <div>
                        <label>URL</label>
                    </div>
                    <input required type="text" id="platform0" name="data_url_platform[]" class="form-control form-control" placeholder="Enter Platform link">
                </div>
            </div>
        </div>


        <div class="col-sm-2">
            <div class="">
                <div>
                    <label> Button Text</label>
                </div>
                <select name="data_text[]" class="custom-select">
                    @foreach($texts as $index => $text)
                    <option value="{{$text['id']}}">{{$text['text']}}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="col-sm-1">
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
            <div class="">
                <label for="form-control form-control"> Platform
                    @php
                    @endphp
                </label>
                <select name="data_platform[]" class="custom-select">
                    @foreach($platforms as $key => $platform)
                    <option 
                    @php
                        if ($platform['id'] === $dt['jenis_platform']) echo 'selected="selected"';
                    @endphp  
                    value="{{$platform['id']}}">{{$platform['platform_name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-sm-7">
            <div class="form-group">
                <div class="">
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
                    <label> Button Text</label>
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
