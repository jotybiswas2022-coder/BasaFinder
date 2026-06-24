@extends('frontend.layouts.app')

@section('title', 'My Profile')

@push('styles')
<style>
body { background: var(--navy); }

.prof-hero {
    background: linear-gradient(135deg, #0F172A 0%, #1E3A5F 50%, #0F172A 100%);
    padding: 2.5rem 1.5rem 2rem;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.prof-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse 800px 500px at 20% 40%, rgba(37,99,235,0.12) 0%, transparent 60%),
        radial-gradient(ellipse 600px 400px at 80% 60%, rgba(245,158,11,0.06) 0%, transparent 60%);
    pointer-events: none;
}
.prof-hero .prof-avatar {
    width: 4.5rem;
    height: 4.5rem;
    border-radius: 50%;
    background: rgba(37,99,235,0.15);
    border: 2px solid rgba(96,165,250,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 0.75rem;
    color: var(--accent);
    position: relative;
    z-index: 1;
}
.prof-hero h1 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #fff;
    margin-bottom: 0.15rem;
    position: relative;
    z-index: 1;
}
.prof-hero .prof-email {
    color: rgba(255,255,255,0.5);
    font-size: 0.85rem;
    position: relative;
    z-index: 1;
}

.prof-wrap { max-width: 48rem; margin: 0 auto; padding: 1.5rem 1rem 4rem; }
.prof-grid { display: flex; flex-direction: column; gap: 1.25rem; }

.prof-card {
    background: linear-gradient(135deg, rgba(15,23,42,0.55), rgba(15,23,42,0.7));
    backdrop-filter: blur(40px) saturate(1.4);
    -webkit-backdrop-filter: blur(40px) saturate(1.4);
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 20px;
    padding: 1.5rem;
    box-shadow: 0 8px 32px rgba(0,0,0,0.2);
    transition: all 0.3s;
}
.prof-card:hover { border-color: rgba(96,165,250,0.12); }
.prof-card .card-hdr {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.125rem;
}
.prof-card .card-hdr svg { color: var(--primary); flex-shrink: 0; }
.prof-card .card-hdr h2 { font-size: 1rem; font-weight: 600; color: #fff; }
.prof-card .card-sub {
    font-size: 0.8rem;
    color: rgba(255,255,255,0.4);
    margin-bottom: 1.25rem;
    margin-left: 1.625rem;
}

.prof-card .field { margin-bottom: 1rem; }
.prof-card .field .input-wrap {
    position: relative;
    display: flex;
    align-items: center;
}
.prof-card .field .input-wrap .input-icon {
    position: absolute;
    left: 0.75rem;
    top: 50%;
    transform: translateY(-50%);
    color: rgba(255,255,255,0.2);
    display: flex;
    align-items: center;
    pointer-events: none;
}
.prof-card .field .input-wrap input {
    width: 100%;
    padding: 0.625rem 0.75rem 0.625rem 2.5rem;
    border: 1.5px solid rgba(255,255,255,0.08);
    border-radius: 10px;
    font-size: 0.875rem;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
    background: rgba(0,0,0,0.2);
    color: #fff;
    box-sizing: border-box;
}
.prof-card .field .input-wrap input:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(37,99,235,0.08);
}
.prof-card .field label {
    display: block;
    font-size: 0.8rem;
    font-weight: 500;
    color: rgba(255,255,255,0.6);
    margin-bottom: 0.3rem;
}
.prof-card .field .error {
    color: #F87171;
    font-size: 0.75rem;
    margin-top: 0.25rem;
}

.verify-box {
    margin-top: 0.75rem;
    padding: 0.75rem 1rem;
    background: rgba(245,158,11,0.08);
    border: 1px solid rgba(245,158,11,0.15);
    border-radius: 10px;
    font-size: 0.8125rem;
    color: #FCD34D;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    flex-wrap: wrap;
}
.verify-box button {
    background: none;
    border: none;
    color: #60A5FA;
    font-weight: 600;
    text-decoration: underline;
    cursor: pointer;
    font-size: 0.8125rem;
}
.verify-box .sent {
    margin-top: 0.375rem;
    font-weight: 500;
    color: #34D399;
    width: 100%;
}

