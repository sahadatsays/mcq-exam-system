@extends('layouts.backend')

@section('content')
<!-- Hero -->
<div class="bg-body-light">
     <div class="content content-full">
          <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
               <h1 class="flex-sm-fill h3 my-2">
                    Questions <small
                         class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Manage
                         Questions</small>
               </h1>
               <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                         <li class="breadcrumb-item">Dashboard</li>
                         <li class="breadcrumb-item" aria-current="page">
                              <a class="link-fx" href="">Questions</a>
                         </li>
                    </ol>
               </nav>
          </div>
     </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">

     <div class="block block-content">
          <form method="get">
               <div class="row">
                    <div class="col-md-6">
                         <div class="form-group">
                              <label for="category">Category</label>
                              <select name="category" class="form-control" id="category">
                                   <option value="">Select Category</option>
                                   @foreach ($categories as $category)
                                   <option {{ request('category') == $category->id ? 'selected' : '' }}
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
                              <select name="sub_category" id="sub_category" class="form-control">
                                   <option value="">Select Sub Category</option>
                              </select>
                              @error('sub_category')
                              <span class="text-danger">{{ $message }}</span>
                              @enderror
                         </div>
                    </div>
               </div>

               <button class="btn btn-primary mb-3" type="submit">Question Filter</button>
               <a href="{{ request()->url() }}" class="btn btn-dark mb-3">Reset Filter </a>
          </form>
     </div>
     <!-- Your Block -->
     <div class="block block-rounded">
          <div class="block-header">
               <h3 class="block-title"> Question List </h3>
          </div>

          <div class="block-content">
               <table class="table">
                    <tr>
                         <th>SL</th>
                         <th>Question</th>
                         <th>Option A</th>
                         <th>Option B</th>
                         <th>Option C</th>
                         <th>Option D</th>
                         <th>Right option</th>
                         <th>Ans Time</th>
                         <th>Action</th>
                    </tr>

                    @foreach ($question_list as $question)
                    <tr>
                         <td>{{ $loop->iteration }}</td>
                         <td>{{ $question->question }}</td>
                         <td>{{ $question->a }}</td>
                         <td>{{ $question->b }}</td>
                         <td>{{ $question->c }}</td>
                         <td>{{ $question->d }}</td>
                         <td>{{ $question->right_option }}</td>
                         <td>{{ $question->q_time }} Sec</td>
                         <td style="min-width: 150px">
                              <a href="{{ route('question.edit', $question->id) }}"
                                   class="btn btn-primary btn-sm">Edit</a>
                              <form class="d-inline" action="{{ route('question.destroy', $question->id) }}"
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