<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login Page</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">

    <style>
        /* Full body gradient background */
        body {
            font-family: "Poppins", sans-serif;
            background: linear-gradient(135deg, #001f3f, #f39c12);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            color: white;
        }

        /* Container for the image and form */
        .container {
            display: flex;
            width: 80%;
            max-width: 1000px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        /* Section for the image */
        .image-section {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            padding: 20px;
            background-color: #f8f9fa;
        }

        .image-section img {
            width: 100%;
            height: auto;
            object-fit: contain;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        /* Section for the form */
        .form-section {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: linear-gradient(135deg, #f39c12, #001f3f);
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        /* Text styling for form titles */
        .login-title {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #ffffff;
            text-align: center;
        }

        .sub-title {
            font-size: 16px;
            font-weight: 300;
            margin-bottom: 30px;
            color: #ffdbb5;
            text-align: center;
        }

        /* Form input fields */
        .form-field {
            margin-bottom: 20px;
            position: relative;
        }

        .form-field input {
            width: 100%;
            padding: 12px 15px 12px 40px;
            background: #f0f0f0;
            border: none;
            border-radius: 25px;
            color: #1b2a4e;
            font-size: 14px;
        }

        /* Icons inside the input fields */
        .form-field span.fas.fa-key,
        .form-field span.far.fa-envelope,
        .form-field span.fas.fa-user {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #1b2a4e;
        }

        /* Password visibility toggle */
        .form-field span.far.fa-eye,
        .form-field span.far.fa-eye-slash {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #1b2a4e;
        }

        /* Login button styling */
        button.btn {
            width: 100%;
            background: linear-gradient(135deg, #001f3f, #f39c12);
            color: white;
            border: none;
            border-radius: 25px;
            padding: 12px;
            font-weight: bold;
            transition: all 0.3s;
            margin-top: 20px;
            font-size: 16px;
        }

        /* Button hover effect */
        button.btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* Link styling */
        .text-center a {
            color: #ffffff;
            text-decoration: none;
            transition: color 0.3s;
            display: inline-block;
            margin-top: 15px;
        }

        .text-center a:hover {
            color: #ffdbb5;
            text-decoration: underline;
        }

        /* Password match indicator */
        .password-match {
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }

        .match {
            color: #4CAF50;
        }

        .no-match {
            color: #f44336;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                width: 90%;
            }
            
            .image-section {
                display: none;
            }
            
            .form-section {
                border-radius: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Image Section -->
        <div class="image-section">
          <img src="{{ asset('/LandingPage/image/Login.png') }}" alt="Sepatu Bersih">
        </div>

        <!-- Form Section -->
        <div class="form-section">
            <div class="login-title">Login Page</div>
            <div class="sub-title">tidak ada akun <a href="#">silahkan registrasi</a></div>
            
           <form class="p-3 mt-3" method="POST" action="{{ route('login') }}">
    @csrf
                
                <div class="form-field d-flex align-items-center">
                    <span class="far fa-envelope"></span>
                    <input type="email" name="email" id="email" placeholder="Email" required>
                </div>
                
                <div class="form-field d-flex align-items-center position-relative">
                    <span class="fas fa-key"></span>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <span class="far fa-eye position-absolute" id="togglePassword"></span>
                </div>
                
                
                <div id="passwordMatch" class="password-match"></div>
                
                <button type="submit" class="btn">Login</button>
            </form>
        </div>
    </div>

    <!-- Custom Script -->
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordField = document.getElementById('password');
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        // Toggle confirm password visibility
        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            const confirmPasswordField = document.getElementById('confirm_password');
            const type = confirmPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordField.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        // Check password match
        document.getElementById('confirm_password').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = this.value;
            const matchIndicator = document.getElementById('passwordMatch');
            
            if (confirmPassword === '') {
                matchIndicator.style.display = 'none';
                return;
            }
            
            if (password === confirmPassword) {
                matchIndicator.textContent = 'Passwords match!';
                matchIndicator.className = 'password-match match';
                matchIndicator.style.display = 'block';
            } else {
                matchIndicator.textContent = 'Passwords do not match!';
                matchIndicator.className = 'password-match no-match';
                matchIndicator.style.display = 'block';
            }
        });
    </script>
</body>
</html>