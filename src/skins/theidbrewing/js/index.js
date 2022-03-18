document.addEventListener("readystatechange", function() {
// --  body に is-loading を渡す
    var myBody = document.getElementsByTagName('body');
    myBody[0].classList.add('is-loading');
})
document.addEventListener('DOMContentLoaded', function() {
    // --  body に is-loaded を渡す
    var myBody = document.getElementsByTagName('body');
    myBody[0].classList.remove('is-loading');
    myBody[0].classList.add('is-loaded');
})