copyToClipboard = function (str) {
    navigator.clipboard.writeText(str).then(function() {
        alert("Copied")
    }, function(err) {
        console.error('Async: Could not copy text: ', err);
    });
}
