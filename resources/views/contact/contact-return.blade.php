<x-app-layout>
    <div class="container pt-[140px]">
        @include('components.front-breadcrumb', ['title' => 'Contact'])

        <div class="pt-24">
            @if (session('error'))
                Error
            @endif

            @if (session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>

                <a href="{{ route('homepage') }}" class="flex justify-center pb-24">Return to Homepage</a>
                <img class="block w-full max-w-[400px] mx-auto" src="{{ asset('assets/img/checkout-success.jpg') }}" alt="">
            @endif
        </div>
    </div>
</x-app-layout>