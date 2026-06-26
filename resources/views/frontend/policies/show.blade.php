@extends('frontend.layouts.app')

@section('title', $policy->title . ' — BasaFinder')

@push('styles')
<style>
.policy-section {
    padding: 4rem 0;
    min-height: 60vh;
    background: linear-gradient(135deg, #070b17 0%, #0d1225 40%, #0a1628 70%, #0f1a30 100%);
    position: relative;
}
.policy-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 0 1rem;
    position: relative;
    z-index: 1;
}
.policy-header {
    text-align: center;
    margin-bottom: 2.5rem;
}
.policy-header h1 {
    font-size: 2rem;
    font-weight: 800;
    color: #fff;
    letter-spacing: -0.03em;
}
.policy-header p {
    color: rgba(255,255,255,0.4);
    font-size: 0.875rem;
    margin-top: 0.375rem;
}
.policy-divider {
    width: 3rem;
    height: 3px;
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    border-radius: 2px;
    margin: 1rem auto 0;
}
.policy-content {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 1rem;
    padding: 2.5rem;
    box-shadow: 0 8px 32px rgba(0,0,0,0.3), inset 0 1px 0 rgba(255,255,255,0.05);
    backdrop-filter: blur(12px);
    line-height: 1.8;
    color: rgba(255,255,255,0.75);
    font-size: 0.9375rem;
}
.policy-content h2 {
    font-size: 1.25rem;
    font-weight: 700;
    color: #fff;
    margin-top: 2rem;
    margin-bottom: 0.75rem;
}
.policy-content h2:first-child {
    margin-top: 0;
}
.policy-content p {
    margin-bottom: 1rem;
}
.policy-content ul {
    margin-bottom: 1rem;
    padding-left: 1.5rem;
}
.policy-content ul li {
    margin-bottom: 0.375rem;
    list-style-type: disc;
    color: rgba(255,255,255,0.75);
}
.policy-content strong {
    font-weight: 600;
    color: #fff;
}
@media (max-width: 640px) {
    .policy-section { padding: 2rem 0; }
    .policy-header h1 { font-size: 1.5rem; }
    .policy-content { padding: 1.5rem; border-radius: 0.75rem; font-size: 0.875rem; }
    .policy-content h2 { font-size: 1.125rem; }
}
</style>
@endpush

@section('content')
<section class="policy-section">
    <div class="policy-container">
        <div class="policy-header">
            <h1>{{ $policy->title }}</h1>
            <p>Last updated: {{ $policy->updated_at->format('F d, Y') }}</p>
            <div class="policy-divider"></div>
        </div>
        <div class="policy-content">
            {!! $policy->content !!}
        </div>
    </div>
</section>
@endsection
