@props(['label', 'name', 'type' => 'text', 'placeholder' => '', 'value' => ''])

<div class="w-full">
    <label class="text-[13px] font-semibold text-gray-700 block mb-2 ml-1">
        {{ $label }}
    </label>

    <input type="{{ $type }}" 
        name="{{ $name }}" 
        id="{{ $name }}"
        placeholder="{{ $placeholder }}"
        {{-- UI disamakan: py-4, rounded-xl, tanpa border, bg abu-abu --}}
        class="w-full px-5 py-4 bg-[#ececec] border-none rounded-xl focus:ring-2 focus:ring-indigo-400 outline-none transition-all font-semibold text-gray-600 placeholder:text-gray-400 placeholder:font-normal"
        value="{{ old($name, $value) }}">
</div>