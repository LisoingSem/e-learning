@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            <div class="card">
                <div class="card-body">
                    <div>
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <label for="kh" class="col-form-label text-md-end">គោត្តនាម នាម</label>
                                <input id="kh" type="text"
                                    class="form-control" name="username"
                                    value="{{$user->kh}}" placeholder="ឈ្មោះជាភាសាខ្មែរ" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <label for="en" class="col-form-label text-md-end">គោត្តនាម នាម (ឡាតាំង)</label>
                                <input id="end" type="text"
                                    class="form-control" name="en"
                                    value="{{$user->en}}" placeholder="ឈ្មោះជាអក្សឡាតាំង" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <label for="en" class="col-form-label text-md-end">មុខតំណែ</label>
                                <input id="end" type="text"
                                    class="form-control" name="en"
                                    value="{{$user->role_name_kh}} ({{$user->role_name_en}})" required>
                            </div>
                        </div>
</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection