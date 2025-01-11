<x-app-layout>
    <div class="container pt-[140px]">
        @include('components.front-breadcrumb', ['title' => 'Complete Checkout'])

        <div class="pt-24">
            @if (session('error'))
                Error
            @else
                <h2 class="flex justify-center text-heading-3 font-bold pb-24">Complete Checkout</h2>
                <a href="{{ route('homepage') }}" class="flex justify-center pb-24">Return to Homepage</a>
                <img class="block w-full max-w-[400px] mx-auto" src="{{ asset('assets/img/checkout-success.jpg') }}" alt="">
            @endif
        </div>
    </div>
</x-app-layout>