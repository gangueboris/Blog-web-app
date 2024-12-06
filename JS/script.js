// NAVBAR VARIABLES
const open__nav = document.getElementById('open__nav-btn');
const close__nav = document.getElementById('close__nav-btn');
const nav_items = document.querySelector('.nav__container-links');

// SIDEBAR VARIABLES
const sidebar = document.querySelector('aside');
const hideSideBarBtn = document.getElementById('hide_sidebar-btn');
const showSideBarBtn = document.getElementById('show_sidebar-btn');

// Navbar 
open__nav.addEventListener("click", function(){
    nav_items.style.display = 'flex';
    open__nav.style.display = 'none';
    close__nav.style.display = 'inline-block';
   
});

close__nav.addEventListener("click", function(){
    close__nav.style.display = 'none';
    open__nav.style.display = 'inline-block';
    nav_items.style.display = 'none';
});

// Sidebar

showSideBarBtn.addEventListener('click', function(){
    sidebar.style.left = '0';
    showSideBarBtn.style.display = 'none';
    hideSideBarBtn.style.display = 'inline-block';
});

hideSideBarBtn.addEventListener('click', function(){
    sidebar.style.left = '-100%';
    hideSideBarBtn.style.display = 'none';
    showSideBarBtn.style.display = 'inline-block';
});