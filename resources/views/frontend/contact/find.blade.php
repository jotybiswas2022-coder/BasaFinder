@extends('frontend.layouts.app')

@section('title', 'My Messages')

@push('styles')
<style>
body { background: var(--navy); }

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}
.mf-animate { animation: fadeUp 0.5s ease-out both; }
.mf-d1 { animation-delay: 0.1s; }
.mf-d2 { animation-delay: 0.2s; }

.mf-wrap { max-width: 700px; margin: 0 auto; }

.mf-header {
    text-align: center;
    margin-bottom: 2rem;
    padding: 2rem 1.5rem 1.5rem;
}

.mf-header h1 {
    font-size: 1.75rem;
    font-weight: 800;
    color: #fff;
    margin-bottom: 0.375rem;
}

.mf-card {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    padding: 1rem 1.25rem;
    text-decoration: none;
    transition: all 0.4s cubic-bezier(0.16,1,0.3,1);
    background: linear-gradient(135deg, rgba(15,23,42,0.55), rgba(15,23,42,0.7));
    backdrop-filter: blur(40px) saturate(1.4);
    -webkit-backdrop-filter: blur(40px) saturate(1.4);
    border-radius: var(--r-lg);
    border: 1px solid rgba(96,165,250,0.06);
    box-shadow: 0 8px 32px rgba(0,0,0,0.3), inset 0 1px 0 rgba(255,255,255,0.06);
    position: relative;
    overflow: hidden;
}
.mf-card::before {
    content: '';
    position: absolute; inset: 0;
    border-radius: var(--r-lg);
    padding: 1px;
    background: linear-gradient(135deg, rgba(96,165,250,0.15), transparent 40%, transparent 60%, rgba(167,139,250,0.08));
    -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
    -webkit-mask-composite: xor;
    mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
    mask-composite: exclude;
    pointer-events: none;
}
.mf-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 16px 48px rgba(0,0,0,0.4), inset 0 1px 0 rgba(255,255,255,0.08);
    border-color: rgba(96,165,250,0.12);
}

.mf-card .mf-name {
    font-size: 0.9375rem;
    font-weight: 600;
    color: #fff;
    display: block;
}
.mf-card .mf-date {
    font-size: 0.75rem;
    color: rgba(255,255,255,0.35);
    display: block;
    margin-top: 0.25rem;
}
.mf-card .mf-badge {
    font-size: 0.6875rem;
    padding: 0.25rem 0.75rem;
    border-radius: 999px;
    font-weight: 700;
    flex-shrink: 0;
    letter-spacing: 0.02em;
}
.mf-card .mf-badge.replied {
    background: rgba(16,185,129,0.12);
    color: #34D399;
    border: 1px solid rgba(16,185,129,0.15);
}
.mf-card .mf-badge.pending {
    background: rgba(245,158,11,0.12);
    color: #FBBF24;
    border: 1px solid rgba(245,158,11,0.15);
}

.mf-empty {
    text-align: center;
    padding: 4rem 0;
}
.mf-empty p {
    font-size: 1rem;
    color: rgba(255,255,255,0.35);
}
</style>
@endpush

@section('content')
<div class="section" style="padding:2rem 0;">
    <div class="container">
        <div class="mf-wrap">
            <div class="mf-header mf-animate">
                <h1>My Messages</h1>
            </div>

            @if($messages->count())
                <div style="display:flex; flex-direction:column; gap:0.75rem;">
                    @foreach($messages as $i => $msg)
                        <a href="{{ route('contact.message', $msg->view_token) }}" class="mf-card mf-animate {{ $i % 2 === 0 ? 'mf-d1' : 'mf-d2' }}">
                            <div>
                                <span class="mf-name">{{ $msg->name }}</span>
                                <span class="mf-date">{{ $msg->created_at->format('d M Y, h:i A') }}</span>
                            </div>
                            <span class="mf-badge {{ $msg->admin_reply ? 'replied' : 'pending' }}">{{ $msg->admin_reply ? 'Replied' : 'Pending' }}</span>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="mf-empty mf-animate">
                    <p>No messages yet.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
