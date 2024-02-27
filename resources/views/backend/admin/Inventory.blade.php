@extends('backend.admin.layouts.index')
@section('admin-content')
<div class="container">


<div class="container pt-3" style="width: 1240px;">
    <hr>
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center fw-bold">Total Product</h5>
                    <p class="card-text text-center ">20</p>
                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center fw-bold">Total Purchase</h5>
                    <p class="card-text text-center">700</p>
                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center fw-bold">Total Sell</h5>
                    <p class="card-text text-center">445</p>
                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                </div>
            </div>
        </div>
    </div>

    <hr>
</div>


<div class="container pt-5">

    <div class="row">

        <div class="col-sm-2" id="T-shirt">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-center ">T-shirt</h5>
                </div>
            </div>
        </div>

        <div class="col-sm-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-center ">oppo vs</h5>
                </div>
            </div>
        </div>

        <div class="col-sm-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-center ">Wifi Router</h5>
                </div>
            </div>
        </div>

        <div class="col-sm-2" >
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-center ">Mans Pents</h5>
                </div>
            </div>
        </div>

        <div class="col-sm-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-center ">Kites</h5>
                </div>
            </div>
        </div>

        <div class="col-sm-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-center ">Pots</h5>
                </div>
            </div>
        </div>

        

    </div>

</div>




</div>
@section('admin-footer')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.2/dist/jquery.min.js"></script>

<script>
    $(document).ready(function(){
        $(document).on("click" , "#T-shirt" , function(){
         alert("Here You see this product information related to inventory, purchase and sell")
        });
    });
</script>
@endsection
@endsection