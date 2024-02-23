<x-pages-index>
@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-octagon me-1"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Page Title -->
<div class="pagetitle">
    <h1>Liste des délégués de quartier</h1>
</div>
<!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Délégués de quartiers</h5>
                    <div class="col-md-11 text-end move-up">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#openModal"><i class="bi bi-plus-circle"></i> Ajouter</button>
                    </div>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th class="col-4">Prénom </th>
                                <th class="col-3">Nom </th>
                                <th class="col-3">Téléphone</th>
                                <th class="col-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($delegueQuartiers as $delegue)
                            <tr>
                                <td>{{ $delegue->habitant->prenom }}</td>
                                <td>{{ $delegue->habitant->nom }}</td>
                                <td>{{ $delegue->habitant->telephone }}</td>
                                <td>
                                    <!-- <button type="button" class="btn btn-outline-info" onclick="window.location.href='{{ route('pages.delegue.show', ['id' => $delegue->id]) }}'"><i class="bi bi-eye"></i> Détails</button> -->
                                    <!-- <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#editDelegueModal_{{ $delegue->id }}" data-delegue-id="{{ $delegue->id }}"><i class="bi bi-pencil-square"></i> Modifier</button> -->
                                    <button type="button" class="btn btn-outline-danger" onclick="openDeleteModalDelegue('{{ $delegue->id }}')"><i class="bi bi-trash"></i> Supprimer</button>
                                </td>
                               
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
            </div>

        </div>
    </div>
</section>

<!-- Add delegue Modal -->
<div class="modal fade" id="openModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un délégué</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" method="POST" action="{{ route('pages.delegue.store') }}" novalidate>
                    {{ csrf_field() }}
                    <div class="form-floating mb-3">
                        <select class="form-select" id="id_habitant" name="id_habitant" aria-label="Nom complet habitant">
                            @foreach($habitants as $habitant)
                            <option value="{{$habitant->id}}">{{$habitant->prenom}} {{$habitant->nom}}</option>
                            @endforeach
                        </select>
                        <label for="id_habitant">Nom complet habitant</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Add delegue Modal -->

<!-- Edit delegue Modal -->
@foreach($delegueQuartiers as $index => $delegue)
<div class="modal fade" id="editDelegueModal_{{ $delegue->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier un délégué</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" method="POST" action="{{ route('pages.delegue.update', $delegue->id) }}" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="form-floating mb-3">
                        <select class="form-select" id="id_habitant_{{ $delegue->id }}" name="id_habitant" aria-label="Prénom habitant">
                            @foreach($habitants as $habitant)
                            <option value="{{ $habitant->id }}" {{ $habitant->id == $delegue->id_habitant ? 'selected' : '' }}>{{ $habitant->prenom }}</option>
                            @endforeach
                        </select>
                        <label for="id_habitant_{{ $delegue->id }}">Prénom habitant</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- End Edit delegue Modal -->

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="deleterDelegueModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmer la suppression du délégué</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer ce délégué de la liste?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" onclick="confirmDeleteDelegue()">Supprimer</button>
            </div>
        </div>
    </div>
</div>
<form id="deleteDelegueForm" method="POST"  style="display: none;">
    @csrf
    @method('DELETE')
    <input type="hidden" name="delegue_id" id="deleteDelegueIdInput">
</form>
<!--End Modal de confirmation de suppression -->

<script>

    function openDeleteModalDelegue(delegueId) {
        deleteDelegueId = delegueId;
        $('#deleterDelegueModal').modal('show');

    }

    function confirmDeleteDelegue() {
        var form = document.getElementById('deleteDelegueForm');
        if (form) {
          form.action = '/delegue/' + deleteDelegueId;
            form.submit();
        } else {
            console.error('Le formulaire de suppression est introuvable.');
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        editDelegueBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var delegueId = this.getAttribute('data-delegue-id');
                openEditModalDelegue(delegueId);
            });
        });
    });

    function openEditModalDelegue(delegueId) {
        var modal = new bootstrap.Modal(document.getElementById('editDelegueModal_' + delegueId));
        modal.show();
    }
</script>

@endsection
</x-pages-index>