@extends('admin.layout.master')

@section('body')
<body class="bg-light">
    <div class="container mt-5">
        <div class="card p-4 shadow-sm">
            <h4 class="mb-3">
                <img src="https://cdn-icons-png.flaticon.com/512/1250/1250680.png" alt="icon" width="24" class="me-2">
                <strong>Preview of Form Group ({{ $formGroup->name }})</strong>
            </h4>

            {{-- Passing dynamic values of label & details --}}
            @foreach($formGroup->elements as $element)
                <div class="mb-3">
                    <label class="form-label">{{ $element->label }}</label>
                    <textarea class="form-control" rows="2">{{ $element->details['text'] ?? '' }}</textarea>
                </div>
            @endforeach
        </div>
    </div>
</body>
@endsection
