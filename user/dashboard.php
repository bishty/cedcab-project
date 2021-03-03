<?php include_once 'header.php' ?>
<?php include_once 'dbconn.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Akaya+Telivigala&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
    <link rel="stylesheet" href="user.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>Ride Details</title>
</head>

<body>
  
    <div class="conatainer0">
        <div class="container1">
            <p>Total Rides</p>
            <h1 id="TAP"></h1>
            <button class="button" id="completeride" style="background-color:#f14e4e">For more Details</button>
        </div>
        <div class="container2">
            <p>Pending Rides</p>
            <h1 id="TAP1"></h1>
            <button class="button" id="pendingride" style="background-color:#f14e4e">For more Details</button>
        </div>
        <div class="container3">
            <p>Cancel Ride</p>
            <h1 id="TAP2"></h1>


            <button class="button" id="cancelride" style="background-color:#f14e4e">For more Details</button>
        </div>
        <div class="container4">
            <p>Total Amount Paid</p>
            <h1 id="TAP3"></h1>
            <button class="button" id="totalamount" style="background-color:#f14e4e">For more Details</button>
        </div>
    </div>


    <!-- Modal content-->
    <div class="container">
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">RIDE DETAILS</h4>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <div id="sorting">
        <select id="select1">
            <option value="asc">Ascending</option>
            <option value="desc">Descending</option>
        </select>
        <select id="select2">
            <option value="date">Ride date</option>
            <option value="total_fare">Total Fare</option>
        </select>
        <button id="sortbtn">apply</button>
    </div>
   
    <table width=100%>
        <tr>
            <th> ID</th>
            <th> DATE</th>
            <th> FROM</th>
            <th> TO</th>
            <th> TOTAL-DISTANCE</th>
            <th>LUGGAGE</th>
            <th>TOATAL_FARE</th>
            <th>CUSTOMER ID</th>
            <th>CABTYPE</th>
            <th>ACTION</th>
        </tr>
        <tbody id="describe"></tbody>

    </table>
    <button class="button1"style="float: right;><a href="../index.php">Book Ride </a></button>
