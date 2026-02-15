@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Modifier Une Tâche</h1>

    <form action="{{route('taches.update' , $tache->id)}}" method="POST" class="task-form">

     @csrf
     @method('PUT')
        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" name="titre" id="title" value="{{$tache->titre}}">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="4" >{{$tache->description}}</textarea>
        </div>

        <div class="form-group">
            <label for="priorite">Priorité</label>
            <select name="priorite" id="priorite" required>
                <option value="" disabled selected>Choisir la priorité</option>
                <option value="moyenne" {{old('priorite' , $tache->priorite) == 'moyenne' ? 'selected' : ''}}>Moyenne</option>
                <option value="faible"  {{old('priorite , $tache->priorite') == 'faible' ? 'selected' : ''}}> Faible</option>
                <option value="faible"  {{old('priorite , $tache->priorite') == 'haute' ? 'selected' : ''}}> Haute</option>
            </select>
        </div>

        <div class="form-group form-actions">
            <button type="submit" class="btn-submit">Modifier la tâche</button>
        </div>
    </form>
@endsection
