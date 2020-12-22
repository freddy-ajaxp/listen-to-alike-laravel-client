//     $(document).ready(function() {
//     var count = 0;
//     dynamic_field(count);
//     count++;

//     function getPlatformList(number) { 
//         $.ajax({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             },
//             enctype: 'multipart/form-data',
//             url: '{{ url("links/platforms") }}',
//             // url: 'http://localhost:5988/shortener/submit',
//             method: 'post',
//             data: formData,
//             dataType: 'json',
//             contentType: false,
//             processData: false,
//             beforeSend: function() {},
//             success: function(data) {
//                 alert("asd")
//             }
//         })
//     }

    
//     function dynamic_field(number) {
//         html = '<tr>';
//         html += `
//         <div class="music-link__platform" data-platform='spotify'>
//         <td style="width: 20%">
//         <div>
//                     <label for="form-control form-control-sm"> Platform </label>
//                 </div>
//             <select name="data_platform[]" class="form-control form-control-sm">
//                     <option disabled selected value=null>Platform</option>
//                     <option value="Youtube" >Youtube</option>
//                     <option value="Spotify">Spotify</option>
//                 </select>
//                             </td>`;
//         html += `
//         <td style="width: 50%">
//         <div class="form-group">
//         <div class='music-link__platform__input music-link__platform__input__url'>
//             <div>
//             <label for="music-link__platform__url-input">URL</label>
//             </div>
//             <input type="text" id="platform${count}" name="data_url_platform[]" class="music-link__platform__url-input" placeholder="Enter Platform link"/>
//         </div>
//         </div>
//         </td>`;
//         html += `
//         <td style="width: 20%">
//         <div class='music-link__platform__input music-link__platform__input__button'>
//                 <div>
//                     <label> Button Text</label>
//                 </div>
//                 <select name="data_text[]" class="music-link__button-text-select">
//                     <option selected="selected" value="Listen" >Listen</option>
//                     <option value="Purchase">Purchase</option>
//                     <option value="Play">Play</option>
//                     <option value="Buy">Buy</option>
//                     <option value="Buy Online">Buy Online</option>
//                     <option value="Download">Download</option>
//                     <option value="Stream">Stream</option>
//                     <option value="Go To">Go To</option>
//                     <option value="Visit">Visit</option>
//                     <option value="Watch">Watch</option>
//                     <option value="View">View</option>
//                     <option value="Pre-Order">Pre-Order</option>
//                     <option value="Pre-Save">Pre-Save</option>
//                     <option value="Pre-Add">Pre-Add</option>
//                     <option value="Buy Tickets">Buy Tickets</option>
//                     <option value="Get Tickets">Get Tickets</option>
//                     <option value="View Ticket Prices">View Ticket Prices</option>
//                     <option value="Discover">Discover</option>
//                 </select>
//             </div>
//         </td>`;


//         if (number > 1) {
//             html += `<td style="width: 10%"> 
//         <div class="music-link__reposition">
// <button type="button" name="remove" id="" class="btn btn-danger remove">X</button>
// </div>
//         </td></tr>`;
//             $('tbody').append(html);
//         } else {
//             html += `<td style="width: 10%"> 
//         <div class="music-link__reposition">
// <button type="button" name="remove" id="" class="btn btn-danger remove">X</button>
// </div>
//         </td></tr>`;
//             $('tbody').html(html);
//         }
//     }

//     $(document).on('click', '#add', function() {
//         count++;
//         dynamic_field(count);
//     });

//     $(document).on('click', '.remove', function() {
//         count--;
//         $(this).closest("tr").remove();
//     });

//     $('#checkbox').click(function() {
//         // alert("checked")
//         if ($(this).prop("checked") == true) {
//             $("#embedVideo").attr("disabled", false);
//         } else {
//             $("#embedVideo").attr("disabled", true);
//             $('#embedVideo').val('')
//         }
//     });

//     $('#dynamic_form').on('submit', function(event) {
//         event.preventDefault();
//         var files = $('#image').get(0).files;
//         formData = new FormData();


//         link_title = $('input[name="link_title"]').val()
//         embed_url_video = $('input[name="embed_url_video"]').val()

//         // getting data
//         var data_platform = $("select[name='data_platform[]']")
//             .map(function() {
//                 return ' ' + $(this).val();
//             }).get();

//         var data_url_platform = $("input[name='data_url_platform[]']")
//             .map(function() {
//                 return ' ' + $(this).val();
//             }).get();

//         var data_text = $("select[name='data_text[]']")
//             .map(function() {
//                 return ' ' + $(this).val();
//             }).get();

//         //log for debug purpose
//         console.log('data_platform', data_platform)
//         console.log('data_url_platform', data_url_platform)
//         console.log('data_text', data_text)
//         console.log('files[0]',files[0])


//         //appending data to sent
//         formData.append('link_title', link_title);
//         formData.append('image', files[0]); //only 1 image, the first index     
//         formData.append('video_embed_url', embed_url_video);
//         formData.append('data_platform', data_platform);
//         formData.append('data_url_platform', data_url_platform);
//         formData.append('data_text', data_text);

//         $.ajax({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             },
//             enctype: 'multipart/form-data',
//             url: '{{ route("dynamic-field.insert") }}',
//             // url: 'http://localhost:5988/shortener/submit',
//             method: 'post',
//             data: formData,
//             dataType: 'json',
//             contentType: false,
//             processData: false,
//             beforeSend: function() {},
//             success: function(data) {
//                 console.log("data return dari server", data);
//             }
//         })
//     });

// });