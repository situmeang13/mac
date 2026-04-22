document.addEventListener("DOMContentLoaded", function () {

    const currentPath = window.location.pathname.toLowerCase();
    const links = document.querySelectorAll(".sidebar-link");

    links.forEach(link => {
        link.classList.remove("active-link");

        const href = link.getAttribute("href");
        if (!href || href === "#") return;

        // Ambil nama folder (beranda, asesmen, intervensi, dll)
        const match = href.match(/\/([^\/]+)\/index\.php$/);
        if (!match) return;

        const folder = match[1];

        if (currentPath.includes("/" + folder + "/")) {
            link.classList.add("active-link");
        }
    });

});