<?php
include_once 'class/user.php';
include_once 'class/location.php';
include_once 'class/ride.php';

if (isset($_POST['action'])) {

    $action = $_POST['action'];
    switch ($action) {
        case 'Signup':
            if (isset($_POST['username'])) {
                $username = $_POST['username'];
                $email_id = $_POST['email'];
                $phone = $_POST['phone'];
                $password = $_POST['password'];
                $filename = $_FILES['file']['name'];
                $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
                $f_extension = strtolower($file_extension);
                $image_ext = array("jpg", "png", "jpeg", "gif");
                $response = 0;
                if (in_array($f_extension, $image_ext)) {
                    $newfilename = $filename . "_" . $username . "." . $f_extension;
                    $location = 'upload/' . $newfilename;
                    move_uploaded_file($_FILES['file']['tmp_name'], $location);
                }
                $obj = new user();
                $sstatus = $obj->Signup($email_id, $username, $phone, $status = 1, $password, $is_admin = 0, $location);
                echo $sstatus;
                break;
            }
        case 'logincheck':
            $email_id = $_POST['email_id'];
            $password = $_POST['password'];
            $obj = new user();
            $login = $obj->logincheck($email_id, $password);
            echo $login;
            break;
        case 'getData':
            $obj = new location();
            $status = $obj->locations();
            echo json_encode($status);
            break;
        case ('farecalculation'):
            $pick = $_POST['pick'];
            $drop = $_POST['drop'];
            $cabtype = $_POST['cabtype'];
            $luggage = $_POST['luggage'];

            $obj = new ride();
            $status = $obj->farecalculation($pick, $drop, $cabtype, $luggage);
            echo json_encode($status);

            break;
        case 'emailcheck':
            $email = $_POST['email'];
            $password = $_POST['password'];
            $obj = new user();
            $status = $obj->emailcheck($email, $password);
            echo $status;
            break;

        case 'bookride':
            $luggage = $_POST['luggage'];
            $carType = $_POST['carType'];
            $obj = new ride();
            $status = $obj->bookride($luggage, $carType);
            echo $status;
            break;


        case 'completeride':
            $obj = new ride();
            $status = $obj->completeride();
            echo json_encode($status);
            break;

        case 'pendingride':
            $obj = new ride();
            $status = $obj->pendingride();
            echo json_encode($status);
            break;
        case 'cancelride':
            $obj = new ride();
            $status = $obj->cancelride();
            echo json_encode($status);
            break;
        case 'totalamount':
            $obj = new ride();
            $status = $obj->totalamount();
            echo json_encode($status);
            break;


        case 'viewdetail':
            $ride_id = $_POST['ride_id'];
            $obj = new ride();
            $status = $obj->viewdetail($ride_id);
            echo json_encode($status);
            break;


        case 'cancel':
            $ride_id = $_POST['ride_id'];
            $obj = new ride();
            $status = $obj->cancel($ride_id);
            echo json_encode($status);
            break;

        case 'number':

            $obj = new ride();
            $status = $obj->number();
            echo json_encode($status);
            break;

        case 'alluser':
            $obj = new location();
            $status = $obj->alluser();
            echo json_encode($status);
            break;
        case 'allride':
            $obj = new ride();
            $status = $obj->allride();
            echo json_encode($status);
            break;

        case 'totalearning':
            $obj = new ride();
            $status = $obj->totalearning();
            echo json_encode($status);
            break;
        case 'tcancelride':
            $obj = new ride();
            $status = $obj->tcancelride();
            echo json_encode($status);
            break;


        case 'tpendingride':
            $obj = new ride();
            $status = $obj->tpendingride();
            echo json_encode($status);
            break;


        case ('block'):
            $e = $_POST['ew'];
            $obj = new user();
            $result = $obj->block($e);
            echo json_encode($result);
            break;

        case ('unblock'):
            $e = $_POST['ew'];
            $obj = new user();
            $result = $obj->unblock($e);
            echo json_encode($result);
            break;

        case ('approve'):
            $e = $_POST['e'];
            $obj = new ride();
            $result = $obj->approve($e);
            echo json_encode($result);
            break;

        case ('cancell'):
            $e = $_POST['e'];
            $obj = new ride();
            $result = $obj->cancell($e);
            echo json_encode($result);
            break;


        case 'tra':
            $select1 = $_POST['select1'];
            $select2 = $_POST['select2'];
            $e = $_POST['e'];
            $obj = new ride();
            $result = $obj->tra($select1, $select2, $e);
            echo json_encode($result);
            break;

        case ('Alocation'):
            $obj = new Location();
            $re = $obj->locationGet();
            echo json_encode($re);
            break;



        case ('addlocation'):
            $select1 = $_POST['select1'];
            $select2 = $_POST['select2'];
            $obj = new Location();
            $re = $obj->addlocation($select1, $select2);
            echo json_encode($re);
            break;

        case ('blockk'):
            $e = $_POST['e'];
            $obj = new location();
            $result = $obj->blockk($e);
            echo json_encode($result);
            break;
        case ('unblockk'):
            $e = $_POST['e'];
            $obj = new location();
            $result = $obj->blockk($e);
            echo json_encode($result);
            break;
    }
}