.btn-row {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-top: 1.25rem;
}
.prof-card .btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 0.375rem;
    background: linear-gradient(135deg, var(--primary), #4F46E5);
    color: #fff;
    border: none;
    padding: 0.6rem 1.5rem;
    border-radius: 10px;
    font-size: 0.85rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.25s;
    font-family: var(--font);
}
.prof-card .btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 16px rgba(37,99,235,0.3);
}
.prof-card .btn-danger {
    display: inline-flex;
    align-items: center;
    gap: 0.375rem;
    background: rgba(239,68,68,0.15);
    color: #F87171;
    border: 1px solid rgba(239,68,68,0.2);
    padding: 0.6rem 1.5rem;
    border-radius: 10px;
    font-size: 0.85rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.25s;
    font-family: var(--font);
}
.prof-card .btn-danger:hover {
    background: rgba(239,68,68,0.25);
    transform: translateY(-1px);
}
.prof-card .btn-secondary {
    display: inline-flex;
    align-items: center;
    gap: 0.375rem;
    background: rgba(255,255,255,0.04);
    color: rgba(255,255,255,0.5);
    border: 1px solid rgba(255,255,255,0.06);
    padding: 0.6rem 1.5rem;
    border-radius: 10px;
    font-size: 0.85rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
    font-family: var(--font);
}
.prof-card .btn-secondary:hover {
    background: rgba(255,255,255,0.08);
    color: #fff;
}
.success-msg {
    display: inline-flex;
    align-items: center;
    gap: 0.375rem;
    font-size: 0.8125rem;
    color: #34D399;
    font-weight: 500;
}

.prof-card.danger {
    border-color: rgba(239,68,68,0.15);
    background: linear-gradient(135deg, rgba(239,68,68,0.06), rgba(15,23,42,0.55));
}
.prof-card.danger .card-hdr svg { color: #F87171; }
.prof-card.danger .card-sub { color: rgba(255,255,255,0.5); }

.modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.6);
    align-items: center;
    justify-content: center;
    z-index: 50;
    backdrop-filter: blur(4px);
}
.modal-overlay.active { display: flex; }
.modal-box {
    background: linear-gradient(135deg, rgba(15,23,42,0.9), rgba(15,23,42,0.95));
    backdrop-filter: blur(40px) saturate(1.4);
    -webkit-backdrop-filter: blur(40px) saturate(1.4);
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 20px;
    padding: 1.5rem;
    max-width: 28rem;
    width: 90%;
    box-shadow: 0 20px 60px rgba(0,0,0,0.5);
    animation: modalIn 0.2s ease-out;
}
.modal-box h3 {
    font-size: 1.125rem;
    font-weight: 600;
    color: #F87171;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.modal-box > p {
    font-size: 0.8125rem;
    color: rgba(255,255,255,0.4);
    margin-bottom: 1.25rem;
    line-height: 1.6;
}
.modal-box .field { margin-bottom: 1.25rem; }
.modal-box .field label {
    display: block;
    font-size: 0.8rem;
    font-weight: 500;
    color: rgba(255,255,255,0.6);
    margin-bottom: 0.3rem;
}
.modal-box .field input {
    width: 100%;
    padding: 0.625rem 0.75rem;
    border: 1.5px solid rgba(255,255,255,0.08);
    border-radius: 10px;
    font-size: 0.875rem;
    outline: none;
    transition: border-color 0.2s;
    background: rgba(0,0,0,0.2);
    color: #fff;
    box-sizing: border-box;
}
.modal-box .field input:focus {
    border-color: #EF4444;
    box-shadow: 0 0 0 3px rgba(239,68,68,0.08);
}
.modal-box .field .error { color: #F87171; font-size: 0.75rem; margin-top: 0.25rem; }
.modal-box .modal-actions {
    display: flex;
    gap: 0.75rem;
    justify-content: flex-end;
}

@keyframes modalIn {
    from { opacity: 0; transform: scale(0.95) translateY(8px); }
    to { opacity: 1; transform: scale(1) translateY(0); }
}

@media (max-width: 768px) {
    .prof-hero { padding: 2rem 1rem 1.5rem; }
    .prof-hero h1 { font-size: 1.25rem; }
    .prof-hero .prof-avatar { width: 3.5rem; height: 3.5rem; }
    .prof-wrap { padding: 1rem 0.75rem 3rem; }
    .prof-card { padding: 1.25rem; }
}
@media (max-width: 480px) {
    .prof-hero { padding: 1.5rem 0.75rem 1.25rem; }
    .prof-hero h1 { font-size: 1.1rem; }
    .prof-hero .prof-avatar { width: 3rem; height: 3rem; }
}
</style>
@endpush

@section('content')
<div class="prof-hero">
    <div class="prof-avatar">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
    </div>
    <h1>{{ $user->name }}</h1>
    <p class="prof-email">{{ $user->email }}</p>
</div>

<div class="prof-wrap">
    <div class="prof-grid">
        @include('profile.partials.update-profile-information-form')
        @include('profile.partials.update-password-form')
        @include('profile.partials.delete-user-form')
    </div>
</div>
@endsection
