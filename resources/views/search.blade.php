<?php
$items = ['Indonesia', 'Malaysia', 'Singapore', 'Thailand'];
$people = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20']
?>
<div class="pt-[1000px] pb-100 border-1 ">
    <div class="container">
        <div class="columns-2 w-full">

            <form class="flex bg-white rounded-[38px] flex-wrap gap-24 p-24 shadow-[0px_0px_20px_0px_rgba(0,0,0,0.15)]"
                action="">
                <div class="flex items-center gap-12 flex-direction: row justify-content: space-between">
                    <div class="date flex items-center gap-24 w-full">
                        <x-text-input class="w-full" type="date" name="startAt" for="startAt" value="{{ old('startAt') }}" />
                        <x-text-input class="w-full" type="date" name="endAt" for="startAt" value="{{ old('endAt') }}" />
                    </div>
                    <div class="country flex items-center gap-24 w-full">
                        <x-select-input class="w-full" name="country" for="country" id="country" :options="$items"
                            placeholder="Select country" value="{{ old('country') }}" />
                        <x-primary-button class="w-[50px]">
                            @include('components.icons.icon-search')
                        </x-primary-button>
                    </div>
                    <div class="people flex items-center gap-24 w-full">
                        <x-select-input class="w-full" name="people" for="people" id="people" :options="$people"
                            placeholder="Select people" value="{{ old('people') }}" />
                    </div>

                </div>

            </form>

            <div class="other-people-search mt-[30px]">
            </div>
        </div>
    </div>
</div>
