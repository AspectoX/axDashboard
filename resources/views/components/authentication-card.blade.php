<div class="min-h-screen flex flex-col lg:flex-row justify-center items-center pt-6 sm:pt-4 ax-login dark:bg-[#293441]">
    <div class="ax-login-logo w-[90%] lg:w-[50%]">
        {{ $logo }}
    </div>

    <div class="w-full px-6 py-4 mt-6 overflow-hidden sm:max-w-md ax-login-form">
        {{ $slot }}
    </div>
</div>

