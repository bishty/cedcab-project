<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
    <link rel="stylesheet" href="locationdash.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <title>Update Location</title>
</head>

<body>
    <?php
    include_once('header.php');
    ?>
    <div class="loc">
        <input placeholder="Enter Location Name" id="select1" type="text">
        <input placeholder="Enter Distance" id="select2" type="number">
        <button id="ANLoc">Add New Location</button>
        <button id="update">update</button>
    </div>
    <table style="margin-top: 2%;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Distance</th>
                <th>Is Available</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="tbodyy">
        </tbody>
    </table>


</body>
<script>
    $(document).ready(function() {
        $("#ANLoc").show();
        $("#update").hide();
        $.ajax({
            url: '../helper.php',
            type: 'POST',
            data: {
                action: 'Alocation',
            },
            success: function(data) {
                let da = JSON.parse(data);
                for (let i = 0; i < da.length; i++) {
                    $("#tbodyy").append("<tr>");
                    $("#tbodyy").append("<td>" + da[i]['id'] + "</td>");
                    $("#tbodyy").append("<td>" + da[i]['name'] + "</td>");
                    $("#tbodyy").append("<td>" + da[i]['distance'] + "</td>");
                    if (da[i]['is_available'] == 1) {
                        $("#tbodyy").append("<td>Yes</td>");
                        $("#tbodyy").append("<td><button class='btn btn-danger' onclick='blockk(" + da[i]['id'] + ")'>Block</button> <button class='btn btn-success' onclick='edit()''>Edit</button></td>");

                    } else if (da[i]['is_available'] == 0) {
                        $("#tbodyy").append("<td>Not</td>");
                        $("#tbodyy").append("<td><button class='btn btn-success' onclick='unblockk(" + da[i]['id'] + ")'>Unblock</button> <button class='btn btn-success' onclick='edit()''>Edit</button></td>");

                    }
                    $("#tbodyy").append("</tr>");
                }
            }
        })
    });
    //////////////////add location////////////
    $(document).ready(function() {
        $("#ANLoc").click(function() {
            var select1 = $('#select1').val();
            var select2 = $('#select2').val();
            $.ajax({
                type: 'post',
                url: '../helper.php',
                data: {

                    action: 'addlocation',
                    select1: select1,
                    select2: select2,

                },
                success: function(data) {
                    location.replace('locationdash.php');
                }

            });
        });
    });

    function blockk(e) {
        $.ajax({
            url: '../helper.php',
            type: 'POST',
            data: {
                action: 'blockk',
                e: e
            },
            success: function(data) {
                if (data == 1) {
                    location.replace('locationdash.php');
                } else if (data == 0) {
                    alert("something went wrong !!");
                }
            }
        })

    }

    function unblockk(e) {
        alert();
        $.ajax({
            url: '../helper.php',
            type: 'POST',
            data: {
                action: 'unblockk',
                e: e
            },
            success: function(data) {
             
                if (data == 1) {
                    location.replace('locationdash.php');
                    
                } else if (data == 0) {
                    alert("something went wrong !!");
                }
            }
        })

    }
</script>

</html>