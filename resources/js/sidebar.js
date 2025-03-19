document.addEventListener("DOMContentLoaded", function () {
    var sidebarOffcanvas = document.getElementById('sidebarOffcanvas');

    if (sidebarOffcanvas) {
        sidebarOffcanvas.addEventListener('hidden.bs.offcanvas', function () {
            console.log('Sidebar closed');
        });

        sidebarOffcanvas.addEventListener('shown.bs.offcanvas', function () {
            console.log('Sidebar opened');
        });
    }
});
