document.addEventListener('DOMContentLoaded', function () {
    var backBtn = document.querySelector('[data-account-back]');
    if (backBtn) {
        backBtn.addEventListener('click', function () {
            if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = '/';
            }
        });
    }

    var tabs = document.querySelectorAll('[data-order-tab]');
    var items = document.querySelectorAll('[data-order-item]');
    var emptyBlock = document.querySelector('[data-empty-block]');

    function setActiveTab(activeTab) {
        tabs.forEach(function (tab) {
            var isActive = tab === activeTab;
            if (isActive) {
                tab.classList.remove('text-neutral-900', 'border-white', 'bg-neutral-200');
                tab.classList.add('text-primary-500', 'border-primary-500');
            } else {
                tab.classList.remove('text-primary-500', 'border-primary-500');
                tab.classList.add('text-neutral-900', 'border-white');
            }
        });
    }

    function filterOrders(status) {
        var hasVisible = false;

        items.forEach(function (item) {
            var itemStatus = item.getAttribute('data-order-status');
            if (status === 'all' || status === itemStatus) {
                item.style.display = '';
                hasVisible = true;
            } else {
                item.style.display = 'none';
            }
        });

        if (emptyBlock) {
            emptyBlock.style.display = hasVisible ? 'none' : '';
        }
    }

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            var status = tab.getAttribute('data-status');
            setActiveTab(tab);
            filterOrders(status);
        });
    });

    filterOrders('all');
});
