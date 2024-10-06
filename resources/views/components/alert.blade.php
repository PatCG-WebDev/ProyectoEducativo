@if (session($type))
    <div class="border px-4 py-2 rounded-md mb-4 shadow-md"
         style="background-color: {{ $bgColor }}; color: #FFFFFF;">
        <span class="block sm:inline">{{ session($type) }}</span>
    </div>
@endif