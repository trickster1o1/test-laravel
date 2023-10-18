let req = document.getElementsByClassName('required');

Array.prototype.map.call(req, (r) => {
    r.addEventListener('focus', () => {
        r.parentNode.style.border = '1px solid red';
    });
    r.addEventListener('blur', () => {
        r.parentNode.style.border = '1px solid #73a580';
        
    });
});