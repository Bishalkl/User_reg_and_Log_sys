<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    echo "Session variables not set. Please log in.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Header -->
    <header class="bg-blue-600 text-white py-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
            <nav class="flex space-x-4">
                <a href="./includes/logout.inc.php" class="hover:underline">Logout</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto my-8 p-6 max-w-4xl bg-white shadow-md rounded-lg">
        <!-- User Profile -->
        <section class="mb-6">
            <h2 class="text-xl font-semibold mb-2">User Profile</h2>
            <p class="text-gray-600">Here are your details:</p>
            <ul class="list-disc list-inside text-gray-700">
                <li><strong>Username:</strong> <?php echo htmlspecialchars($_SESSION['username']); ?></li>
                <li><strong>User ID:</strong> <?php echo $_SESSION['user_id']; ?></li>
                <li><strong>Session ID:</strong> <?php echo session_id(); ?></li>
            </ul>
        </section>

        <!-- Recent Activities -->
        <section>
            <h3 class="text-lg font-semibold mb-2">Recent Activities</h3>
            <!-- Placeholder for dynamic content (could be fetched from a database) -->
            <ul class="list-disc list-inside text-gray-700">
                <li>Logged in at <?php echo date('Y-m-d H:i:s'); ?></li>
                <li>Updated profile settings</li>
                <li>Made a purchase</li>
            </ul>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4 mt-8">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 Your Website. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
