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
              <form class="row g-3">
                  <div class="col-md-12">
                      <div class="form-floating">
                          <input type="text" class="form-control" name="name" id="name" :value="old('name')" placeholder="Name" required autofocus>
                          <label for="name">Name</label>
                      </div>
                  </div>
                  
                  <div class="form-floating mb-3">
                      <select class="form-select" id="floatingSelect" aria-label="Commune">
                          @foreach($communes as $commune)
                            <option value="{{$commune->id}}">{{$commune->name}}</option>
                          @endforeach
                      </select>
                      <label for="floatingSelect">Commune</label>
                  </div>
              </form>
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


<!-- @foreach ($communes as $commune)
  <option value="{{$commune->id}}">{{$commune->name}}</option>
@endforeach -->