</body>
<script>
    $(document).ready(function() {
        $("#completeride").click(function() {
            $("#completeride").prop(disabled = "true");
            $("td").css('display', "none");
            $("#totalamount").prop(disabled = "false");
            $("#pendingride").prop(disabled = "false");
            $("#cancelride").prop(disabled = "false");
            $.ajax({
                type: 'post',
                url: '../helper.php',
                data: {
                    
                    action: 'completeride'
                },
                success: function(data) {
                    let dd = JSON.parse(data);
                    $("#sortbtn").attr('onclick', 'tra(' + dd[0]['customer_user_id'] + ');');
                    for (let i = 0; i < dd.length; i++) {
                        $("#describe").append("<tr>");
                        $("#describe").append("<td>" + dd[i]['id'] + "</td>");
                        $("#describe").append("<td>" + dd[i]['date'] + "</td>");
                        $("#describe").append("<td>" + dd[i]['from'] + "</td>");
                        $("#describe").append("<td>" + dd[i]['to'] + "</td>");
                        $("#describe").append("<td>" + dd[i]['total_distance'] + "</td>");
                        $("#describe").append("<td>" + dd[i]['luggage'] + "</td>");
                        $("#describe").append("<td>" + dd[i]['total_fare'] + "</td>");
                        $("#describe").append("<td>" + dd[i]['customer_user_id'] + "</td>");
                        $("#describe").append("<td>" + dd[i]['cabtype'] + "</td>");
                        $("#describe").append("<td><button class='btn btn-primary'  data-dismiss='modal' onclick='viewdetail(" + dd[i]['id'] + ")'>view details</button></td>");
                        $("#describe").append("</tr>");
                    }
                }
            })
        })


        $("#pendingride").click(function() {
            $("#completeride").prop(disabled = "false");
            $("td").css('display', "none");
            $("#totalamount").prop(disabled = "false");
            $("#pendingride").prop(disabled = "true");
            $("#cancelride").prop(disabled = "false");
            $.ajax({
                type: 'post',
                url: '../helper.php',
                action: 'pendingride',
                data: {
                    action: 'pendingride'
                },
                success: function(data) {
                    let dd = JSON.parse(data);
                  
                    for (let i = 0; i < dd.length; i++) {
                        $("#describe").append("<tr>");
                        $("#describe").append("<td>" + dd[i]['id'] + "</td>");
                        $("#describe").append("<td>" + dd[i]['date'] + "</td>");
                        $("#describe").append("<td>" + dd[i]['from'] + "</td>");
                        $("#describe").append("<td>" + dd[i]['to'] + "</td>");
                        $("#describe").append("<td>" + dd[i]['total_distance'] + "</td>");
                        $("#describe").append("<td>" + dd[i]['luggage'] + "</td>");
                        $("#describe").append("<td>" + dd[i]['total_fare'] + "</td>");
                        $("#describe").append("<td>" + dd[i]['customer_user_id'] + "</td>");
                        $("#describe").append("<td>" + dd[i]['cabtype'] + "</td>");
                        $("#describe").append("<td><button class='btn btn-primary'  data-dismiss='modal' onclick='viewdetail(" + dd[i]['id'] + ")'>view details</button><button class='btn btn-primary'  data-dismiss='modal', onclick='cancel(" + dd[i]['id'] + ")'>cancel</button></td>");
                        $("#describe").append("</tr>");
                    }
                }
            });
        });
        $("#completeride").prop(disabled = "false");
        $("td").css('display', "none");
        $("#totalamount").prop(disabled = "false");
        $("#pendingride").prop(disabled = "true");
        $("#cancelride").prop(disabled = "false");
        $.ajax({
            type: 'post',
            url: '../helper.php',
            action: 'pendingride',
            data: {
                action: 'pendingride'
            },
            success: function(data) {
               
                let dd = JSON.parse(data);
                $("#sortbtn").attr('onclick', 'tpr(' + dd[0]['customer_user_id'] + ');');

                for (let i = 0; i < dd.length; i++) {
                    $("#describe").append("<tr>");
                    $("#describe").append("<td>" + dd[i]['id'] + "</td>");
                    $("#describe").append("<td>" + dd[i]['date'] + "</td>");
                    $("#describe").append("<td>" + dd[i]['from'] + "</td>");
                    $("#describe").append("<td>" + dd[i]['to'] + "</td>");
                    $("#describe").append("<td>" + dd[i]['total_distance'] + "</td>");
                    $("#describe").append("<td>" + dd[i]['luggage'] + "</td>");
                    $("#describe").append("<td>" + dd[i]['total_fare'] + "</td>");
                    $("#describe").append("<td>" + dd[i]['customer_user_id'] + "</td>");
                    $("#describe").append("<td>" + dd[i]['cabtype'] + "</td>");
                    $("#describe").append("<td><button class='btn btn-primary'  data-dismiss='modal' onclick='viewdetail(" + dd[i]['id'] + ")'>view details</button><button class='btn btn-primary'  data-dismiss='modal', onclick='cancel(" + dd[i]['id'] + ")'>cancel</button></td>");
                    $("#describe").append("</tr>");
                }
            }
        });
        $("#cancelride").click(function() {
            $("#completeride").prop(disabled = "false");
            $("td").css('display', "none");
            $("#pendingride").prop(disabled = "false");
            $("#totalamount").prop(disabled = "false");
            $("#cancelride").prop(disabled = "true");

            $("td").css('display', "true");

            $.ajax({
                type: 'post',
                url: '../helper.php',
                action: 'cancelride',
                data: {
                    action: 'cancelride'
                },
                success: function(data) {
                    let dd = JSON.parse(data);
                    // console.log(dd);
                    for (let i = 0; i < dd.length; i++) {
                        $("#describe").append("<tr>");
                        $("#describe").append("<td>" + dd[i]['id'] + "</td>");
                        $("#describe").append("<td>" + dd[i]['date'] + "</td>");
                        $("#describe").append("<td>" + dd[i]['from'] + "</td>");
                        $("#describe").append("<td>" + dd[i]['to'] + "</td>");
                        $("#describe").append("<td>" + dd[i]['total_distance'] + "</td>");
                        $("#describe").append("<td>" + dd[i]['luggage'] + "</td>");
                        $("#describe").append("<td>" + dd[i]['total_fare'] + "</td>");
                        $("#describe").append("<td>" + dd[i]['customer_user_id'] + "</td>");
                        $("#describe").append("<td>" + dd[i]['customer_user_id'] + "</td>");
                        $("#describe").append("<td><button class='btn btn-primary'  data-dismiss='modal' onclick='viewdetail(" + dd[i]['id'] + ")'>view details</button></td>");
                        $("#describe").append("</tr>");
                    }
                }
            })
        });
    });
    $("#totalamount").click(function() {
        $("#completeride").prop(disabled = "false");
        $("td").css('display', "none");
        $("#totalamount").prop(disabled = "true");
        $("#cancelride").prop(disabled = "false");
        $("#pendingride").prop(disabled = "false");
        $.ajax({
            type: 'post',
            url: '../helper.php',
            action: 'totalamount',
            data: {
                action: 'totalamount'
            },
            success: function(data) {
                let dd = JSON.parse(data);
                for (let i = 0; i < dd.length; i++) {
                    $("#describe").append("<tr>");
                    $("#describe").append("<td>" + dd[i]['id'] + "</td>");
                    $("#describe").append("<td>" + dd[i]['date'] + "</td>");
                    $("#describe").append("<td>" + dd[i]['from'] + "</td>");
                    $("#describe").append("<td>" + dd[i]['to'] + "</td>");
                    $("#describe").append("<td>" + dd[i]['total_distance'] + "</td>");
                    $("#describe").append("<td>" + dd[i]['luggage'] + "</td>");
                    $("#describe").append("<td>" + dd[i]['total_fare'] + "</td>");
                    $("#describe").append("<td>" + dd[i]['customer_user_id'] + "</td>");
                    $("#describe").append("<td>" + dd[i]['cabtype'] + "</td>");
                    $("#describe").append("<td><button class='btn btn-primary'  data-dismiss='modal' onclick='viewdetail(" + dd[i]['id'] + ")'>view details</button></td>");
                    $("#describe").append("</tr>");
                }
            }
        });
    });

    ///////////////////view details///////////////////////


    function viewdetail(ride_id) {
        $.ajax({
            type: 'post',
            url: '../helper.php',
            data: {
                action: 'viewdetail',
                ride_id: ride_id,
            },
            success: function(data) {
                let dd = JSON.parse(data);

                for (i = 0; i < dd.length; i++) {
                    $(".modal-body").html("<h3>" + "<br>" + "Date=" + dd[i]['date'] + "<br>" + "pickup=" + dd[i]['from'] + "<br>" + "Droppoint=" + dd[i]['to'] + "<br>" +
                        "Total_Distance=" + dd[i]['total_distance'] + "<br>" + "Luggage=" + dd[i]['luggage'] + "<br>" + "Total_fare=" + dd[i]['total_fare'] + "<br>" + "Customer_id=" + dd[i]['customer_user_id'] + "<br>" + "cabtype=" + dd[i]['cabtype'] + "</h3>")
                    $("#myModal").modal('show');
                }

            }
        })
    }

    function cancel(ride_id) {

        if (confirm("really you want to cancel this ride")) {

            $.ajax({
                type: 'post',
                url: '../helper.php',
                data: {
                    action: 'cancel',
                    ride_id: ride_id,
                },
                success: function(data) {
                    alert(data);

                }
            });
        } else {


        }
    }

    $(document).ready(function() {
        $.ajax({
            url: '../helper.php',
            type: 'POST',
            data: {
                action: 'number'
            },
            success: function(data) {
                let da = JSON.parse(data);
                console.log(da);
                let len = da.length;
                console.log(len);
                let TotalAmount = 0;
                let PendingRide = 0;
                let CancelledRide = 0;
                for (let i = 0; i < len; i++) {
                    if (da[i]['status'] == 2) {
                        TotalAmount += parseInt(da[i]['total_fare']);
                    } else if (da[i]['status'] == 1) {
                        PendingRide += 1;
                    } else if (da[i]['status'] == 0) {
                        CancelledRide += 1;
                    }
                }
                $("#TAP3").html(TotalAmount);
                $("#TAP1").html(PendingRide);
                $("#TAP").html(len);
                $("#TAP2").html(CancelledRide);

            }

        })
    });

    /////////////////////sorting//////////////////////
    function apply() {
        $("#apply").click(function() {

            var select1 = $("#select1").val();
            var select2 = $("#select2").val();
            $.ajax({
                type: 'post',
                url: '../helper.php',
                data: {
                    action: 'apply',
                    select1: select1,
                    select2: select2
                },
                success: function(data) {

                    var dd = JSON.parse(data);
                    console.log(dd);
                    $("td").css('display', "none");
                    $("th").css('display', "none");
                    for (let i = 0; i < dd.length; i++) {
                        $("#describe").append("<tr>");
                        $("#describe").append("<td>" + dd[i]['id'] + "</td>");
                        $("#describe").append("<td>" + dd[i]['date'] + "</td>");
                        $("#describe").append("<td>" + dd[i]['from'] + "</td>");
                        $("#describe").append("<td>" + dd[i]['to'] + "</td>");
                        $("#describe").append("<td>" + dd[i]['total_distance'] + "</td>");
                        $("#describe").append("<td>" + dd[i]['luggage'] + "</td>");
                        $("#describe").append("<td>" + dd[i]['total_fare'] + "</td>");
                        $("#describe").append("<td>" + dd[i]['customer_user_id'] + "</td>");
                        $("#describe").append("<td>" + dd[i]['cabtype'] + "</td>");
                        $("#describe").append("<td><button class='btn btn-primary'  data-dismiss='modal' onclick='viewdetail(" + dd[i]['id'] + ")'>view details</button><button class='btn btn-primary'  data-dismiss='modal', onclick='cancel(" + dd[i]['id'] + ")'>cancel</button></td>");
                        $("#describe").append("</tr>");
                    }


                }


            })
        })
    }

    function tra(e) {
        var select1 = $("#select1").val();
        var select2 = $("#select2").val();
        $.ajax({
            url: '../helper.php',
            type: 'POST',

            data: {
                action: 'tra',
                select1: select1,
                select2: select2,
                e: e
            },
            success: function(data) {
                let dd = JSON.parse(data);
                $("td").css('display', "none");
                   
                for (let i = 0; i < dd.length; i++) {
                    $("#describe").append("<tr>");
                    $("#describe").append("<td>" + dd[i]['id'] + "</td><td>" + dd[i]['date'] + "</td><td>" + dd[i]['from'] + "</td>");
                    $("#describe").append("<td>" + dd[i]['to'] + "</td>");
                    $("#describe").append("<td>" + dd[i]['total_distance'] + "</td>");
                    $("#describe").append("<td>" + dd[i]['luggage'] + "</td>");
                    $("#describe").append("<td>" + dd[i]['total_fare'] + "</td>");
                    $("#describe").append("<td>" + dd[i]['customer_user_id'] + "</td>");
                    $("#describe").append("<td>" + dd[i]['cabtype'] + "</td>");
                    $("#describe").append("<td><button class='btn btn-primary'  data-dismiss='modal' onclick='viewdetail(" + dd[i]['id'] + ")'>view details</button><button class='btn btn-primary'  data-dismiss='modal', onclick='cancel(" + dd[i]['id'] + ")'>cancel</button></td>");
                    $("#describe").append("</tr>");
                }
            }

        })
    }
   
</script>

</html>