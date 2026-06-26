@extends('admin.layouts.app')

@push('styles')
<style>
@keyframes dfFade { from { opacity:0; transform:translateY(14px); } to { opacity:1; transform:translateY(0); } }
.df-anim { animation: dfFade 0.45s ease-out both; }

/* ── Hero ── */
.df-hero {
    position: relative;
    margin: -2rem -2rem 1.5rem;
    padding: 2.25rem 2.5rem;
    background: linear-gradient(135deg, #0b1120 0%, #1a1a2e 40%, #16213e 70%, #0f3460 100%);
    overflow: hidden;
    isolation: isolate;
}
.df-hero::before {
    content: ''; position: absolute; top:-40%; right:-5%;
    width:30rem; height:30rem;
    background: radial-gradient(circle,rgba(99,102,241,0.12) 0%,transparent 70%);
    border-radius:50%; pointer-events:none;
}
.df-hero::after {
    content: ''; position: absolute; bottom:-25%; left:5%;
    width:18rem; height:18rem;
    background: radial-gradient(circle,rgba(16,185,129,0.08) 0%,transparent 70%);
    border-radius:50%; pointer-events:none;
}
.df-hero .hr-inner {
    position:relative; z-index:1;
    display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:1rem;
}
.df-hero .hr-left h1 {
    font-size:1.375rem; font-weight:800; color:#fff; letter-spacing:-0.03em;
    display:flex; align-items:center; gap:0.5rem;
}
.df-hero .hr-left h1 .greet { font-weight:400; color:rgba(255,255,255,0.5); font-size:1.125rem; }
.df-hero .hr-left p { color:rgba(255,255,255,0.4); font-size:0.8125rem; margin-top:0.125rem; }
.df-hero .date-badge {
    display:inline-flex; align-items:center; gap:0.375rem;
    padding:0.375rem 0.875rem;
    background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.1);
    border-radius:9999px; font-size:0.75rem; color:rgba(255,255,255,0.6);
}

