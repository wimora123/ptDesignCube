@extends('indexDashboard')

@section('content')

<div class="container">
<h1 class="text-center pt-2 pb-2">List of subscription</h1>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Email</th>
            <th scope="col">IP</th>
            <th scope="col">Date</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="tbodyData">
          
        </tbody>
    </table>
</div>

<div class="container pt-2">
<h1 class="text-center">Subscription Form</h1>
<div class="successInput alert alert-success text-center"></div>
    <form id="formInput">
        <div class="form-group">
            <label>Email address</label>
            <input type="text" class="form-control" placeholder="Enter email" name="email">
            <small id="emailDanger"></small>
        </div>
        <div class="form-group">
            <label>IP</label>
            <input type="text" class="form-control" placeholder="Enter IP" name="ip">
            <small id="IPDanger"></small>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection