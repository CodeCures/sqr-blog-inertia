<button {{ $attributes->merge(['class' => 'block bg-secondary px-10 py-4 text-center font-body text-xl font-semibold text-white transition-colors hover:bg-green sm:inline-block sm:text-left sm:text-2xl']) }}>
    {{ $slot }}
</button>
