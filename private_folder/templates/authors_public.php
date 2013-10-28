<form method="post" action="">
    Име: <input type="text" name="author_name" />
    <input type="submit" value="Добави" />    
</form>

<?php
foreach ($data['errors'] as $value) {
    echo '<div class="error">' . $value . '</div>';
}
?>
<table >
    <tr><th>Автор</th></tr>

<?php
foreach ($data['authors'] as $row) {
    echo '<tr><td>' . $row['author_name'] . '</td></tr>';
}
?>

</table>