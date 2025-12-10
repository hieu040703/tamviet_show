document.addEventListener('DOMContentLoaded', function () {
    const root = document.querySelector('.category');
    if (!root) return;
    const nav = document.getElementById('mainNav'); // bao cả thanh nav
    const trigger = root.querySelector('.group');
    const triggerBtn = trigger?.querySelector('button');
    const wrapper = root.querySelector('[data-radix-popper-content-wrapper]');
    const dialog = wrapper?.querySelector('[role="dialog"]');
    if (!trigger || !wrapper || !dialog || !nav) return;
    const tabs = dialog.querySelectorAll('[role="tab"][data-radix-collection-item]');
    const panels = dialog.querySelectorAll('[role="tabpanel"]');

    function applyState(state) {
        const isOpen = state === 'open';
        wrapper.style.display = isOpen ? 'block' : 'none';
        dialog.dataset.state = state;
        trigger.dataset.state = state;
        trigger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    }

    applyState('closed');

    function togglePopover() {
        const next = dialog.dataset.state === 'open' ? 'closed' : 'open';
        applyState(next);
    }

    triggerBtn?.addEventListener('click', function (e) {
        e.stopPropagation();
        togglePopover();
    });
    dialog.addEventListener('click', e => e.stopPropagation());
    document.addEventListener('click', function (e) {
        if (trigger.contains(e.target) || dialog.contains(e.target) || nav.contains(e.target)) return;
        applyState('closed');
    });
    nav.addEventListener('mouseleave', function () {
        applyState('closed');
    });
    window.addEventListener('scroll', function () {
        if (dialog.dataset.state === 'open') {
            applyState('closed');
        }
    });

    function activateTab(tab) {
        const id = tab.getAttribute('aria-controls');
        if (!id) return;
        tabs.forEach(t => {
            t.dataset.state = 'inactive';
            t.setAttribute('aria-selected', 'false');
        });

        tab.dataset.state = 'active';
        tab.setAttribute('aria-selected', 'true');

        panels.forEach(panel => {
            const active = panel.id === id;
            panel.hidden = !active;
            panel.dataset.state = active ? 'active' : 'inactive';
        });
    }

    tabs.forEach(tab => {
        tab.addEventListener('mouseenter', () => activateTab(tab));
        tab.addEventListener('click', function (e) {
            const href = tab.dataset.href;
            if (href) {
                window.location.href = href;
                return;
            }
            e.preventDefault();
            activateTab(tab);
        });
    });

    const firstActive = [...tabs].find(t => t.dataset.state === 'active') || tabs[0];
    if (firstActive) activateTab(firstActive);
});
