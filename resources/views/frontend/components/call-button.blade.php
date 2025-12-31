<a href="tel:{{$system['contact_hotline'] ?: '092.686.5566'}}"
   class="hidden md:flex p-icon-1 items-center gap-2 rounded-full bg-blue-600 px-3 py-1.5 text-white
          md:bg-transparent md:px-2 md:text-white">
    <svg class="h-8 w-8 shrink-0"
         viewBox="0 0 24 24" fill="none"
         xmlns="http://www.w3.org/2000/svg">
        <circle cx="12" cy="12" r="12" fill="currentColor"/>
        <path d="M15.59 13.34L13.16 12.63
                 C12.86 12.54 12.53 12.62 12.31 12.84L11.39 13.76
                 C9.95 13.04 8.96 12.05 8.24 10.61L9.16 9.69
                 C9.38 9.47 9.46 9.14 9.37 8.84L8.66 6.41
                 C8.53 5.97 8.07 5.7 7.62 5.8L5.38 6.3
                 C4.97 6.39 4.67 6.76 4.67 7.18
                 C4.67 14.28 9.72 19.33 16.82 19.33
                 C17.24 19.33 17.61 19.03 17.7 18.62L18.2 16.38
                 C18.3 15.93 18.03 15.47 17.59 15.34Z"
              fill="#ffffff"/>
    </svg>
    <span class="text-sm font-semibold whitespace-nowrap">
       {{$system['contact_hotline'] ?: '092.686.5566'}}
    </span>
</a>
