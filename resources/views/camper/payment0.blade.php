<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirect to payment gateway</title>
</head>
<body>
   
    <p><b>Please wait while you are redirecting to secure bank sites...</b></p>

    <?php
        // redirect to payment gateway page
        header("refresh:3; url=" . route('app.booking.payment1', $booking->id));
        exit;
    ?>
</body>
</html>