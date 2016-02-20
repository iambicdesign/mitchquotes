<?php

class votemodel extends Model {

	public $unique_votes = true;

	public function ableToVote($voters_ip, $quote_id, $type) {
		$able_to_vote = false;
		if($this->unique_votes == true) {
			$sql = "SELECT COUNT(*) AS votes FROM votes WHERE voters_ip = :voters_ip AND quote_id = :quote_id AND vote_type = :type";
			$query = $this->db->prepare($sql);
			$parameters = array(':voters_ip' => $voters_ip, ':quote_id' => $quote_id, ':type' => $type);
			$query->execute($parameters);
			$result = $query->fetch();
			if($result->votes == 0) $able_to_vote = true;
		} else {
			$able_to_vote = true;
		}

		return $able_to_vote;
	}
	public function addVote($quote_id = 0, $type = 'up') {
	    $voters_ip = Helper::get_visitor_ip_address();
		if($this->ableToVote($voters_ip, $quote_id, $type) == true) {
			// Going from up to down, down to up? Change vote type in DB
			if($this->isChangingVote($quote_id, $voters_ip, $type)) {
				$sql = "UPDATE votes SET vote_type = :vote_type WHERE quote_id = :quote_id AND voters_ip = :voters_ip";
				$query = $this->db->prepare($sql);
				$parameters = array(':vote_type' => $type, ':quote_id' => $quote_id, ':voters_ip' => $voters_ip);
				$query->execute($parameters);
				$voted = true;
			} else {
		        $sql = "INSERT INTO votes (quote_id, voters_ip, vote_type, date_added_gmt) VALUES (:quote_id, :voters_ip, :vote_type, :date_added_gmt)";
		        $query = $this->db->prepare($sql);
		        $parameters = array(':quote_id' => $quote_id, ':voters_ip' => $voters_ip, ':vote_type' => $type, 
		        ':date_added_gmt' => date('Y-m-d H:i:s'));
		        $query->execute($parameters);
		        $voted = true;
		    }
	    } else $voted = false;

	    return $voted;
	}

	/**
	 * Check to see if this voter has voted for this quote, and is now trying to vote the opposite
	 */
	public function isChangingVote($quote_id, $voters_ip, $type) {
		$changing_vote = false;
		$old_type = $type == 'up' ? 'down' : 'up';
		$sql = "SELECT COUNT(*) AS votes FROM votes WHERE voters_ip = :voters_ip AND quote_id = :quote_id AND vote_type = :old_type";
		$query = $this->db->prepare($sql);
		$parameters = array(':voters_ip' => $voters_ip, ':quote_id' => $quote_id, ':old_type' => $old_type);
		$query->execute($parameters);
		$result = $query->fetch();
		if($result->votes > 0) $changing_vote = true;
		return $changing_vote;
	}

	public function countVotes($quote_id, $type = 'up') {
		$parameters = array();
		$sql = "SELECT COUNT(*) AS votes FROM votes WHERE quote_id = :quote_id";
		if($type != 'all') {
			$sql .= " AND vote_type = :type";
			$parameters[':type'] = $type;
		}
		$query = $this->db->prepare($sql);
		$parameters[':quote_id'] = $quote_id;
		$query->execute($parameters);
		$result = $query->fetch();
		return $result->votes;
	}
}