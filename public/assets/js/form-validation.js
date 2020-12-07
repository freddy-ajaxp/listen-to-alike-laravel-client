$(document).ready(function () {
    $.validator.setDefaults({
        submitHandler: function () {
            //when form successfully submitted
            // alert("Form successful submitted!");
        },
    });
    $().ready(function () {
        $("#dynamic_form").validate({
            errorClass: 'error-validation',
            ignore: [],
            rules: {
                link_title: {
                    required: true,
                    minlength: 5,
                },
                "data_url_platform[]": {
                    required: true,
                },
                "data_platform[]": {
                    required: true,
                },
            },
            messages: {
                link_title: {
                    required: "Title dari Link harus diisi",
                    minlength: "Minimal 5 karakter",
                },
                "data_url_platform[]": {
                    required: "Isi URL harus diisi",
                },
                "data_platform[]": {
                    required: "Pilih",
                },
            },
            errorElement: "span",
            errorPlacement: function (error, element) {
                error.addClass("invalid-feedbacks");
                element.closest(".form-group").append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass("is-invalid");
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass("is-invalid");
            },
        });
    });
});

