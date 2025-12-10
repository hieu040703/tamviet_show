(function () {
    function handleFacebookShare(btn) {
        const url = btn.getAttribute('data-share-facebook') || window.location.href;
        const shareUrl = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(url);

        window.open(
            shareUrl,
            '_blank',
            'width=600,height=600,menubar=no,toolbar=no,status=no,location=no,scrollbars=yes'
        );
    }

    function handleCopyLink(btn) {
        const url = btn.getAttribute('data-copy-link') || window.location.href;
        const successText = btn.getAttribute('data-success-text') || 'Đã sao chép liên kết!';

        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(url)
                .then(function () {
                    showCopyMessage(btn, successText);
                })
                .catch(function () {
                    fallbackCopy(url, btn, successText);
                });
        } else {
            fallbackCopy(url, btn, successText);
        }
    }

    function fallbackCopy(text, btn, successText) {
        const textarea = document.createElement('textarea');
        textarea.value = text;
        textarea.style.position = 'fixed';
        textarea.style.left = '-9999px';
        document.body.appendChild(textarea);
        textarea.select();

        try {
            document.execCommand('copy');
            showCopyMessage(btn, successText);
        } catch (e) {
            alert('Không thể sao chép liên kết, vui lòng copy thủ công.');
        }
        document.body.removeChild(textarea);
    }

    function showCopyMessage(btn, message) {
        const hint = document.createElement('div');
        hint.textContent = message;
        hint.style.position = 'fixed';
        hint.style.bottom = '20px';
        hint.style.left = '50%';
        hint.style.transform = 'translateX(-50%)';
        hint.style.background = 'rgba(15,23,42,0.95)';
        hint.style.color = '#fff';
        hint.style.padding = '8px 14px';
        hint.style.borderRadius = '999px';
        hint.style.fontSize = '13px';
        hint.style.zIndex = '9999';
        hint.style.boxShadow = '0 10px 30px rgba(15,23,42,.25)';

        document.body.appendChild(hint);

        setTimeout(function () {
            hint.style.opacity = '0';
            hint.style.transform = 'translateX(-50%) translateY(10px)';
            hint.style.transition = 'all .25s ease-out';
        }, 1500);

        setTimeout(function () {
            if (hint && hint.parentNode) {
                hint.parentNode.removeChild(hint);
            }
        }, 1800);
    }

    document.addEventListener('click', function (e) {
        const fbBtn = e.target.closest('[data-share-facebook]');
        if (fbBtn) {
            e.preventDefault();
            handleFacebookShare(fbBtn);
            return;
        }
        const copyBtn = e.target.closest('[data-copy-link]');
        if (copyBtn) {
            e.preventDefault();
            handleCopyLink(copyBtn);
            return;
        }
    });
})();
