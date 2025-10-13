@props(['name', 'show' => false, 'maxWidth' => '2xl', 'closeable' => true])

<div
    x-data="{
        show: {{ $show ? 'true' : 'false' }},
        focusables() { /* ... kode focusables tetap sama ... */ },
        firstFocusable() { /* ... kode firstFocusable tetap sama ... */ },
        lastFocusable() { /* ... kode lastFocusable tetap sama ... */ },
        nextFocusable() { /* ... kode nextFocusable tetap sama ... */ },
        prevFocusable() { /* ... kode prevFocusable tetap sama ... */ },
        nextFocusableIndex() { /* ... kode nextFocusableIndex tetap sama ... */ },
        prevFocusableIndex() { /* ... kode prevFocusableIndex tetap sama ... */ },
    }"
    x-init="$watch('show', value => {
        if (value) {
            document.body.classList.add('overflow-y-hidden');
            {{ $attributes->has('focusable') ? 'setTimeout(() => firstFocusable().focus(), 100)' : '' }}
        } else {
            document.body.classList.remove('overflow-y-hidden');
        }
    })"
    x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = true : null"
    x-on:close-modal.window="$event.detail == '{{ $name }}' ? show = false : null"
    x-on:keydown.escape.window="if (show && {{ $closeable ? 'true' : 'false' }}) { show = false; }"
    x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
    x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
    x-show="show"
    class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50"
    style="display: none;"
>
    {{-- Backdrop --}}
    <div
        x-show="show"
        class="fixed inset-0 transform transition-all"
        x-on:click="show = false"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div class="absolute inset-0 bg-gray-500/75 backdrop-blur-sm"></div>
    </div>

    {{-- Modal Content --}}
    <div
        x-show="show"
        class="mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto {{ $maxWidth == '2xl' ? 'sm:max-w-2xl' : '' }}"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    >
        {{ $slot }}
    </div>
</div>