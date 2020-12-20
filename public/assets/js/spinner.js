//toggle spinner
function toggleSpinner(status, text = "Processing Your Request") {
    $('#spinner-text strong').text(text);
    status ? $("#overlay").css("display", "block") : $("#overlay").css("display", "none")
}

