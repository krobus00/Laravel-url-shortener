/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/script.js ***!
  \********************************/
copyToClipboard = function copyToClipboard(str) {
  navigator.clipboard.writeText(str).then(function () {
    alert("Copied");
  }, function (err) {
    console.error('Async: Could not copy text: ', err);
  });
};
/******/ })()
;