<header>
        <div class="logo">
            <a href="{{ route('dashboard.Dashboard', 1) }}">
                <img src="{{asset('asset/img/Logo.png')}}" alt="Logo de moi hyper bg">
            </a>
        </div>
        <h2>Welcome</h2>
        <nav>
            <a href="{{ route('dashboard.Dashboard',1) }}">Dashboard</a>
            <a href="{{ route('projects.ProjectList', 1) }}">Projects</a>
            <a href="{{ route('tickets.TicketList',1) }}">Tickets</a>
            
            <div class="Profile-drop">
                <button class="Drop-button">☰</button>
                <div class="Drop-content">
                    <a href="{{ route('profil.Profil') }}">Profile</a>
                    <a href="{{ route('settings.Settings') }}">Settings</a>
                    <a href="{{ route('connexion.Connexion') }}">Logout</a>
                </div>   
                
            </div>
        </nav>
    </header>