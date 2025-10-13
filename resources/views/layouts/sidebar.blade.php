<aside class="w-64 sticky top-0" aria-label="Sidebar">
    <div class="overflow-y-auto py-4 px-3 h-screen bg-white border-r border-gray-200">
        
        <a href="{{ route('dashboard') }}" class="flex items-center pl-2.5 mb-5">
            <img src="{{ asset('images/TASKFLOW-LOGO.png') }}" class="h-10 mr-3" alt="TaskFlow Logo" />
            <span class="self-center text-xl font-semibold whitespace-nowrap">TaskFlow</span>
        </a>

        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg hover:bg-gray-100 {{ request()->routeIs('dashboard') ? 'bg-gray-100' : '' }}">
                    <svg class="w-6 h-6 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('profile.edit') }}" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg hover:bg-gray-100 {{ request()->routeIs('profile.edit') ? 'bg-gray-100' : '' }}">
                    <svg class="w-6 h-6 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Profil</span>
                </a>
            </li>
        </ul>

        <div class="absolute bottom-0 left-0 w-full p-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); this.closest('form').submit();"
                   class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg hover:bg-gray-100">
                   <svg class="w-6 h-6 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"></path></svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Logout</span>
                </a>
            </form>
        </div>
    </div>
</aside>