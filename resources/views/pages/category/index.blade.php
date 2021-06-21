@extends('layouts.backend')

@section('content')
<!-- Hero -->
<div class="bg-body-light">
     <div class="content content-full">
          <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
               <h1 class="flex-sm-fill h3 my-2">
                    Category <small
                         class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Manage
                         Category</small>
               </h1>
               <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                         <li class="breadcrumb-item">Dashboard</li>
                         <li class="breadcrumb-item" aria-current="page">
                              <a class="link-fx" href="">Category</a>
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
               <h3 class="block-title">New Category</h3>
          </div>
          <form action="{{ route('category.store') }}" method="POST">
               @csrf
               <div class="block-content">
                    <div class="form-group">
                         <label for="name">Category Name</label>
                         <input type="text" class="form-control" name="name" placeholder="Enter category name">
                         @error('name')
                         <span class="text-danger">{{ $message }}</span>
                         @enderror
                    </div>
                    <button class="btn btn-primary mb-3" type="submit">Submit </button>
               </div>


          </form>
     </div>
     <!-- END Your Block -->
     <!-- Your Block -->
     <div class="block block-rounded">
          <div class="block-header">
               <h3 class="block-title"> Category List </h3>
          </div>

          <div class="block-content">
               <table class="table">
                    <tr>
                         <th>SL</th>
                         <th>Category Name</th>
                         <th>Total sub-category</th>
                         <th>Action</th>
                    </tr>

                    @foreach ($categories as $category)
                    <tr>
                         <td>{{ $loop->iteration }}</td>
                         <td>{{ $category->name }}</td>
                         <td>
                              {{ $category->sub_categories->count() }}
                         </td>
                         <td>
                              <a href="{{ route('category.edit', $category->id) }}"
                                   class="btn btn-primary btn-sm">Edit</a>
                              <form class="d-inline" action="{{ route('category.destroy', $category->id) }}"
                                   method="POST">
                                   @csrf
                                   @method('DELETE')
                                   <button type="submit" onclick="return confirm('Are you sure ?')"
                                        class="btn btn-danger btn-sm">Delete</button>
                              </form>
                         </td>
                    </tr>
                    @endforeach
               </table>
          </div>



     </div>
     <!-- END Your Block -->
</div>
<!-- END Page Content -->
@endsection