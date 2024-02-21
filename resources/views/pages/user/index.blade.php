@extends('pages.index')

@section('content')
 
<div class="pagetitle">
      <h1>Liste des utilisateurs</h1>

    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Utilisateurs</h5>
              <div class="col-md-11 text-end move-up">
                <!-- <button type="button" class="btn btn-primary"  onclick="window.location.href='{{ url('/utilisateur/create') }}'"><i class="bi bi-plus-circle"></i> Ajouter</button> -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal"><i class="bi bi-plus-circle"></i> Ajouter</button>
              </div>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>           
                  <tr>
                    <th>
                      <b>N</b>ame
                    </th>
                    <th>Email</th>
                    <th>Status</th>
                    <th></th>

                  </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="green"><span class="badge bg-success">Approved</span></td>
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

    <!-- Add User Modal -->
  <div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Ajouter un utilisateur</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <label for="email" class="form-label">Name</label>
                <input type="text" name="name" :value="old('name')" class="form-control" id="name" required autofocus>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
              </div>
          </div>
      </div>
  </div>
<!-- End Add User Modal -->
@endsection

