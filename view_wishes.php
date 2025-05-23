<?php
$host = 'localhost';
$db   = 'wedding';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name, message, created_at FROM wish ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Wedding Wishes Table</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style>
    body {
      font-family: 'Georgia', serif;
      background: #fffafc;
      margin: 0;
      padding: 30px;
    }
    h1 {
      text-align: center;
      color: #e91e63;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px;
      background: #fff;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 15px;
      border: 1px solid #ddd;
      text-align: left;
      vertical-align: top;
    }
    th {
      background-color: #fce4ec;
      color: #c2185b;
    }
    tr:nth-child(even) {
      background-color: #f9f9f9;
    }
    .back-link {
      text-align: center;
      margin-top: 30px;
    }
    .back-link a {
      text-decoration: none;
      color: #e91e63;
      font-weight: bold;
    }
  </style>
</head>
<body>

  <h1>Wedding Wishes</h1>

  <?php if ($result->num_rows > 0): ?>
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Message</th>
          <th>Date & Time</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
            <td><?= $row['created_at'] ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p>No wishes yet. Be the first to send one!</p>
  <?php endif; ?>

  <div class="back-link">
    <p><a href="index.html">← Back</a></p>
  </div>

</body>
</html>

<?php $conn->close(); ?>
