@props(['label', 'name', 'type' => 'text', 'placeholder' => ''])

<div class="w-full">
    <label class="text-[13px] font-semibold text-gray-700 block mb-1.5 ml-1">
        {{ $label }}
    </label>

    <input type="{{ $type }}" 
        name="{{ $name }}" 
        id="{{ $name }}"
        placeholder="{{ $placeholder }}"
        class="w-full px-5 py-3 !bg-[#ececec] border border-gray-200 rounded-2xl outline-none focus:ring-2 focus:ring-indigo-400 focus:bg-white placeholder:text-gray-400 placeholder:text-sm transition-all"
        value="{{ old($name) }}">
</div>