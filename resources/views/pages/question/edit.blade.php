@extends('layouts.backend')

@section('content')
<!-- Hero -->
<div class="bg-body-light">
     <div class="content content-full">
          <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
               <h1 class="flex-sm-fill h3 my-2">
                    Question <small
                         class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Edit
                         Question</small>
               </h1>
               <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                         <li class="breadcrumb-item">Dashboard</li>
                         <li class="breadcrumb-item" aria-current="page">
                              <a class="link-fx" href="">Edit Question </a>
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
               <h3 class="block-title">Edit Question </h3>
          </div>
          <form action="{{ route('question.update', $question->id) }}" method="POST">
               @csrf
               @method('PUT')
               <div class="block-content">
                    <div class="row">
                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="category">Category</label>
                                   <select name="category_id" class="form-control" id="category">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                        <option {{ $question->category_id == $category->id ? 'selected' : '' }}
                                             value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                   </select>
                                   @error('category_id')
                                   <span class="text-danger">{{ $message }}</span>
                                   @enderror
                              </div>
                         </div>
                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="name">Sub Category</label>
                                   <select name="sub_category_id" id="sub_category" class="form-control">
                                        <option value="{{ $question->sub_category_id }}">
                                             {{ $question->sub_category->name }}</option>
                                   </select>
                                   @error('sub_category_id')
                                   <span class="text-danger">{{ $message }}</span>
                                   @enderror
                              </div>
                         </div>
                    </div>
                    <div class="row">
                         <div class="col-md-12">
                              <div class="form-group">
                                   <label for="name">Question</label>
                                   <input type="text" class="form-control" name="question"
                                        value="{{ $question->question }}" />
                                   @error('question')
                                   <span class="text-danger">{{ $message }}</span>
                                   @enderror
                              </div>
                         </div>
                    </div>

                    <div class="row">
                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="name">A</label>
                                   <input type="text" class="form-control" name="a" value="{{ $question->a }}">
                                   @error('a')
                                   <span class="text-danger">{{ $message }}</span>
                                   @enderror
                              </div>
                         </div>

                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="name">B</label>
                                   <input type="text" class="form-control" name="b" value="{{ $question->b }}">
                                   @error('b')
                                   <span class="text-danger">{{ $message }}</span>
                                   @enderror
                              </div>
                         </div>
                    </div>

                    <div class="row">
                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="name">C</label>
                                   <input type="text" class="form-control" name="c" value="{{ $question->c }}">
                                   @error('c')
                                   <span class="text-danger">{{ $message }}</span>
                                   @enderror
                              </div>
                         </div>

                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="name">D</label>
                                   <input type="text" class="form-control" name="d" value="{{ $question->d }}">
                                   @error('d')
                                   <span class="text-danger">{{ $message }}</span>
                                   @enderror
                              </div>
                         </div>
                    </div>

                    <div class="row">
                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="name">Answer of Option</label>
                                   <select name="right_option" class="form-control">
                                        <option {{ $question->right_option == 'a' ? 'selected' : '' }} value="a">A
                                        </option>
                                        <option {{ $question->right_option == 'b' ? 'selected' : '' }} value="b">B
                                        </option>
                                        <option {{ $question->right_option == 'c' ? 'selected' : '' }} value="c">C
                                        </option>
                                        <option {{ $question->right_option == 'd' ? 'selected' : '' }} value="d">D
                                        </option>
                                   </select>
                                   @error('right_option')
                                   <span class="text-danger">{{ $message }}</span>
                                   @enderror
                              </div>
                         </div>
                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="name">Answer Time</label>
                                   <input type="text" class="form-control" name="time" value="{{ $question->q_time }}">
                                   @error('time')
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