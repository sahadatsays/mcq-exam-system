@extends('layouts.backend')

@section('content')
<!-- Hero -->
<div class="bg-body-light">
     <div class="content content-full">
          <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
               <h1 class="flex-sm-fill h3 my-2">
                    Examination <small
                         class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Manage
                         Examination</small>
               </h1>
               <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                         <li class="breadcrumb-item">Dashboard</li>
                         <li class="breadcrumb-item" aria-current="page">
                              <a class="link-fx" href="">Examination</a>
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
               <h3 class="block-title">New Examination</h3>
          </div>
          <form action="{{ route('exam.store') }}" method="POST">
               @csrf
               <div class="block-content">
                    <div class="row">
                         <div class="col-md-12">
                              <div class="form-group">
                                   <label for="name">Examination Name</label>
                                   <input type="text" class="form-control" name="name" placeholder="Enter exam name">
                                   @error('name')
                                   <span class="text-danger">{{ $message }}</span>
                                   @enderror
                              </div>
                         </div>
                    </div>
                    <div class="row">
                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="name">Category</label>
                                   <select name="category" id="category" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                   </select>
                                   @error('category')
                                   <span class="text-danger">{{ $message }}</span>
                                   @enderror
                              </div>
                         </div>
                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="name">Sub Category</label>
                                   <select name="sub_category" required id="sub_category" class="form-control">
                                        <option value="">Select Sub Category</option>
                                   </select>
                                   @error('sub_category')
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

     <div class="block block-content">
          <form>
               <div class="row">
                    <div class="col-md-6">
                         <div class="form-group">
                              <label for="category">Category</label>
                              <select name="category" class="form-control" id="f_category">
                                   <option value="">Select Category</option>
                                   @foreach ($categories as $category)
                                   <option value="{{ $category->id }}">{{ $category->name }}</option>
                                   @endforeach
                              </select>
                         </div>
                    </div>
                    <div class="col-md-6">
                         <div class="form-group">
                              <label for="name">Sub Category</label>
                              <select name="sub_category" id="f_sub_category" class="form-control">
                                   <option value="">Select Sub Category</option>
                              </select>
                              @error('sub_category')
                              <span class="text-danger">{{ $message }}</span>
                              @enderror
                         </div>
                    </div>
               </div>
               <div class="row justify-content-center mb-3">
                    <button type="submit" class="btn btn-primary mr-3">Filter</button>
                    <a href="{{ request()->url() }}" class="btn btn-dark">Reset Filter</a>
               </div>
          </form>
     </div>
     <!-- Your Block -->
     <div class="block block-rounded">
          <div class="block-header">
               <h3 class="block-title"> Examination List </h3>
          </div>

          <div class="block-content">
               <table class="table">
                    <tr>
                         <th>SL</th>
                         <th>Examination Name</th>
                         <th>Category </th>
                         <th>Sub Category </th>
                         <th>Total Questions</th>
                         <th>Action</th>
                    </tr>

                    @foreach ($exam_list as $exam)
                    <tr>
                         <td>{{ $loop->iteration }}</td>
                         <td>{{ $exam->name }}</td>
                         <td>{{ $exam->category->name }}</td>
                         <td>{{ $exam->sub_category->name }}</td>
                         <td>{{ $exam->questions->count() }}</td>
                         <td>
                              <a href="{{ route('exam.edit', $exam->id) }}" class="btn btn-primary btn-sm">Edit</a>
                              <form class="d-inline" action="{{ route('exam.destroy', $exam->id) }}" method="POST">
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

@section('js_after')
<script>
     $("#sub_category").attr('disabled', true);
     $(document).on('change', '#category', function  () {
          let catId = $(this).val();
          let url   = "{{ route('get_sub_by_cat', 'catId')  }}".replace('catId', catId);
          let options = '<option value="">Select Sub Category</option>';
          $.get(url, (data) => {
               let { sub_list } = data;
               sub_list.map((val, index) => {
                    options += `<option value=${val.id}>${val.name}</option>`
               });
               $("#sub_category").attr('disabled', false);
               $("#sub_category").html(options);
          }).catch(error => {
               if(error.status == 404) {
                    console.log('Page not found !');
               }
               $("#sub_category").html(options);
               $("#sub_category").attr('disabled', true);
          });
          
     });


     $("#f_sub_category").attr('disabled', true);
     $(document).on('change', '#f_category', function  () {
          let catId = $(this).val();
          let url   = "{{ route('get_sub_by_cat', 'catId')  }}".replace('catId', catId);
          let options = '<option value="">Select Sub Category</option>';
          $.get(url, (data) => {
               let { sub_list } = data;
               sub_list.map((val, index) => {
                    options += `<option value=${val.id}>${val.name}</option>`
               });
               $("#f_sub_category").attr('disabled', false);
               $("#f_sub_category").html(options);
          }).catch(error => {
               if(error.status == 404) {
                    console.log('Page not found !');
               }
               $("#f_sub_category").html(options);
               $("#f_sub_category").attr('disabled', true);
          });
          
     });
</script>
@endsection