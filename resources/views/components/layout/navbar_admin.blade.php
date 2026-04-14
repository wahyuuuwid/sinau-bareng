<div class="bg-white rounded-2xl p-4 mb-8 flex justify-between items-center shadow-sm border border-gray-100">
    <div class="relative w-96">
        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </span>
        <input type="text" placeholder="Search" class="w-full bg-gray-50 border-none rounded-xl pl-12 pr-12 py-2 focus:ring-2 focus:ring-indigo-400 outline-none">
        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 text-xs border rounded px-1 px-1.5 font-mono">⌘ K</span>
    </div>

    <div class="flex items-center gap-6">
        <button class="text-gray-400 hover:text-indigo-600 relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
            </svg>
        </button>
        <div class="flex items-center gap-3">
            <div class="text-right leading-tight">
                <p class="font-bold text-gray-800">{{Auth()->user()->username}}</p>
                <p class="text-xs text-gray-400">{{Auth()->user()->role ?? 'Admin' }}</p>
            </div>
            <div class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden">
                <img src="https://ui-avatars.com/api/?name=User" alt="avatar">
            </div>
        </div>
    </div>
</div>