@extends('layouts.app')

@section('content')
<div class="container">
     <div class="row justify-content-center">
          <div class="col-md-10">

               <div class="card ">
                    <form action="{{ route('answer', $question->id) }}" method="POST">
                         @csrf
                         @method('PUT')
                         <div class="card-header">
                              <strong> Q - {{ $question->question }}</strong>
                              <span class="float-right">

                                   <span id="q_time">{{ \Carbon\Carbon::parse($question->q_time)->format('s') }}</span>
                                   Seconds
                              </span>
                         </div>
                         <div class="card-body p-0">
                              <table class="table">
                                   <tr>
                                        <td>
                                             <span class="mr-3">A</span>
                                             <input type="radio" name="answer" class="mr-2" value="a">
                                             {{ $question->a }}
                                        </td>
                                        <td>
                                             <span class="mr-3">C</span>
                                             <input type="radio" name="answer" class="mr-2" value="c">
                                             {{ $question->c }}
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>
                                             <span class="mr-3">B</span>
                                             <input type="radio" name="answer" class="mr-2" value="b">{{ $question->b }}
                                        </td>
                                        <td>
                                             <span class="mr-3">D</span>
                                             <input type="radio" name="answer" class="mr-2" value="d">{{ $question->d }}
                                        </td>
                                   </tr>
                              </table>
                         </div>
                         <div class="card-footer">
                              <button class="btn btn-success" type="submit">Answer</button>
                         </div>
                    </form>
               </div>
          </div>
     </div>
</div>
@endsection

@section('scripts')
<script>
     let qTime = parseInt($("#q_time").text());
     let counter = qTime;
         setInterval(function () {
              $("#q_time").text(counter)
              if(counter == 0) {
                   window.location.href = "{{ route('my_answers') }}";
              }
              --counter;
         }, 1000)
</script>
@endsection