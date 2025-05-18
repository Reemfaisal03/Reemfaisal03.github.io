<?php
session_start();

$h1 = mysqli_connect("localhost", "root", "", "neurocode");

if (!isset($_SESSION['username'])) {
    header("location:signin.html");
    exit();
}

$username = $_SESSION['username'];

$h2 = "SELECT * FROM users WHERE UserName = '$username'";
$r = mysqli_query($h1, $h2);
$row = mysqli_fetch_assoc($r); 


if (isset($_POST['logout'])) {
    session_destroy();
    header("location:homepage.html"); 
    exit();
}


$recent_activities = [
    ['description' => 'Completed a coding challenge', 'date' => '2025-05-15'],
    ['description' => 'Started a new project', 'date' => '2025-05-14'],
    ['description' => 'Explored advanced tutorials', 'date' => '2025-05-13'],
    ['description' => 'Participated in a discussion', 'date' => '2025-05-12'],
    ['description' => 'Won a coding competition', 'date' => '2025-05-11']
];


$quotes = [
    "Code is like humor. When you have to explain it, it’s bad.",
    "First, solve the problem. Then, write the code.",
    "Experience is the name everyone gives to their mistakes.",
    "In order to be irreplaceable, one must always be different."
];
$random_quote = $quotes[array_rand($quotes)];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - NeuroCode</title>
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="profile.css"> 
    <script>
    
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
        }
    </script>
</head>
<body>
    
    <nav class="navbar">
        <a href="homepage.html">Home</a>
        <a href="index.html">Explore</a>
        <a href="tutorials.html">Tutorials</a>
        <a href="challenges.html">Challenges</a>
        <a href="community.html">Community</a>
        <a href="profile.php">Profile</a>
        <a href="ai-chat.html">NeuroCode AI</a>
    </nav>

    <header class="hero-banner">
        <div class="hero-content">
            <h1>Welcome, <?php echo htmlspecialchars($row['FirstName']); ?> <?php echo htmlspecialchars($row['LastName']); ?>!</h1>
            <p>Empower your coding journey with NeuroCode.</p>
        </div>
    </header>

    <section class="user-info">
        <div class="info-card">
            <h2>User Information</h2>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($row['Email']); ?> <a href="update-email.html" class="active">Update</a> </p>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($row['UserName']); ?> </p>
        </div>
    </section>

    <section class="recent-activities">
        <h2>Recent Activities</h2>
        <ul>
            <?php
            if (count($recent_activities) > 0) {
                foreach ($recent_activities as $activity) {
                    echo "<li>" . htmlspecialchars($activity['description']) . " on " . htmlspecialchars($activity['date']) . "</li>";
                }
            } else {
                echo "<p>No recent activities available.</p>";
            }
            ?>
        </ul>
    </section>

    
    <section class="friends">
        <h2>Friends</h2>
        <ul>
            <?php
            
            $friends = ['Alice', 'Bob', 'Charlie', 'David', 'Eve'];
            foreach ($friends as $friend) {
                echo "<li>" . htmlspecialchars($friend) . "</li>";
            }
            ?>
        </ul>
    </section>

    <section class="badges">
        <h2>Achievements</h2>
        <div>
            <p>
            🏅Coding Champion, 🏅Bug Fixer, 🏅Fast Learner
            </p>
        </div>
    </section>


    <section class="notifications">
        <h2>Notifications</h2>
        <ul>
            <?php
            $notifications = [
                "You have a new friend request from Alice.",
                "Your coding challenge submission has been approved.",
                "Reminder: Complete your pending tutorials."
            ];
            foreach ($notifications as $notification) {
                echo "<li>" . htmlspecialchars($notification) . "</li>";
            }
            ?>
        </ul>
    </section>

    <section class="saved-items">
        <h2>Saved Tutorials</h2>
        <ul>
            <?php
            $saved_tutorials = ['Intro to Python', 'Advanced JavaScript', 'Machine Learning Basics'];
            foreach ($saved_tutorials as $tutorial) {
                echo "<li>" . htmlspecialchars($tutorial) . "</li>";
            }
            ?>
        </ul>
    </section>

    <section class="progress-tracker">
        <h2>Progress</h2>
        <div class="progress-bar">
            <div class="progress" style="width: 75%;"></div> 
        </div>
    </section>

    <section class="quote-section">
        <h2>Inspirational Quote</h2>
        <p class="quote"><?php echo $random_quote; ?></p>
    </section>

    <section class="dark-mode-toggle">
        <button onclick="toggleDarkMode()">Toggle Dark Mode</button>
    </section>

    <section class="logout-section">
        <form method="POST">
            <button type="submit" name="logout" class="logout-button">Log Out</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2025 NeuroCode. All rights reserved.</p>
    </footer>

    <style>

        body.dark-mode {
            background: #121212;
            color: #ffffff;
        }
        .progress-bar {
            width: 100%;
            background: #e0e0e0;
            height: 20px;
            border-radius: 10px;
            overflow: hidden;
        }
        .progress {
            height: 100%;
            background: #4caf50;
        }
    </style>
</body>
</html>