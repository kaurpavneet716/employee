 <table class="table table-bordered">
    <thead>
        
            <td>Name</td>
            <td>Email</td>
            <td>Mobile Number</td>
            <td>DOB</td>
            <td>Status</td>
            <td>Action</td>

        
    </thead>
    <tbody>
        @if(!empty($user))
            @foreach($user as $key => $value)
                <tr data-id="{{$value['id']}}" id="row_{{$value['id']}}">
                    <td>{{$value['name']}}</td>
                    <td>{{$value['email']}}</td>
                    <td>{{$value['mobile_number']}}</td>
                    <td>{{$value['dob']}}</td>
                    <td>@if(!empty($value['deleted_at'])){{'In-Active'}}@else{{'Active'}}@endif</td>
                    <td> 
                        <a href="{{url('edit-employee/'.$value['id'])}}" class="delete-data">Edit</a>
                        <a href="jaavscript:void(0);" class="delete-data" data-id="{{$value['id']}}">Delete</a>

                    </td>
                </tr>
                
            @endforeach
        @else
            <tr>
                <td colspan="5" class="text-center"> No records found</td>
                   
            </tr>
        @endif

    </tbody>

</table>