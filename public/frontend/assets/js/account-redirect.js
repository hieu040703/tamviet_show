(function () {
    if (!window.APP_ROUTES) {
        return;
    }
    var config = window.APP_ROUTES;
    var ACCOUNT_PATH = config.accountPath || '/account.html';
    var REDIRECT_URL = config.redirectUrl || '/account/personal-info.html';
    var BREAKPOINT = config.breakpoint || 768;

    function normalizePath(path) {
        var a = document.createElement('a');
        a.href = path;
        var pathname = a.pathname || '/';
        if (pathname.length > 1 && pathname.endsWith('/')) {
            pathname = pathname.slice(0, -1);
        }
        return pathname;
    }

    function redirectIfDesktop() {
        var isDesktop = window.innerWidth >= BREAKPOINT;
        var currentPath = normalizePath(window.location.pathname);
        var accountPathNormalized = normalizePath(ACCOUNT_PATH);

        if (isDesktop && currentPath === accountPathNormalized) {
            window.location.replace(REDIRECT_URL);
        }
    }

    redirectIfDesktop();
    var resizeTimer = null;
    window.addEventListener('resize', function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(redirectIfDesktop, 150);
    });
})();
