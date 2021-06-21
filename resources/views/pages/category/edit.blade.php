@extends('layouts.backend')

@section('content')
<!-- Hero -->
<div class="bg-body-light">
     <div class="content content-full">
          <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
               <h1 class="flex-sm-fill h3 my-2">
                    Category <small
                         class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Edit
                         Category</small>
               </h1>
               <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                         <li class="breadcrumb-item">Dashboard</li>
                         <li class="breadcrumb-item" aria-current="page">
                              <a class="link-fx" href="">Edit Category</a>
                         </li>
                    </ol>
               </nav>
          </div>
     </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
     <!-- Your Block -->
     <div class="block block-rounded">
          <div class="block-header">
               <h3 class="block-title">Edit Category</h3>
          </div>
          <form action="{{ route('category.update', $category->id) }}" method="POST">
               @csrf
               @method('PUT')
               <div class="block-content">
                    <div class="form-group">
                         <label for="name">Category Name</label>
                         <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                         @error('name')
                         <span class="text-danger">{{ $message }}</span>
                         @enderror
                    </div>
                    <button class="btn btn-primary mb-3" type="submit">Update </button>
               </div>


          </form>
     </div>
     <!-- END Your Block -->

</div>
<!-- END Page Content -->
@endsection