<div class="p-2.5 pb-0 mb-2 before:absolute before:top-16 before:bottom-0 before:left-0 before:right-0 before:bg-no-repeat before:bg-[url('images/2816.png')]">
    <div class="nav-profile-left">
        <a href="{{ route('profile.show') }}" class="profile-photo">
            <img src="{{ asset(Auth::user()->profile_photo_url) }}" alt="{{ Auth::user()->name }}">
        </a>
    </div>
    <div class="nav-profile-right">
        <p class="leading-4">
            <span class="text-sm font-bold">{{ Auth::user()->name }}</span>
            <span class="text-xs">{{ Auth::user()->email }}</span>
        </p>
    </div>
    <div class="w-full px-10 my-4">
        <ul class="flex items-center justify-between w-full">
            <li class="inline-block mr-2">
                <a href="{{ route('profile.show') }}" class="relative flex items-center w-[32px] h-[32px] px-1 py-[6px] text-white text-opacity-50 rounded-full cursor-pointer hover:bg-black/20">
                    <x-filament::icon
                        icon="icon-user"
                        class="w-5 h-5 pl-[3px]"
                    />
                </a>
            </li>
            <li class="inline-block mr-2">
                <a href="" class="relative flex items-center w-[32px] h-[32px] px-1 py-[6px] text-white text-opacity-50 rounded-full cursor-pointer hover:bg-black/20">
                    <x-filament::icon
                        icon="icon-bell"
                        class="w-5 h-5 pl-[3px]"
                    />
                </a>
            </li>
            <li class="inline-block mr-2">
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <a href="{{ route('logout') }}" class="relative flex items-center w-[32px] h-[32px] px-1 py-[6px] text-white text-opacity-50 rounded-full cursor-pointer hover:bg-black/20"
                        @click.prevent="$root.submit()"
                        >
                        <x-filament::icon
                            icon="icon-power-off"
                            class="w-5 h-5 text-red-800 pl-[3px] hover:text-slate-400"
                            style="text-shadow: 0px 0px 6px #CB4854;"
                        />
                    </a>
                </form>
            </li>
        </ul>
    </div>
</div>
