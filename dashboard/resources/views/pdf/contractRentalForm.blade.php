<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Script Font Awesome-->
    <script src="https://kit.fontawesome.com/55c0c4353f.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <h2 style="text-align: center; font-family: sans-serif">MVM MACHINERY LLC</h2>
    <div class="row">
        <div class="col-lg-l"><b>MACHINERY RENTAL</b></div>
        <div class="col-lg-r">#RNT{{$rental->id}}2022  
            <div class="rowempty" style="margin-bottom: 8px;">
            </div>
            <b>Date:</b>_________________
        </div>
    </div>
    <div class="row2">
        <b>Client's information</b>
    </div>
    <div class="row">
        <div class="col-9">
            Name: <span style="color: white;">__________</span>{{$rental->nameFormRental}}       
        </div>
        <div class="col-3">
            Phone: {{$rental->phoneFormRental}}
        </div>
    </div>
    <div class="row">
        <div class="col-9">
            Delivery Address: <span style="color: white;">_</span>{{$rentalAddress}}
        </div>
        <div class="col-3">
            Email: {{$rental->phoneFormRental}}
        </div>
    </div>
    <div class="row">
        <div class="col-9">
            Start Date: <span style="color: white;">_______</span>{{$rental->deliveryDateFormRental}}
        </div>
        <div class="col-3">
            Time: _____________________
        </div>
    </div>
    <div class="row">
        <div class="col-9">
            End Date: <span style="color: white;">_______ </span>{{$rental->estimatedDateFormRental}}
        </div>
        <div class="col-3">
            Time: _____________________
        </div>
    </div>

    <table style="padding-top: 8px;">
        <thead>
            <tr>
                <th style="width: 12%">Items</th>
                <th style="width: 52%">Comments</th>
                <th style="width: 12%">Days</th>
                <th style="width: 12%">Price/Day</th>
                <th style="width: 12%">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allRentaMachinery as $rentaMachinery)
            <tr>
                <td style="text-align: center;">{{$rentaMachinery->machinery_fk}}</td>
                <td style="padding-left: 5px;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <table class="table2">
        <tfoot>
            <th class="thClass" style="width: 12%;"></th>
            <th class="thClass" style="width: 52%;"></th>
            <th class="thClass" style="width: 12%;"></th>
            <th class="thClass" style="width: 12%;">Delivery:</th>
            <th class="thClass" style="width: 12%;"><span style="color: white;">_</span>$</th>
    </tfoot>
    </table>
    <table class="table2">
        <tfoot>
            <th class="thClass" style="width: 12%;"></th>
            <th class="thClass" style="width: 52%;"></th>
            <th class="thClass" style="width: 12%;"></th>
            <th class="thClass" style="width: 12%;">Total:</th>
            <th class="thClass" style="width: 12%;"><span style="color: white;">_</span>$</th>
    </tfoot>
    </table>
    
    <div class="row">
        <div class="col-message">
            *This quote is valid for the next 30 days, after which values may be subject to change.
        </div>
    </div>

    <div class="row">
        <div class="col-image" style="text-align:center; ">
            <br>
            <br>
            <br>
            <br>
            <img src="{{ public_path('images/medidorDiesel.png') }}" style="width: 250px; height: 200px;">
            <br>
            <b>Hours meter: ______________</b> 
        </div>
        <div class="col-text">
            <h3 style="text-align: center;" >RENTAL CONTRACT TERMS</h3>
            <ul>
                <li>Customer is responsible for the equipment or any damages to equipment.</li>
                <li>If equipment does not function properly notify lessor within 30 minutes of occurrence or no refund or allowance will be made.</li>
                <li>Equipment comes full with diesel, if not refueled, customer will be charged $8.50 a gallon.</li>
                <li>Charges will be made if machine is not maintained, returned dirty or in damaged conditions.</li>
                <li>Rental rates are based upon single shift usage (eight hours per day, five days a week).</li>
                <li>If customer makes greater use of the equipment, it is agreed that the additional usage will be charged.</li>
                <li>The equipment can only be withdrawal by authorized personal of MVM MACHINERY with the same ID when delivered.</li>
            </ul>
            By signing this contract, I certify that I have read and agree to all terms present in this document
        </div>
    </div>
    <div class="row">
        <h3 style="text-align: center; color: red;">CALL (310) 622 - 4135 TO SCHEDULE PICKUP AND TERMINATE RENTAL</h3>
    </div>

    <div class="row" style="text-align: center;">
        <div class="col-signature">
            <b>___________________________</b>
            <br>
            <b>Person who receives</b>
            <br>
            Signature
        </div>
        <div class="col-signature">
            <b>__________________________</b>
            <br>
            <b>Person who delivers</b>
            <br>
            Signature
        </div>
    </div>

    <div class="row" style="margin-top:5px;"></div>

    <div class="row" >
        <div class="col-social">
            <img src="{{ public_path('images/instagram.png') }}" style="width: 15px; height: 15px;"> @mvmmachinery
        </div>
        <div class="col-information">
            Phone: +1 (310) 622 - 4135
        </div>
    </div>
    <div class="row">
        <div class="col-social">
            <img src="{{ public_path('images/yelp.png') }}" style="width: 15px; height: 15px;"> MVM MACHINERY
        </div>
        <div class="col-information">
            Email: office@mvm-machinery.com
        </div>
    </div>
    <div class="row">
        <div class="col-social">
            <img src="{{ public_path('images/youtube.png') }}" style="width: 15px; height: 15px;"> MVM MACHINERY
        </div>
        <div class="col-information">
            Website: mvm-machinery.com
        </div>
    </div>

