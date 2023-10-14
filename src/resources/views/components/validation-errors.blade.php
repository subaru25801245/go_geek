@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-red-600">
            Please confirm the error.
        </div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

            {{-- ここから追加 --}}
            @if(empty($errors->first('image')))
                <li>Select the image file again.</li>
            @endif
        </ul>
    </div>
@endif
