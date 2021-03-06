<?php

class Scoreboard extends AppModel {
	public $recursive = -1;

	public $primaryKey = 'id_scoreboard';

	public $belongsTo = array(
		'User'
	);

	public function getPivotTable($quiz, $problems) {
		
		/* ACM ICPC Scoring Style */
		
		$problemsPivot = "";

		foreach ($problems as $problem) {
			$problemsPivot .= "SUM(CASE WHEN scoreboards.problem_id = " . $problem['Problem']['id_problem'] . " THEN scoreboards.score END) AS `" . $problem['Problem']['unique_name'] . "`, ";
		}

		$pivotQuery = 
		"SELECT " . 
			"users.display_name, " .
			"roles.name, " .
			"scoreboards.attempt, " .
			"SUM(IF(scoreboards.score = 100, 1, 0)) AS `_solved`, " .
			"SUM(scoreboards.attempt) AS `_attempts`, " .

			$problemsPivot .
			
			"SUM(scoreboards.score) as `_total`, " .
			"SUM(CASE " . 
				"WHEN scoreboards.score = 0 THEN 0 " .
				"WHEN scoreboards.score < 100 THEN UNIX_TIMESTAMP(scoreboards.last_accepted_attempt) - UNIX_TIMESTAMP('" . $quiz['Quiz']['start_time'] . "') + 1200 * (scoreboards.attempt) " . 
				"WHEN scoreboards.score = 100 THEN UNIX_TIMESTAMP(scoreboards.last_accepted_attempt) - UNIX_TIMESTAMP('" . $quiz['Quiz']['start_time'] . "') + 1200 * (scoreboards.attempt - 1) " .
			"END) AS `_elapsed_time` " .

		"FROM scoreboards, users, roles " .
		
		"WHERE " .
			"scoreboards.quiz_id = " . $quiz['Quiz']['id_quiz'] . " AND " .
			"scoreboards.user_id = users.id_user AND " .
			"users.role_id = roles.id_role " .

		"GROUP BY " .
			"users.id_user " .

		"ORDER BY " .
			"`_total` DESC," .
			"`_elapsed_time` ASC";

		return $this->query($pivotQuery);
	}

	public function getSingleUserPivotTable($userId, $quiz, $problems) {
		
		/* ACM ICPC Scoring Style */
		
		$problemsPivot = "";

		foreach ($problems as $problem) {
			$problemsPivot .= "SUM(CASE WHEN scoreboards.problem_id = " . $problem['Problem']['id_problem'] . " THEN scoreboards.score END) AS `" . $problem['Problem']['unique_name'] . "`, ";
		}

		$pivotQuery = 
		"SELECT " . 
			"users.display_name, " .
			"roles.name, " .
			"scoreboards.attempt, " .
			"SUM(IF(scoreboards.score = 100, 1, 0)) AS `_solved`, " .
			"SUM(scoreboards.attempt) AS `_attempts`, " .

			$problemsPivot .
			
			"SUM(scoreboards.score) as `_total`, " .
			"SUM(CASE " . 
				"WHEN scoreboards.score = 0 THEN 0 " .
				"WHEN scoreboards.score < 100 THEN UNIX_TIMESTAMP(scoreboards.last_accepted_attempt) - UNIX_TIMESTAMP('" . $quiz['Quiz']['start_time'] . "') + 1200 * (scoreboards.attempt) " . 
				"WHEN scoreboards.score = 100 THEN UNIX_TIMESTAMP(scoreboards.last_accepted_attempt) - UNIX_TIMESTAMP('" . $quiz['Quiz']['start_time'] . "') + 1200 * (scoreboards.attempt - 1) " .
			"END) AS `_elapsed_time` " .

		"FROM scoreboards, users, roles " .
		
		"WHERE " .
			"scoreboards.quiz_id = " . $quiz['Quiz']['id_quiz'] . " AND " .
			"scoreboards.user_id = users.id_user AND " .
			"users.role_id = roles.id_role AND " .
			"scoreboards.user_id = " . $userId . " " . 

		"GROUP BY " .
			"users.id_user " .

		"ORDER BY " .
			"`_total` DESC," .
			"`_elapsed_time` ASC";

		return $this->query($pivotQuery);
	}
}