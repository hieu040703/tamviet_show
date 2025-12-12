<div class="fixed top-0 z-10 h-11 w-full bg-white md:hidden">
    <div class="flex px-4 py-1">
        <div class="flex items-center justify-center">
            <button data-size="sm" type="button"
                    data-back-button="true"
                    class="relative flex justify-center outline-none font-semibold focus:ring-primary-300 text-sm bg-transparent data-[size=sm]:text-sm border-0 hover:bg-0 hover:text-primary-500 focus:text-primary-500 h-6 p-0 text-neutral-900">
                                        <span
                                            class="p-icon-1 inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6">
                                            <svg viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6.29231 12.7138L15.2863 21.7048C15.6809 22.0984 16.3203 22.0984 16.7159 21.7048C17.1106 21.3111 17.1106 20.6717 16.7159 20.2781L8.43539 12.0005L16.7149 3.72293C17.1096 3.32928 17.1096 2.68989 16.7149 2.29524C16.3203 1.90159 15.6799 1.90159 15.2853 2.29524L6.29131 11.2861C5.90273 11.6757 5.90273 12.3251 6.29231 12.7138Z"
                                                    fill="currentColor"></path>
                                            </svg>
                                        </span>
            </button>
        </div>
        <div class="flex flex-1 justify-end">
            <button id="open-mobile-search" data-size="sm" type="button"
                    class="relative flex justify-center outline-none font-semibold focus:ring-primary-300 text-sm bg-transparent data-[size=sm]:text-sm border-0 hover:bg-0 hover:text-primary-500 focus:text-primary-500 text-neutral-900 -mr-2 h-9 items-center p-2">
                    <span class="p-icon-1 inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6">
                         <span
                             class="p-icon-1 inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6">
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
                    </span>
            </button>
            @include('frontend.components.cart-icon-mobile')
            <button data-size="sm" type="button" data-go-home
                    class="relative flex justify-center outline-none font-semibold focus:ring-primary-300 text-sm bg-transparent data-[size=sm]:text-sm border-0 hover:bg-0 hover:text-primary-500 focus:text-primary-500 text-neutral-900 -mr-2 h-9 items-center p-2">
                    <span class="p-icon-1 inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M12 2L22 10.8894L21.2004 12L12 3.82146L2.79963 12L2 10.8894L12 2Z"
                                  fill="currentColor"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M9 14H15V21H13.5V15.3333H10.5V21H9V14Z"
                                  fill="currentColor"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M5.33333 12V19.5C5.33333 20.1904 5.93019 20.75 6.66667 20.75H17.3333C18.0698 20.75 18.6667 20.1904 18.6667 19.5V12H20V19.5C20 20.8808 18.8062 22 17.3333 22H6.66667C5.19381 22 4 20.8808 4 19.5V12H5.33333Z"
                                  fill="currentColor"></path>
                        </svg>
                    </span>
            </button>

        </div>
    </div>
</div>
