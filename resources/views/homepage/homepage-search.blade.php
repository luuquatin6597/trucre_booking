<?php
use App\Models\Buildings;
$countries = Buildings::distinct('country')->pluck('country');
$hashtags = ['#meetting_room', '#conference_room', '#ha_noi', '#da_nang', '#ho_chi_minh'];
?>

<div class="pt-[250px] pb-100">
    <div class="container">
        <div class="columns-2 w-full">
            <div class="left relative">
                <h1 class="font-petrona font-bold text-heading-1 text-primary-400 leading-none mb-[30px]">Get
                    everything<br />you need
                    in here!</h1>

                <form
                    class="flex bg-white rounded-[38px] flex-wrap gap-24 p-24 shadow-[0px_0px_20px_0px_rgba(0,0,0,0.15)]"
                    action="{{ route('categories.index') }}" method="GET">
                    @csrf
                    <x-text-input type="search" name="search" for="search" placeholder="Type place you want"
                        class="w-full" />
                    <div class="date flex items-center gap-24 w-full">
                        <x-text-input class="w-full" type="date" name="startAt" for="startAt" />
                        <x-text-input class="w-full" type="date" name="endAt" for="endAt" />
                    </div>
                    <div class="country flex items-center gap-24 w-full">
                        <x-select-input class="w-full" name="country" for="country" id="country" :options="$countries"
                            placeholder="Choose Country" />
                        <x-primary-button class="w-[50px]" type="submit">
                            @include('components.icons.icon-search')
                        </x-primary-button>
                    </div>
                </form>

                <div class="other-people-search mt-[30px]">
                    <h2 class="font-bold text-heading-4 text-secondary-300 leading-normal mb-[10px]">Other people
                        are searching:</h2>
                    <div class="flex items-center gap-[10px]">
                        @foreach ($hashtags as $hashtag)
                            <x-hashtag>{{ $hashtag }}</x-hashtag>
                        @endforeach
                    </div>
                </div>

                <img class="absolute top-[-154px] right-[-172px] z-[-1]"
                    src="{{ asset('assets/img/home-search-2.png') }}" alt="">
            </div>

            <div class="right flex items-center justify-end">
                <img src="{{ asset('assets/img/home-search-1.png') }}" alt="">
            </div>
        </div>
    </div>
</div>