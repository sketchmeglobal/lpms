<div id="page-content">
    <section class="sheet padding-5mm" style="height: auto">
        <!--<header class="pull-right">-->
        <!--    <small>Page No. </small>-->
        <!--</header>-->
        <div class="clearfix"></div>
        <div class="container">
            <div class="row border_all text-center text-uppercase mar_bot_3">
                <h3 class="mar_0 head_font">CONTRACTOR PAYROLL REGISTER</h3>
            </div>
            <div class="row mar_bot_3 text-center">
                <div class="col-sm-6 border_all header_left" style="height: 44px;">
                    <h4 class="" style="margin-top: 2px; margin-bottom: 0px;"><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
                    <p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
                </div>
                <div class="col-sm-6 border_all header_left" style="height: 44px; text-align: left;">
                    <b>Month: <?= $mont ?><br />
                    Date: <?= date('d-m-Y') ?><br /></b>
                </div>
            </div>
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="table-responsive">
                            <!--<h5>Retrieve Table</h5>-->
                            <table id="all_det" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" align="center" colspan="26">REGISTER OF WAGES <br /> [Prescribed under Rule 23(1) of the West Bengal Minimum Wages Rules 1951] <br /> [Prescribed under Rule 26(1) of the Central Minimum Wages Rules 1951]</th>
                                    </tr>
                                    <tr>
                                        <th rowspan="2" style="text-align: center;">Sr. #</th>
                                        <th rowspan="2" style="text-align: center;display:none">Contractor</th>
                                        <th rowspan="2" style="text-align: center;">Empl.Id</th>
                                        <th rowspan="2" style="text-align: center;">Name</th>
                                        <!--<th rowspan="2" style="text-align: center; ">Wrkg. Days</th>-->
                                        <th rowspan="2" style="text-align: center; ">Days Wrkd</th>
                                        <th rowspan="2" style="text-align: center; ">Hldays + Lv.</th>
                                        <!--<th rowspan="2" style="text-align: center; ">Lv.</th>-->
                                        <!-- <th rowspan="2" style="text-align: center; ">Ab.</th> -->
                                        <th rowspan="2" style="text-align: center; ">Total</th>
                                        
                                        <th rowspan="2" style="text-align: center; ">Total Parts of Cut Comp</th>
                                        <th rowspan="2" style="text-align: center; ">Rate per Cut Comp</th>
                                        <th rowspan="2" style="text-align: center; ">Pcs.  Wages Earned</th>
                                        <th class="text-center" rowspan="1" colspan="2" style="text-align: right;">Additional Pay</th>

                                        <th rowspan="2" style="text-align: center; ">Total Amount</th>
                                        <th rowspan="2" style="text-align: center; ">H.R.A</th>
                                        <th rowspan="2" style="text-align: center; ">Total Gross Payable</th>
                                        
                                        <th class="text-center" rowspan="1" colspan="5" style="text-align: right;">Deductions</th>
                                        <th rowspan="2" style="text-align: right;">Net Amount Paid</th>
                                        <th rowspan="2" style="text-align: right;">Sign. / Thumb Impression</th>
                                    </tr>
                                    <tr>
                                        <th rowspan="1" style="text-align: right;">Pay for Holiday</th> 
                                        <th rowspan="1" style="text-align: right;">Pay for Leave</th>
                                        <th rowspan="1" style="text-align: right;">P.F.</th>
                                        <th rowspan="1" style="text-align: right;">E.S.I.</th>
                                        <th rowspan="1" style="text-align: right;">WB. PR TAX</th>
                                        <th rowspan="1" style="text-align: right;">Loan <br/> /Advance</th>
                                        <th rowspan="1" style="text-align: right;">Total</th>
                                    </tr>
                                    <tr align="center">
                                        <th style="text-align:center">1</th>
                                        <th style="text-align:center">2</th>
                                        <th style="text-align:center">3</th>
                                        <th style="text-align:center">4</th>
                                        <th style="text-align:center">5</th>
                                        <th style="text-align:center">6</th>
                                        <th style="text-align:center">7</th>
                                        <th style="text-align:center">8</th>
                                        <th style="text-align:center">9</th>
                                        <th style="text-align:center">10</th>
                                        <th style="text-align:center">11</th>
                                        <th style="text-align:center">12</th>
                                        <th style="text-align:center">13</th>
                                        <th style="text-align:center">14</th>
                                        <th style="text-align:center">15</th>
                                        <th style="text-align:center">16</th>
                                        <th style="text-align:center">17</th>
                                        <th style="text-align:center">18</th>
                                        <th style="text-align:center">19</th>
                                        <th style="text-align:center">20</th>
                                        <th style="text-align:center">21</th>
                                        <!-- <th style="text-align:center">22</th> -->
                                        <!-- <th style="text-align:right">23</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    