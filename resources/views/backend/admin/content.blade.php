@extends('backend.admin.layouts.index')
@section('admin-content')

<div class="container mt-5 rounded p-2  d-flex align-items-center justify-content-center flex-wrap bg-light" style="width: 1225px;">

   <div class="container d-flex align-items-center justify-content-center flex-wrap flex-column bg-dark p-5 m-2 rounded" style="width: 300px; margin: 0; padding: 0;">
      <h5 class="card-title text-light">Total User</h5>
      <h4 class="text-light"><?php echo $User; ?></h4>
      <a href="/admin/user" class="btn btn-outline-light">Go to User</a>
   </div>

   <div style="border: 2px solid black; height: 200px;" class="mx-5"></div>

   <div class="container d-flex align-items-center justify-content-center flex-wrap flex-column bg-dark p-5 m-2 rounded " style="width: 300px; margin: 0; padding: 0;">
      <h5 class=" card-title text-light">Total Category</h5>
      <h4 class="text-light"> <?php echo $category; ?></h4>
      <a href="/admin/category" class="btn btn-outline-light">Go to Category</a>
   </div>

</div>



@endsection