<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="styles/styles_login.css">
</head>
<body>
<form method="post" action="authenticate.php">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <input type="submit" value="Login">
</form>


<script>
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');

    emailInput.addEventListener('focus', function() {
        this.parentNode.style.borderColor = '#007BFF';
    });

    emailInput.addEventListener('blur', function() {
        this.parentNode.style.borderColor = 'transparent';
    });

    passwordInput.addEventListener('focus', function() {
        this.parentNode.style.borderColor = '#007BFF';
    });

    passwordInput.addEventListener('blur', function() {
        this.parentNode.style.borderColor = 'transparent';
    });
</script>
</body>
</html>
