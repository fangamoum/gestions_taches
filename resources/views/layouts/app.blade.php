<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow Pro - Gestion de tâches intelligente</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel ="stylesheet" href="{{asset('css/taches_create.css')}}">
     <link rel ="stylesheet" href="{{asset('css/taches_index.css')}}">
</head>
<body>
    <div class="app-wrapper">
        <!-- Sidebar -->
        @include('../partials.sidebar')
        <!-- Main Content -->
        <div class="main-content">
            <!-- Navbar -->
        @include('../partials.navbar')

        <!-- Content Area -->

         @yield('content')

            <!-- Footer -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script>
        // Données initiales
        let tasks = JSON.parse(localStorage.getItem('tasks')) || [
            {
                id: Date.now() - 3 * 24 * 60 * 60 * 1000,
                title: 'Présentation client',
                priority: 'high',
                completed: false,
                date: new Date(Date.now() - 1 * 24 * 60 * 60 * 1000).toISOString().split('T')[0],
                category: 'Travail'
            },
            {
                id: Date.now() - 2 * 24 * 60 * 60 * 1000,
                title: 'Mettre à jour documentation',
                priority: 'medium',
                completed: true,
                date: new Date().toISOString().split('T')[0],
                category: 'Personnel'
            },
            {
                id: Date.now() - 1 * 24 * 60 * 60 * 1000,
                title: 'Réunion d\'équipe',
                priority: 'high',
                completed: false,
                date: new Date(Date.now() + 1 * 24 * 60 * 60 * 1000).toISOString().split('T')[0],
                category: 'Travail'
            }
        ];

        let currentFilter = 'all';
        let searchTerm = '';
        let sortBy = 'date';

        // Éléments DOM
        const tasksList = document.getElementById('tasksList');
        const taskInput = document.getElementById('taskInput');
        const prioritySelect = document.getElementById('prioritySelect');
        const taskDate = document.getElementById('taskDate');
        const addTaskBtn = document.getElementById('addTaskBtn');
        const filterBtns = document.querySelectorAll('.filter-btn');
        const sortSelect = document.getElementById('sortSelect');
        const totalTasksEl = document.getElementById('totalTasks');
        const completedTasksEl = document.getElementById('completedTasks');
        const pendingTasksEl = document.getElementById('pendingTasks');
        const overdueTasksEl = document.getElementById('overdueTasks');
        const tasksCountEl = document.getElementById('tasksCount');

        // Sidebar toggle
        const sidebar = document.getElementById('sidebar');
        const menuToggle = document.getElementById('menuToggle');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('show');
        });

        // Profile dropdown
        const profileDropdown = document.getElementById('profileDropdown');
        const dropdownMenu = document.getElementById('dropdownMenu');

        profileDropdown.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdownMenu.classList.toggle('show');
        });

        document.addEventListener('click', (e) => {
            if (!profileDropdown.contains(e.target)) {
                dropdownMenu.classList.remove('show');
            }
        });

        // Profile modal
        const profileModal = document.getElementById('profileModal');
        const closeModal = document.getElementById('closeModal');
        const cancelModal = document.getElementById('cancelModal');
        const profileItems = document.querySelectorAll('.dropdown-item');

        profileItems.forEach(item => {
            if (item.querySelector('span').textContent === 'Mon profil') {
                item.addEventListener('click', () => {
                    profileModal.classList.add('show');
                    dropdownMenu.classList.remove('show');
                });
            }
        });

        closeModal.addEventListener('click', () => {
            profileModal.classList.remove('show');
        });

        cancelModal.addEventListener('click', () => {
            profileModal.classList.remove('show');
        });

        window.addEventListener('click', (e) => {
            if (e.target === profileModal) {
                profileModal.classList.remove('show');
            }
        });

        // Logout
        const logoutBtn = document.getElementById('logoutBtn');
        logoutBtn.addEventListener('click', () => {
            if (confirm('Êtes-vous sûr de vouloir vous déconnecter ?')) {
                alert('Déconnexion réussie !');
                // Redirection simulée
                window.location.reload();
            }
        });

        // Notifications
        const notificationIcon = document.querySelector('.notification-icon');
        notificationIcon.addEventListener('click', () => {
            alert('📬 3 notifications non lues\n- Tâche "Présentation" en retard\n- Nouveau commentaire\n- Rappel: Réunion demain');
        });

        // Sauvegarder les tâches
        function saveTasks() {
            localStorage.setItem('tasks', JSON.stringify(tasks));
            updateStats();
            renderTasks();
        }

        // Mettre à jour les statistiques
        function updateStats() {
            const total = tasks.length;
            const completed = tasks.filter(t => t.completed).length;
            const pending = total - completed;
            const today = new Date().toISOString().split('T')[0];
            const overdue = tasks.filter(t => !t.completed && t.date < today).length;

            totalTasksEl.textContent = total;
            completedTasksEl.textContent = completed;
            pendingTasksEl.textContent = pending;
            overdueTasksEl.textContent = overdue;
            tasksCountEl.textContent = `${total} tâche(s)`;
        }

        // Formater la date
        function formatDate(dateString) {
            if (!dateString) return 'Pas de date';

            const date = new Date(dateString);
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);
            const yesterday = new Date(today);
            yesterday.setDate(yesterday.getDate() - 1);

            if (date.toDateString() === today.toDateString()) {
                return "Aujourd'hui";
            } else if (date.toDateString() === tomorrow.toDateString()) {
                return 'Demain';
            } else if (date.toDateString() === yesterday.toDateString()) {
                return 'Hier';
            } else {
                return date.toLocaleDateString('fr-FR', {
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric'
                });
            }
        }

        // Vérifier si une tâche est en retard
        function isOverdue(task) {
            if (task.completed) return false;
            const today = new Date().toISOString().split('T')[0];
            return task.date && task.date < today;
        }

        // Filtrer et trier les tâches
        function getFilteredAndSortedTasks() {
            let filteredTasks = tasks.filter(task => {
                if (currentFilter === 'pending' && task.completed) return false;
                if (currentFilter === 'completed' && !task.completed) return false;
                if (currentFilter === 'overdue' && !isOverdue(task)) return false;

                if (searchTerm && !task.title.toLowerCase().includes(searchTerm.toLowerCase())) return false;

                return true;
            });

            // Tri
            filteredTasks.sort((a, b) => {
                switch(sortBy) {
                    case 'priority':
                        const priorityWeight = { high: 3, medium: 2, low: 1 };
                        return priorityWeight[b.priority] - priorityWeight[a.priority];
                    case 'title':
                        return a.title.localeCompare(b.title);
                    case 'date':
                    default:
                        return new Date(b.date || 0) - new Date(a.date || 0);
                }
            });

            return filteredTasks;
        }

        // Rendu des tâches
        function renderTasks() {
            const filteredTasks = getFilteredAndSortedTasks();

            if (filteredTasks.length === 0) {
                tasksList.innerHTML = `
                    <div style="text-align: center; padding: 50px 20px;">
                        <i class="fas fa-clipboard-list" style="font-size: 4em; color: #ccc; margin-bottom: 20px;"></i>
                        <h3 style="color: #666; margin-bottom: 10px;">Aucune tâche trouvée</h3>
                        <p style="color: #999;">Créez une nouvelle tâche pour commencer</p>
                    </div>
                `;
                return;
            }

            tasksList.innerHTML = filteredTasks.map(task => {
                const today = new Date().toISOString().split('T')[0];
                const isTaskOverdue = !task.completed && task.date && task.date < today;

                return `
                    <div class="task-item" data-id="${task.id}">
                        <div class="task-content">
                            <input type="checkbox" class="task-checkbox" ${task.completed ? 'checked' : ''} onchange="toggleTask(${task.id})">
                            <div class="task-details">
                                <div class="task-title ${task.completed ? 'completed' : ''}">${task.title}</div>
                                <div class="task-meta">
                                    <span class="task-priority priority-${task.priority}">
                                        <i class="fas fa-flag"></i>
                                        ${task.priority === 'high' ? 'Haute' : task.priority === 'medium' ? 'Moyenne' : 'Basse'}
                                    </span>
                                    <span class="task-category">
                                        <i class="fas fa-folder"></i> ${task.category || 'Général'}
                                    </span>
                                    <span class="task-date ${isTaskOverdue ? 'overdue' : ''}">
                                        <i class="far fa-calendar"></i>
                                        ${task.date ? formatDate(task.date) : 'Pas de date'}
                                        ${isTaskOverdue ? ' ⚠️ En retard' : ''}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="task-actions">
                            <button class="task-btn edit-btn" onclick="editTask(${task.id})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="task-btn delete-btn" onclick="deleteTask(${task.id})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
            }).join('');
        }

        // Ajouter une tâche
        function addTask() {
            const title = taskInput.value.trim();
            if (!title) {
                alert('Veuillez entrer un titre pour la tâche');
                return;
            }

            const newTask = {
                id: Date.now(),
                title: title,
                priority: prioritySelect.value,
                completed: false,
                date: taskDate.value || new Date().toISOString().split('T')[0],
                category: 'Général'
            };

            tasks.unshift(newTask);
            taskInput.value = '';
            taskDate.value = '';
            saveTasks();
        }

        // Basculer le statut d'une tâche
        window.toggleTask = function(id) {
            const task = tasks.find(t => t.id === id);
            if (task) {
                task.completed = !task.completed;
                saveTasks();
            }
        };

        // Modifier une tâche
        window.editTask = function(id) {
            const task = tasks.find(t => t.id === id);
            if (task) {
                const newTitle = prompt('Modifier la tâche :', task.title);
                if (newTitle && newTitle.trim()) {
                    task.title = newTitle.trim();
                    saveTasks();
                }
            }
        };

        // Supprimer une tâche
        window.deleteTask = function(id) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')) {
                tasks = tasks.filter(t => t.id !== id);
                saveTasks();
            }
        };

        // Recherche
        const searchInput = document.querySelector('.navbar-search input');
        searchInput.addEventListener('input', (e) => {
            searchTerm = e.target.value;
            renderTasks();
        });

        // Filtres
        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                currentFilter = btn.dataset.filter;
                renderTasks();
            });
        });

        // Tri
        sortSelect.addEventListener('change', (e) => {
            sortBy = e.target.value;
            renderTasks();
        });

        // Événements
        addTaskBtn.addEventListener('click', addTask);

        taskInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                addTask();
            }
        });

        // Initialisation
        taskDate.value = new Date().toISOString().split('T')[0];
        updateStats();
        renderTasks();

        // Fermer la sidebar quand on clique en dehors sur mobile
        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 1024) {
                if (!sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });
    </script>
</body>
</html>
