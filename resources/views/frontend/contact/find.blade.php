@extends('frontend.layouts.app')

@section('title', 'Find My Messages')

@section('content')
<div class="section">
    <div class="container">
        <div style="max-width:600px; margin:0 auto;">
            <div style="text-align:center; margin-bottom:2.5rem;">
                <h1 style="font-size:1.75rem; font-weight:700; color:var(--secondary); margin-bottom:0.5rem;">Find My Messages</h1>
                <p style="color:var(--text-muted);">Enter your email to find your submitted messages.</p>
            </div>

            <form method="GET" action="{{ route('contact.find') }}" style="display:flex; gap:0.5rem; margin-bottom:2rem;">
                <input type="email" name="email" placeholder="Your email address" value="{{ $email }}" required style="flex:1; padding:0.75rem 1rem; border:1px solid var(--border); border-radius:var(--r-sm); font-size:0.875rem; font-family:inherit; outline:none; box-sizing:border-box;">
                <button type="submit" style="padding:0.75rem 1.5rem; background:var(--primary); color:#fff; border:none; border-radius:var(--r-sm); font-size:0.875rem; font-weight:600; cursor:pointer; font-family:inherit; white-space:nowrap;">Search</button>
            </form>

            @if($email)
                @if($messages->count())
                    <p style="font-size:0.875rem; color:var(--text-muted); margin-bottom:1rem;">Found {{ $messages->count() }} message(s) for <strong>{{ $email }}</strong>. Click to view.</p>
                    <div style="display:flex; flex-direction:column; gap:0.75rem;">
                        @foreach($messages as $msg)
                            <a href="{{ route('contact.message', $msg->view_token) }}" style="display:flex; justify-content:space-between; align-items:center; background:#fff; border:1px solid var(--border); border-radius:var(--r-md); padding:1rem 1.25rem; text-decoration:none; transition:all 0.2s; gap:1rem;" onmouseover="this.style.borderColor='var(--primary)';this.style.boxShadow='0 2px 12px rgba(37,99,235,0.1)'" onmouseout="this.style.borderColor='var(--border)';this.style.boxShadow='none'">
                                <span style="font-size:0.875rem; color:var(--text); font-weight:500;">{{ $msg->created_at->format('d M Y, h:i A') }}</span>
                                <span style="font-size:0.75rem; padding:0.25rem 0.625rem; border-radius:999px; font-weight:600; flex-shrink:0; {{ $msg->admin_reply ? 'background:#D1FAE5;color:#065F46;' : 'background:#FEF3C7;color:#92400E;' }}">{{ $msg->admin_reply ? 'Replied' : 'Pending' }}</span>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div style="text-align:center; padding:3rem 0;">
                        <p style="font-size:1rem; color:var(--text-muted);">No messages found for <strong>{{ $email }}</strong>.</p>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection
