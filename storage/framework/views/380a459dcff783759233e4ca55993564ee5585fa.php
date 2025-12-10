<?php if(!empty($menu) && $menu->items->count()): ?>
    <div role="dialog"
         id="mobile-menu"
         aria-describedby="radix-:r3e6:"
         aria-labelledby="radix-:r3e5:"
         data-state="closed"
         class="hidden overflow-x-auto md:px-6 lef-0 right-0 grid w-full border bg-background md:pt-20 animate-moveToTop fixed bottom-0 left-0 top-0 z-50 gap-0 border-none px-0 pb-0 pt-[76px] data-[state=open]:animate-in data-[state=open]:fade-in-0 data-[state=open]:slide-in-from-left-1/2 data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=closed]:slide-out-to-left-1/2 max-w-[329px] rounded-none md:hidden"
         tabindex="-1"
         style="pointer-events: auto;">
        <div class="absolute w-full flex-col space-y-1.5 md:px-6 md:pt-7 flex p-0">
            <h2 id="radix-:r3e5:" class="tracking-tight text-xl font-semibold">

                <?php if(auth()->guard('web')->guest()): ?>
                    <div class="grid h-[76px] grid-cols-[1fr,24px] items-center bg-primary-500 px-4 shadow-yPlus">
                        <button
                            data-size="sm"
                            type="button"
                            class="relative justify-center outline-none font-semibold bg-white border border-neutral-200 hover:bg-bg-white hover:text-primary-500 focus:text-primary-500 text-sm px-4 py-2 h-9 items-center rounded-full btn-login flex"
                        >
                    <span
                        class="p-icon inline-flex align-[-0.125em] justify-center max-h-full max-w-full m-[-1] mr-1 h-6 w-6 px-0">
                        <svg viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M20.0711 4.92895C18.1823 3.0402 15.6711 2 13 2C10.3289 2 7.8177 3.0402 5.92891 4.92895C4.0402 6.8177 3 9.32891 3 12C3 14.6711 4.0402 17.1823 5.92891 19.0711C7.8177 20.9598 10.3289 22 13 22C15.6711 22 18.1823 20.9598 20.0711 19.0711C21.9598 17.1823 23 14.6711 23 12C23 9.32891 21.9598 6.8177 20.0711 4.92895ZM13 20.8281C10.3879 20.8281 8.03762 19.6874 6.41984 17.8785C7.42277 15.2196 9.99016 13.3281 13 13.3281C11.0584 13.3281 9.48438 11.7541 9.48438 9.8125C9.48438 7.87086 11.0584 6.29688 13 6.29688C14.9416 6.29688 16.5156 7.87086 16.5156 9.8125C16.5156 11.7541 14.9416 13.3281 13 13.3281C16.0098 13.3281 18.5772 15.2196 19.5802 17.8785C17.9624 19.6874 15.6121 20.8281 13 20.8281Z"
                                fill="currentColor"
                            ></path>
                        </svg>
                    </span>
                            <span id="openLogin">Đăng nhập /</span>
                            <span id="openRegister" class="ml-1">Đăng ký</span>
                        </button>

                        <button data-size="sm" type="button"
                                data-mobile-menu-close
                                class="relative flex justify-center outline-none font-semibold focus:ring-primary-300 text-sm bg-transparent data-[size=sm]:text-sm text-inherit border-0 hover:bg-0 hover:text-primary-500 focus:text-primary-500 h-6 p-0">
                    <span
                        class="p-icon inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6 text-neutral-50">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  clip-rule="evenodd"
                                  d="M4.29289 4.29289C4.68342 3.90237 5.31658 3.90237 5.70711 4.29289L19.7071 18.2929C20.0976 18.6834 20.0976 19.3166 19.7071 19.7071C19.3166 20.0976 18.6834 20.0976 18.2929 19.7071L4.29289 5.70711C3.90237 5.31658 3.90237 4.68342 4.29289 4.29289Z"
                                  fill="currentColor"></path>
                            <path
                                fill-rule="evenodd" clip-rule="evenodd"
                                d="M19.7071 4.29289C19.3166 3.90237 18.6834 3.90237 18.2929 4.29289L4.29289 18.2929C3.90237 18.6834 3.90237 19.3166 4.29289 19.7071C4.68342 20.0976 5.31658 20.0976 5.70711 19.7071L19.7071 5.70711C20.0976 5.31658 20.0976 4.68342 19.7071 4.29289Z"
                                fill="currentColor"></path>
                        </svg>
                    </span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if(auth()->guard('web')->check()): ?>
                    <?php
                        $user = auth('web')->user();
                         $avatarPath = $user && $user->avatar
                             ? (\Illuminate\Support\Str::startsWith($user->avatar, ['http://', 'https://'])
                             ? $user->avatar
                             : asset( $user->avatar))
                             : asset('backend/img/not-found.jpg');
                         $displayName = $user && $user->name ? $user->name : 'Khách hàng';
                    ?>
                    <div class="grid h-[76px] grid-cols-[1fr,24px] items-center bg-primary-500 px-4 shadow-yPlus">
                        <div class="grid grid-cols-[48px,1fr] items-center gap-3">
                            <img class="h-[48px] w-[48px] rounded-full object-cover"
                                 src="<?php echo e($avatarPath); ?>"
                                 alt="avatar" loading="lazy" width="500" height="500">
                            <div class="grid gap-1">
                                <h4 class="text-[16px] leading-[24px] truncate font-semibold text-neutral-50">
                                    <?php echo e($displayName); ?>

                                </h4>
                            </div>
                        </div>
                        <button data-size="sm" type="button"
                                class="relative flex justify-center outline-none font-semibold focus:ring-primary-300 text-sm bg-transparent data-[size=sm]:text-sm text-inherit border-0 hover:bg-0 hover:text-primary-500 focus:text-primary-500 h-6 p-0"
                                data-mobile-menu-close>
                    <span
                        class="p-icon inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6 text-neutral-50">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M4.29289 4.29289C4.68342 3.90237 5.31658 3.90237 5.70711 4.29289L19.7071 18.2929C20.0976 18.6834 20.0976 19.3166 19.7071 19.7071C19.3166 20.0976 18.6834 20.0976 18.2929 19.7071L4.29289 5.70711C3.90237 5.31658 3.90237 4.68342 4.29289 4.29289Z"
                                  fill="currentColor"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M19.7071 4.29289C19.3166 3.90237 18.6834 3.90237 18.2929 4.29289L4.29289 18.2929C3.90237 18.6834 3.90237 19.3166 4.29289 19.7071C4.68342 20.0976 5.31658 20.0976 5.70711 19.7071L19.7071 5.70711C20.0976 5.31658 20.0976 4.68342 19.7071 4.29289Z"
                                  fill="currentColor"></path>
                        </svg>
                    </span>
                        </button>
                    </div>
                <?php endif; ?>

            </h2>
        </div>

        <div class="grid flex-1 shrink-0 overflow-auto">
            <div class="flex w-full flex-col px-4" data-orientation="vertical">
                <?php $__currentLoopData = $menu->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $children    = $item->children ?? collect();
                        $hasChildren = $children->count() > 0;

                        $href = optional($item->router)->canonical
                            ? router_link_from_canonical(optional($item->router)->canonical)
                            : ($item->url ?: '#');

                        $panelId = 'mobile-accordion-' . $item->id;
                        $wrapperBorderClass = $loop->last ? 'border-b-0' : 'border-b';
                    ?>

                    <div data-state="closed"
                         data-orientation="vertical"
                         data-accordion-item
                         class="<?php echo e($wrapperBorderClass); ?>">
                        <div class="flex items-center justify-between">
                            <a target="" class="flex-1 py-4" href="<?php echo e($href); ?>">
                                <div class="flex w-full justify-start">
                                    <h4 class="text-[16px] leading-[24px] line-clamp-1 font-semibold text-neutral-900 group-data-[state=active]:text-primary-500"
                                        title="<?php echo e($item->name); ?>">
                                        <?php echo e($item->name); ?>

                                    </h4>
                                </div>
                            </a>

                            <?php if($hasChildren): ?>
                                <button type="button"
                                        aria-controls="<?php echo e($panelId); ?>"
                                        aria-expanded="false"
                                        data-state="closed"
                                        data-orientation="vertical"
                                        data-accordion-trigger
                                        class="m-3 me-0 h-6 w-6 shrink-0 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round"
                                         class="h-6 w-6 transition-transform duration-200">
                                        <path d="m6 9 6 6 6-6"></path>
                                    </svg>
                                </button>
                            <?php endif; ?>
                        </div>

                        <?php if($hasChildren): ?>
                            <div data-state="closed"
                                 id="<?php echo e($panelId); ?>"
                                 hidden
                                 role="region"
                                 data-orientation="vertical"
                                 class="overflow-hidden text-sm transition-all data-[state=closed]:animate-accordion-up data-[state=open]:animate-accordion-down"
                                 style="--radix-accordion-content-height: var(--radix-collapsible-content-height); --radix-accordion-content-width: var(--radix-collapsible-content-width);">
                                <div class="pt-0 grid px-4 pb-0">
                                    <?php $__currentLoopData = $children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $childHref = optional($child->router)->canonical
                                                ? router_link_from_canonical(optional($child->router)->canonical)
                                                : ($child->url ?: '#');
                                        ?>
                                        <a class="flex w-full justify-start py-3"
                                           href="<?php echo e($childHref); ?>">
                                            <h4 class="text-[16px] leading-[24px] line-clamp-1 font-normal text-neutral-900 group-data-[state=active]:text-primary-500"
                                                title="<?php echo e($child->name); ?>">
                                                <?php echo e($child->name); ?>

                                            </h4>
                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <div>
            <?php if(isset($system['contact_hotline'])): ?>
                <div class="flex flex-wrap items-center justify-between gap-2 border-t p-4">
                    <div class="grid flex-1 grid-cols-[18px,1fr] items-center gap-2">
                    <span class="p-icon inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                             viewBox="0 0 24 24">
                            <path
                                fill="currentColor"
                                d="M21.424 17.015l-2.89-2.905a2.055 2.055 0 00-1.464-.601c-.578 0-1.124.228-1.537.643l-1.125 1.13c-.874-.488-2.036-1.16-3.243-2.371C9.96 11.7 9.292 10.536 8.803 9.653l1.126-1.13c.838-.844.855-2.196.039-3.015l-2.89-2.903A2.046 2.046 0 005.614 2c-.565 0-1.1.219-1.51.616-.249.201-1.494 1.306-1.958 3.584-.65 3.188.843 6.256 5.154 10.588C12.116 21.624 16.228 22 17.373 22c.238 0 .382-.015.42-.02 2.247-.264 3.051-1.266 3.638-1.997.761-.948.758-2.196-.007-2.968zm-.959 2.185c-.552.688-1.073 1.337-2.816 1.543 0 0-.096.01-.276.01-1.025 0-4.717-.35-9.195-4.847C4.202 11.911 2.807 9.171 3.36 6.45c.405-1.987 1.48-2.832 1.522-2.864l.037-.027.033-.033a.93.93 0 01.66-.28c.225 0 .433.085.586.24L9.09 6.389c.333.334.315.896-.039 1.252L7.777 8.92l-.02.023c-.332.367-.293.863-.11 1.186.527.957 1.25 2.267 2.64 3.664 1.386 1.392 2.688 2.117 3.638 2.647.095.053.291.143.537.143a.99.99 0 00.754-.348l1.195-1.2a.926.926 0 01.659-.279c.225 0 .434.085.587.238l2.889 2.903c.367.37.215.935-.081 1.304z"></path>
                        </svg>
                    </span>
                        <h4 class="text-[16px] leading-[24px] whitespace-nowrap font-semibold">
                            Liên hệ & Đặt hàng
                        </h4>
                    </div>
                    <a rel="noopener noreferrer" target="_blank"
                       class="relative flex justify-center border-0 bg-transparent text-sm font-normal text-hyperLink outline-none md:hover:text-primary-600 md:text-base text-base font-semibold text-hyperLink"
                       type="button" href="tel:18006821"><?php echo e($system['contact_hotline'] ?? '09877233223'); ?></a>
                </div>
            <?php endif; ?>
        </div>
        <button type="button"
                data-mobile-menu-close
                class="fixed right-2 rounded-sm opacity-100 outline-0 ring-offset-background transition-opacity hover:opacity-80 md:right-4 md:top-6 top-5 hidden">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="h-7 w-7">
                <path d="M18 6 6 18"></path>
                <path d="m6 6 12 12"></path>
            </svg>
            <span class="sr-only">Close</span>
        </button>
    </div>
<?php endif; ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var wrapper = document.querySelector('[data-account-wrapper]');
        if (!wrapper) return;

        var trigger = wrapper.querySelector('[data-account-trigger]');
        var menu = wrapper.querySelector('[data-account-menu]');

        function closeAccountMenu() {
            if (!menu.classList.contains('hidden')) {
                menu.classList.add('hidden');
            }
        }

        trigger.addEventListener('click', function (e) {
            e.stopPropagation();
            menu.classList.toggle('hidden');
        });

        document.addEventListener('click', function (e) {
            if (!wrapper.contains(e.target)) {
                closeAccountMenu();
            }
        });
    });
</script>
<?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/frontend/layouts/partials/mobile-menu.blade.php ENDPATH**/ ?>