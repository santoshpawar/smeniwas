<style>
            .sidebar .sidebar-wrapper, .off-canvas-sidebar .sidebar-wrapper {
        position: relative;
        height: calc(100vh - 75px);
        overflow: auto;
        width: 260px;
        z-index: 4;
    }
    .btn.btn-success{
        background-color: transparent;
        color: grey
    }
    .sidebar .nav{
        margin-top: 20px;
    }
    .nav {
        padding-left: 0;
        margin-bottom: 0;
        list-style: none;
    }
    ol, ul {
        margin-top: 0;
        margin-bottom: 10px;
    }
    .sidebar .nav li > a{
        margin: 25px 12px;
        border-radius: 3px;
        color: #1C4E92;
        font-weight: bold;
    }
    .dropdownjs > ul > li {
        list-style: none;
        padding: 10px 20px;
        color: #4F4E4E;
        font-size: 15px;
        font-weight: 500;
    }
    .sidebar .logo, .off-canvas-sidebar .logo {
        position: relative;
        padding: 15px 15px;
        z-index: 4;
    }
    .nav>li>a {
        position: relative;
        display: block;
        padding: 10px 15px;
    }
    .material-icons {
        vertical-align: middle;
        font-size: 17px;
        top: -1px;
        position: relative;
    }
    .btn{
        text-align: left;
    }
        a.tooltips {
            position: relative;
            display: inline;
            color: #000000;
            text-decoration: none;
            cursor: default;
        }
        a.tooltips span {
            position: absolute;
            color: #FFFFFF;
            min-width:500px;
            color: #FFFFFF;
            background: #000000;
            border: 2px solid #6D6D6D;
            /*height: 63px;*/
            /*line-height: 63px;*/
            /*text-align: center;*/
            visibility: hidden;
            border-radius: 12px;
            padding: 10px;
        }
        a.tooltips span:before {
            content: '';
            position: absolute;
            top: 15%;
            left: 100%;
            /*margin-top: -12px;*/
            width: 0; height: 0;
            border-left: 12px solid #6D6D6D;
            border-top: 12px solid transparent;
            border-bottom: 12px solid transparent;
        }
        a.tooltips span:after {
            content: '';
            position: absolute;
            top: 15%;
            left: 100%;
            /*margin-top: -8px;*/
            width: 0; height: 0;
            border-left: 8px solid #000000;
            border-top: 8px solid transparent;
            border-bottom: 8px solid transparent;
        }
        a:hover.tooltips span {
            visibility: visible;
            opacity: 0.8;
            right: 100%;
            top: 50%;
            margin-top: -31.5px;
            margin-right: 15px;
            z-index: 999;
        }
    </style>
     <div class="sidebar" data-color="purple" data-image="{{ asset('/images/sidebar-1.jpg') }}">
        <div class="logo">
           <a href="/home"><img style="background-color: white;height: 77px;width:219px" src="{{ asset('/images/smeLogo.png') }}"></a>
        </div>
        <div class="sidebar-wrapper">
          <div id="tab" class="btn-group leftside_tab" role="group">
            <ul class="nav">
              <li>
                <a  href="#" class="btn btn-large btn-success btn-space lefttabbtn " role="button"><i class="material-icons">dashboard</i>Dashboard<div class="ripple-container"></div></a>
              </li>
              <li>
                <a  href="#" class="btn btn-large btn-success btn-space lefttabbtn" role="button"><i class="material-icons ">person</i>Background<div class="ripple-container"></div></a>
              </li>
              <li>
                <a  href="#" class="btn btn-large btn-success btn-space lefttabbtn  " role="button"><i class="material-icons">content_paste</i>Promoter Details</a>
              </li>
              <li>
                <a  href="#" class="btn btn-large btn-success btn-space lefttabbtn  " role="button"><i class="material-icons">library_books</i>Business Financials</a>
              </li>
              <li>
                <a  href="#" class="btn btn-large btn-success btn-space lefttabbtn  " role="button"><i class="material-icons">security</i>Security Details</a>
              </li>
              <li>
                <a  href="#" class="btn btn-large btn-success btn-space lefttabbtn  " role="button"><i class="material-icons">file_upload</i>Upload Documents</a>
              </li>
            </ul>
          </div>
        </div>

      </div>