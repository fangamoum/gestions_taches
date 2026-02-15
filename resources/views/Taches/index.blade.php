@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6 text-center">Mes tâches</h1>

    <!-- Bouton Ajouter -->
    <div class="mb-4 text-right">
        <a href="{{ route('taches.create') }}" class="btn-submit">+ Ajouter une tâche</a>
    </div>

    <!-- Message de succès -->
    @if(session('success'))
        <div class= "alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if($taches->count())
        <table class="task-table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Priorité</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($taches as $tache)
                    <tr>
                        <td>{{ $tache->titre }}</td>
                        <td>{{ $tache->description ?? '-' }}</td>
                        <td>
                            @if($tache->priorite == 'faible')
                                <span class="priority faible">Faible</span>
                            @elseif($tache->priorite == 'haute')
                                <span class="priority moyenne">Haute</span>
                            @else
                                <span class="priority haute">Moyenne</span>
                            @endif
                        </td>
                        <td>{{ ucfirst($tache->status) }}</td>
                        <td>
                            <!-- Actions futur: edit/delete -->
                            <a href="{{route('taches.edit',$tache->id)}}" class="btn-action edit">Edit</a>

                            <form method ="POST" action="{{route('taches.destroy', $tache->id)}}" style="display: inline-block;" onsubmit="return confirm('Voulez-vous vraiment supprimer cette tache ?')">
                                @csrf
                                @method('DELETE')
                               <button type="submit" class="btn btn-danger"> delete </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Aucune tâche pour le moment.</p>
    @endif

    <div class="mt-6 flex justify-center">
        {{$taches->links()}}
    </div>
@endsection
