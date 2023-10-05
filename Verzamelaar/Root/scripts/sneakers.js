document.addEventListener("DOMContentLoaded", function () {
    const filterButton = document.getElementById("filter-button");
    const sidebarMobile = document.querySelector(".sidebar-mobile");

    filterButton.addEventListener("click", function () {
        sidebarMobile.classList.toggle("menu-open");
    });
});