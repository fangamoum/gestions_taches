@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Ajouter une nouvelle tâche</h1>

    <form action="{{route('taches.store')}}" method="POST" class="task-form">

     @csrf
        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" name="titre" id="title" placeholder="Titre de la tâche" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="4" placeholder="Détails de la tâche"></textarea>
        </div>

        <div class="form-group">
            <label for="priorite">Priorité</label>
            <select name="priorite" id="priorite" required>
                <option value="" disabled selected>Choisir la priorité</option>
                <option value="faible">Faible</option>
                <option value="moyenne">Moyenne</option>
                <option value="haute">Haute</option>
            </select>
        </div>

        <div class="form-group form-actions">
            <button type="submit" class="btn-submit">Ajouter la tâche</button>
            <a href="" class="btn-cancel">Annuler</a>
        </div>
    </form>
@endsection
