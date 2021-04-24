<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Employee Manangement</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <script
          src="https://code.jquery.com/jquery-3.6.0.min.js"
          integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
          crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">

        <!-- Styles -->
    

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            .error-label{
                color:red;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
            <form id="submit-form" action="{{url('submit-form')}}"  method="post" enctype="multipart/form-data" class="text-center">
                {{csrf_field()}}
                <h3>Employee Details</h3>
                <hr>
                <label>Name:</label> <input type="text" name="name" id="name" value="{{old('name')}}"><br>
                 @if ($errors->has('name'))
                    <p class="error-label">{{$errors->first('name')}}</p>
                 @endif
                <label>Email:</label> <input type="email" name="email" id="email" value="{{old('email')}}"><br>
                @if ($errors->has('email'))
                    <p class="error-label">{{$errors->first('email')}}</p>
                @endif
                <label>Mobile Number:</label> <input type="texxt" name="mobile_number"  id="mobile_number" value="{{old('mobile_number')}}"><br>
                @if ($errors->has('mobile_number'))
                    <p class="error-label">{{$errors->first('mobile_number')}}</p>
                @endif
                <label>Password:</label> <input type="password" name="password" id="password" value="{{old('password')}}"><br>
                @if ($errors->has('password'))
                    <p class="error-label">{{$errors->first('password')}}</p>
                @endif
                <label>DOB:</label> <input type="date" name="date" id="date" value="{{old('date')}}"><br>
                @if ($errors->has('date'))
                    <p class="error-label">{{$errors->first('date')}}</p>
                @endif
                <label>Profile picture:</label> <input type="file" name="profile_picture" accept="image/jpg,png" id="profile_picture"  value="{{old('profile_picture')}}"><br>
                @if ($errors->has('profile_picture'))
                    <p class="error-label">{{$errors->first('profile_picture')}}</p>
                @endif
                <button type="submit" >Submit</button>
            </form>
        </div>
        <div class="filters">
            <label>Name:</label><input type="text" class="input_filter" name="name_filter" id="name_filter" data-type="name">
            <label>Email:</label><input type="text" class="input_filter" name="email_filter" id="email_filter" data-type="email">
            <label>Status:</label>
            <select name="status_filter" id="status_filter">
                <option value="active">Active</option>
                <option value="in-active">In-Active</option>
            </select>
        </div>
        <div id="render_table">
           @include('users');
        </div>

<!-- Submit form script starts -->
<script type="text/javascript">
    
    $(document).ready(function(){
        
        $(document).on('click','.delete-data',function(){
            var id = $(this).attr('data-id');
            $.ajax({
                method: "GET",
                url:"{{url('')}}"+'/delete-data/'+id,
                success:function(data){
                    $("#row_"+id).hide();
                    alert('Record Deleted');
                }

            });

        });

        $(document).on('keyup keydown',".input_filter",function(){
            var search = $(this).val();
            var data_type =  $(this).attr('data-type');


            if(search != ""){
                $("#render_table").html('');

                $.ajax({
                    url: "{{url('')}}"+"/name-search",
                    type: 'POST',
                    data: {search:search,data_type:data_type},
                    dataType: 'html',
                    success:function(response){
                    
                        console.log('response',response);
                        $("#render_table").html(response);


                    }
                });
            }

        });

        $(document).on('change',"#status_filter",function(){
            var search = $(this).val();
            var data_type =  'status';
            if(search != ""){
                $("#render_table").html('');
                $.ajax({
                    url: "{{url('')}}"+"/name-search",
                    type: 'POST',
                    data: {search:search,data_type:data_type},
                    dataType: 'html',
                    success:function(response){
                    
                        console.log('response',response);
                        $("#render_table").html(response);


                    }
                });
            }

        });




    });
</script>
<!-- Submit form script ends -->
    </body>
</html>
