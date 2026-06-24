@extends('frontend.layouts.app')

@section('title', 'My Messages')

@push('styles')
<style>
body { background: var(--navy); }

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}
@keyframes pulseDot {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.4; transform: scale(0.85); }
}
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-6px); }
}
.mf-animate { animation: fadeUp 0.5s ease-out both; }
.mf-d1 { animation-delay: 0.08s; }
.mf-d2 { animation-delay: 0.16s; }
.mf-d3 { animation-delay: 0.24s; }

.mf-wrap { max-width: 680px; margin: 0 auto; }

/* ── Header ── */
.mf-header {
    text-align: center;
    margin-bottom: 2.5rem;
    padding: 2.5rem 1.5rem 1.5rem;
    position: relative;
}
.mf-header-icon {
    width: 3.5rem; height: 3.5rem;
    margin: 0 auto 1rem;
    background: linear-gradient(135deg, rgba(96,165,250,0.1), rgba(167,139,250,0.06));
    border: 1px solid rgba(96,165,250,0.08);
    border-radius: 16px;
    display: flex; align-items: center; justify-content: center;
    color: var(--primary);
    animation: float 3s ease-in-out infinite;
}
.mf-header h1 { font-size: 1.75rem; font-weight: 800; color: #fff; margin-bottom: 0.375rem; }
.mf-header p { font-size: 0.875rem; color: rgba(255,255,255,0.3); }

/* ── Search Bar ── */
.mf-search-wrap {
    margin-bottom: 1.5rem;
    position: relative;
}
.mf-search-wrap input {
    width: 100%;
    padding: 0.75rem 1rem 0.75rem 2.75rem;
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 14px;
    font-size: 0.875rem;
    font-family: var(--font);
    outline: none;
    box-sizing: border-box;
    background: rgba(0,0,0,0.2);
    color: rgba(255,255,255,0.7);
    transition: all 0.3s;
}
.mf-search-wrap input:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(37,99,235,0.08);
}
.mf-search-wrap input::placeholder { color: rgba(255,255,255,0.2); }
.mf-search-wrap .mf-search-icon {
    position: absolute;
    left: 0.875rem; top: 50%;
    transform: translateY(-50%);
    color: rgba(255,255,255,0.15);
    pointer-events: none;
}

