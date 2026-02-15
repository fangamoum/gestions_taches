@extends('layouts.app')

@section('content')
   <div class="content-area">
                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon total">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <div class="stat-details">
                            <h3 id="totalTasks">{{$total_taches}}</h3>
                            <p>Tâches totales</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon completed">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-details">
                            <h3 id="completedTasks">0</h3>
                            <p>Terminées</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon pending">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-details">
                            <h3 id="pendingTasks">0</h3>
                            <p>En cours</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon overdue">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="stat-details">
                            <h3 id="overdueTasks">0</h3>
                            <p>En retard</p>
                        </div>
                    </div>
                </div>

                <!-- Filters Bar -->
                <div class="filters-bar">
                    <div class="filter-group">
                        <button class="filter-btn active" data-filter="all">Toutes</button>
                        <button class="filter-btn" data-filter="pending">En cours</button>
                        <button class="filter-btn" data-filter="completed">Terminées</button>
                        <button class="filter-btn" data-filter="overdue">En retard</button>
                    </div>
                    <select class="sort-select" id="sortSelect">
                        <option value="date">Trier par date</option>
                        <option value="priority">Trier par priorité</option>
                        <option value="title">Trier par titre</option>
                    </select>
                </div>

                <!-- Tasks List -->
                 <a class="add-taks" href="{{route('taches.create')}}">Ajouter une taches</a>
                <div class="tasks-container">
                  @if(session('success'))
                    <div class="alert alert-succes">
                        {{session('success')}}
                    </div>
                  @endif
                    <div class="tasks-header">
                        <h3>Mes tâches</h3>
                        <span class="tasks-count" id="tasksCount">0 tâche(s)</span>
                    </div>
                    <div id="tasksList">
                        <!-- Tasks will be injected here -->
                    </div>
                </div>
            </div>

@endsection

