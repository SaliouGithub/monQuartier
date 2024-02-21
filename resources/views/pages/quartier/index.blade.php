@extends('pages.index')

@section('content')
 
<div class="pagetitle">
      <h1>Liste des quartiers</h1>

    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Quartier</h5>
              <div class="col-md-11 text-end move-up">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#openModal"><i class="bi bi-plus-circle"></i> Ajouter</button>
              </div>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>           
                  <tr>
                    <th>
                      <b>N</b>ame
                    </th>
                    <th></th>

                  </tr>
                </thead>
                <tbody>
                @foreach($quartiers as $quartier)
                <tr>
                    <td>{{ $quartier->name }}</td>
                    <td> 
                      <button type="button" class="btn btn-outline-info"><i class="bi bi-eye"></i> Détails</button>  
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

    <!-- Add quartier Modal -->
    <div class="modal fade" id="openModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un quartier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" :value="old('name')" class="form-control" id="name" required autofocus>
                  </div>
                  <div class="row mb-3">
                    <label for="inputState" class="form-label">State</label>
                    <select id="inputState" class="form-select">
                      <option selected="">Choose...</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                    </select>
                  </div>
                <div class="d-flex justify-content-start">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
  <!-- End Add quartier Modal -->


@endsection


