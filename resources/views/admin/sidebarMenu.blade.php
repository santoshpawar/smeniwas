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
@section('content')


<div class="wrapper">
  <div class="sidebar" data-color="purple" data-image="{{ asset('/images/sidebar-1.jpg') }}">
      <div class="logo">
        <a href="/home"><img style="background-color: white;height: 77px;width:219px" src="{{ asset('/images/smeLogo.png') }}"></a>
    </div>
    <div class="sidebar-wrapper">
        <div id="tab" class="btn-group leftside_tab" role="group">
            <ul class="nav">
              <li>
                <a  href="/admin/users"  class="btn btn-large btn-success btn-space lefttabbtn {{{ @$sideTab == "userData" ? 'active' : ''}}} " role="button">Users<div class="ripple-container"></div></a>
            </li>
            <li>
                <a  href={{URL::to("/admin/masterdata/")}}  title="Manage Master Data" class="btn btn-large btn-success btn-space lefttabbtn {{{ @$sideTab == "masterData"  ? 'active' : ''}}}" role="button">Master Data<div class="ripple-container"></div></a>
            </li>
            <li>
                <a  href={{URL::to("/admin/questions/")}} title="Manage Question Configurations" class="btn btn-large btn-success btn-space lefttabbtn {{{ @$sideTab == "quesData" ? 'active' : ''}}} " role="button">Question Configurations</a>
            </li>
            <li>
                <a  href={{URL::to("/admin/creditmodel/")}} title="Manage Analyst Model" class="btn btn-large btn-success btn-space lefttabbtn {{{ @$sideTab == "analystData" ? 'active' : ''}}} " role="button">Analyst Model</a>
            </li>
            <li>
                <a  href={{URL::to("/admin/liquiditymodel/")}} title="Manage Liquidityt Model Model" class="btn btn-large btn-success btn-space lefttabbtn {{{ @$sideTab == "liquidityData" ? 'active' : ''}}}  " role="button">Liquidity Model</a>
            </li>
            <li>
                <a  href={{URL::to("/admin/financialdata/")}} title="Manage Financial Data" class="btn btn-large btn-success btn-space lefttabbtn {{{ @$sideTab == "finData" ? 'active' : ''}}} " role="button">Financial Data</a>
            </li>
            <li>
                <a  href={{URL::to("/admin/bankmasterdata/")}} title="Manage Bank Master Data" class="btn btn-large btn-success btn-space lefttabbtn {{{ @$sideTab == "bankData" ? 'active' : ''}}} " role="button">Bank Master Data</a>
            </li>
            <li>
                <a  href={{URL::to("/admin/parameterdata/")}} title="Manage Parameter Configurations" class="btn btn-large btn-success btn-space lefttabbtn {{{ @$sideTab == "paramData" ? 'active' : ''}}}  " role="button">Parameter Configurations</a>
            </li>
            <li>
                <a  href={{URL::to("/admin/industrytype/")}} title="Manage Parameter Configurations" class="btn btn-large btn-success btn-space lefttabbtn {{{ @$sideTab == "indData" ? 'active' : ''}}}  " role="button">Industry Type </a>
            </li>
            <li>
                <a  href={{URL::to("/admin/bankallocation/")}} title="Manage Parameter Configurations" class="btn btn-large btn-success btn-space lefttabbtn {{{ @$sideTab == "bankAlloData" ? 'active' : ''}}}  " role="button">Bank Allocation</a>
            </li>
            <li>
                <a  href={{URL::to("/admin/manualallocation/")}} title="Manage Manual Bank Allocations" class="btn btn-large btn-success btn-space lefttabbtn {{{ @$sideTab == "manBankAlloData" ? 'active' : ''}}}  " role="button">Manual Bank Allocation </a>
            </li>

        </ul>


    </div>
</div>
</div>
