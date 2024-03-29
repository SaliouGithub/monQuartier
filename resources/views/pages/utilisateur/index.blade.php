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
                <button type="button" class="btn btn-primary"  onclick="window.location.href='{{ url('/utilisateur/create') }}'"><i class="bi bi-plus-circle"></i> Ajouter</button>
                <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal"><i class="bi bi-plus-circle"></i> Ajouter</button> -->
              </div>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>           
                  <tr>
                    <th>Nom complet</th>
                    <th>Email</th>
                    <th>Est admin</th>
                    <th>Action</th>

                  </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="{{ $user->admin == 1 ? 'green' : 'red' }}">
                        <span class="badge {{ $user->admin == 1 ? 'bg-success' : 'bg-danger' }}">
                            {{ $user->admin == 1 ? 'OUI' : 'NON' }}
                        </span>
                    </td>                    
                    <td  class="text-end"> 
                      <button type="button" class="btn btn-outline-info" onclick="window.location.href='{{ route('pages.utilisateur.show', ['id' => $user->id]) }}'"><i class="bi bi-eye"></i> Détails</button>  
                      <button type="button" class="btn btn-outline-success"><i class="bi bi-pencil-square"></i> Edit</button>  
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
@endsection

