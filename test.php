<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reCAPTCHA demo: Simple page</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <formaction=" <?php echo $_SERVER['PHP_SELF'] ?> " method="POST">
      <div class="g-recaptcha" data-sitekey="6Ld-pekUAAAAAC2_jDw4dSOo7zbjlgqIrw1QpblL"></div>
      <br/>
      <input type="submit" value="Submit">
    </form>
  </body>
</html>