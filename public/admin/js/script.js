/**
 * SmartLMS Industrial Admin Script
 */

document.addEventListener('livewire:navigated', function () {
    
    // --- SIDEBAR ELEMENTS ---
    const sidebar = document.getElementById('sidebar');
    const collapseBtn = document.getElementById('sidebarCollapse');
    const overlay = document.getElementById('sidebarOverlay');
    const menuSearch = document.getElementById('menuSearch');
    const menuItems = document.querySelectorAll('#sidebarMenu li:not(#noMenuResult)');
    const noResultMsg = document.getElementById('noMenuResult');

    // --- 1. SIDEBAR TOGGLE ---
    if (collapseBtn && sidebar) {
        collapseBtn.addEventListener('click', function () {
            if (window.innerWidth <= 768) {
                // Mobile behavior: Toggle the floating drawer
                sidebar.classList.toggle('show-mobile');
                if (overlay) overlay.classList.toggle('active');
            } else {
                // Desktop behavior: Standard collapse
                sidebar.classList.toggle('active');
            }
        });
    }

    // --- 2. OVERLAY CLICK (MOBILE UX) ---
    if (overlay) {
        overlay.addEventListener('click', function () {
            sidebar.classList.remove('show-mobile');
            overlay.classList.remove('active');
        });
    }

    // --- 3. MENU SEARCH FILTER ---
    if (menuSearch) {
        menuSearch.addEventListener('keyup', function () {
            const filter = this.value.toLowerCase();
            let hasResults = false;

            menuItems.forEach(item => {
                const text = item.textContent.toLowerCase();
                if (text.includes(filter)) {
                    item.style.display = "";
                    hasResults = true;
                } else {
                    item.style.display = "none";
                }
            });

            if (noResultMsg) {
                noResultMsg.style.display = (!hasResults && filter !== "") ? "block" : "none";
            }
        });
    }

    // --- 4. SWEETALERT TOAST LISTENER ---
    window.addEventListener('profile-updated', event => {
        const data = event.detail[0];
        
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        Toast.fire({
            icon: data.type, 
            title: data.message,
            background: data.type === 'success' ? '#198754' : '#dc3545',
            color: '#fff',
            iconColor: '#fff'
        });
    });
});