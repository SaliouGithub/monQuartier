@extends('pages.index')

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

    <div class="pagetitle">
      <h1>Liste des communes</h1>
    </div><!-- End Page Title -->

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
                      <button type="button" class="btn btn-outline-info" onclick="window.location.href='{{ route('pages.commune.show', ['commune' => $commune->id]) }}'"><i class="bi bi-eye"></i> Détails</button>  
                      <button type="button" class="btn btn-outline-secondary"><i class="bi bi-pencil-square"></i> Edit</button>  
                      <button type="button" class="btn btn-outline-danger"><i class="bi bi-trash"></i> Delete</button>  
                    </td>
                    <!-- Ajoutez d'autres colonnes selon vos besoins -->
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
                <!-- <form class="row g-3 needs-validation" method="POST" action="{{ route('pages.commune.store') }}" novalidate>
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" :value="old('name')" class="form-control" id="name" required autofocus>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
                </form> -->
                <div class="modal-body">
                  <form class="row g-3" method="POST" action="{{ route('pages.commune.store') }}" novalidate>
                    {{ csrf_field() }}
                    <div class="col-md-12">
                      <div class="form-floating">
                          <input type="text" class="form-control" name="name" id="name" :value="old('name')" placeholder="Name" required autofocus>
                          <label for="name">Name</label>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Valider</button>
                      </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Add commune Modal -->

@endsection


