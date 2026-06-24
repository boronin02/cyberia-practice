@php
    /**
     * @var App\Models\Feedback $feedback
     */

    $filePath = public_path('images/logo.svg');
    $svgData = file_get_contents($filePath);
    $base64EncodedSvg = 'data:image/svg+xml;base64,' . base64_encode($svgData);
@endphp

<style>
    .card {
        margin: 0 auto;
        background-color: #ffffff;
        border: 1px solid #d3d3d3;
        border-radius: 25px;
        padding: 20px;
        width: 80%;
        max-width: 600px;
    }

    .logo {
        text-align: center;
        margin-bottom: 20px;
    }

    .data {
        padding: 25px 0;
        border-top: 1px solid #d3d3d3;
    }

    .description {
        width: 100%;
        padding-bottom: 40px;
    }
</style>

<div>
    <div class="card">
        <div class="logo">
            <img src="{{ $base64EncodedSvg }}" alt="Логотип">
            <h3>Новая заявка</h3>
        </div>
        <div class="data">
            <div>
                <p><strong>{{ __('filament/feedback.fields.name') }}: </strong> {{ $feedback->name }}</p>
                <p><strong>{{ __('filament/feedback.fields.phone') }}: </strong> {{ $feedback->phone }}</p>
                <p><strong>{{ __('filament/feedback.fields.created_at') }}: </strong> {{ $feedback->created_at->format('H:i:s, d.m.Y') }}</p>
            </div>
        </div>
        <div class="description">
            <p><strong>{{ __('filament/feedback.fields.comment') }}:</strong></p>
            <p>{{ $feedback->comment }}</p>
        </div>
    </div>
</div>