<style>
b {
    font-family: sans-serif;
}
.row {
    display:table;
    width: 100%;
    clear: both;
    margin-bottom: 25px;
    font-family: sans-serif;
    font-size: 15px;
}
.row2 {
    display:table;
    width: 100%;
    clear: both;
    margin-bottom: 10px;
    font-family: sans-serif;
    font-size: 15px;
}
.col-lg-l {
    float: left;
    width: 50%;
    font-family: sans-serif;
    font-size: 15px;
}
.col-lg-r {
    text-align: right;
    float: left;
    width: 50%;
    font-family: sans-serif;
    font-size: 15px;
}

.col-9 {
    float: left;
    width: 68%;
    font-family: sans-serif;
    font-size: 15px;
}
.col-3 {
    float: left;
    width: 32%;
    font-family: sans-serif;
    font-size: 15px;
}
.col-message {
    float: left;
    width: 75%;
    font-family: sans-serif;
    font-size: 15px;
}
.col-total {
    float: left;
    width: 25%;
    font-family: sans-serif;
    font-size: 15px;
}
.col-image {
    float: left;
    width: 35%;
    font-family: sans-serif;
    font-size: 15px;
}
.col-text {
    float: left;
    width: 65%;
    font-family: sans-serif;
    font-size: 15px;
}
.col-signature {
    float: left;
    width: 50%;
    font-family: sans-serif;
    font-size: 15px;
}
.col-social {
    float: left;
    width: 50%;
    font-family: sans-serif;
    font-size: 15px;
}
.col-information {
    text-align: right;
    float: left;
    width: 50%;
    font-family: sans-serif;
    font-size: 15px;
}

.table2{
    
    border: 0px !important;
    font-family: sans-serif;
    font-size: 15px;
    width: 100%;
    border-collapse: collapse;
    font-family: sans-serif;
    font-size: 15px;
}

.thClass{
    border: 0px !important;
    text-align: left;
}

table, td, th {
  border: 1px solid;
  font-family: sans-serif;
  font-size: 15px;
}

table {
  width: 100%;
  border-collapse: collapse;
  font-family: sans-serif;
  font-size: 15px;
}
</style>
</body>
</html>