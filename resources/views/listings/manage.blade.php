<x-layout>
    <div class="mx-4">
        <x-card class="!p-10">
            <header>
                <h1
                    class="text-3xl text-center font-bold my-6 uppercase"
                >
                    Manage Gigs
                </h1>
            </header>
            <table class="w-full table-auto rounded-sm">
                <tbody>
                @unless($listings->isEmpty())
                    @foreach($listings as $listing)
                        <tr class="border-gray-300">
                            <td
                                class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                            >
                                <a href="{{route('listings.show', $listing->id)}}">
                                    {{$listing->title}}
                                </a>
                            </td>
                            <td
                                class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                            >
                                <a href="{{route('listings.edit', $listing->id)}}">
                                    <i class="fa-solid fa-pencil"></i> Edit
                                </a>
                            </td>
                            <td
                                class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                            >
                                <form method="POST" action="/listings/{{$listing->id}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="border-gray-300">
                        <td class="px-4 py-8 border-t border-b border-gray-300">
                            <p class="text-center">
                                Empty Listings
                            </p>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </x-card>
    </div>
</x-layout>
