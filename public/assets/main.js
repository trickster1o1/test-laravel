let req = document.getElementsByClassName('required');
let view = screen.width
let flag = 0;
let mname = document.getElementById('mname');
let lname = document.getElementById('lname');
let txt = document.getElementsByClassName('tx-field');

window.addEventListener('resize', () => {
    if(screen.width < view && flag==0) {
        mname.parentNode.classList.add("mname");
        lname.parentNode.classList.add("lname");
        mname.parentNode.parentNode.classList.add('main-div');
        console.log('chladai xa');
        flag = 1;
    }if(screen.width >= view) {
        mname.parentNode.classList.remove("mname");
        lname.parentNode.classList.remove("lname");
        mname.parentNode.parentNode.classList.remove('main-div');
        flag=0;
    }
});

Array.prototype.map.call(req, (r) => {
    r.addEventListener('focus', () => {
        r.parentNode.style.border = '2px solid red';
    });
    r.addEventListener('blur', () => {
        r.parentNode.style.border = '1px solid #73a580';
        
    });
});

Array.prototype.map.call(txt, (t) => {
    t.addEventListener('focus', () => {
        t.parentNode.style.backgroundColor = '#927E70';
    });
    t.addEventListener('blur', () => {
        t.parentNode.style.backgroundColor = 'rgba(0,0,0,0)';
        
    });
}); 