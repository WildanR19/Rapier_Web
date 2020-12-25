$(document).ready(function() {
    var height = $('.navbar:visible').outerHeight();
    $('.main-sidebar').css('margin-top', height);
});

const navtoggle = document.querySelector('.nav-toggle');
const navmenuback = document.querySelector('.nav-menu-back');
const sidebaroverlay = document.querySelector('.sidebar-overlay');
const sidebar = document.querySelector('.main-sidebar');
sidebaroverlay.onclick = () => sidebar.classList.toggle('active');

const navtask = document.querySelector('.nav-task');
const sidenav = document.querySelector('.sidenav');

const navitem = document.querySelector('.nav-item');
const navlink = document.querySelector('.nav-link');
navlink.onclick = () => navitem.classList.toggle('active');

const currentLocation = location.href;
const menuItem = document.querySelectorAll('.nav-link');
const menuLength = menuItem.length;
for (let i = 0; i < menuLength; i++) {
    if (menuItem[i].href === currentLocation) {
        menuItem[i].classList.add("active");
    }
}

// Jam
function showTime() {
    var date = new Date();
    h = (date.getHours() < 10 ? '0' : '') + date.getHours();
    m = (date.getMinutes() < 10 ? '0' : '') + date.getMinutes();
    var hm = h + ':' + m;

    document.getElementById("time").innerText = hm;
    setTimeout(showTime, 1000);
}
showTime();

// Hari, Bulan, Tahun
function showDate(){
    var d = new Date();
    function getDayName(dateStr, locale) {
        var date = new Date(dateStr);
        return date.toLocaleDateString(locale, { weekday: 'long' });
    }
    function getMonthName(dateStr, locale) {
        var date = new Date(dateStr);
        return date.toLocaleDateString(locale, { month: 'long' });
    }
    var dateStr = d.toLocaleDateString();
    var dayName = getDayName(dateStr).toString().substr(0, 3);
    var day = (d.getDate() < 10 ? '0' : '') + d.getDate();
    var mo = getMonthName(dateStr).toString().substr(0, 3);
    var y = d.getFullYear().toString().substr(-2);
    document.getElementById("date").innerText = dayName + ", " + day + " " +  mo + " " + y;
}
showDate();

// Modal
$('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
})

//tooltip
$(document).ready(function(){
    $('[data-tooltip="tooltip"]').tooltip();   
});