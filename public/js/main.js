// $(document).ready(function() {
//     var height = $('.navbar:visible').outerHeight();
//     $('.main-sidebar').css('margin-top', height);
// });

// const navtoggle = document.querySelector('.nav-toggle');
// const navmenuback = document.querySelector('.nav-menu-back');
// const sidebaroverlay = document.querySelector('.sidebar-overlay');
// const sidebar = document.querySelector('.main-sidebar');
// sidebaroverlay.onclick = () => sidebar.classList.toggle('active');

// const navtask = document.querySelector('.nav-task');
// const sidenav = document.querySelector('.sidenav');

// const navitem = document.querySelector('.nav-item');
// const navlink = document.querySelector('.nav-link');
// navlink.onclick = () => navitem.classList.toggle('active');

// const currentLocation = location.href;
// const menuItem = document.querySelectorAll('.nav-link');
// const menuLength = menuItem.length;
// for (let i = 0; i < menuLength; i++) {
//     if (menuItem[i].href === currentLocation) {
//         menuItem[i].classList.add("active");
//     }
// }

// Modal
$('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
})

//tooltip
$(document).ready(function(){
    $('[data-tooltip="tooltip"]').tooltip();   
});

 //alert delete
 $(document).on('click', '.delete-confirm', function (e) {
    e.preventDefault();
    const url = $(this).attr('href');
    swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            window.location.href = url;
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire('Cancelled', '', 'error')
        }
    });
});

// datatable modal
$(function () {
    $('#modal_table').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": false,
        "pageLength": 5,
    });
});