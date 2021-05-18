
$(document).ready(function () {
   $(document).on('submit', '#f-short-link', function(e) {
       e.preventDefault();
       $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
        url: "shorten",
        method: "post",
        data: {
            fullURL: $("#shorten-full-url").val(),
        },
        async: false,
        success: function name(res) {
            $('#shorten-full-url').val(res.url)
            // let returnMessage = JSON.parse(res.responseText);
            Swal.fire({
                title: 'Berhasil',
                text: `URL: ${res.url}`,
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Close',
                confirmButtonText: 'Copy'
              }).then((result) => {
                if (result.isConfirmed) {
                    var textarea = document.createElement("textarea");
                    textarea.setAttribute("type", "hidden");
                    textarea.textContent = res.url;
                    textarea.style.position = "fixed";  
                    document.body.appendChild(textarea);
                    textarea.select();
                    document.execCommand("copy");   
                    Swal.fire({
                    position: 'top',
                    title: 'URL link berhasil di copy',
                    showConfirmButton: false,
                    timer: 1000
                    })
                }
              })
        },
        error: function name(res) {
            let returnMessage = JSON.parse(res.responseText)      
            console.log(returnMessage)
            Swal.fire(
                "Gagal",
                `${returnMessage.error}`,
                "error"
            );
        },
       })
        
   });
})

