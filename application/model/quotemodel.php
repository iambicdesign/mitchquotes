<?php

class quotemodel extends Model {
	public function getRandom() {
		$sql = "SELECT * FROM quotes ORDER BY RAND() LIMIT 1";
		$query = $this->db->prepare($sql);
		$query->execute();
		$result = $query->fetch();

        require_once APP . 'model/votemodel.php';
        $votemodel = new votemodel($this->db);

        $result->upvotes = $votemodel->countVotes($result->ID, 'up');
        $result->downvotes = $votemodel->countVotes($result->ID, 'down');
        return $result;
	}

    public function getRandomID() {
        $result = $this->getRandom();
        return $result->ID;
    }

    public function getTop($limit) {
        $sql = "SELECT COUNT(quote_id) vote_count, quote_id FROM votes WHERE vote_type = 'up' GROUP BY quote_id ORDER BY vote_count DESC LIMIT $limit";
        $query = $this->db->prepare($sql);
        $query->execute();
        $results = $query->fetchAll();
        $quotes = array();
        if(!empty($results)) {
            foreach($results as $result_key => $result) {
                $quotes[] = $this->getByID($result->quote_id);
            }
        }

        return $quotes;
    }

    public function getBottom($limit) {
        $sql = "SELECT COUNT(quote_id) vote_count, quote_id FROM votes WHERE vote_type = 'down' GROUP BY quote_id ORDER BY vote_count DESC LIMIT $limit";
        $query = $this->db->prepare($sql);
        $query->execute();
        $results = $query->fetchAll();
        $quotes = array();
        if(!empty($results)) {
            foreach($results as $result_key => $result) {
                $quotes[] = $this->getByID($result->quote_id);
            }
        }

        return $quotes;
    }

    public function getLatest($limit) {
        $sql = "SELECT * FROM quotes ORDER BY ID DESC LIMIT $limit";
        $query = $this->db->prepare($sql);
        $query->execute();
        $results = $query->fetchAll();
        $quotes = array();
        if(!empty($results)) {
            foreach($results as $result_key => $result) {
                $quotes[] = $this->getByID($result->ID);
            }
        }

        return $quotes;
    }

    public function getByID($id) {
        $sql = "SELECT * FROM quotes WHERE ID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);
        $result = $query->fetch();

        require_once APP . 'model/votemodel.php';
        $votemodel = new votemodel($this->db);

        $result->upvotes = $votemodel->countVotes($result->ID, 'up');
        $result->downvotes = $votemodel->countVotes($result->ID, 'down');
        return $result;
    }
}