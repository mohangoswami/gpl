@extends('layouts.student_master')


@section('content')
        <div class="col-sm-6 offset-2 mt-5">
            <h3>
                Contact in school office.
            </h3>
        </div>

@stop

@section('footerScript')
<script type="text/javascript">
  
     window.onload = function() {
 var timeout =  setInterval(function() {
    location.reload(true);
  }, 60000); 

};
</script>

@stop