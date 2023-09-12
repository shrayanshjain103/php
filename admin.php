<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* CSS styles for the admin dashboard */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e0e0e0; /* Background color for the whole page */
        }

        #header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        #sidebar {
            background-color: #222;
            color: #fff;
            width: 250px;
            padding: 20px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
        }

        #content {
            padding: 20px;
            background-color: #fff; /* Content background color */
            border: 1px solid #dcdcdc; /* Content border */
            border-radius: 5px; /* Rounded corners for content */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Box shadow effect */
        }

        /* Style for navigation links */
        #sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
        }

        #sidebar a:hover {
            background-color: #444;
        }

        /* Style for the logout button */
        #logout-btn {
            background-color: #d9534f; /* Red color for the logout button */
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            position: absolute;
            top: 40px;
            right: 20px;
            transition: background-color 0.3s;
        }

        #logout-btn:hover {
            background-color: #c9302c; /* Darker red on hover */
        }

        /* Style for the table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff; /* Table background color */
            border: 1px solid #dcdcdc; /* Table border */
            border-radius: 5px; /* Rounded corners for table */
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #dcdcdc; /* Table cell border */
        }

        th {
            background-color: #d9534f; /* Header background color */
            color: #fff;
        }

        /* Style for the "Welcome, Admin" message */
        h2 {
            background-color: #007bff; /* Blue color for the message */
            color: #fff;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div id="header">
        <h1>Welcome to the Admin Dashboard</h1>
        <button id="logout-btn" onclick="logout()">Logout</button> 
    </div>
    <script>
        // JavaScript function to log out the admin
        function logout() {
            // You can add a confirmation dialog here if needed
            window.location.href = "logout.php";
        }
    </script>
</body>
</html>

<?php
     if(isset($_SESSION["user_type!==1"])){
         header("login.php");
         exit;
     }
    // session_start();
    $mysqli = require __DIR__ . "/database.php";
    
    // Fetch user information for admin users (user_type = 1)
    $sql = "SELECT id, name, email, status FROM user WHERE user_type='0'";
    $result = $mysqli->query($sql);
    
    
    // Check for errors or empty results
    if ($result === false || $result->num_rows == 0) {
        echo "No  users found.";
    } else {
        // Display user information in a table
        echo "<table border='1'>";
        echo "<tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
             </tr>";
    
        // ...
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            if($row["status"] == 0){
            echo '<td><p><a style="text-decoration:none;" href="status.php?id='.$row['id'].'&status=1">Enable</a></p></td>';
            }
            else{
            echo '<td><p><a style="text-decoration:none;" href="status.php?id='.$row['id'].'&status=0">Disable</a></p></td>';
            }
            echo "</tr>";
        }
        // ...

    
        echo "</table>";
    }
    
    // Close the database connection
    $mysqli->close();
 ?>