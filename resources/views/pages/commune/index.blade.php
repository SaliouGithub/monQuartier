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
      <h1>Liste des communes</h1>
    </div>
    <!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Communes</h5>
              <div class="col-md-11 text-end move-up">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#openModal"><i class="bi bi-plus-circle"></i> Ajouter</button>
              </div>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>           
                  <tr>
                    <th class="col-8">
                      <b>N</b>ame
                    </th>
                    <th class="col-4">Option</th>

                  </tr>
                </thead>
                <tbody>
                @foreach($communes as $commune)
                <tr>
                    <td>{{ $commune->name }}</td>
                    <td class="text-end"> 
                      <button type="button" class="btn btn-outline-info" onclick="window.location.href='{{ route('pages.commune.show', ['id' => $commune->id]) }}'"><i class="bi bi-eye"></i> Détails</button>  
                      <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editCommuneModal_{{ $commune->id }}" data-commune-id="{{ $commune->id }}"><i class="bi bi-pencil-square"></i> Edit</button>
                      <button type="button" class="btn btn-outline-danger" onclick="openDeleteModal('{{ $commune->id }}')"><i class="bi bi-trash"></i> Supprimer</button>
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
    
    <!-- Add commune Modal -->
    <div class="modal fade" id="openModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter une commune</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form class="row g-3" method="POST" action="{{ route('pages.commune.store') }}" novalidate>
                    {{ csrf_field() }}
                    <div class="col-md-12">
                      <div class="form-floating">
                          <input type="text" class="form-control" name="name" id="name" :value="old('name')" placeholder="Name" required autofocus>
                          <label for="name">Name</label>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Valider</button>
                      </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Add commune Modal -->



    <!-- Edit commune Modal -->
    @foreach($communes as $index => $commune)
    <!-- <div class="modal fade" id="editCommuneModal" tabindex="-1" aria-hidden="true"> -->
    <div class="modal fade" id="editCommuneModal_{{ $commune->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier une commune</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" method="POST" action="{{ route('pages.commune.update', $commune->id) }}" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="name" id="name" value="{{ $commune->name }}" placeholder="Name" required autofocus>
                                <label for="name">Name</label>
                            </div>
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
    <!-- End Edit commune Modal -->


    <!-- Modal de confirmation de suppression -->
    <div class="modal fade" id="deleteCommuneModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmer la suppression de la commune</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir supprimer cette commune?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" onclick="confirmDelete()">Supprimer</button>
                </div>
            </div>
        </div>
    </div>
    <form id="deleteCommuneForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
    <!--End Modal de confirmation de suppression -->


  <script>
    var deleteCommuneId;

    function openDeleteModal(communeId) {
        deleteCommuneId = communeId;
        $('#deleteCommuneModal').modal('show');
    }

    function confirmDelete() {
        var form = document.getElementById('deleteCommuneForm');
        if (form) {
            form.action = '/commune/' + deleteCommuneId;
            form.submit();
        } else {
            console.error('Le formulaire de suppression est introuvable.');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        var editCommuneBtns = document.querySelectorAll('.btn-outline-secondary[data-bs-target^="#editCommuneModal"]');
        editCommuneBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var communeId = this.getAttribute('data-commune-id');
                openEditModal(communeId);
            });
        });
    });

    function openEditModal(communeId) {
        var modal = new bootstrap.Modal(document.getElementById('editCommuneModal_' + communeId));
        modal.show();
    }
    
  </script>




@endsection
</x-pages-index>