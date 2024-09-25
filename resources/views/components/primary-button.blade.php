<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-3 bg-[#2C3D8F] border border-transparent rounded-md font-semibold text-base text-white uppercase tracking-widest hover:bg-[#24395B] focus:bg-[#24395B] active:bg-[#1A2334] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
