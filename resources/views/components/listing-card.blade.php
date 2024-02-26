@props(['listing'])
<x-card>
    <div class="flex">
        <img
            class="hidden w-48 mr-6 md:block"
            src="{{$listing->logo ? asset("storage/{$listing->logo}") : asset('images/no-image.png')}}"
            alt=""
        />
        <div>
            <h3 class="text-2xl">
                <a href="{{route('listings.show', $listing->id)}}">{{$listing->title}}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{$listing->company}}</div>
{{--            tags--}}
            <x-listing-tag :tagsCsv="$listing->tags"/>
            <div class="text-lg mt-4 flex items-center">
                <i class="fa-solid fa-location-dot mr-2"></i> {{$listing->location}}
                <a href="?votes={{$listing->votes}}" class="ml-2 bg-red-500 text-white py-1 px-3 rounded-xl">💗 {{$listing->votes ?? 0}}</a>
            </div>
        </div>
    </div>
</x-card>
