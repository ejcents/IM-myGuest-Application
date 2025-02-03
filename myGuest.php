<?php
require_once 'database.php';

if($_SERVER["REQUEST_METHOD"]=="POST") {
    $firstname = $_POST['firstname'] ?? '';
    $lastname = $_POST['lastname'] ?? '';
    $email = $_POST['email'] ?? '';


    if(!empty($firstname) && !empty($lastname) && !empty($email)) {
         addGuests($conn, $firstname, $lastname, $email);
    }
}
// Fetch data from the database

    
$dataResult = fetchGuests($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            background-color: #333;
            padding: 15px;
        }
        .logo {
            color: white;
            font-size: 20px;
            font-weight: bold;
        }
        .menu a {
            color: white;
            text-decoration: none;
            padding: 10px;
            margin: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <div class="navbar">
        <div class="logo">My Hotel</div>
        <div class="menu">
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
            <a href="#">Guests</a>
        </div>
    </div>
        <h1> Add new Guest</h1>
        <form method="POST" action="">
       
        <input type="text" name="firstname" placeholder="firstname" require>
       
        <input type="text" name="lastname" placeholder="lastname" require>
        
        <input type="text" name="email" placeholder="email" require>
        <button type="submit">submit</button>


        </form>
    <!-- Guest List Content -->
    <h1>Guest List</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Registration Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($dataResult->num_rows > 0) {
                while ($row = $dataResult->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['firstname']}</td>
                        <td>{$row['lastname']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['reg_date']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No guests found</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>