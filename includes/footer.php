<footer class="p-12 text-center border-t border-slate-100 bg-white/50 backdrop-blur-sm">
    <p class="text-slate-400 text-[11px] font-medium">
        &copy; 2026 Malang Autism Center
    </p>
</footer>

<script>
    lucide.createIcons();

    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    document.getElementById('current-date').innerText =
        new Date().toLocaleDateString('id-ID', options);

    function showSection(sectionId) {
        document.querySelectorAll('.content-section')
            .forEach(s => s.classList.remove('active'));

        document.getElementById(sectionId)?.classList.add('active');

        document.querySelectorAll('.sidebar-link')
            .forEach(l => l.classList.remove('active-link'));

        document.getElementById('nav-' + sectionId)
            ?.classList.add('active-link');

        window.scrollTo({ top: 0, behavior: 'smooth' });
        lucide.createIcons();
    }
</script>

</body>
</html>