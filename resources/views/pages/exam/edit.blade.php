@extends('layouts.backend')

@section('content')
<!-- Hero -->
<div class="bg-body-light">
     <div class="content content-full">
          <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
               <h1 class="flex-sm-fill h3 my-2">
                    Examination <small
                         class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Edit
                         Examination</small>
               </h1>
               <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                         <li class="breadcrumb-item">Dashboard</li>
                         <li class="breadcrumb-item" aria-current="page">
                              <a class="link-fx" href="">Edit Examination</a>
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
               <h3 class="block-title">Edit Examination</h3>
          </div>
          <form action="{{ route('exam.update', $exam->id) }}" method="POST">
               @csrf
               @method('PUT')
               <div class="block-content">
                    <div class="row">
                         <div class="col-md-12">
                              <div class="form-group">
                                   <label for="name">Examination Name</label>
                                   <input type="text" class="form-control" name="name" value="{{ $exam->name}}" />
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
                                        <option {{ $exam->category_id == $category->id ? 'selected' : '' }}
                                             value="{{ $category->id }}">{{ $category->name }}</option>
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
                                        <option value="{{ $exam->sub_category_id}}">{{ $exam->sub_category->name }}
                                        </option>
                                   </select>
                                   @error('sub_category')
                                   <span class="text-danger">{{ $message }}</span>
                                   @enderror
                              </div>
                         </div>
                    </div>
                    <button class="btn btn-primary mb-3" type="submit">Update </button>
               </div>


          </form>
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
</script>
@endsection