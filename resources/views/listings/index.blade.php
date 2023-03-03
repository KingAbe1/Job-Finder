<x-layout>
    @include('partials._hero')
    @include('partials._search')
    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        @if (count($job_list) == 0)
            <h5>No Job Listing</h5>
        @else
            @foreach ($job_list as $collection)
                <x-listing-card :listing="$collection" />
            @endforeach
        @endif

    </div>
    <div class="mt-6 p-4">
        {{ $job_list->links() }}
    </div>
</x-layout>
