<div class="row">
    <!-- uncomment code for absolute positioning tweek see top comment in css -->
    <div class="absolute-wrapper"></div>

    <!-- Menu -->
    <div class="side-menu" style="border-left: 1px solid #e7e7e7;">
      
            <!-- Main Menu -->
            <div class="side-menu-container">
                <ul class="nav navbar-nav">
                    <li><a href="{{URL::to("messaging/create")}}" ><span
                                    class="glyphicon glyphicon-inbox"></span> COMPOSE QUERY</a></li>
                    <li><a href="{{URL::to("messaging")}}"><span
                                    class="glyphicon glyphicon-envelope"></span> INBOX @if($count > 0 )<span class="label label-danger pull-right">{!! $count !!}</span>@endif</a></li>

                    <li><a href="{{URL::to("messaging/sent")}}"><span class="glyphicon glyphicon-share-alt"></span> SENT QUERY</a></li>
                    <li><a href="{{URL::to("messaging/sentreply")}}"><span class="glyphicon glyphicon-share-alt"></span> SENT REPLY</a></li>

                    {{--<li><a href="#"><span class="glyphicon glyphicon-trash"></span> TRASH</a></li>--}}

                </ul>
            </div>
            <!-- /.navbar-collapse -->
   
    </div>
</div>