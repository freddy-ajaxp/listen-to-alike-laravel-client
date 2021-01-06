//img preview edit
$(document).on("change", "#image", function () {
    let reader = new FileReader();
    reader.onload = (e) => {
        $("#image-preview-container").attr("src", e.target.result);
    };
    reader.readAsDataURL(this.files[0]);
    $("#userErasingImage").val(false);
    $("#clear-image").attr("hidden", false);
    $("#upload-text").attr("hidden", true);
});

//img remove preview edit
$(document).on("click", "#clear-image", function (e) {
    e.preventDefault();
    $("#image-preview-container").attr("src", "");
    $("#form-platform")[0].reset(); //menghilangkan file gambar
    $("#userErasingImage").val(true);
    $("#clear-image").attr("hidden", true);
    $("#upload-text").attr("hidden", false);
});

//clear form edit
$("#modal-edit").on("hidden.bs.modal", function (e) {
    $("#modal-dynamic-form").html("");
    $(this).find("form").trigger("reset");
    $("#image-preview-container").attr("src", "");
    $("#form-platform").attr("src", "");
    $("#form-custom").attr("src", "");
    counter = 0;
});

//add and remove platform edit
$(document).on("click", "#add", function () {
    dynamic_field(counter, "#modal-dynamic-form");
    counter++;
});
$(document).on("click", ".remove", function () {
    $(this).closest(".form-group").remove();
});
