@extends('layouts.app')

@section('content')
<div class="container">
     <div class="row justify-content-center">
          <div class="col-md-10">
               <div class="d-flex justify-content-bewteen">
                    <div class="alert alert-primary mr-3">
                         <h5>Total Answer : {{ $my_answers->count() }}</h5>
                    </div>
                    <div class="alert alert-danger mr-3">
                         <h5>Wrong Answer : {{ $my_answers->where('yes', 0)->count() }}</h5>
                    </div>
                    <div class="alert alert-success">
                         <h5>Correct Answer : {{ $my_answers->where('yes', 1)->count() }}</h5>
                    </div>
               </div>
          </div>
          <div class="col-md-12">
               <div class="card ">
                    <div class="card-header">My Answer List</div>
                    <div class="card-body p-0">
                         <table class="table table-bordered">
                              <tr>
                                   <th>Sl</th>
                                   <th>Question</th>
                                   <th>Correct Answer</th>
                                   <th>My Answer</th>
                                   <th>Yes/Not</th>

                              </tr>
                              @forelse ($my_answers as $answer)
                              <tr>

                                   <td>{{ $loop->iteration }}</td>
                                   <td>{{ $answer->question->question }}</td>
                                   <td>{{ $answer->question->{$answer->question->right_option} }}</td>
                                   <td>{{ $answer->question->{$answer->answer} }}</td>
                                   <td>{!! $answer->yes ? '<span class="badge badge-success">Correct</span>' : '<span
                                             class="badge badge-danger">Wrong</span>'
                                        !!} </td>

                              </tr>
                              @empty
                              <tr>
                                   <td colspan="5" class="text-center">
                                        <strong class="text-danger">No answer found !</strong>
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