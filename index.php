<?php
// check if user coming from request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // assign variables
    // V#8: Secure The Form By Filtering the Inputs
    $user = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT);
    $msg = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

    // recaptcha validation
    $secretKey = '6Lc5pukUAAAAAKAEVfbLwg2MuRPt2koTD6s4zmuR';
    $responseKey =  $_POST['g-recaptcha-response'];
    $userIp = $_SERVER['REMOTE_ADDR'];

    // $url = 'https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey'; fuck error:  because of single qouts  
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIp";
    $response = file_get_contents($url);
    // echo $response;
    $response = json_decode($response);
    
    // validate Form in server side
    // declare empty errors array
    $formErrors = array();

    if (strlen($user) < 4) {
        // assign into array to print it later in html
        $formErrors[] = "Username Must Be Larger Than <strong> 4</strong> Character";
    }
    if (strlen($msg) < 10) {
        $formErrors[] = "Message Can't Be Less Than <strong> 10 </strong> Character";
    }
    // recaptcha validation
    if (!$response->success) {
        $formErrors[] = "You Must Do Recaptcha Challenge";
    }

    // if no errors send the mail
    /**
     * mail ( string $to ,
     *  string $subject ,
     *  string $message
     *  [, mixed $additional_headers [, string $additional_parameters ]] ) : bool
     *
     */

    $myMail = 'ahmed.elwan568@gmail.com';
    $subject = "Contact Form Test";
    $headers = 'From: ' . $email . '\r\n';
    // $succeed = false;

    if (empty($formErrors)) {

        mail($myMail, $subject, $msg, $headers);

        $user = '';
        $email = '';
        $mobile = '';
        $msg = '';

        $succeed = '<div class="alert alert-success" id="success-alert"> We have recevied your message</div>';

    }

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- responsive framework -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- font awesome (very cool) -->
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <!-- main style -->
    <link rel="stylesheet" href="css/contact.css" type="text/css">
    <!-- google fonts (very cool) -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,300;0,400;0,700;0,900;1,900&display=swap">

    <title>Contact Form</title>
</head>

<body>

    <!-- Start Form here -->
    <div class="container">
        <h1 class="text-center">Contact Me</h1>

        <form class="contact-form" action=" <?php echo $_SERVER['PHP_SELF'] ?> " method="post">
            <!-- print errors div if array not empty -->
            <!-- validate in server side -->
            <?php if (!empty($formErrors)) {?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?php
                        foreach ($formErrors as $error ) {
                            echo $error . "<br />";
                        }
                    ?>
                </div>
            <?php } ?>

            <?php if(isset($succeed)){ echo $succeed;} ?>

            <div class="form-group">
                <input class="username form-control" type="text" name="username" placeholder="Type your username"
                    value="<?php if (isset($user)) echo $user; ?>" /> <!-- to prevent losing  data -->
                <i class="fas fa-user fa-fw"></i> <!-- fa-fw = fixed width -->
                <span class="asterisx">*</span>
                <!-- validate in client side using jQuery -->
                <div class="alert alert-danger custom-alert">
                    Username Must Be Larger Than <strong> 4</strong> Character
                </div>
            </div>

            <div class="form-group">
                <input class="email form-control" type="email" name="email" placeholder="Please type a vaild email"
                    value="<?php if (isset($email)) echo $email; ?>" />
                <i class="fas fa-envelope fa-fw"></i>
                <span class="asterisx">*</span>
                <!-- validate in client side using jQuery -->
                <div class="alert alert-danger custom-alert">
                    Email Can't Be <strong>Empty</strong>
                </div>
            </div>

            <div class="form-group">
                <input class="form-control" type="text" name="mobile" placeholder="Type your mobile"
                    value="<?php if (isset($mobile)) echo $mobile; ?>" />
                <i class="fas fa-phone-alt fa-fw"></i>
            </div>

            <div class="form-group">
                <textarea class="message form-control" name="message"
                    placeholder="Your Message!"><?php if (isset($msg)) {echo $msg;}?></textarea>
                <!-- validate in client side using jQuery -->
                <span class="asterisx">*</span>
                <div class="alert alert-danger custom-alert">
                    Message Can't Be Less Than <strong> 10 </strong> Character
                </div>
            </div>
            <div class="form-group">
                <div class="g-recaptcha" data-sitekey="6Lc5pukUAAAAAN2Ie-Uc558aUF4ZE2JBCehwM7lQ">
                </div>
                <div class="alert alert-danger custom-alert">
                    You Must Do <strong> Recaptcha </strong>  Challenge
                </div>
            </div>

            <div class="form-group">
                <input class="btn btn-success" type="submit" value="Send Message">
                <i class="fas fa-paper-plane fa-fw send-icon"></i>
            </div>

        </form>
    </div>
    <!-- End form here -->



    <script src="js/jquery-3.5.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</body>

</html>