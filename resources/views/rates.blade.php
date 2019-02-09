@extends('layouts.app')

@section('content')
<div id="show"></div>
<script src = "https://code.jquery.com/jquery-3.3.1.min.js"></script>
      
      <script>
         function getRates() {
            $.ajax({
               type:'POST',
               url:'/get_rates',
               data:'_token = <?php echo csrf_token() ?>',
               success:function(data) {
		  Console.log(data);
               }
            });
         }
	 $(document).ready(function() {
		$.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              	});
	 	setInterval(getRates,1000);
	 });
      </script>
@endsection
