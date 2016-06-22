<?php
	include('setup.php');
	$match_query = "SELECT * FROM match_data LIMIT 1;";
	$match_data = $cxn->query($match_query)->fetch_assoc();
	$user1_id = $match_data['user1_id'];
	$user2_id = $match_data['user2_id'];
	$status = $match_data['status'];
	$winner_id = $match_data['winner_id'];
	$loser_id = $match_data['loser_id'];
	$elo_diff = $match_data['elo_diff'];
	$updated = $match_data['updated'];

	if ($user1_id != NULL) {
		$user1_query = "SELECT * FROM users WHERE id='$user1_id';";
		$user1_data = $cxn->query($user1_query)->fetch_assoc();
		$user1_name = $user1_data['name'];
		$user1_image_url = $user1_data['image_url'];
		$user1_wins = $user1_data['wins'];
		$user1_losses = $user1_data['losses'];
		$user1_elo = $user1_data['elo'];
	}
	if ($user2_id != NULL) {
		$user2_query = "SELECT * FROM users WHERE id='$user2_id';";
		$user2_data = $cxn->query($user2_query)->fetch_assoc();
		$user2_name = $user2_data['name'];
		$user2_image_url = $user2_data['image_url'];
		$user2_wins = $user2_data['wins'];
		$user2_losses = $user2_data['losses'];
		$user2_elo = $user2_data['elo'];
	}	
?>
<h1>Match (<?php print($status); ?>)</h1>
<div class='col-md-6'> <!-- User1 -->
	<?php if ($status == 'completed'): ?>
		<h3><?php print($user1_name . ' (' . $user1_elo . ')'); ?></h3>
    	<img src="<?php print($user1_image_url); ?>" class="pro-pic">
    	<p><?php print($user1_wins . '-' . $user1_losses); ?></p>
    	<?php if($winner_id == $user1_id): ?>
			<h4>Winner!</h4>
			<?php print($user1_elo - $elo_diff); ?> <i class="fa fa-level-up" aria-hidden="true"></i> <?php print($elo_diff); ?>
		<?php else: ?>
			<h4>Loser!</h4>
			<?php print($user1_elo + $elo_diff); ?> <i class="fa fa-level-down" aria-hidden="true"></i> <?php print($elo_diff); ?>
		<?php endif; ?>
    <?php elseif ($status == 'waiting'): ?>
    	<h3><?php print($user1_name . ' (' . $user1_elo . ')'); ?></h3>
    	<img src="<?php print($user1_image_url); ?>" class="pro-pic">
    	<p><?php print($user1_wins . '-' . $user1_losses); ?></p>
   	<?php elseif ($status == 'started'): ?>
		<h3><?php print($user1_name . ' (' . $user1_elo . ')'); ?></h3>
    	<img src="<?php print($user1_image_url); ?>" class="pro-pic">
    	<p><?php print($user1_wins . '-' . $user1_losses); ?></p>
    	<a href="php/update_match.php?win=<?php print($user1_id); ?>"><button class="winner"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Winner</button></a>
	<?php endif; ?>
</div>
<div class='col-md-6'> <!-- User2 -->
	<?php if ($status == 'completed'): ?>
		<h3><?php print($user2_name . ' (' . $user2_elo . ')'); ?></h3>
    	<img src="<?php print($user2_image_url); ?>" class="pro-pic">
    	<p><?php print($user2_wins . '-' . $user2_losses); ?></p>
    	<?php if($winner_id == $user2_id): ?>
			<h4>Winner!</h4>
			<?php print($user2_elo - $elo_diff); ?> <i class="fa fa-level-up" aria-hidden="true"></i> <?php print($elo_diff); ?>
		<?php else: ?>
			<h4>Loser!</h4>
			<?php print($user2_elo + $elo_diff); ?> <i class="fa fa-level-down" aria-hidden="true"></i> <?php print($elo_diff); ?>
		<?php endif; ?>
    <?php elseif ($status == 'waiting'): ?>
    	<a href="php/update_match.php"><button class="join"><i class="fa fa-plus-circle" aria-hidden="true"></i> Join Match</button></a>
   	<?php elseif ($status == 'started'): ?>
   		<h3><?php print($user2_name . ' (' . $user2_elo . ')'); ?></h3>
    	<img src="<?php print($user2_image_url); ?>" class="pro-pic">
    	<p><?php print($user2_wins . '-' . $user2_losses); ?></p>
    	<a href="php/update_match.php?win=<?php print($user2_id); ?>"><button class="winner"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Winner</button></a>
   	<?php endif; ?>
</div>