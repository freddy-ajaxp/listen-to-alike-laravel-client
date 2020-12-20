//toggle alert
//untuk sementara jenis alert baru alert, jenis alert ditentukan oleh parameter status dengna default 'Error'
function toggleAlert(show, status="Error", msgStatus = "Alert", msgContent="something happenned" ) {
    $('#alert-error').html(`<strong> ${msgStatus}!</strong> ${msgContent}` );
    show ? $("#overlay-alert").css("display", "block") : $("#overlay-alert").css("display", "none")
}

