@extends('pages.index')

@section('content')

<div class="pagetitle">
    <h1>Détails commune</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{ $communes->name }}" disabled="">
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection