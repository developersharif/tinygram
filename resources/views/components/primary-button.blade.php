<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex btn btn-outline items-center px-4 py-2  rounded-md font-semibold text-xs  uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
