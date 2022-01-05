window.addEventListener('load', function() {
    // --  body に is-loaded を渡す
    var myBody = document.getElementsByTagName('body');
    myBody[0].classList.add('is-loaded');
})