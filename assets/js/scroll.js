// Checks if document is loaded
const mateuswetahPerformWhenDocumentIsLoaded = callback => {
    if (/comp|inter|loaded/.test(document.readyState))
        callback();
    else
        document.addEventListener('DOMContentLoaded', callback, false);
}

mateuswetahPerformWhenDocumentIsLoaded(() => {
    /* Watch Scroll position to display floating buttons */
    let scrollPosition = window.scrollY;
    const stickyHeader = document.querySelector('.is-position-sticky-top');
    
    if ( !stickyHeader )
        return;

    if ( scrollPosition < 100 && stickyHeader.classList.contains('.has-color-lightest-background-color') )
        stickyHeader.classList.remove('has-color-lightest-background-color');   
    else if ( scrollPosition >= 100 && !stickyHeader.classList.contains('has-color-lightest-background-color') )   
        stickyHeader.classList.add('has-color-lightest-background-color');
    
    window.addEventListener('scroll', function() {
        if ( !stickyHeader )
            return;

        scrollPosition = window.scrollY;
        
        if ( scrollPosition < 100 && stickyHeader.classList.contains('has-color-lightest-background-color') )
            stickyHeader.classList.remove('has-color-lightest-background-color');   
        else if ( scrollPosition >= 100 && !stickyHeader.classList.contains('has-color-lightest-background-color') )     
            stickyHeader.classList.add('has-color-lightest-background-color');
    });
});