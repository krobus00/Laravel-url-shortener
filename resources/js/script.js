copyToClipboard = function (str) {
      navigator.clipboard.writeText(str);
      alert("Copied the text: " + str);
}
