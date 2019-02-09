@extends('layouts.app')

@section('content')
<div id="show"></div>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>
<script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        var time = 100;
        //make it a named function
        $(document).ready(function poll(){
            //this makes the setTimeout a self run function it runs the first time always
            setTimeout(function(){
                $.ajax({
                    url:'/get_rates', // Url to which the request is send
                    type: "POST",             // Type of request to be send, called as method
		    data:'_token = <?php echo csrf_token() ?>',
                    success: function()   // A function to be called if request succeeds
                    {
                        $("#show").html(data.companies);
                    },
            //this is where you call the function again so when ajax complete it will cal itself after the time out you set.
		    complete: poll
                });
        //end setTimeout and ajax 
            },time);
    //end poll function
    });
</script>
@endsection
