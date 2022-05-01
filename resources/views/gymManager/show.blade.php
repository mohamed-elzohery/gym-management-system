@extends('layouts.user-layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Show Gym Manager Number {{$singleUser->id}}</h4>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
<div class="card card-solid">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <h6 class="d-inline-block d-sm-none">Gym Manager Name : </h6>
                            <img class="img-fluid" src="{{ asset($singleUser->profile_image) }}">
                        </div>
                        <div class="col-12 col-sm-6 d-flex  align-items-center">
                            <div>
                                <p class="my-3" style="font-weight:bold"> Id :{{ $singleUser->id }}</p>
                                <p class="my-3" style="font-weight:bold"> Name :{{ $singleUser->name }}</p>
                                <p class="my-3" style="font-weight:bold"> Email :{{ $singleUser->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>


    </section>
</div>
<!-- /.content-wrapper -->
@endsection

