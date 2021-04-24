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
            <form id="submit-form" action="{{url('update-form/'.$employee['id'])}}"  method="post" enctype="multipart/form-data" class="text-center">
                {{csrf_field()}}
                <h3>Employee Details</h3>
                <hr>
                <label>Name:</label> <input type="text" name="name" id="name" value="{{$employee['name']}}"><br>
                 @if ($errors->has('name'))
                    <p class="error-label">{{$errors->first('name')}}</p>
                 @endif
                <label>Email:</label> <input type="email" name="email" id="email" value="{{$employee['email']}}"><br>
                @if ($errors->has('email'))
                    <p class="error-label">{{$errors->first('email')}}</p>
                @endif
                <label>Mobile Number:</label> <input type="texxt" name="mobile_number"  id="mobile_number" value="{{$employee['mobile_number']}}"><br>
                @if ($errors->has('mobile_number'))
                    <p class="error-label">{{$errors->first('mobile_number')}}</p>
                @endif
                <label>Password:</label> <input type="password" name="password" id="password" value="{{$employee['encoded_password']}}"><br>
                @if ($errors->has('password'))
                    <p class="error-label">{{$errors->first('password')}}</p>
                @endif
                <label>DOB:</label> <input type="date" name="date" id="date" value="{{$employee['dob']}}"><br>
                @if ($errors->has('date'))
                    <p class="error-label">{{$errors->first('date')}}</p>
                @endif
                <label>Profile picture:</label> <input type="file" name="profile_picture" accept="image/jpg,png" id="profile_picture"  value="{{old('profile_picture')}}"><br>
                <img src="{{asset('public/uploads/'.$employee['profile_image'])}}" id="profile_picture_show" height="60" width="60">
                @if ($errors->has('profile_picture'))
                    <p class="error-label">{{$errors->first('profile_picture')}}</p>
                @endif
                <button type="submit" >Update</button>
            </form>
        </div>
       

<script type="text/javascript">
    
    $(document).ready(function(){
        
        function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
              $('#profile_picture_show').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]); // convert to base64 string
          }
        }

        $("#profile_picture").change(function() {
          readURL(this);
        });


    });
</script>
    </body>
</html>
