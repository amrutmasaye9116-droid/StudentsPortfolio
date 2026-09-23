<?php
include("../database/connection.php");

$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);
?>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Course</th>
    <th>Year</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result))
{
?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['full_name']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['course']; ?></td>
    <td><?php echo $row['year']; ?></td>
</tr>

<?php } ?>

</table>