<nav class="navbar">
    <div class="nav-inner">
        <a href="{{ route('home') }}" class="nav-logo">
            <span class="logo-icon">B</span>
            <span class="logo-text">BasaFinder</span>
        </a>
        <button id="navToggle" class="nav-toggle" aria-label="Toggle menu">
            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                <path id="hamburgerIcon" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
        <div id="navLinks" class="nav-links">
            <a href="{{ route('home') }}" class="nav-link">Home</a>
            <a href="{{ route('search') }}" class="nav-link">Browse</a>
            <a href="{{ route('home') }}#properties" class="nav-link">Properties</a>
            <a href="{{ route('post-property') }}" class="nav-link nav-link-highlight">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Post Property
            </a>
            @auth
                <div class="nav-divider"></div>
                <a href="{{ route('profile.edit') }}" class="nav-link">Profile</a>
                @if(Auth::user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="nav-link nav-link-admin">Admin</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" class="nav-logout-form">
                    @csrf
                    <button type="submit" class="nav-link nav-logout-btn">Logout</button>
                </form>
            @else
                <div class="nav-divider"></div>
                <a href="{{ route('login') }}" class="nav-link">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Register</a>
            @endauth
        </div>
    </div>
</nav>    <style>
.navbar {
    position: sticky;
    top: 0;
    z-index: 1000;
    background: rgba(255,255,255,0.82);
    backdrop-filter: blur(28px) saturate(2);
    -webkit-backdrop-filter: blur(28px) saturate(2);
    border-bottom: 1px solid rgba(200,164,92,0.1);
    box-shadow: 0 1px 0 rgba(200,164,92,0.07), 0 4px 20px rgba(0,0,0,0.04);
    transition: all 0.35s ease;
}
.nav-inner {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 1.5rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 70px;
}
.nav-logo {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    text-decoration: none;
}
.logo-icon {
    width: 2.4rem;
    height: 2.4rem;
    background: linear-gradient(135deg, #C8A45C, #A8893D);
    border-radius: 11px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-weight: 900;
    font-size: 1.1rem;
    box-shadow: 0 4px 14px rgba(200,164,92,0.4);
    transition: all 0.3s cubic-bezier(0.34,1.56,0.64,1);
    font-family: 'Playfair Display', Georgia, serif;
}
.nav-logo:hover .logo-icon {
    transform: rotate(-10deg) scale(1.1);
    box-shadow: 0 6px 20px rgba(200,164,92,0.55);
}
.logo-text {
    font-size: 1.35rem;
    font-weight: 800;
    color: #1A1A2E;
    letter-spacing: -0.04em;
    font-family: 'Plus Jakarta Sans', sans-serif;
}
.logo-text span {
    color: #C8A45C;
}
.nav-toggle {
    display: none;
    background: none;
    border: none;
    color: #1A1A2E;
    cursor: pointer;
    padding: 0.3rem;
    border-radius: 8px;
    transition: background 0.2s;
}
.nav-toggle:hover { background: rgba(200,164,92,0.1); }
.nav-links {
    display: flex;
    align-items: center;
    gap: 0.25rem;
}
.nav-link {
    color: #4A5568;
    text-decoration: none;
    padding: 0.5rem 0.9rem;
    border-radius: 10px;
    font-size: 0.875rem;
    font-weight: 600;
    transition: all 0.22s ease;
    white-space: nowrap;
    position: relative;
}
.nav-link:hover {
    background: rgba(200,164,92,0.09);
    color: #A8893D;
}
.nav-link-highlight {
    background: linear-gradient(135deg, rgba(200,164,92,0.12), rgba(200,164,92,0.06));
    color: #A8893D !important;
    font-weight: 700;
    border: 1px solid rgba(200,164,92,0.18);
    display: flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.5rem 1rem;
}
.nav-link-highlight:hover {
    background: rgba(200,164,92,0.18) !important;
    border-color: rgba(200,164,92,0.35);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(200,164,92,0.2);
}
.nav-link-admin {
    background: rgba(245,158,11,0.1);
    color: #92400E !important;
    border: 1px solid rgba(245,158,11,0.15);
}
.nav-link-admin:hover { background: rgba(245,158,11,0.18); }
.nav-divider { width: 1px; height: 1.5rem; background: rgba(200,164,92,0.15); margin: 0 0.25rem; }
.nav-logout-form { display: inline; }
.nav-logout-btn {
    background: none;
    border: none;
    cursor: pointer;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 0.875rem;
    font-weight: 600;
    color: #EF4444;
    padding: 0.5rem 0.9rem;
    border-radius: 10px;
    transition: all 0.2s;
}
.nav-logout-btn:hover { background: #FEF2F2; }

/* Register button */
.nav-links .btn.btn-primary.btn-sm {
    background: linear-gradient(135deg, #C8A45C, #A8893D) !important;
    color: #fff !important;
    font-size: 0.84rem;
    font-weight: 700;
    padding: 0.5rem 1.2rem;
    border-radius: 10px;
    border: none;
    box-shadow: 0 4px 14px rgba(200,164,92,0.35);
    transition: all 0.28s ease;
}
.nav-links .btn.btn-primary.btn-sm:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 22px rgba(200,164,92,0.5);
    background: linear-gradient(135deg, #D4B06A, #C8A45C) !important;
}

/* Mobile */
@media (max-width: 768px) {
    .nav-toggle { display: block; }
    .nav-links {
        display: none;
        position: absolute;
        top: 70px;
        left: 0;
        right: 0;
        background: rgba(255,255,255,0.96);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(200,164,92,0.12);
        flex-direction: column;
        padding: 0.75rem;
        gap: 0.25rem;
        box-shadow: 0 16px 40px rgba(0,0,0,0.1);
    }
    .nav-links.open { display: flex; }
    .nav-link, .nav-logout-btn { width: 100%; padding: 0.8rem 1rem; border-radius: 10px; }
    .nav-link-highlight { justify-content: flex-start; }
    .nav-divider { width: 100%; height: 1px; background: rgba(200,164,92,0.1); margin: 0.3rem 0; }
    .nav-logout-form { width: 100%; }
    .nav-links .btn.btn-primary.btn-sm { width: 100%; justify-content: center; }
}
</style>

<script>
document.getElementById('navToggle')?.addEventListener('click', function() {
    const links = document.getElementById('navLinks');
    links.classList.toggle('open');
    const icon = document.getElementById('hamburgerIcon');
    if (links.classList.contains('open')) {
        icon.setAttribute('d', 'M6 18L18 6M6 6l12 12');
    } else {
        icon.setAttribute('d', 'M4 6h16M4 12h16M4 18h16');
    }
});
</script>

<script>
(function(){
    var nav = document.querySelector('.navbar');
    if(!nav) return;
    window.addEventListener('scroll', function(){
        if(window.scrollY > 50){
            nav.style.background = 'rgba(255,255,255,0.94)';
            nav.style.boxShadow = '0 1px 0 rgba(200,164,92,0.12), 0 8px 32px rgba(0,0,0,0.08)';
        } else {
            nav.style.background = 'rgba(255,255,255,0.82)';
            nav.style.boxShadow = '0 1px 0 rgba(200,164,92,0.07), 0 4px 20px rgba(0,0,0,0.04)';
        }
    }, {passive:true});
})();
</script>
