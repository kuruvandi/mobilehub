<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QuestionModel
 *
 * @author DRX
 */
class Question extends MY_Model {

    const DB_TABLE = 'questions';
    const DB_TABLE_PK = 'questionId';

    public $questionId;
    public $questionTitle;
    public $questionDescription;
    public $askerUserId;
    public $answerCount;
    public $askedOn;
    public $netVotes;
    public $upVotes;
    public $downVotes;
    public $categoryId;

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function basicSearch($query) {
        $this->db->like(array('questionTitle' => $query));
        $this->db->or_like(array('questionDescription' => $query));
        $res = $this->db->get('questions');
        return $res->result();
    }

    function advancedSearch($advWords, $advPhrase) {
        $this->db->like(array('questionTitle' => $advPhrase));
        $this->db->or_like(array('questionDescription' => $advPhrase));
        
        if (!($advWords === '')) {
            foreach ($advWords as $term) {
                $this->db->or_like('questionTitle', $term);
                $this->db->or_like('questionDescription', $term);
            }
        }

        $res = $this->db->get('questions');
        return $res->result();
    }

    function getQuestionWithTitle($qTitle) {
        $question = $this->db->get_where('questions', array('questionTitle' => $qTitle));
        $res = $question->result();
        return $res[0]->questionId;
    }

}

?>
