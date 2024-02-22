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
      <h1>Liste des maisons</h1>
    </div>
    <!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Maisons</h5>
              <div class="col-md-11 text-end move-up">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#openModal"><i class="bi bi-plus-circle"></i> Ajouter</button>
              </div>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>           
                  <tr>
                    <th class="col-4"> Surface </th>
                    <th class="col-4"> Rue </th>
                    <th class="col-4">Action</th>

                  </tr>
                </thead>
                <tbody>
                @foreach($maisons as $maison)
                <tr>
                    <td>{{ $maison->surface }}  m²</td>
                    <td>{{ $maison->rue }}</td>
                    <td class="text-end"> 
                      <button type="button" class="btn btn-outline-info" onclick="window.location.href='{{ route('pages.maison.show', ['id' => $maison->id]) }}'"><i class="bi bi-eye"></i> Détails</button>  
                      <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editMaisonModal_{{ $maison->id }}" data-maison-id="{{ $maison->id }}"><i class="bi bi-pencil-square"></i> Edit</button>
                      <button type="button" class="btn btn-outline-danger" onclick="openDeleteModal('{{ $maison->id }}')"><i class="bi bi-trash"></i> Supprimer</button>
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
    
    <!-- Add maison Modal -->
    <div class="modal fade" id="openModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter une maison</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form class="row g-3" method="POST" action="{{ route('pages.maison.store') }}" novalidate>
                    {{ csrf_field() }}
                    <div class="col-md-12">
                      <div class="form-floating">
                          <input type="number" class="form-control" name="surface" id="surface" :value="old('surface')" placeholder="Surface" required autofocus>
                          <label for="surface">Surface</label>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-floating">
                          <input type="text" class="form-control" name="rue" id="rue" :value="old('rue')" placeholder="Rue" required autofocus>
                          <label for="rue">Rue</label>
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
    <!-- End Add maison Modal -->



    <!-- Edit maison Modal -->
    @foreach($maisons as $index => $maison)
    <!-- <div class="modal fade" id="editMaisonModal" tabindex="-1" aria-hidden="true"> -->
    <div class="modal fade" id="editMaisonModal_{{ $maison->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier une maison</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" method="POST" action="{{ route('pages.maison.update', $maison->id) }}" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="number" class="form-control" name="surface" id="surface" value="{{ $maison->surface }}" placeholder="Surface" required autofocus>
                                <label for="surface">Surface</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="rue" id="rue" value="{{ $maison->rue }}" placeholder="Rue" required autofocus>
                                <label for="rue">Rue</label>
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
    <!-- End Edit maison Modal -->


    <!-- Modal de confirmation de suppression -->
    <div class="modal fade" id="deleteMaisonModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmer la suppression de la maison</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir supprimer cette maison?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" onclick="confirmDelete()">Supprimer</button>
                </div>
            </div>
        </div>
    </div>
    <form id="deleteMaisonForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
    <!--End Modal de confirmation de suppression -->


  <script>
    var deleteMaisonId;

    function openDeleteModal(MaisonId) {
        deleteMaisonId = MaisonId;
        $('#deleteMaisonModal').modal('show');
    }

    function confirmDelete() {
        var form = document.getElementById('deleteMaisonForm');
        if (form) {
            form.action = '/maison/' + deleteMaisonId;
            form.submit();
        } else {
            console.error('Le formulaire de suppression est introuvable.');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        editMaisonBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var MaisonId = this.getAttribute('data-maison-id');
                openEditModal(MaisonId);
            });
        });
    });

    function openEditModal(MaisonId) {
        var modal = new bootstrap.Modal(document.getElementById('editMaisonModal_' + MaisonId));
        modal.show();
    }
    
  </script>




@endsection
</x-pages-index>