/* ── Stats Grid ── */
.df-stats {
    display:grid;
    grid-template-columns:repeat(4, 1fr);
    gap:1rem;
    margin-bottom:1.5rem;
}
.df-card {
    background:#fff; border:1px solid #e5e7eb; border-radius:0.75rem;
    padding:1.25rem; position:relative; overflow:hidden;
    transition:all 0.25s;
}
.df-card:hover { transform:translateY(-2px); box-shadow:0 8px 24px rgba(0,0,0,0.07); }
.df-card .df-top { display:flex; align-items:center; justify-content:space-between; margin-bottom:0.625rem; }
.df-card .df-icon {
    width:2.5rem; height:2.5rem; border-radius:0.5rem;
    display:flex; align-items:center; justify-content:center; flex-shrink:0;
}
.df-card .df-label { font-size:0.7rem; font-weight:600; color:#6b7280; text-transform:uppercase; letter-spacing:0.03em; }
.df-card .df-value { font-size:1.75rem; font-weight:800; color:#111827; line-height:1.2; }
.df-card .df-sub { font-size:0.72rem; color:#9ca3af; margin-top:0.125rem; display:flex; align-items:center; gap:0.25rem; }
.df-card .df-sub .df-dot { width:0.375rem; height:0.375rem; border-radius:50%; display:inline-block; }

/* ── Quick Actions ── */
.df-quick {
    display:grid;
    grid-template-columns:repeat(4, 1fr);
    gap:0.875rem;
    margin-bottom:1.5rem;
}
.df-q {
    display:flex; align-items:center; gap:0.75rem;
    background:#fff; border:1px solid #e5e7eb; border-radius:0.625rem;
    padding:0.875rem 1rem; text-decoration:none;
    transition:all 0.25s;
}
.df-q:hover { transform:translateY(-2px); box-shadow:0 6px 20px rgba(0,0,0,0.06); border-color:#6366f1; }
.df-q .df-qi {
    width:2.5rem; height:2.5rem; border-radius:0.5rem;
    display:flex; align-items:center; justify-content:center; flex-shrink:0;
}
.df-q .df-qt { flex:1; }
.df-q .df-qt .df-ql { font-size:0.75rem; font-weight:600; color:#111827; }
.df-q .df-qt .df-qs { font-size:0.68rem; color:#6b7280; }
.df-q .df-arrow { color:#9ca3af; flex-shrink:0; }

/* ── Section ── */
.df-section { margin-bottom:1.5rem; }
.df-section .df-sh {
    display:flex; align-items:center; justify-content:space-between; margin-bottom:0.75rem;
}
.df-section .df-sh h2 {
    font-size:0.9375rem; font-weight:700; color:#111827;
    display:flex; align-items:center; gap:0.5rem;
}
.df-section .df-sh h2 svg { color:#6366f1; }
.df-section .df-sh .df-sl {
    font-size:0.75rem; color:#6366f1; text-decoration:none; font-weight:500;
}
.df-section .df-sh .df-sl:hover { text-decoration:underline; }

/* ── Tables ── */
.df-tbls { display:grid; grid-template-columns:1fr 1fr; gap:1.25rem; }
.df-tbl {
    background:#fff; border:1px solid #e5e7eb; border-radius:0.75rem; overflow:hidden;
    transition:box-shadow 0.25s;
}
.df-tbl:hover { box-shadow:0 4px 16px rgba(0,0,0,0.04); }
.df-tbl .df-th {
    display:flex; align-items:center; justify-content:space-between;
    padding:0.875rem 1.125rem; border-bottom:1px solid #f3f4f6;
}
.df-tbl .df-th h3 { font-size:0.875rem; font-weight:600; color:#111827; margin:0; display:flex; align-items:center; gap:0.375rem; }
.df-tbl .df-th h3 svg { color:#6366f1; }
.df-tbl .df-th .df-cnt { font-size:0.65rem; font-weight:600; color:#6b7280; background:#f3f4f6; padding:0.125rem 0.5rem; border-radius:9999px; }
.df-tbl table { width:100%; border-collapse:collapse; }
.df-tbl th {
    background:#f9fafb; text-align:left;
    padding:0.5rem 1.125rem; font-size:0.65rem; font-weight:600;
    color:#6b7280; text-transform:uppercase; letter-spacing:0.04em;
    border-bottom:1px solid #e5e7eb;
}
.df-tbl td {
    padding:0.625rem 1.125rem; font-size:0.8rem;
    border-bottom:1px solid #f3f4f6; color:#374151;
}
.df-tbl tr:last-child td { border-bottom:none; }
.df-tbl tbody tr { transition:background 0.15s; }
.df-tbl tbody tr:hover td { background:#f8faff; }
.df-tbl .badge {
    display:inline-flex; padding:0.125rem 0.5rem;
    border-radius:9999px; font-size:0.65rem; font-weight:600;
}
.df-tbl .badge-pending { background:#fef3c7; color:#92400e; }
.df-tbl .badge-approved { background:#d1fae5; color:#065f46; }
.df-tbl .badge-rejected { background:#fee2e2; color:#991b1b; }
.df-tbl .badge-unread { background:#dbeafe; color:#1e40af; }
.df-tbl .badge-read { background:#f3f4f6; color:#6b7280; }
.df-tbl .empty { text-align:center; color:#9ca3af; padding:1.5rem 1.125rem; font-size:0.8rem; }
.df-tbl .msg-subj { max-width:200px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }

/* ── Responsive ── */
@media (max-width:1200px) { .df-stats { grid-template-columns:repeat(3,1fr); } .df-quick { grid-template-columns:repeat(2,1fr); } }
@media (max-width:1024px) { .df-tbls { grid-template-columns:1fr; } }
@media (max-width:768px) {
    .df-hero { margin:-1rem -1rem 1rem; padding:1.25rem 1rem 1.5rem; }
    .df-hero .hr-inner { flex-direction:column; align-items:flex-start; }
    .df-hero .hr-left h1 { font-size:1.2rem; flex-wrap:wrap; }
    .df-hero .hr-left h1 .greet { font-size:1rem; }
    .df-hero .hr-left p { font-size:0.75rem; }
    .df-stats { grid-template-columns:repeat(2,1fr); gap:0.75rem; }
    .df-card { padding:1rem; }
    .df-card .df-value { font-size:1.375rem; }
    .df-quick { grid-template-columns:repeat(2,1fr); gap:0.625rem; }
    .df-q { padding:0.75rem 0.875rem; }
    .df-section .df-sh h2 { font-size:0.85rem; }
}
@media (max-width:480px) {
    .df-hero { margin:-0.75rem -0.75rem 0.75rem; padding:1rem 0.75rem 1.25rem; }
    .df-hero .hr-left h1 { font-size:1rem; }
    .df-hero .hr-left h1 .greet { font-size:0.875rem; }
    .df-stats { grid-template-columns:1fr; gap:0.625rem; }
    .df-card { padding:0.875rem; }
    .df-card .df-icon { width:2rem; height:2rem; }
    .df-card .df-icon svg { width:16px; height:16px; }
    .df-card .df-label { font-size:0.65rem; }
    .df-card .df-value { font-size:1.25rem; }
    .df-quick { grid-template-columns:1fr; }
    .df-tbl { overflow-x:auto; }
    .df-tbl table { min-width:360px; }
    .df-tbl th { padding:0.4rem 0.75rem; font-size:0.6rem; }
    .df-tbl td { padding:0.5rem 0.75rem; font-size:0.75rem; }
}
</style>
@endpush

@section('content')
<div class="df-hero df-anim">
    <div class="hr-inner">
        <div class="hr-left">
            <h1><span class="greet">Welcome back,</span> {{ auth()->user()->name }}</h1>
            <p>{{ now()->timezone('Asia/Dhaka')->format('l, F j, Y') }}</p>
        </div>
        <div class="hr-right">
            <span class="date-badge">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                {{ now()->timezone('Asia/Dhaka')->format('M d, Y') }}
            </span>
        </div>
    </div>
</div>

{{-- Stats Cards --}}
<div class="df-stats df-anim" style="animation-delay:0.05s">
    <div class="df-card">
        <div class="df-top">
            <div class="df-icon" style="background:#eef2ff;color:#4f46e5;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <span class="df-sub" style="color:#6366f1;font-size:0.68rem;font-weight:600;">Total</span>
        </div>
        <div class="df-label">Users</div>
        <div class="df-value">{{ $totalUsers }}</div>
    </div>
    <div class="df-card">
        <div class="df-top">
            <div class="df-icon" style="background:#fef3c7;color:#d97706;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            </div>
            <span class="df-sub" style="font-size:0.68rem;">
                <span class="df-dot" style="background:#f59e0b;"></span> {{ $pendingProperties }} pending
            </span>
        </div>
        <div class="df-label">Properties</div>
        <div class="df-value">{{ $totalProperties }}</div>
    </div>
    <div class="df-card">
        <div class="df-top">
            <div class="df-icon" style="background:#d1fae5;color:#059669;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            </div>
            <span class="df-sub" style="font-size:0.68rem;">
                <span class="df-dot" style="background:#10b981;"></span> {{ $activeTestimonials }} active
            </span>
        </div>
        <div class="df-label">Testimonials</div>
        <div class="df-value">{{ $totalTestimonials }}</div>
    </div>
    <div class="df-card">
        <div class="df-top">
            <div class="df-icon" style="background:#f3e8ff;color:#7c3aed;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><line x1="9" y1="10" x2="15" y2="10"/></svg>
            </div>
            <span class="df-sub" style="font-size:0.68rem;">
                <span class="df-dot" style="background:#8b5cf6;"></span> {{ $unreadMessages }} unread
            </span>
        </div>
        <div class="df-label">Messages</div>
        <div class="df-value">{{ $totalMessages }}</div>
    </div>
</div>

{{-- Quick Actions --}}
<div class="df-quick df-anim" style="animation-delay:0.1s">
    <a href="{{ route('admin.to-let.index') }}" class="df-q">
        <div class="df-qi" style="background:#fef3c7;color:#d97706;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        </div>
        <div class="df-qt">
            <div class="df-ql">Advertisements</div>
            <div class="df-qs">{{ $pendingProperties }} pending review</div>
        </div>
        <svg class="df-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
    </a>
    <a href="{{ route('admin.messages.index') }}" class="df-q">
        <div class="df-qi" style="background:#dbeafe;color:#2563eb;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        </div>
        <div class="df-qt">
            <div class="df-ql">Messages</div>
            <div class="df-qs">{{ $unreadMessages }} unread</div>
        </div>
        <svg class="df-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
    </a>
    <a href="{{ route('admin.testimonials.index') }}" class="df-q">
        <div class="df-qi" style="background:#d1fae5;color:#059669;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        </div>
        <div class="df-qt">
            <div class="df-ql">Testimonials</div>
            <div class="df-qs">{{ $activeTestimonials }} active</div>
        </div>
        <svg class="df-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
    </a>
    <a href="{{ route('admin.policies.index') }}" class="df-q">
        <div class="df-qi" style="background:#f3e8ff;color:#7c3aed;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
        </div>
        <div class="df-qt">
            <div class="df-ql">Policies</div>
            <div class="df-qs">{{ $activePolicies }} active</div>
        </div>
        <svg class="df-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
    </a>
</div>

{{-- Secondary Stats --}}
<div class="df-section df-anim" style="animation-delay:0.15s">
    <div class="df-sh">
        <h2>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
            Overview
        </h2>
    </div>
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:0.875rem;">
        <div style="background:#fff;border:1px solid #e5e7eb;border-radius:0.625rem;padding:0.875rem 1rem;">
            <div style="font-size:0.68rem;font-weight:600;color:#6b7280;text-transform:uppercase;letter-spacing:0.03em;display:flex;align-items:center;gap:0.375rem;">
                <span style="width:0.5rem;height:0.5rem;border-radius:50%;background:#f59e0b;display:inline-block;"></span>
                Pending Properties
            </div>
            <div style="font-size:1.125rem;font-weight:700;color:#111827;margin-top:0.25rem;">{{ $pendingProperties }}</div>
        </div>
        <div style="background:#fff;border:1px solid #e5e7eb;border-radius:0.625rem;padding:0.875rem 1rem;">
            <div style="font-size:0.68rem;font-weight:600;color:#6b7280;text-transform:uppercase;letter-spacing:0.03em;display:flex;align-items:center;gap:0.375rem;">
                <span style="width:0.5rem;height:0.5rem;border-radius:50%;background:#10b981;display:inline-block;"></span>
                Approved Properties
            </div>
            <div style="font-size:1.125rem;font-weight:700;color:#111827;margin-top:0.25rem;">{{ $approvedProperties }}</div>
        </div>
        <div style="background:#fff;border:1px solid #e5e7eb;border-radius:0.625rem;padding:0.875rem 1rem;">
            <div style="font-size:0.68rem;font-weight:600;color:#6b7280;text-transform:uppercase;letter-spacing:0.03em;display:flex;align-items:center;gap:0.375rem;">
                <span style="width:0.5rem;height:0.5rem;border-radius:50%;background:#ef4444;display:inline-block;"></span>
                Active FAQs
            </div>
            <div style="font-size:1.125rem;font-weight:700;color:#111827;margin-top:0.25rem;">{{ $activeFaqs }} / {{ $totalFaqs }}</div>
        </div>
        <div style="background:#fff;border:1px solid #e5e7eb;border-radius:0.625rem;padding:0.875rem 1rem;">
            <div style="font-size:0.68rem;font-weight:600;color:#6b7280;text-transform:uppercase;letter-spacing:0.03em;display:flex;align-items:center;gap:0.375rem;">
                <span style="width:0.5rem;height:0.5rem;border-radius:50%;background:#8b5cf6;display:inline-block;"></span>
                Active Policies
            </div>
            <div style="font-size:1.125rem;font-weight:700;color:#111827;margin-top:0.25rem;">{{ $activePolicies }} / {{ $totalPolicies }}</div>
        </div>
    </div>
</div>

{{-- Recent Data Tables --}}
<div class="df-tbls df-anim" style="animation-delay:0.2s">
    <div class="df-tbl">
        <div class="df-th">
            <h3>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                Recent Messages
            </h3>
            <span class="df-cnt">{{ $recentMessages->count() }}</span>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Message</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentMessages as $m)
                    <tr>
                        <td style="font-weight:500;">{{ $m->name }}</td>
                        <td><div class="msg-subj">{{ \Illuminate\Support\Str::limit($m->message, 40) }}</div></td>
                        <td>
                            <span class="badge {{ $m->admin_reply ? 'badge-read' : 'badge-unread' }}">
                                {{ $m->admin_reply ? 'Replied' : 'Unread' }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="empty">No messages yet</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="df-tbl">
        <div class="df-th">
            <h3>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                Recent Properties
            </h3>
            <span class="df-cnt">{{ $recentProperties->count() }}</span>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentProperties as $p)
                    <tr>
                        <td style="font-weight:500;">{{ \Illuminate\Support\Str::limit($p->title, 30) }}</td>
                        <td style="text-transform:capitalize;">{{ str_replace('_', ' ', $p->property_type) }}</td>
                        <td>
                            <span class="badge badge-{{ $p->status }}">{{ ucfirst($p->status) }}</span>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="empty">No properties yet</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
