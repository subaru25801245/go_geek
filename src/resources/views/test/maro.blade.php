<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @foreach ($tests as $test)
            <p>{{ $test->name }}</p>
        @endforeach
    </div>
</x-app-layout>
