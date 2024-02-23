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
    <h1>Liste des quartiers</h1>
</div>
<!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Quartiers</h5>
                    <div class="col-md-11 text-end move-up">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#openModal"><i class="bi bi-plus-circle"></i> Ajouter</button>
                    </div>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th class="col-4"> Nom </th>
                                <th class="col-5"> Nom de la commune</th>
                                <th class="col-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quartiers as $quartier)
                            <tr>
                                <td>{{ $quartier->name }}</td>
                                <td>{{ $quartier->commune->name }}</td>
                                <td>
                                    <!-- <button type="button" class="btn btn-outline-info" onclick="window.location.href='{{ route('pages.quartier.show', ['id' => $quartier->id]) }}'"><i class="bi bi-eye"></i> Détails</button> -->
                                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#editQuartierModal_{{ $quartier->id }}" data-quartier-id="{{ $quartier->id }}"><i class="bi bi-pencil-square"></i> Modifier</button>
                                    <button type="button" class="btn btn-outline-danger" onclick="openDeleteModalQuartier('{{ $quartier->id }}')"><i class="bi bi-trash"></i> Supprimer</button>
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

<!-- Add quartier Modal -->
<div class="modal fade" id="openModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un quartier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" method="POST" action="{{ route('pages.quartier.store') }}" novalidate>
                    {{ csrf_field() }}
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="name" id="name" :value="old('name')"
                                placeholder="Name" required autofocus>
                            <label for="name">Name</label>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="id_commune" name="id_commune" aria-label="Commune">
                            @foreach($communes as $commune)
                            <option value="{{$commune->id}}">{{$commune->name}}</option>
                            @endforeach
                        </select>
                        <label for="id_commune">Commune</label>
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
<!-- End Add quartier Modal -->

<!-- Edit quartier Modal -->
@foreach($quartiers as $index => $quartier)
<div class="modal fade" id="editQuartierModal_{{ $quartier->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier un quartier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" method="POST" action="{{ route('pages.quartier.update', $quartier->id) }}" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="name" id="quartier_name_{{ $quartier->id }}" value="{{ $quartier->name }}" placeholder="Name" required autofocus>
                            <label for="quartier_name_{{ $quartier->id }}">Name</label>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="id_commune_{{ $quartier->id }}" name="id_commune" aria-label="Commune">
                            @foreach($communes as $commune)
                            <option value="{{ $commune->id }}" {{ $commune->id == $quartier->id_commune ? 'selected' : '' }}>{{ $commune->name }}</option>
                            @endforeach
                        </select>
                        <label for="id_commune_{{ $quartier->id }}">Commune</label>
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
<!-- End Edit quartier Modal -->

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="deleteQuartierModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmer la suppression du quartier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer ce quartier?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" onclick="confirmDeleteQuartier()">Supprimer</button>
            </div>
        </div>
    </div>
</div>
<form id="deleteQuartierForm" method="POST"  style="display: none;">
    @csrf
    @method('DELETE')
    <input type="hidden" name="quartier_id" id="deleteQuartierIdInput">
</form>
<!--End Modal de confirmation de suppression -->

<script>

    function openDeleteModalQuartier(quartierId) {
        deleteQuartierId = quartierId;
        $('#deleteQuartierModal').modal('show');

    }

    function confirmDeleteQuartier() {
        var form = document.getElementById('deleteQuartierForm');
        if (form) {
          form.action = '/quartier/' + deleteQuartierId;
            form.submit();
        } else {
            console.error('Le formulaire de suppression est introuvable.');
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        editQuartierBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var quartierId = this.getAttribute('data-quartier-id');
                openEditModalQuartier(quartierId);
            });
        });
    });

    function openEditModalQuartier(quartierId) {
        var modal = new bootstrap.Modal(document.getElementById('editQuartierModal_' + quartierId));
        modal.show();
    }
</script>

@endsection
</x-pages-index>