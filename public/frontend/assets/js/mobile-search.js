document.addEventListener('DOMContentLoaded', function () {
    const DESKTOP_INPUT_ID = 'search-input-desktop';
    const DIALOG_ID = 'mobile-search-dialog';
    const MOBILE_INPUT_ID = 'search-input-mobile';
    const MOBILE_RESULTS_ID = 'mobileSearchResultsHook';
    const BACK_BTN_ID = 'mobile-search-back';
    const trigger = document.getElementById('open-mobile-search');

    function $(id) {
        return document.getElementById(id);
    }

    function isMobile() {
        return window.matchMedia && window.matchMedia('(max-width: 767px)').matches;
    }

    const desktopInput = $(DESKTOP_INPUT_ID);
    const dialog = $(DIALOG_ID);
    const mobileInput = $(MOBILE_INPUT_ID);
    const mobileResults = $(MOBILE_RESULTS_ID);
    const backBtn = $(BACK_BTN_ID);
    if (!dialog || !mobileInput) return;

    function openDialog(sourceValue) {
        dialog.classList.remove('hidden');
        dialog.style.display = 'block';
        dialog.dataset.state = 'open';
        dialog.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
        document.documentElement.style.overflow = 'hidden';
        const desktopResultsBox = document.getElementById('searchResults');
        if (desktopResultsBox) {
            desktopResultsBox.classList.add('hidden');
        }
        setTimeout(function () {
            if (sourceValue) mobileInput.value = sourceValue;
            try {
                mobileInput.focus();
            } catch (e) {
            }
            if (window.searchAutocomplete && typeof window.searchAutocomplete.doSearch === 'function') {
                if (mobileInput.value && mobileInput.value.trim()) {
                    window.searchAutocomplete.doSearch(mobileInput.value.trim(), 'mobile');
                }
            }
        }, 40);
    }

    function closeDialog() {
        dialog.dataset.state = 'closed';
        dialog.classList.add('hidden');
        dialog.style.display = 'none';
        dialog.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        document.documentElement.style.overflow = '';
        if (mobileInput) mobileInput.value = '';
        if (mobileResults) mobileResults.innerHTML = '';
    }

    window.searchOpen = function (sourceValue) {
        openDialog(sourceValue || '');
    };
    if (trigger) {
        trigger.addEventListener('click', function (e) {
            e.preventDefault();
            window.searchOpen();
        }, {passive: false});
    }
    if (desktopInput) {
        const openFromDesktop = function (e) {
            if (!isMobile()) return;
            try {
                e.preventDefault();
            } catch (err) {
            }
            openDialog(desktopInput.value || '');
        };
        desktopInput.addEventListener('focus', openFromDesktop, {passive: false});
        desktopInput.addEventListener('click', openFromDesktop, {passive: false});
        desktopInput.addEventListener('touchstart', openFromDesktop, {passive: false});
    }
    if (backBtn) backBtn.addEventListener('click', function (e) {
        e.preventDefault();
        closeDialog();
    }, {passive: false});
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && dialog.dataset.state === 'open') closeDialog();
    });
    document.addEventListener('click', function (e) {
        if (dialog.dataset.state !== 'open') return;
        const container = dialog.querySelector('.mobile-search-area') || dialog;
        if (!container.contains(e.target) && !e.target.closest('#' + MOBILE_INPUT_ID) && !e.target.closest('#' + BACK_BTN_ID)) {
            closeDialog();
        }
    }, {capture: true});
});
