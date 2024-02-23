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
    <h1>Liste des habitants</h1>
</div>
<!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Habitants</h5>
                    <div class="col-md-11 text-end move-up">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#openModal"><i class="bi bi-plus-circle"></i> Ajouter</button>
                    </div>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Prénom</th>
                                <th>Nom</th>
                                <th>Téléphone</th>
                                <th>Maison</th>
                                <th class="col-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($habitants as $habitant)
                            <tr>
                                <td>{{ $habitant->prenom }}</td>
                                <td>{{ $habitant->nom }}</td>
                                <td>{{ $habitant->telephone }}</td>
                                <td>{{ $habitant->maison->rue }}</td>
                                <td>
                                    <button type="button" class="btn btn-outline-info" onclick="window.location.href='{{ route('pages.habitant.show', ['id' => $habitant->id]) }}'"><i class="bi bi-eye"></i> Détails</button>
                                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editHabitantModal_{{ $habitant->id }}" data-habitant-id="{{ $habitant->id }}"><i class="bi bi-pencil-square"></i> Modifier</button>
                                    <button type="button" class="btn btn-outline-danger" onclick="openDeleteModalHabitant('{{ $habitant->id }}')"><i class="bi bi-trash"></i> Supprimer</button>
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

<!-- Add habitant Modal -->
<div class="modal fade" id="openModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un habitant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" method="POST" action="{{ route('pages.habitant.store') }}" novalidate>
                    {{ csrf_field() }}
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="prenom" id="prenom" :value="old('prenom')"
                                placeholder="Prénom" required autofocus>
                            <label for="prenom">Prénom</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="nom" id="nom" :value="old('nom')"
                                placeholder="Nom" required autofocus>
                            <label for="nom">Nom</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="tel" class="form-control" name="telephone" id="telephone" :value="old('telephone')"
                                placeholder="Téléphone" required autofocus>
                            <label for="telephone">Téléphone</label>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="id_maison" name="id_maison" aria-label="Maison">
                            @foreach($maisons as $maison)
                            <option value="{{$maison->id}}">{{$maison->rue}}</option>
                            @endforeach
                        </select>
                        <label for="id_maison">Maison</label>
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
<!-- End Add habitant Modal -->

<!-- Edit habitant Modal -->
@foreach($habitants as $index => $habitant)
<div class="modal fade" id="editHabitantModal_{{ $habitant->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier un habitant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" method="POST" action="{{ route('pages.habitant.update', $habitant->id) }}" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="prenom" id="habitant_prenom_{{ $habitant->id }}" value="{{ $habitant->prenom }}" placeholder="Prénom" required autofocus>
                            <label for="habitant_prenom_{{ $habitant->id }}">Prénom</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="nom" id="habitant_nom_{{ $habitant->id }}" value="{{ $habitant->nom }}" placeholder="Nom" required autofocus>
                            <label for="habitant_nom_{{ $habitant->id }}">Nom</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="telephone" id="habitant_telephone_{{ $habitant->id }}" value="{{ $habitant->telephone }}" placeholder="Téléphone" required autofocus>
                            <label for="habitant_telephone_{{ $habitant->id }}">Téléphone</label>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="id_maison_{{ $habitant->id }}" name="id_maison" aria-label="Maison">
                            @foreach($maisons as $maison)
                            <option value="{{ $maison->id }}" {{ $maison->id == $habitant->id_maison ? 'selected' : '' }}>{{ $maison->rue }}</option>
                            @endforeach
                        </select>
                        <label for="id_maison_{{ $habitant->id }}">Maison</label>
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
<!-- End Edit habitant Modal -->

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="deleteHabitantModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmer la suppression de l'habitant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer cet habitant?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" onclick="confirmDeleteHabitant()">Supprimer</button>
            </div>
        </div>
    </div>
</div>
<form id="deleteHabitantForm" method="POST"  style="display: none;">
    @csrf
    @method('DELETE')
    <input type="hidden" name="habitant_id" id="deleteHabitantIdInput">
</form>
<!--End Modal de confirmation de suppression -->

<script>

    function openDeleteModalHabitant(HabitantId) {
        deleteHabitantId = HabitantId;
        $('#deleteHabitantModal').modal('show');

    }

    function confirmDeleteHabitant() {
        var form = document.getElementById('deleteHabitantForm');
        if (form) {
          form.action = '/habitant/' + deleteHabitantId;
            form.submit();
        } else {
            console.error('Le formulaire de suppression est introuvable.');
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        editHabitantBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var HabitantId = this.getAttribute('data-habitant-id');
                openEditModalHabitant(HabitantId);
            });
        });
    });

    function openEditModalHabitant(HabitantId) {
        var modal = new bootstrap.Modal(document.getElementById('editHabitantModal_' + HabitantId));
        modal.show();
    }
</script>

@endsection
</x-pages-index>