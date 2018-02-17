@extends('layouts.admin')

@section('content')

    <h1>Media</h1>


   @if($photos)
       <form action="delete/media" method="post" class="form-inline">
            {{csrf_field()}}
            {{method_field('delete')}}
         <div class="form-group">
             <select id="" name="checkBoxArray" class="form-control">
               <option value="">DELETE</option>
             </select>
         </div>

         <div class="form-group">
             <input class="btn btn-primary" type="submit" name="delete_all" class="form-control">
         </div>

       <table class="table">
       <thead>
         <tr>
           <th><input type="checkbox" id="options"></th>
           <th>id</th>
           <th>Name</th>
           <th>Created at</th>
         </tr>
       </thead>
       <tbody>
           @foreach($photos as $photo)
             <tr>
               <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="{{$photo->id}}"></td>
               <td>{{ $photo->id }}</td>
               <td><img height="50" src="{{ $photo->file }}" alt=""></td>
               <td>{{ $photo->created_at ? $photo->created_at->diffForHumans() : 'no date' }}</td>
               <td>
                   <input type="hidden" name="photo" value="{{$photo->id}}">
                  <div class="form-group">
                      <input type="submit" name="delete_single" value="delete" class="btn btn-danger">
                  </div>
               </td>
             </tr>
           @endforeach
       </tbody>
       </table>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-5">
                {{$photos->render()}}
            
            </div>
        </div>
       </form>

   @endif

@stop

@section('scripts')

    <script>
        $(document).ready(function(){
            $('#options').click(function(){
                if(this.checked){
                    $('.checkBoxes').each(function(){
                        this.checked = true;
                    });
                } else {
                    $('.checkBoxes').each(function(){
                        this.checked = false;
                    });
                }
            });
        });
    </script>

@stop
