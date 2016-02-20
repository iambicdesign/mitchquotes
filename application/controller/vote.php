<?php

/**
 * Class Vote
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Vote extends Controller
{
    /**
     * Whenever controller is created, open a database connection too and load "the model".
     */
    function __construct()
    {
        parent::__construct();
        $this->loadModel('votemodel');
    }

    public function up($id) {
        $voted = $this->votemodel->addVote($id, 'up');
        $response = array('status' => $voted == true ? 'success' : 'failure', 'upvotes' => $this->votemodel->countVotes($id, 'up'),
             'downvotes' => $this->votemodel->countVotes($id, 'down'));
        echo json_encode($response);
    }

    public function down($id) {
        $voted = $this->votemodel->addVote($id, 'down');
        $response = array('status' => $voted == true ? 'success' : 'failure', 'downvotes' => $this->votemodel->countVotes($id, 'down'),
            'upvotes' => $this->votemodel->countVotes($id, 'up'));
        echo json_encode($response);
    }
}
