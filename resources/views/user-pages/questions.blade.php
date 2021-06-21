@extends('layouts.app')

@section('content')
<div class="container">
     <div class="row justify-content-center">
          <div class="col-md-10">
               <div class="card card-body">
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
               <div class="card ">
                    <div class="card-header">Question List</div>
                    <div class="card-body p-0">
                         <table class="table table-bordered">
                              <tr>
                                   <th>Sl</th>
                                   <th>Question</th>
                                   <th>Category</th>
                                   <th>Sub Category</th>
                                   <th>#</th>
                              </tr>
                              @forelse ($questions as $question)
                              <tr>
                                   <td>{{ $loop->iteration }}</td>
                                   <td>{{ $question->question }}</td>
                                   <td>{{ $question->category->name }}</td>
                                   <td>{{ $question->sub_category->name }}</td>
                                   <td>
                                        <a href="{{ route('question', $question->id) }}"
                                             class="btn btn-primary btn-sm">Give Answer</a>
                                   </td>
                              </tr>
                              @empty
                              <tr>
                                   <td colspan="5" class="text-center">
                                        <strong class="text-danger">No question found !</strong>
                                   </td>
                              </tr>
                              @endforelse
                         </table>
                    </div>
               </div>
          </div>
     </div>
</div>
@endsection


@section('scripts')
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