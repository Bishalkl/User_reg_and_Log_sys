<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">

  <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-center mb-6">Login</h2>
    
    <!-- Login Form -->
    <form action="./includes/login.inc.php" method="POST">
      <!-- hidden input -->
       <input type="hidden" name="action" value="login">
      <!-- Email -->
      <div class="mb-4">
        <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
        <input type="email" id="email" name="email" required class="w-full mt-2 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
      </div>
      
      <!-- Password -->
      <div class="mb-4">
        <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
        <input type="password" id="password" name="password" required class="w-full mt-2 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
      </div>
      
      <!-- Submit Button -->
      <div class="mb-4">
        <button type="submit" class="w-full py-3 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-400">Login</button>
      </div>
      
      <!-- Register Link -->
      <div class="text-center">
        <p class="text-sm text-gray-600">Don't have an account? <a href="./signup.php" class="text-blue-600 hover:underline">Register</a></p>
      </div>
    </form>
  </div>

</body>
</html>
