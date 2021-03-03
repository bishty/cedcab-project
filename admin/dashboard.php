<!DOCTYPE html>
<html lang="en">

<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
    <link rel="stylesheet" href="admin.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <title>Admin Details</title>
</head>

<body>
    <?php include_once 'header.php' ?>

    <div class="conatainer0">
        <div class="container1">
            <p>All users</p>
            <h3 id="alll"></h3>
            <button class="button" id="alluser" style="background-color:#f14e4e">For more Details</button>
        </div>
        <div class="container2">
            <p>ALL rides</p>
            <h3 id="all"></h3>
            <button class="button" id="allride" style="background-color:#f14e4e">For more Details</button>
        </div>
        <div class="container3">
            <p>Total Earning</p>
            <p id="ear"></p>

            <button class="button" id="totalearning" style="background-color:#f14e4e">For more Details</button>
        </div>

        <div class="container4">
            <p>Total cancel rides</p>
            <h3 id="allll"></h3>
            <button class="button" id="tcancelride" style="background-color:#f14e4e">For more Details</button>
        </div>
        <div class="container4">
            <p>Total pending rides</p>
            <h3 id="alllll"></h3>
            <button class="button" id="tpendingride" style="background-color:#f14e4e">For more Details</button>
        </div>
    </div>


    
    <table width=100%>
        <thead id="thead"></thead>
        <tbody id="tbody"></tbody>
        </tr>
    </table>
    <script>
        $(document).ready(function() {
            $("#alluser").click(function() {
                $("th").css("display", "none");
                $("td").css("display", "none");
                $('#alluser').prop("disabled", true);
                $('#allride').prop("disabled", false);
                $('#totalearning').prop("disabled", false);
                $('#tcancelride').prop("disabled", false);
                $('#tcompleteride').prop("disabled", false);
                $('#tpendingride').prop("disabled", false);
                $.ajax({
                    url: '../helper.php',
                    type: 'POST',
                    data: {
                        action: 'alluser'
                    },

                    success: function(data) {
                        let da = JSON.parse(data);
                        let len = da.length;

                        $("#alll").html(len);
                        $("#thead").append("<tr>");
                        $("#thead").append("<th>Sign-up date</th>");
                        $("#thead").append("<th>Email id</th>");
                        $("#thead").append("<th>Mobile</th>");
                        $("#thead").append("<th>Name</th>");
                        $("#thead").append("<th>User id</th>");
                        $("#thead").append("<th>Status</th>");
                        $("#thead").append("<th>Action</th>");
                        $("#thead").append("</tr>");
                        for (let i = 0; i < len; i++) {
                            if (da[i]['is_admin'] == 0) {
                                $("#tbody").append("<tr>");
                                $("#tbody").append("<td>" + da[i]['dateofsignup'] + "</td>");
                                $("#tbody").append("<td>" + da[i]['email_id'] + "</td>");
                                $("#tbody").append("<td>" + da[i]['mobile'] + "</td>");
                                $("#tbody").append("<td>" + da[i]['name'] + "</td>");
                                $("#tbody").append("<td>" + da[i]['user_id'] + "</td>");
                                if (da[i]['status'] == 0) {
                                    $("#tbody").append(
                                        "<td><button class='btn btn-danger' disabled >BLOCKED</button></td>"
                                    );
                                    $("#tbody").append("<td><button onclick='unblock(" + da[i][
                                            'user_id'
                                        ] +
                                        ")' class='btn btn-success' >UNBLOCK</button></td>");

                                } else if (da[i]['status'] == 1) {
                                    $("#tbody").append(
                                        "<td><button class='btn btn-success' disabled>UNBLOCKED</button></td>"
                                    );
                                    $("#tbody").append("<td><button onclick='block(" + da[i][
                                            'user_id'
                                        ] +
                                        ")' class='btn btn-danger' >BLOCK</button></td>");
                                }
                            }
                        }
                    }
                })
            })

            $("#allride").click(function() {
                $("th").css("display", "none");
                $("td").css("display", "none");
                $('#allride').prop("disabled", true);
                $('#alluser').prop("disabled", false);
                $('#totalearning').prop("disabled", false);
                $('#tcancelride').prop("disabled", false);
                $('#tcompleteride').prop("disabled", false);
                $('#tpendingride').prop("disabled", false);
                $.ajax({
                    url: '../helper.php',
                    type: 'POST',
                    data: {
                        action: 'allride'
                    },

                    success: function(data) {
                        let da = JSON.parse(data);
                        let len = da.length;
                        $("#all").html(len);
                     

                        $("#thead").append("<tr>");
                        $("#thead").append("<th> ID</th>");
                        $("#thead").append("<th> DATE</th>");
                        $("#thead").append("<th>FROM</th>");
                        $("#thead").append("<th> TO</th>");
                        $("#thead").append("<th>TOTAL-DISTANCE</th>");
                        $("#thead").append("<th>LUGGAGE</th>");
                        $("#thead").append("<th>TOATAL_FARE</th>");
                        $("#thead").append("<th>CUSTOMER ID </th>");
                        $("#thead").append("<th>CABTYPE</th>");
                        $("#thead").append("<th>Status</th>");
                        $("#thead").append("<th>Action</th>");
                        $("#thead").append("</tr>");
                        for (let i = 0; i < len; i++) {
                            $("#tbody").append("<tr>");
                            $("#tbody").append("<td>" + da[i]['id'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['date'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['from'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['to'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['total_distance'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['luggage'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['total_fare'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['customer_user_id'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['cabtype'] + "</td>");
                            if (da[i]['status'] == 1) {
                                $("#tbody").append("<td><button class='btn btn-warning'>Pending</button></td>");
                                $("#tbody").append("<td><button onclick='approve(" + da[i]['id'] + ")' class='btn btn-success'>Approve</button> <button onclick='cancel(" + da[i]['id'] + ")' class='btn btn-danger'>Cancel</button></td>");
                            } else if (da[i]['status'] == 0) {
                                $("#tbody").append("<td><button class='btn btn-success'>Cancelled</button></td>");
                                $("#tbody").append("<td><button class='btn btn-success' disabled>Approve</button> <button class='btn btn-danger' disabled>Cancel</button></td>");
                            } else if (da[i]['status'] == 2) {
                                $("#tbody").append("<td><button class='btn btn-success'>Completed</button></td>");
                                $("#tbody").append("<td><button class='btn btn-success' disabled>Approve</button> <button class='btn btn-danger' disabled>Cancel</button></td>");
                            }
                            $("#tbody").append("</tr>");
                        }
                    }
                });

            });

            $("#totalearning").click(function() {
                $("th").css("display", "none");
                $("td").css("display", "none");
                $('#totalearning').prop("disabled", true);
                $('#alluser').prop("disabled", false);
                $('#allride').prop("disabled", false);
                $('#tcancelride').prop("disabled", false);
                $('#tcompleteride').prop("disabled", false);
                $('#tpendingride').prop("disabled", false);
                $.ajax({

                    url: '../helper.php',
                    type: 'POST',
                    data: {
                        action: 'totalearning'
                    },

                    success: function(data) {
                        let da = JSON.parse(data);
                        let len = da.length;
                        let totalearning = 0;
                        $("#totalearning").html(len);
                        $("#thead").append("<tr>");
                        $("#thead").append("<th> ID</th>");
                        $("#thead").append("<th> DATE</th>");
                        $("#thead").append("<th>FROM</th>");
                        $("#thead").append("<th> TO</th>");
                        $("#thead").append("<th>TOTAL-DISTANCE</th>");
                        $("#thead").append("<th>LUGGAGE</th>");
                        $("#thead").append("<th>TOATAL_FARE</th>");
                        $("#thead").append("<th>CUSTOMER ID </th>");
                        $("#thead").append("<th>CABTYPE</th>");
                        $("#thead").append("<th>Status</th>");
                        $("#thead").append("<th>Action</th>");
                        $("#thead").append("</tr>");
                        for (let i = 0; i < len; i++) {
                            totalearning += parseInt(da[i]['total_fare']);
                            $("#ear").html(totalearning);
                            $("#tbody").append("<tr>");
                            $("#tbody").append("<td>" + da[i]['id'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['date'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['from'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['to'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['total_distance'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['luggage'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['total_fare'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['customer_user_id'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['cabtype'] + "</td>");
                            $("#tbody").append(
                                "<td><button class='btn btn-success'>COMPLETED</button></td>"
                            );


                        }
                    }

                });

            });





            ///////////////earning////////
            $("#tcancelride").click(function() {
                $("th").css("display", "none");
                $("td").css("display", "none");
                $('#allride').prop("disabled", false);
                $('#alluser').prop("disabled", false);
                $('#totalearning').prop("disabled", false);
                $('#tcancelride').prop("disabled", true);
                $('#tcompleteride').prop("disabled", false);
                $('#tpendingride').prop("disabled", false);
                $.ajax({
                    url: '../helper.php',
                    type: 'POST',
                    data: {
                        action: 'tcancelride'
                    },

                    success: function(data) {
                        let da = JSON.parse(data);
                        let len = da.length;
                        $("#allll").html(len);
                        $("#thead").append("<tr>");
                        $("#thead").append("<th> ID</th>");
                        $("#thead").append("<th> DATE</th>");
                        $("#thead").append("<th>FROM</th>");
                        $("#thead").append("<th> TO</th>");
                        $("#thead").append("<th>TOTAL-DISTANCE</th>");
                        $("#thead").append("<th>LUGGAGE</th>");
                        $("#thead").append("<th>TOATAL_FARE</th>");
                        $("#thead").append("<th>CUSTOMER ID </th>");
                        $("#thead").append("<th>CABTYPE</th>");
                        $("#thead").append("<th>Status</th>");
                        $("#thead").append("<th>Action</th>");
                        $("#thead").append("</tr>");
                        for (let i = 0; i < len; i++) {
                            $("#tbody").append("<tr>");
                            $("#tbody").append("<td>" + da[i]['id'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['date'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['from'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['to'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['total_distance'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['luggage'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['total_fare'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['customer_user_id'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['cabtype'] + "</td>");


                            $("#tbody").append(
                                "<td><button class='btn btn-success disabled'>CANCELED</button></td>"
                            );


                        }
                    }
                });

            });




            $("#tpendingride").click(function() {
                $("th").css("display", "none");
                $("td").css("display", "none");
                $('#allride').prop("disabled", false);
                $('#alluser').prop("disabled", false);
                $('#totalearning').prop("disabled", false);
                $('#tcancelride').prop("disabled", false);
                $('#tcompleteride').prop("disabled", false);
                $('#tpendingride').prop("disabled", true);
                $.ajax({
                    url: '../helper.php',
                    type: 'POST',
                    data: {
                        action: 'tpendingride'
                    },

                    success: function(data) {
                        let da = JSON.parse(data);
                        let len = da.length;
                        $("#alllll").html(len);
                        $("#thead").append("<tr>");
                        $("#thead").append("<th> ID</th>");
                        $("#thead").append("<th> DATE</th>");
                        $("#thead").append("<th>FROM</th>");
                        $("#thead").append("<th> TO</th>");
                        $("#thead").append("<th>TOTAL-DISTANCE</th>");
                        $("#thead").append("<th>LUGGAGE</th>");
                        $("#thead").append("<th>TOATAL_FARE</th>");
                        $("#thead").append("<th>CUSTOMER ID </th>");
                        $("#thead").append("<th>CABTYPE</th>");
                        $("#thead").append("<th>Status</th>");
                        $("#thead").append("<th>Action</th>");
                        $("#thead").append("</tr>");
                        for (let i = 0; i < len; i++) {
                            $("#tbody").append("<tr>");
                            $("#tbody").append("<td>" + da[i]['id'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['date'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['from'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['to'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['total_distance'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['luggage'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['total_fare'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['customer_user_id'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['cabtype'] + "</td>");
                            if (da[i]['status'] == 1) {
                                $("#tbody").append("<td><button class='btn btn-warning'>Pending</button></td>");
                                $("#tbody").append("<td><button onclick='approve(" + da[i]['id'] + ")' class='btn btn-success'>Approve</button> <button onclick='cancel(" + da[i]['id'] + ")' class='btn btn-danger'>Cancel</button></td>");
                            } else if (da[i]['status'] == 0) {
                                $("#tbody").append("<td><button class='btn btn-success'>Cancelled</button></td>");
                                $("#tbody").append("<td><button class='btn btn-success' disabled>Approve</button> <button class='btn btn-danger' disabled>Cancel</button></td>");
                            } else if (da[i]['status'] == 2) {
                                $("#tbody").append("<td><button class='btn btn-success'>Completed</button></td>");
                                $("#tbody").append("<td><button class='btn btn-success' disabled>Approve</button> <button class='btn btn-danger' disabled>Cancel</button></td>");
                            }
                            $("#tbody").append("</tr>");



                        }
                    }
                })

            });
        })

        function block(e) {
            $.ajax({
                type: 'POST',
                url: '../helper.php',
                data: {
                    ew: e,
                    action: 'block'
                },
                success: function(data) {
                    if (data == 1) {
                        alert("succcessfully blocked !");
                        location.replace('dashboard.php');
                    } else if (data == 0) {
                        alert("something went wrong !!");
                    }
                }

            })
        }

        function unblock(e) {
            $.ajax({
                type: 'POST',
                url: '../helper.php',
                data: {
                    ew: e,
                    action: 'unblock'
                },
                success: function(data) {
                    if (data == 1) {
                        alert("succcessfully unblocked !");
                        location.replace('dashboard.php');
                    } else if (data == 0) {
                        alert("something went wrong !!");
                    }
                }

            })
        }

        function approve(e) {
            // alert(e);
            $.ajax({
                url: '../helper.php',
                type: 'POST',
                data: {
                    e: e,
                    action: 'approve'
                },
                success: function(data) {
                    if (data == 1) {
                        location.replace('dashboard.php');
                    } else if (data == 0) {
                        alert("Please try again");
                    }
                }
            })
        }

        function cancel(e) {
            $.ajax({
                url: '../helper.php',
                type: 'POST',
                data: {
                    e: e,
                    action: 'cancell'
                },
                success: function(data) {
                    if (data == 1) {
                        location.replace('dashboard.php');
                    } else if (data == 0) {
                        alert("Something went wrong !!");
                    }
                }
            })
        }



     
    </script>
</body>

</html>