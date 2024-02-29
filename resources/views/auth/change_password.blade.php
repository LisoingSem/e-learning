@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('change_password.save')}}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <label for="password" class="col-form-label text-md-end">លេខម្ងាត់ថ្មី</label>
                                <input id="password" type="text"
                                    class="form-control" name="password"
                                    value="" placeholder="បញ្ចូលលេខម្ងាត់ថ្មី" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <label for="re_password" class="col-form-label text-md-end">បញ្ជាក់ឡើងវិញ</label>
                                <input id="re_password" type="text"
                                    class="form-control" name="re_password"
                                    placeholder="បញ្ចូលលេខម្ងាត់ថ្មីម្ដងទៀត" required>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-out-line">
                                    <i class="fas fa-save mr-2"></i>
                                    រក្សាទុក
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection