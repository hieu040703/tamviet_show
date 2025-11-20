@php
    $icon = $catalogue->icon
        ? asset('storage/' . $catalogue->icon)
        : asset('backend/img/not-found.jpg');
@endphp
<div class="bg-white">
    <div class="md:container">
        <div class="mb-2 border-b-0 px-4 pb-4  md:px-0 md:pb-6">
            <div class="flex flex-col justify-between md:flex-row md:items-center">
                <div class="flex items-center justify-center pt-4 md:justify-start md:pt-6">
                    <div class="mr-2 h-[72px] w-[72px]">
                        <img
                                class=""
                                src="{{ $icon }}"
                                alt="{{ $catalogue->name }}"
                                loading="lazy"
                                width="500"
                                height="500"
                        >
                    </div>
                    <div
                            class="fixed left-0 top-0 z-10 h-11 w-full bg-white block md:static md:z-auto md:block md:h-auto md:w-auto">
                        <div
                                class="z-50 grid w-full content-start gap-4 bg-white px-4 py-2.5 md:py-0 md:px-0 md:z-auto">
                            <div class="flex">
                                <div class="flex w-6 items-center md:hidden">
                                    <button data-size="sm" type="button"
                                            class="relative flex justify-center outline-none font-semibold focus:ring-primary-300 text-sm bg-transparent data-[size=sm]:text-sm border-0 hover:bg-0 hover:text-primary-500 focus:text-primary-500 h-6 p-0 text-neutral-900">
                                        <span
                                                class="p-icon inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6">
                                            <svg viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                        d="M6.29231 12.7138L15.2863 21.7048C15.6809 22.0984 16.3203 22.0984 16.7159 21.7048C17.1106 21.3111 17.1106 20.6717 16.7159 20.2781L8.43539 12.0005L16.7149 3.72293C17.1096 3.32928 17.1096 2.68989 16.7149 2.29524C16.3203 1.90159 15.6799 1.90159 15.2853 2.29524L6.29131 11.2861C5.90273 11.6757 5.90273 12.3251 6.29231 12.7138Z"
                                                        fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    </button>
                                </div>

                                <div class="grid flex-1 items-center text-center md:text-start">
                                    <h1 class="text-[24px] font-semibold leading-[32px] max-md:text-base md:block md:px-0">
                                        <div class="[&amp;_a:not(.ignore-css_a)]:text-hyperLink">
                                            {{ $catalogue->name }}
                                        </div>
                                    </h1>
                                </div>

                                <div class="w-auto relative block md:hidden">
                                    <div class="flex">
                                        <a
                                                class="relative flex justify-center outline-none font-semibold focus:ring-primary-300 text-sm h-9 bg-transparent data-[size=sm]:text-sm text-inherit border-0 hover:bg-0 hover:text-primary-500 focus:text-primary-500 items-center p-0"
                                                href="/tim-bai-viet?init=true">
                                            <span
                                                    class="p-icon inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6">
                                                <svg viewBox="0 0 24 24" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                          d="M15.5 15.4366C15.7936 15.143 16.2697 15.143 16.5634 15.4366L21.7798 20.7163C22.0734 21.01 22.0734 21.4861 21.7798 21.7797C21.4861 22.0734 21.01 22.0734 20.7164 21.7797L15.5 16.5C15.2064 16.2064 15.2064 15.7303 15.5 15.4366Z"
                                                          fill="currentColor"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                          d="M10.5 3.57732C6.67671 3.57732 3.57732 6.67671 3.57732 10.5C3.57732 14.3233 6.67671 17.4227 10.5 17.4227C14.3233 17.4227 17.4227 14.3233 17.4227 10.5C17.4227 6.67671 14.3233 3.57732 10.5 3.57732ZM2 10.5C2 5.80558 5.80558 2 10.5 2C15.1944 2 19 5.80558 19 10.5C19 15.1944 15.1944 19 10.5 19C5.80558 19 2 15.1944 2 10.5Z"
                                                          fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block md:pt-6">
                    <form method="get" action="">
                        <div
                                class="grid w-full grid-cols-[20px,1fr] items-center justify-start gap-2 rounded-sm border border-neutral-200 px-2 text-neutral-600 md:w-[389px]">
                            <button data-size="sm" type="submit"
                                    class="relative flex justify-center outline-none font-semibold focus:ring-primary-300 text-sm bg-transparent data-[size=sm]:text-sm border-0 hover:bg-0 hover:text-primary-500 focus:text-primary-500 h-5 items-center p-0 text-neutral-900">
                                <span
                                        class="p-icon inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-5 h-5">
                                    <svg viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M15.5 15.4366C15.7936 15.143 16.2697 15.143 16.5634 15.4366L21.7798 20.7163C22.0734 21.01 22.0734 21.4861 21.7798 21.7797C21.4861 22.0734 21.01 22.0734 20.7164 21.7797L15.5 16.5C15.2064 16.2064 15.2064 15.7303 15.5 15.4366Z"
                                              fill="currentColor"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M10.5 3.57732C6.67671 3.57732 3.57732 6.67671 3.57732 10.5C3.57732 14.3233 6.67671 17.4227 10.5 17.4227C14.3233 17.4227 17.4227 14.3233 17.4227 10.5C17.4227 6.67671 14.3233 3.57732 10.5 3.57732ZM2 10.5C2 5.80558 5.80558 2 10.5 2C15.1944 2 19 5.80558 19 10.5C19 15.1944 15.1944 19 10.5 19C5.80558 19 2 15.1944 2 10.5Z"
                                              fill="currentColor"></path>
                                    </svg>
                                </span>
                            </button>
                            <div class="relative flex">
                                <input
                                        enterkeyhint="search"
                                        type="search"
                                        name="keyword"
                                        value="{{ request('keyword') }}"
                                        class="w-full border-neutral-500 text-neutral-900 rounded-lg placeholder:text-neutral-600 focus:ring-neutral-500 focus:border-neutral-700 outline-none p-3.5 post-search-input h-[38px] truncate border-0 px-3 !pr-6 text-sm font-medium focus-visible:placeholder:opacity-0 md:ps-0"
                                        placeholder="Tìm kiếm thông tin về bệnh..."
                                        inputmode="text"
                                >
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @if(!empty($catalogue->description))
                <div class="[&amp;_a:not(.ignore-css_a)]:text-hyperLink mt-4 text-sm">
                    {!! $catalogue->description !!}
                </div>
            @endif
        </div>
    </div>
</div>
