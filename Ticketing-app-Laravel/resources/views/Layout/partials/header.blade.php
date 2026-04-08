<header>
        <div class="logo">
            <a href="{{ route('dashboard') }}">
                <img src="{{asset('asset/img/Logo.png')}}" alt="Logo">
            </a>
        </div>
        <h2>Welcome {{auth()->user()->name}}</h2>
        <nav>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('clients.ClientList') }}">Clients</a>
            <a href="{{ route('projects.ProjectList') }}">Projects</a>
            <a href="{{ route('tickets.TicketList') }}">Tickets</a>
            
            <div class="Profile-drop">
                <button class="Drop-button">☰</button>
                <div class="Drop-content">
                    <a href="{{ route('profil.Profil') }}">Profile</a>
                    <a href="{{ route('settings.Settings') }}">Settings</a>
                    <form method="POST" action="{{ route('logout') }}" class="Button_Form">
                    @csrf
                    <a :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </a>
                    </form>
                </div>   
                
            </div>
        </nav>
    </header>