/* ── Stats Bar ── */
.mf-stats {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
    padding: 0 0.25rem;
}
.mf-stats span {
    font-size: 0.75rem;
    color: rgba(255,255,255,0.25);
}
.mf-stats .mf-stat-dot {
    width: 0.375rem; height: 0.375rem;
    border-radius: 50%;
    display: inline-block;
}
.mf-stats .mf-stat-dot.green { background: #34D399; }
.mf-stats .mf-stat-dot.amber { background: #FBBF24; }

/* ── Card ── */
.mf-card-list { display: flex; flex-direction: column; gap: 0.75rem; }

.mf-card {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.125rem 1.25rem;
    text-decoration: none;
    transition: all 0.4s cubic-bezier(0.16,1,0.3,1);
    background: linear-gradient(135deg, rgba(15,23,42,0.5), rgba(15,23,42,0.65));
    backdrop-filter: blur(40px) saturate(1.4);
    -webkit-backdrop-filter: blur(40px) saturate(1.4);
    border-radius: 16px;
    border: 1px solid rgba(96,165,250,0.06);
    box-shadow: 0 8px 32px rgba(0,0,0,0.3), inset 0 1px 0 rgba(255,255,255,0.06);
    position: relative;
    overflow: hidden;
}
.mf-card::before {
    content: '';
    position: absolute; inset: 0;
    border-radius: 16px;
    padding: 1px;
    background: linear-gradient(135deg, rgba(96,165,250,0.12), transparent 40%, transparent 60%, rgba(167,139,250,0.06));
    -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
    -webkit-mask-composite: xor;
    mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
    mask-composite: exclude;
    pointer-events: none;
}
.mf-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 20px 56px rgba(0,0,0,0.4), inset 0 1px 0 rgba(255,255,255,0.08);
    border-color: rgba(96,165,250,0.12);
}

/* ── Avatar ── */
.mf-card .mf-avatar {
    width: 2.75rem;
    height: 2.75rem;
    border-radius: 12px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1rem;
    color: #fff;
    transition: all 0.3s;
}
.mf-card:hover .mf-avatar { border-radius: 14px; }

/* ── Body ── */
.mf-card .mf-body { flex: 1; min-width: 0; }
.mf-card .mf-body .mf-top-row {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.25rem;
}
.mf-card .mf-body .mf-name {
    font-size: 0.9375rem;
    font-weight: 600;
    color: #fff;
}
.mf-card .mf-body .mf-pending-dot {
    width: 0.375rem; height: 0.375rem;
    border-radius: 50%;
    background: #FBBF24;
    animation: pulseDot 2s ease-in-out infinite;
    flex-shrink: 0;
}
.mf-card .mf-body .mf-email {
    font-size: 0.75rem;
    color: rgba(255,255,255,0.25);
    display: block;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 280px;
}
.mf-card .mf-body .mf-date {
    font-size: 0.6875rem;
    color: rgba(255,255,255,0.2);
    display: block;
    margin-top: 0.125rem;
}

/* ── Badge + Arrow ── */
.mf-card .mf-right { display: flex; align-items: center; gap: 0.625rem; flex-shrink: 0; }
.mf-card .mf-badge {
    font-size: 0.625rem;
    padding: 0.25rem 0.625rem;
    border-radius: 999px;
    font-weight: 700;
    letter-spacing: 0.03em;
    text-transform: uppercase;
}
.mf-card .mf-badge.replied {
    background: rgba(16,185,129,0.1);
    color: #34D399;
    border: 1px solid rgba(16,185,129,0.12);
}
.mf-card .mf-badge.pending {
    background: rgba(245,158,11,0.1);
    color: #FBBF24;
    border: 1px solid rgba(245,158,11,0.12);
}
.mf-card .mf-arrow {
    color: rgba(255,255,255,0.08);
    transition: all 0.3s;
    flex-shrink: 0;
}
.mf-card:hover .mf-arrow {
    color: var(--primary);
    transform: translateX(3px);
}

/* ── Empty ── */
.mf-empty {
    text-align: center;
    padding: 5rem 1rem;
}
.mf-empty-icon {
    width: 4rem; height: 4rem;
    margin: 0 auto 1rem;
    background: rgba(255,255,255,0.02);
    border: 1px solid rgba(255,255,255,0.04);
    border-radius: 20px;
    display: flex; align-items: center; justify-content: center;
    color: rgba(255,255,255,0.06);
}
.mf-empty p {
    font-size: 0.9375rem;
    color: rgba(255,255,255,0.25);
}
</style>
@endpush

@section('content')
<div class="section" style="padding:2rem 0;">
    <div class="container">
        <div class="mf-wrap">
            <div class="mf-header mf-animate">
                <div class="mf-header-icon">
                    <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                </div>
                <h1>My Messages</h1>
                <p>View and track your submitted inquiries</p>
            </div>

            @if($messages->count())
                <div class="mf-search-wrap mf-animate mf-d1">
                    <input type="text" id="mfSearch" placeholder="Search by name or email..." oninput="filterMessages(this.value)">
                    <svg class="mf-search-icon" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                </div>

                @php
                    $repliedCount = $messages->where('admin_reply', true)->count();
                    $pendingCount = $messages->where('admin_reply', false)->count();
                @endphp
                <div class="mf-stats mf-animate mf-d1">
                    <span><span class="mf-stat-dot green"></span> {{ $repliedCount }} Replied</span>
                    <span><span class="mf-stat-dot amber"></span> {{ $pendingCount }} Pending</span>
                </div>

                <div class="mf-card-list" id="mfCardList">
                    @foreach($messages as $i => $msg)
                        @php
                            $colors = ['#3B82F6','#8B5CF6','#EC4899','#F59E0B','#10B981','#06B6D4'];
                            $color = $colors[crc32($msg->email ?? $msg->name) % count($colors)];
                            $initials = implode('', array_map(function($s) { return strtoupper(substr($s, 0, 1)); }, array_filter(explode(' ', $msg->name))));
                            if (strlen($initials) > 2) $initials = substr($initials, 0, 2);
                            if (!$initials) $initials = '?';
                        @endphp
                        <a href="{{ route('contact.message', $msg->view_token) }}" class="mf-card mf-animate" style="animation-delay: {{ 0.06 + $i * 0.04 }}s;" data-search="{{ strtolower($msg->name . ' ' . $msg->email) }}">
                            <div class="mf-avatar" style="background:{{ $color }}1a; color:{{ $color }}; border:1px solid {{ $color }}22;">{{ $initials }}</div>
                            <div class="mf-body">
                                <div class="mf-top-row">
                                    <span class="mf-name">{{ $msg->name }}</span>
                                    @if(!$msg->admin_reply)
                                        <span class="mf-pending-dot"></span>
                                    @endif
                                </div>
                                @if($msg->email)
                                    <span class="mf-email">{{ $msg->email }}</span>
                                @endif
                                <span class="mf-date">{{ $msg->created_at->format('d M Y, h:i A') }}</span>
                            </div>
                            <div class="mf-right">
                                <span class="mf-badge {{ $msg->admin_reply ? 'replied' : 'pending' }}">{{ $msg->admin_reply ? 'Replied' : 'Pending' }}</span>
                                <svg class="mf-arrow" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M9 18l6-6-6-6"/></svg>
                            </div>
                        </a>
                    @endforeach
                </div>

                <script>
                function filterMessages(q) {
                    q = q.toLowerCase().trim();
                    document.querySelectorAll('#mfCardList .mf-card').forEach(function(card) {
                        card.style.display = (!q || card.getAttribute('data-search').includes(q)) ? '' : 'none';
                    });
                }
                </script>
            @else
                <div class="mf-empty mf-animate">
                    <div class="mf-empty-icon">
                        <svg width="36" height="36" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                    <p>No messages yet. Submit an inquiry to get started.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
