@extends('layouts.backend')

@section('content')
<!-- Hero -->
<div class="bg-body-light">
     <div class="content content-full">
          <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
               <h1 class="flex-sm-fill h3 my-2">
                    Sub Category <small
                         class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Manage Sub
                         Category</small>
               </h1>
               <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                         <li class="breadcrumb-item">Dashboard</li>
                         <li class="breadcrumb-item" aria-current="page">
                              <a class="link-fx" href="">Sub Category</a>
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
               <h3 class="block-title">New Sub Category</h3>
          </div>
          <form action="{{ route('sub-category.store') }}" method="POST">
               @csrf
               <div class="block-content">
                    <div class="row">
                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="name">Sub Category Name</label>
                                   <input type="text" class="form-control" name="name"
                                        placeholder="Enter sub category name">
                                   @error('name')
                                   <span class="text-danger">{{ $message }}</span>
                                   @enderror
                              </div>
                         </div>
                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="name">Category</label>
                                   <select name="category_id" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                   </select>
                                   @error('category_id')
                                   <span class="text-danger">{{ $message }}</span>
                                   @enderror
                              </div>
                         </div>
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
                         <th>Sub Category Name</th>
                         <th>Category</th>
                         <th>Action</th>
                    </tr>

                    @foreach ($sub_category_list as $category)
                    <tr>
                         <td>{{ $loop->iteration }}</td>
                         <td>{{ $category->name }}</td>
                         <td>{{ $category->category->name }}</td>
                         <td>
                              <a href="{{ route('sub-category.edit', $category->id) }}"
                                   class="btn btn-primary btn-sm">Edit</a>
                              <form class="d-inline" action="{{ route('sub-category.destroy', $category->id) }}"
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