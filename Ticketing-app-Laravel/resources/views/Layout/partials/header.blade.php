<header>
        <div class="logo">
            <a href="{{ route('dashboard.Dashboard') }}">
                <img src="{{asset('asset/img/Logo.png')}}" alt="Logo de moi hyper bg">
            </a>
        </div>
        <h2>Welcome Maxence Gautier-Grall</h2>
        <nav>
            <a href="{{ route('dashboard.Dashboard') }}">Dashboard</a>
            <a href="{{ route('projects.ProjectList') }}">Projects</a>
            <a href="{{ route('tickets.TicketList') }}">Tickets</a>
            <a href="{{ route('clients.ClientList') }}">Clients</a>
            
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