<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Signup</title>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
  }
  
  body {
      background-color: #f0f2f5;
      color: #333;
  }
  
  .container {
      width: 90%;
      max-width: 1200px;
      margin: 0 auto;
  }
  

  .header {
      background-color: #4267b2; 
      padding: 15px 0;
  }
  
  .header .login-form {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
  }
  
  .header .login-form input {
      padding: 8px;
      border: none;
      border-radius: 4px;
      outline: none;
  }
  
  .header .login-form button {
      padding: 8px 12px;
      border: none;
      border-radius: 4px;
      background-color: #1877f2;
      color: #fff;
      cursor: pointer;
  }
  
  .header .login-form button:hover {
      background-color: #145dbf;
  }
  

  .main {
      padding: 50px 0;
      text-align: center;
  }
  
  .signup-form {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      display: inline-block;
      max-width: 400px;
      width: 100%;
  }
  
  .signup-form h2 {
      margin-bottom: 20px;
  }
  
  .signup-form input {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
      outline: none;
  }
  
  .signup-form button {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 4px;
      background-color: #1877f2;
      color: #fff;
      cursor: pointer;
      font-size: 16px;
  }
  
  .signup-form button:hover {
      background-color: #145dbf;
  }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="login-form">
                <form action="/login" method="POST">
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit">Log In</button>
                </form>
            </div>
        </div>
    </header>

    <main class="main">
        <div class="container">
            <div class="signup-form">
                <h2>Create an Account</h2>
                <form action="/signup" method="POST">
                    <label for="role">I am a:</label>
                    <select name="role" id="role" onchange="togglePatientFields()">
                        <option value="admin">Admin</option>
                        <option value="supervisor">Supervisor</option>
                        <option value="doctor">Doctor</option>
                        <option value="caregiver">Caregiver</option>
                        <option value="patient">Patient</option>
                    </select>
                    <input type="text" name="first_name" placeholder="First Name" required>
                    <input type="text" name="last_name" placeholder="Last Name" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="phone" name="phone" placeholder="Phone Number" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="date" name="dob" placeholder="Date of Birth" required>
    
                    <div id="patient-fields" style="display: none;">
                        <input type="text" name="family_code" placeholder="Family Code">
                        <input type="text" name="emergency_contact" placeholder="Emergency Contact Name">
                        <input type="text" name="relation_to_contact" placeholder="Relation to Contact">
                    </div>
    
                    <button type="submit">Sign Up</button>
                </form>
            </div>
        </div>
    
        <script>
            function togglePatientFields() {
                const role = document.getElementById('role').value;
                const patientFields = document.getElementById('patient-fields');
                if (role === 'patient') {
                    patientFields.style.display = 'block';
                } else {
                    patientFields.style.display = 'none';
                }
            }
        </script>
    </main>
</html>