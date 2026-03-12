 @extends('layout.main')

@section('content')
 
 <section class="SettingsPage">
        <div class="ClassicSettings">
            <h2>General Settings</h2>
            <div class="Theme">
                <h3>Mode Sombre :</h3>

                <label class="ThemeSwitch">
                    <input type="checkbox" id="theme-toggle">
                    <span class="slider"></span>
                </label>
            </div>

            <div class="LangueSettings">

                <h3>Langue :</h3>
                <select type="text" id="projet" name="projet">
                    <option value="Langue1">Français</option>
                    <option value="Langue2">Anglais</option>
                </select>

            </div>
            
        </div>
         <div class="DashBoardSettings">
            <h2>Dashboard Settings</h2>
            <div class="Theme">
                <h3>Fast Access :</h3>

                <label class="FastAccessSwitch" >
                    <input type="checkbox" id="FastAccess-toggle" checked>
                    <span class="slider"></span>
                </label>
            </div>
            
        </div>
    </section>

    @endsection