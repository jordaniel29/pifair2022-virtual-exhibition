<?php
  require_once("services/config.php");
  require_once("services/auth-admin.php");

  // Get teams with votes data
  $sql = 'SELECT team.team_name, COUNT(user.team_id) as votes
  FROM team LEFT JOIN user ON team.id = user.team_id 
  GROUP BY team.id
  ORDER BY votes DESC;';
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $teams = array(); //Create array to keep all results
  while ($res = $stmt->fetch(PDO::FETCH_ASSOC)){
    array_push($teams, $res);
  };

  // Get users data
  $sql = 'SELECT name, email, university, team_name
  FROM user INNER JOIN team ON team.id = user.team_id
  WHERE is_admin is false 
  GROUP BY team_id;';
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $users = array(); //Create array to keep all results
  while ($res = $stmt->fetch(PDO::FETCH_ASSOC)){
    array_push($users, $res);
  };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pifair 2022 - Admin</title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" language="javascript" src="https:////cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/admin-home.css" />
    <link
      href="https://fonts.googleapis.com/css?family=Roboto"
      rel="stylesheet"
    />
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
          $('.table-paginate').dataTable();
        } );
    </script>
</head>
<body>
  <div class="content">
    <?php include "admin-navbar.php" ?>
    <h1>Teams Ranking</h1>
    <table class="table table-striped table-team">
      <thead class="table-team-head">
        <tr>
          <th>Rank</th>
          <th>Team Name</th>
          <th>Number of Votes</th>
        </tr>
      </thead>
      <?php for ($i=0; $i<count($teams); $i++): ?>
        <tr>
          <td><?= $i+1 ?></td>
          <td><?= $teams[$i]["team_name"] ?></td>
          <td><?= $teams[$i]["votes"] ?></td>
        </tr>
      <?php endfor;?>
    </table>
    <h1 class="user-title">Users</h1>
    <table class="table table-paginate table-striped table-user">
      <thead class="table-user-head">
        <tr>
          <th>No</th>
          <th>Name</th>
          <th>Email</th>
          <th>University/Insitution</th>
          <th>Voted Team</th>
        </tr>
      </thead>
      <?php for ($i=0; $i<count($users); $i++): ?>
        <tr>
          <td><?= $i+1 ?></td>
          <td><?= $users[$i]["name"] ?></td>
          <td><?= $users[$i]["email"] ?></td>
          <td><?= $users[$i]["university"] ?></td>
          <td><?= $users[$i]["team_name"] ?></td>
        </tr>
      <?php endfor;?>
    </table>
  </div>
</body>
</html>