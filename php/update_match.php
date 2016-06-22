<?php
	include('setup.php');
	$match_query = "SELECT * FROM match_data LIMIT 1;";
	$match_data = $cxn->query($match_query)->fetch_assoc();
	$user1_id = $match_data['user1_id'];
	$user2_id = $match_data['user2_id'];
	$status = $match_data['status'];

    if (isset($_SESSION['user_id'])) {	//logged in
    	if ($status == 'completed') {
    		$user1_id = $_SESSION['user_id'];
    		$query = "UPDATE match_data SET user1_id=$user1_id, status='waiting' WHERE 1;";
    		$cxn->query($query);
    	}
    	elseif ($status == 'waiting' && $user1_id != $_SESSION['user_id']) {
    		$user2_id = $_SESSION['user_id'];
    		$query = "UPDATE match_data SET user2_id=$user2_id, status='started' WHERE 1;";
    		$cxn->query($query);
    	}
    	elseif ($status == 'started') {
    		$winner_id = $_GET['win'];

    		if (!filter_var($winner_id, FILTER_SANITIZE_NUMBER_INT) === false) {
    			$user1_query = "SELECT * FROM users WHERE id='$user1_id';";
				$user1_data = $cxn->query($user1_query)->fetch_assoc();
				$user1_elo = $user1_data['elo'];
				$user2_query = "SELECT * FROM users WHERE id='$user2_id';";
				$user2_data = $cxn->query($user2_query)->fetch_assoc();
				$user2_elo = $user2_data['elo'];

				$r1 = pow(10, $user1_elo/400);
				$r2 = pow(10, $user2_elo/400);
				$e1 = $r1 / ($r1 + $r2);
				$e2 = $r2 / ($r1 + $r2);
				$k = 100;
				$elo_diff = $k * (1 - $e1);
				if ($winner_id == $user1_id) {
					$new1 = $user1_elo + $elo_diff;
					$new2 = $user2_elo - $elo_diff;
					$user1_new = "UPDATE users SET wins=wins+1, elo=$new1 WHERE id=$user1_id;";
	    			$user2_new = "UPDATE users SET losses=losses+1, elo=$new2 WHERE id=$user2_id;";
				}
				else {
					$new1 = $user1_elo - $elo_diff;
					$new2 = $user2_elo + $elo_diff;
					$user1_new = "UPDATE users SET losses=losses+1, elo=$new1 WHERE id=$user1_id;";
	    			$user2_new = "UPDATE users SET wins=wins+1, elo=$new2 WHERE id=$user2_id;";
				}
	    		$match = "UPDATE match_data SET winner_id=$winner_id, status='completed', elo_diff=$elo_diff;";
	    		$cxn->query($match);
	    		$cxn->query($user1_new);
	    		$cxn->query($user2_new);
    		}
    	}
	}
	header("Location: ../index.php");
?>