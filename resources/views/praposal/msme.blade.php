 <div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="{{ asset('/images/sidebar-1.jpg') }}">
        <div class="logo">
             <a href="/home"><img style="background-color: white;height: 77px;width:219px" src="{{ asset('/images/smeLogo.png') }}"></a>
        </div>
        <div class="sidebar-wrapper">
            <div id="tab" class="btn-group leftside_tab" role="group">
                <ul class="nav">
         
                    <li>
                        <a style="width:100%;" href="/home" class="btn btn-large btn-success btn-space lefttabbtn active" role="button"><i class="material-icons ">person</i>Background<div class="ripple-container"></div></a>
                    </li>
                    <li>
                        <a style="width:100%;" href="#" class="btn btn-large btn-success btn-space lefttabbtn  " role="button"><i class="material-icons">content_paste</i>Promoter Details</a>
                    </li>
                    <li>
                        <a style="width:100%;" href="#" class="btn btn-large btn-success btn-space lefttabbtn  " role="button"><i class="material-icons">library_books</i>Business Financials</a>
                    </li>
                    <li>
                        <a style="width:100%;" href="#" class="btn btn-large btn-success btn-space lefttabbtn  " role="button"><i class="material-icons">security</i>Security Details</a>
                    </li>
                    <li>
                        <a style="width:100%;" href="#" class="btn btn-large btn-success btn-space lefttabbtn  " role="button"><i class="material-icons">file_upload</i>Upload Documents</a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
    <div class="main-panel">
     @include('loans.dashboardNavbar')
    
