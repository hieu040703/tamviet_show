document.addEventListener('DOMContentLoaded', function () {
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileTriggers = document.querySelectorAll('[data-mobile-menu-toggle]');
    const mobileCloseButtons = mobileMenu
        ? mobileMenu.querySelectorAll('[data-mobile-menu-close]')
        : [];

    function openMobileMenu() {
        if (!mobileMenu) return;
        mobileMenu.classList.remove('hidden');
        mobileMenu.dataset.state = 'open';
        document.body.classList.add('overflow-hidden');
    }

    function closeMobileMenu() {
        if (!mobileMenu) return;
        mobileMenu.dataset.state = 'closed';
        mobileMenu.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    mobileTriggers.forEach(function (btn) {
        btn.addEventListener('click', function () {
            if (!mobileMenu) return;
            const isOpen = mobileMenu.dataset.state === 'open';
            isOpen ? closeMobileMenu() : openMobileMenu();
        });
    });

    mobileCloseButtons.forEach(function (btn) {
        btn.addEventListener('click', closeMobileMenu);
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && mobileMenu && mobileMenu.dataset.state === 'open') {
            closeMobileMenu();
        }
    });
    const accountWrapper = document.querySelector('[data-account-wrapper]');
    if (accountWrapper) {
        const accountTrigger = accountWrapper.querySelector('[data-account-trigger]');
        const accountMenu = accountWrapper.querySelector('[data-account-menu]');
        function closeAccountMenu() {
            if (accountMenu && !accountMenu.classList.contains('hidden')) {
                accountMenu.classList.add('hidden');
            }
        }

        if (accountTrigger && accountMenu) {
            accountTrigger.addEventListener('click', function (e) {
                e.stopPropagation();
                accountMenu.classList.toggle('hidden');
            });
        }
        document.addEventListener('click', function (e) {
            if (accountWrapper && !accountWrapper.contains(e.target)) {
                closeAccountMenu();
            }
        });

        window.addEventListener('resize', closeAccountMenu);
        window.addEventListener('scroll', closeAccountMenu, { passive: true });
    }
});
