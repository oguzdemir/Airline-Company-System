<?PHP
    $u_id = $_POST['user_name'];
    $u_pass = $_POST['inputPassword'];

    $servername = "127.0.0.1";
    $user = "root";
    $pass = "mfs12";
    $dbname = "airline";

    $con = mysqli_connect($servername, $user, $pass, $dbname);

    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $sql = "SELECT * FROM manager NATURAL JOIN reservationauthoritative WHERE username='".$u_id."' AND password='".$u_pass."'";
    $res = mysqli_query($con, $sql);

    if (mysqli_num_rows($res) > 0){
        header('Location: manager/index.php');
    }
    else{
        $sql = "SELECT * FROM customer WHERE user_name='".$u_id."' AND password='".$u_pass."'";
        $res = mysqli_query($con, $sql);

        if (mysqli_num_rows($res) == 1){
            header('Location: customer/index.php');
        }
        else{
            header('Location: index2.php?r=1');
        }
    }

?>