 @if(Session::has('flash_message'))
 <div class = "alert alert-success{{{Session::has('flash_message_important') ? ' alert-important' : ''}}}" style="margin-bottom: 0px;">
    @if(Session::has('flash_message_important'))
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    @endif
</div>
@endif

<div class="clearfix_responsive"></div>
@if(Session::has('flash_message'))
<div class = "alert alert-success{{{Session::has('flash_message_important') ? ' alert-important' : ''}}}" style="margin-bottom: 0px; z-index:101; position:fixed; top:150px; width:100%;">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    @if(Session::has('flash_message_important'))
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    @endif
    {{ Session::get('flash_message') }}
</div>
@endif

@if (count($errors) > 0)
<div class="alert alert-danger" >
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>

@endif