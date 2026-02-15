<nav class="navbar">
                <div class="navbar-left">
                    <div class="menu-toggle" id="menuToggle">
                        <i class="fas fa-bars"></i>
                    </div>
                    <div class="navbar-search">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Rechercher une tâche...">
                    </div>
                </div>

                <div class="navbar-right">
                    <div class="notification-icon">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </div>

                    <div class="profile-dropdown" id="profileDropdown">
                        <div class="profile-trigger">
                            <img src="https://ui-avatars.com/api/?name=Jean+Dupont&background=4361ee&color=fff&size=35" alt="Profile">
                            <span>Jean Dupont</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>

                        <div class="dropdown-menu" id="dropdownMenu">
                            <div class="dropdown-header">
                                <h4>Jean Dupont</h4>
                                <p>jean.dupont@email.com</p>
                            </div>
                            <div class="dropdown-item">
                                <i class="fas fa-user"></i>
                                <span>Mon profil</span>
                            </div>
                            <div class="dropdown-item">
                                <i class="fas fa-cog"></i>
                                <span>Paramètres</span>
                            </div>
                            <div class="dropdown-item">
                                <i class="fas fa-question-circle"></i>
                                <span>Aide</span>
                            </div>
                            <div class="dropdown-item logout" id="logoutBtn">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Déconnexion</span>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
