document.addEventListener("DOMContentLoaded", function () {
    const ROUTES = window.APP_ROUTES || {};

    const toast = document.getElementById("tv-cart-toast");
    const toastMessage = document.getElementById("tv-cart-toast-message");
    let toastTimer = null;

    function showAuthToast(message) {
        if (!toast) return;
        if (toastMessage) {
            toastMessage.textContent = message;
        }
        toast.style.display = "block";
        if (toastTimer) {
            clearTimeout(toastTimer);
        }
        toastTimer = setTimeout(function () {
            toast.style.display = "none";
        }, 2500);
    }

    const body = document.body;
    const loginPopup = document.getElementById("loginPopup");
    const registerPopup = document.getElementById("registerPopup");
    const openLogin = document.getElementById("openLogin");
    const openRegister = document.getElementById("openRegister");
    const loginCloseBtn = loginPopup ? loginPopup.querySelector("button[type='button']") : null;
    const registerCloseBtn = registerPopup ? registerPopup.querySelector("button[type='button']") : null;
    const loginToRegisterBtn = document.getElementById("login_to_register");

    function openPopup(popup) {
        if (!popup) return;
        if (popup === loginPopup && registerPopup) {
            registerPopup.classList.add("popup-hidden");
        }
        if (popup === registerPopup && loginPopup) {
            loginPopup.classList.add("popup-hidden");
        }
        popup.classList.remove("popup-hidden");
        body.classList.add("overflow-hidden");
    }

    function closePopup(popup) {
        if (!popup) return;
        popup.classList.add("popup-hidden");
        const bothHidden =
            (!loginPopup || loginPopup.classList.contains("popup-hidden")) &&
            (!registerPopup || registerPopup.classList.contains("popup-hidden"));
        if (bothHidden) {
            body.classList.remove("overflow-hidden");
        }
    }

    if (openLogin && loginPopup) {
        openLogin.addEventListener("click", function (e) {
            e.preventDefault();
            openPopup(loginPopup);
        });
    }

    if (openRegister && registerPopup) {
        openRegister.addEventListener("click", function (e) {
            e.preventDefault();
            openPopup(registerPopup);
        });
    }
    if (loginToRegisterBtn && registerPopup && loginPopup) {
        loginToRegisterBtn.addEventListener("click", function (e) {
            e.preventDefault();
            closePopup(loginPopup);
            openPopup(registerPopup);
        });
    }

    if (loginCloseBtn && loginPopup) {
        loginCloseBtn.addEventListener("click", function () {
            closePopup(loginPopup);
        });
    }

    if (registerCloseBtn && registerPopup) {
        registerCloseBtn.addEventListener("click", function () {
            closePopup(registerPopup);
        });
    }

    if (loginPopup) {
        loginPopup.addEventListener("click", function (e) {
            if (e.target === loginPopup) {
                closePopup(loginPopup);
            }
        });
    }

    if (registerPopup) {
        registerPopup.addEventListener("click", function (e) {
            if (e.target === registerPopup) {
                closePopup(registerPopup);
            }
        });
    }

    if (loginPopup) {
        const loginInput = document.getElementById("login_input");
        const passwordInput = document.getElementById("password_input");
        const submitBtn = document.getElementById("login_submit");
        const loginLabel = document.getElementById("login_label");
        const loginError = document.getElementById("login_error");
        const authError = document.getElementById("auth_error");
        const form = document.getElementById("loginForm");

        if (loginInput && passwordInput && submitBtn && loginLabel && loginError && authError && form) {
            const baseInputClass = "w-full border border-neutral-400 text-neutral-900 rounded-lg placeholder:text-neutral-500 text-base p-3 mt-1 focus:border-primary-500 outline-none";
            const errorInputClass = baseInputClass + " !border-red-500";
            const disabledBtnClass = "relative flex justify-center outline-none font-semibold border-0 w-full text-base px-5 py-2.5 h-12 items-center rounded-lg cursor-not-allowed bg-neutral-100 hover:bg-neutral-100 hover:text-neutral-600 focus:ring-neutral-100 text-neutral-600";
            const enabledBtnClass = "relative flex justify-center outline-none font-semibold border-0 w-full text-base px-5 py-2.5 h-12 items-center rounded-lg bg-primary-500 text-white hover:bg-primary-600 focus:ring-2 focus:ring-primary-300";

            function isValidLoginValue() {
                const raw = loginInput.value.trim();
                if (!raw) {
                    loginError.classList.add("hidden");
                    loginError.textContent = "";
                    loginLabel.classList.remove("text-red-500");
                    loginInput.className = baseInputClass;
                    return false;
                }
                const digits = raw.replace(/\D/g, "");
                const isPhone = /^\d+$/.test(digits);
                const isGmail = /^[^\s@]+@gmail\.com$/i.test(raw);
                if (isPhone) {
                    if (digits.length !== 10) {
                        loginError.textContent = "Số điện thoại không đúng, vui lòng nhập lại";
                        loginError.classList.remove("hidden");
                        loginLabel.classList.add("text-red-500");
                        loginInput.className = errorInputClass;
                        return false;
                    }
                } else if (!isGmail) {
                    loginError.textContent = "Email không đúng, vui lòng nhập lại";
                    loginError.classList.remove("hidden");
                    loginLabel.classList.add("text-red-500");
                    loginInput.className = errorInputClass;
                    return false;
                }
                loginError.classList.add("hidden");
                loginError.textContent = "";
                loginLabel.classList.remove("text-red-500");
                loginInput.className = baseInputClass;
                return true;
            }

            function updateSubmitState() {
                authError.classList.add("hidden");
                authError.textContent = "";
                const loginOk = isValidLoginValue();
                const passOk = passwordInput.value.trim().length > 0;
                if (loginOk && passOk) {
                    submitBtn.disabled = false;
                    submitBtn.className = enabledBtnClass;
                } else {
                    submitBtn.disabled = true;
                    submitBtn.className = disabledBtnClass;
                }
            }

            loginInput.addEventListener("input", updateSubmitState);
            passwordInput.addEventListener("input", updateSubmitState);
            updateSubmitState();

            form.addEventListener("submit", function (e) {
                e.preventDefault();
                updateSubmitState();
                if (submitBtn.disabled) {
                    return;
                }
                authError.classList.add("hidden");
                authError.textContent = "";
                submitBtn.disabled = true;
                submitBtn.className = disabledBtnClass;
                const csrfMeta = document.querySelector('meta[name="csrf-token"]');
                const csrf = csrfMeta ? csrfMeta.getAttribute('content') : null;

                fetch(ROUTES.login, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrf,
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({
                        login: loginInput.value.trim(),
                        password: passwordInput.value
                    })
                })
                    .then(function (res) {
                        if (!res.ok) {
                            return res.json().then(function (data) {
                                throw data;
                            });
                        }
                        return res.json();
                    })
                    .then(function (data) {
                        if (data.success) {
                            showAuthToast("Đăng nhập thành công");
                            setTimeout(function () {
                                window.location.href = data.redirect || "/";
                            }, 800);
                        } else {
                            authError.textContent = data.message || "Thông tin đăng nhập không chính xác";
                            authError.classList.remove("hidden");
                            submitBtn.disabled = false;
                            submitBtn.className = enabledBtnClass;
                        }
                    })
                    .catch(function (err) {
                        const msg = err && err.message ? err.message : "Thông tin đăng nhập không chính xác";
                        authError.textContent = msg;
                        authError.classList.remove("hidden");
                        submitBtn.disabled = false;
                        submitBtn.className = enabledBtnClass;
                    });
            });
        }
    }

    if (registerPopup) {
        const regName = document.getElementById("register_name");
        const regEmail = document.getElementById("register_email");
        const regPhone = document.getElementById("register_phone");
        const regPass = document.getElementById("register_password");
        const regPassCf = document.getElementById("register_password_confirm");
        const errName = document.getElementById("register_name_error");
        const errEmail = document.getElementById("register_email_error");
        const errPhone = document.getElementById("register_phone_error");
        const errPass = document.getElementById("register_password_error");
        const errPassCf = document.getElementById("register_password_confirm_error");
        const authError = document.getElementById("register_auth_error");
        const btnSubmit = document.getElementById("register_submit");
        const form = document.getElementById("registerForm");

        if (regName && regEmail && regPhone && regPass && regPassCf && btnSubmit && form) {
            const baseInputClass = "w-full border border-neutral-400 text-neutral-900 rounded-lg placeholder:text-neutral-500 text-base p-3 mt-1 focus:border-primary-500 outline-none";
            const errorInputClass = baseInputClass + " !border-red-500";
            const disabledBtnClass = "relative flex justify-center outline-none font-semibold border-0 w-full text-base px-5 py-2.5 h-12 items-center rounded-lg cursor-not-allowed bg-neutral-100 text-neutral-600";
            const enabledBtnClass = "relative flex justify-center outline-none font-semibold border-0 w-full text-base px-5 py-2.5 h-12 items-center rounded-lg bg-primary-500 text-white hover:bg-primary-600 focus:ring-2 focus:ring-primary-300";

            function setError(inputEl, errorEl, message) {
                if (!errorEl || !inputEl) return;
                if (message) {
                    errorEl.textContent = message;
                    errorEl.classList.remove("hidden");
                    inputEl.className = errorInputClass;
                } else {
                    errorEl.textContent = "";
                    errorEl.classList.add("hidden");
                    inputEl.className = baseInputClass;
                }
            }

            function validateRegisterForm() {
                let valid = true;

                if (!regName.value.trim()) {
                    setError(regName, errName, "Vui lòng nhập họ và tên");
                    valid = false;
                } else {
                    setError(regName, errName, "");
                }

                const email = regEmail.value.trim();
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!email) {
                    setError(regEmail, errEmail, "Vui lòng nhập email");
                    valid = false;
                } else if (!emailRegex.test(email)) {
                    setError(regEmail, errEmail, "Email không đúng, vui lòng nhập lại");
                    valid = false;
                } else {
                    setError(regEmail, errEmail, "");
                }

                const digits = regPhone.value.replace(/\D/g, "");
                if (!digits) {
                    setError(regPhone, errPhone, "Vui lòng nhập số điện thoại");
                    valid = false;
                } else if (digits.length !== 10) {
                    setError(regPhone, errPhone, "Số điện thoại không đúng, vui lòng nhập lại");
                    valid = false;
                } else {
                    setError(regPhone, errPhone, "");
                }

                if (!regPass.value) {
                    setError(regPass, errPass, "Vui lòng nhập mật khẩu");
                    valid = false;
                } else if (regPass.value.length < 6) {
                    setError(regPass, errPass, "Mật khẩu phải có ít nhất 6 ký tự");
                    valid = false;
                } else {
                    setError(regPass, errPass, "");
                }

                if (!regPassCf.value) {
                    setError(regPassCf, errPassCf, "Vui lòng nhập lại mật khẩu");
                    valid = false;
                } else if (regPassCf.value !== regPass.value) {
                    setError(regPassCf, errPassCf, "Mật khẩu nhập lại không khớp");
                    valid = false;
                } else {
                    setError(regPassCf, errPassCf, "");
                }

                if (valid) {
                    btnSubmit.disabled = false;
                    btnSubmit.className = enabledBtnClass;
                } else {
                    btnSubmit.disabled = true;
                    btnSubmit.className = disabledBtnClass;
                }

                if (authError) {
                    authError.classList.add("hidden");
                    authError.textContent = "";
                }

                return valid;
            }

            [regName, regEmail, regPhone, regPass, regPassCf].forEach(function (el) {
                el.addEventListener("input", validateRegisterForm);
            });
            validateRegisterForm();

            form.addEventListener("submit", function (e) {
                e.preventDefault();
                if (!validateRegisterForm()) {
                    return;
                }

                btnSubmit.disabled = true;
                btnSubmit.className = disabledBtnClass;
                if (authError) {
                    authError.classList.add("hidden");
                    authError.textContent = "";
                }

                const csrfMeta = document.querySelector('meta[name="csrf-token"]');
                const csrf = csrfMeta ? csrfMeta.getAttribute("content") : null;

                fetch(ROUTES.register, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrf,
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({
                        name: regName.value.trim(),
                        email: regEmail.value.trim(),
                        phone: regPhone.value.trim(),
                        password: regPass.value,
                        password_confirmation: regPassCf.value
                    })
                })
                    .then(function (res) {
                        if (!res.ok) {
                            return res.json().then(function (data) {
                                throw data;
                            });
                        }
                        return res.json();
                    })
                    .then(function (data) {
                        if (data.success) {
                            showAuthToast("Đăng ký thành công");
                            setTimeout(function () {
                                window.location.href = data.redirect || "/";
                            }, 800);
                        } else {
                            if (authError) {
                                authError.textContent = data.message || "Đăng ký không thành công";
                                authError.classList.remove("hidden");
                            }
                            btnSubmit.disabled = false;
                            btnSubmit.className = enabledBtnClass;
                        }
                    })
                    .catch(function (err) {
                        const msg = err && err.message ? err.message : "Đăng ký không thành công";
                        if (authError) {
                            authError.textContent = msg;
                            authError.classList.remove("hidden");
                        }
                        btnSubmit.disabled = false;
                        btnSubmit.className = enabledBtnClass;
                    });
            });
        }
    }

    const logoutButtons = document.querySelectorAll("[data-logout-button]");
    if (logoutButtons.length && ROUTES.logout) {
        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
        const csrf = csrfMeta ? csrfMeta.getAttribute("content") : null;

        logoutButtons.forEach(function (btn) {
            btn.addEventListener("click", function (e) {
                e.preventDefault();
                if (!csrf) return;

                fetch(ROUTES.logout, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrf,
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({})
                })
                    .then(function (res) {
                        if (!res.ok) {
                            return res.json().then(function (data) {
                                throw data;
                            });
                        }
                        return res.json();
                    })
                    .then(function (data) {
                        if (data.success) {
                            showAuthToast("Đăng xuất thành công");
                            setTimeout(function () {
                                window.location.href = data.redirect || "/";
                            }, 800);
                        } else {
                            showAuthToast("Đăng xuất không thành công");
                        }
                    })
                    .catch(function () {
                        showAuthToast("Đăng xuất không thành công");
                    });
            });
        });
    }
    const requiresAuthLinks = document.querySelectorAll('[data-requires-auth]');
    const isAuthenticated = !!(window.APP_STATE && window.APP_STATE.isAuthenticated);
    if (requiresAuthLinks.length && loginPopup) {
        requiresAuthLinks.forEach(function (link) {
            link.addEventListener('click', function (e) {
                if (!isAuthenticated) {
                    e.preventDefault();
                    openPopup(loginPopup);
                }
            });
        });
    }
});

