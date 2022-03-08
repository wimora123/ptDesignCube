@extends('indexDashboard')


@section('content')

<div class="container-fluid">
    <form>
        <div class="form-group">
            <label>Select Province</label>
            <select class="form-control" id="province">
            <option selected>Select Province</option>
            @foreach($dataProv AS $prov):
            <option  value="{{ $prov->id }}">{{ $prov->name }}</option>
            @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Select Regency</label>
            <select class="form-control" id="regency">
            <option selected>Select Regency</option>
            </select>
        </div>
        <div class="form-group">
            <label>Select Subdistrict</label>
            <select class="form-control" id="subdistrict">
            <option selected>Select Subdistrict</option>
            </select>
        </div>
        <div class="form-group">
            <label>Select Regency</label>
            <select class="form-control" id="village">
            <option selected>Select Regency</option>
            </select>
        </div>
    </form>
</div>

@endsection