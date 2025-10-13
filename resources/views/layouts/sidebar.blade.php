<div class="fixed top-0 left-0 h-screen w-64 z-40">
    <aside class="h-full w-full" aria-label="Sidebar">
        <div class="flex flex-col h-full overflow-y-auto bg-white border-r border-gray-200 text-gray-700 py-4 px-3 shadow-sm">
            
            <div class="pb-4 mb-4 border-b border-gray-200">
                <a href="{{ route('dashboard') }}" class="flex items-center pl-2.5 mt-2">
                    <img src="{{ asset('images/TASKFLOW-LOGO.png') }}" class="h-10 mr-3" alt="TaskFlow Logo" />
                    <span class="self-center text-xl font-bold whitespace-nowrap text-gray-800">TaskFlow</span>
                </a>
            </div>

            <ul class="space-y-1 flex-grow">
                <li>
                    <a href="{{ route('dashboard') }}" 
                       class="flex items-center p-2 text-base font-medium rounded-lg transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-900 group {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-700' }}">
                        <svg class="w-6 h-6 transition duration-150 ease-in-out group-hover:text-gray-700 {{ request()->routeIs('dashboard') ? 'text-indigo-600' : 'text-gray-500' }}" 
                             fill="currentColor" viewBox="0 0 20 20"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('calendar.index') }}" 
                       class="flex items-center p-2 text-base font-medium rounded-lg transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-900 group {{ request()->routeIs('calendar.index') ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-700' }}">
                        <svg class="w-6 h-6 transition duration-150 ease-in-out group-hover:text-gray-700 {{ request()->routeIs('calendar.index') ? 'text-indigo-600' : 'text-gray-500' }}" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Kalender</span>
                    </a>
                </li>
            </ul>

            <div class="mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); this.closest('form').submit();"
                       class="flex items-center p-2 text-base font-medium text-gray-700 rounded-lg transition duration-150 ease-in-out hover:bg-red-50 hover:text-red-700 group">
                       <svg class="w-6 h-6 text-gray-500 transition duration-150 ease-in-out group-hover:text-red-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"></path></svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Logout</span>
                    </a>
                </form>
            </div>
        </div>
    </aside>
</div>