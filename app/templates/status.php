<?php 
	if(count($parameters['status'])<=0){
		echo "<h2>No status</h2>";
	}
	else {
?>
<form action="/statuses/<?= $parameters['status']['id'] ?>" method="POST">
	<table>
		<tr>
			<td><strong><?= $parameters['status']['user']?></strong></td>
			<td><?= $parameters['status']['message']?></td>
			<td><a href="#">
				<input type="hidden" name="_method" value="DELETE">
				<input type="submit" value="X"></td>
			</a></tr>
	</table>   
</form>

<?php } ?>
