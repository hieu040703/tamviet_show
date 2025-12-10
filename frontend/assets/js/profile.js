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

    var pictureInputDesktop = document.getElementById('picture');
    var pictureInputMobile = document.getElementById('picture_mobile');

    var pictureTriggers = document.querySelectorAll(
        '[data-account-picture-button], [data-account-picture-trigger]'
    );

    pictureTriggers.forEach(function (el) {
        el.addEventListener('click', function () {
            if (window.innerWidth >= 768 && pictureInputDesktop) {
                pictureInputDesktop.click();
            } else if (pictureInputMobile) {
                pictureInputMobile.click();
            }
        });
    });

    var isDirty = false;
    var saveDesktopBtn = document.getElementById('saveDesktopBtn');
    var saveMobileBtn = document.getElementById('saveMobileBtn');

    function enableSaveButtons() {
        if (isDirty) return;
        isDirty = true;

        if (saveDesktopBtn) {
            saveDesktopBtn.disabled = false;
            saveDesktopBtn.classList.remove(
                'cursor-not-allowed',
                'bg-neutral-100',
                'hover:bg-neutral-100',
                'hover:text-neutral-600',
                'text-neutral-600',
                'focus:ring-neutral-100'
            );
            saveDesktopBtn.classList.add(
                'text-white',
                'bg-primary-500',
                'hover:bg-primary-600',
                'focus:ring-primary-300'
            );
        }

        if (saveMobileBtn) {
            saveMobileBtn.disabled = false;
            saveMobileBtn.classList.remove(
                'cursor-not-allowed',
                'bg-neutral-100',
                'hover:bg-neutral-100',
                'hover:text-neutral-600',
                'text-neutral-600',
                'focus:ring-neutral-100'
            );
            saveMobileBtn.classList.add(
                'text-white',
                'bg-primary-500',
                'hover:bg-primary-600',
                'focus:ring-primary-300'
            );
        }
    }

    function attachDirtyEvents(formId) {
        var form = document.getElementById(formId);
        if (!form) return;
        var elements = form.querySelectorAll('input, select, textarea');
        elements.forEach(function (el) {
            el.addEventListener('input', enableSaveButtons);
            el.addEventListener('change', enableSaveButtons);
        });
    }

    attachDirtyEvents('accountFormDesktop');
    attachDirtyEvents('accountFormMobile');

    if (pictureInputDesktop) {
        pictureInputDesktop.addEventListener('change', enableSaveButtons);
    }
    if (pictureInputMobile) {
        pictureInputMobile.addEventListener('change', enableSaveButtons);
    }

    function initGenderDropdown(scope) {
        var wrapper = document.querySelector('[data-gender="' + scope + '"]');
        if (!wrapper) return;
        var trigger = wrapper.querySelector('[data-gender-trigger="' + scope + '"]');
        var dropdown = wrapper.querySelector('[data-gender-dropdown="' + scope + '"]');
        var labelEl = wrapper.querySelector('[data-gender-label="' + scope + '"]');
        var selectEl = wrapper.querySelector('select[name="gender"]');
        if (!trigger || !dropdown) return;

        trigger.addEventListener('click', function (e) {
            e.stopPropagation();
            dropdown.classList.toggle('hidden');
        });

        dropdown.querySelectorAll('[data-gender-option]').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.stopPropagation();
                var value = btn.getAttribute('data-gender-option');
                var text = btn.textContent.trim();
                if (selectEl) {
                    selectEl.value = value;
                }
                if (labelEl) {
                    labelEl.textContent = text;
                }
                dropdown.classList.add('hidden');
                enableSaveButtons();
            });
        });

        document.addEventListener('click', function (e) {
            if (!wrapper.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    }

    initGenderDropdown('desktop');
    initGenderDropdown('mobile');

    var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    var toast = document.getElementById('tv-cart-toast');
    var toastMessage = document.getElementById('tv-cart-toast-message');
    var toastTimer = null;

    function showToast(message) {
        if (!toast) return;
        if (toastMessage && message) {
            toastMessage.textContent = message;
        }
        toast.style.display = 'block';
        if (toastTimer) {
            clearTimeout(toastTimer);
        }
        toastTimer = setTimeout(function () {
            toast.style.display = 'none';
        }, 2500);
    }

    function resetDirtyState() {
        isDirty = false;

        if (saveDesktopBtn) {
            saveDesktopBtn.disabled = true;
            saveDesktopBtn.classList.remove(
                'text-white',
                'bg-primary-500',
                'hover:bg-primary-600',
                'focus:ring-primary-300'
            );
            saveDesktopBtn.classList.add(
                'cursor-not-allowed',
                'bg-neutral-100',
                'hover:bg-neutral-100',
                'hover:text-neutral-600',
                'text-neutral-600',
                'focus:ring-neutral-100'
            );
        }

        if (saveMobileBtn) {
            saveMobileBtn.disabled = true;
            saveMobileBtn.classList.remove(
                'text-white',
                'bg-primary-500',
                'hover:bg-primary-600',
                'focus:ring-primary-300'
            );
            saveMobileBtn.classList.add(
                'cursor-not-allowed',
                'bg-neutral-100',
                'hover:bg-neutral-100',
                'hover:text-neutral-600',
                'text-neutral-600',
                'focus:ring-neutral-100'
            );
        }
    }

    function bindAjaxForm(formId) {
        var form = document.getElementById(formId);
        if (!form) return;

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData
            })
                .then(function (res) {
                    if (res.status === 422) {
                        return res.json().then(function (data) {
                            var msg = 'Dữ liệu không hợp lệ';
                            if (data.errors) {
                                var firstKey = Object.keys(data.errors)[0];
                                if (firstKey && data.errors[firstKey][0]) {
                                    msg = data.errors[firstKey][0];
                                }
                            }
                            showToast(msg);
                            throw new Error('Validation error');
                        });
                    }
                    if (!res.ok) {
                        showToast('Có lỗi xảy ra, vui lòng thử lại');
                        throw new Error('Request failed');
                    }
                    return res.json();
                })
                .then(function (data) {
                    if (data.status === 'success') {
                        showToast('Cập nhật hồ sơ thành công!');
                        resetDirtyState();

                        if (data.data && data.data.full_name) {
                            var nameEls = document.querySelectorAll('[data-customer-name]');
                            nameEls.forEach(function (el) {
                                el.textContent = data.data.full_name;
                            });
                        }

                        if (data.data && data.data.avatar_url) {
                            var avatarEls = document.querySelectorAll('[data-customer-avatar]');
                            avatarEls.forEach(function (img) {
                                img.src = data.data.avatar_url;
                            });
                        }
                    } else {
                        showToast(data.message || 'Có lỗi xảy ra, vui lòng thử lại');
                    }
                })
                .catch(function () {});
        });
    }

    bindAjaxForm('accountFormDesktop');
    bindAjaxForm('accountFormMobile');
});
