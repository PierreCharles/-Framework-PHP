
<h1>Welcome on TweetTweet</h1>

<form action="statuses" method="POST">
    <input type="hidden" name="_method" value="POST">

    <label for="user">Your Name</label>
    <input type="text" name="user">

    <label for="message">Your message:</label>
    <textarea name="message"></textarea>

    <input type="submit" value="Submit">
</form>


<?php 
	if(count($parameters['status'])<=0){
		echo "<h2>No status posted yet</h2>";
	}
	else {
?>

<table>
    <?php foreach ($parameters['status'] as $id => $status) : ?>
    <tr>
		<td><?= $status['message'] ?> <strong>@<?= $status['user'] ?></strong></td>
	</tr>
    <?php endforeach; ?>
</table>

<?php } ?>
