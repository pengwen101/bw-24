<?php
class Database
{

    var $db_server = 'localhost';
    var $db_username = 'root';
    var $db_password = '';
    var $db_name = 'quiz';
    var $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO('mysql: host=' . $this->db_server . '; dbname='. $this->db_name, $this->db_username, $this->db_password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("ERROR COULD NOT CONNECT" . $e->getMessage());
        }
    }

    //get all questions
    public function getQuestions()
    {
        $sql = "SELECT * FROM questions";
        if ($result = $this->pdo->query($sql)) {
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        return -1;
    }

    //get all answer choices for a certain question
    public function getAnswers($q_id)
    {
        $sql = "SELECT * FROM answers WHERE q_id = :q_id";
        if ($stmt = $this->pdo->prepare($sql)) {
            $stmt->bindParam(":q_id", $q_id);
            if ($stmt->execute()) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            return -1;
        }
        return -1;
    }

    //insert user's test result
    //answers_id is an array filled with the answers that the user has chosen
    public function insertResult($nrp, $full_name, $answers_id)
    {
        $full_result = "";

        //full result convert answers_id to string
        //ex: answers_id = ['Q1A', 'Q2B'], full_result = 'Q1A;Q2B;'
        foreach ($answers_id as $answer_id) {
            $full_result .= $answer_id . ";";
        }

        $categories = $this->getCategories();
        if($categories==-1) return -1;

        //total the points for each category
        $result = [];
        foreach ($categories as $category) {
            $points_per_category = 0;
            foreach ($answers_id as $answer_id) {
                if ($this->getCategory($answer_id) == $category) {
                    $points_per_category += $this->getPoints($answer_id);
                }
            }

            $result[$category] = $points_per_category;
        }


        $kenyamanan = $result['comfort'];
        $pengakuan = $result['acknowledgement'];
        $penerimaan = $result['affirmation'];
        $kontrol = $result['order'];
        $kuasa = $result['dominance'];
        $superioritas = $result['excellence'];
        $kebebasan = $result['freedom'];

        //convert assoc array result to string of sorted categories based on points descending
        
        arsort($result);
        $tops = "";
        foreach ($result as $key => $value) {
            $tops .= $key . ";";
        }
        
        $dt = new DateTime("now", new DateTimeZone('Asia/Jakarta'));

        $created_at = $dt->format('Y-m-d H:i:s');

        $sql = "INSERT INTO results (nrp, full_name, kenyamanan, pengakuan, penerimaan, kontrol, kuasa, superioritas, kebebasan, full_result, tops, created_at) VALUES (:nrp, :full_name, :kenyamanan, :pengakuan, :penerimaan, :kontrol, :kuasa, :superioritas, :kebebasan, :full_result, :tops, :created_at)";
        if ($stmt = $this->pdo->prepare($sql)) {
            $stmt->bindParam(":nrp", $nrp);
            $stmt->bindParam(":full_name", $full_name);
            $stmt->bindParam(":kenyamanan", $kenyamanan);
            $stmt->bindParam(":pengakuan", $pengakuan);
            $stmt->bindParam(":penerimaan", $penerimaan);
            $stmt->bindParam(":kontrol", $kontrol);
            $stmt->bindParam(":kuasa", $kuasa);
            $stmt->bindParam(":superioritas", $superioritas);
            $stmt->bindParam(":kebebasan", $kebebasan);
            $stmt->bindParam(":full_result", $full_result);
            $stmt->bindParam(":tops", $tops);
            $stmt->bindParam(":created_at", $created_at);
            $stmt->execute();
        }else{
            return -1;
        }
    }

    public function getCategories()
    {
        $sql = "SELECT category FROM categories";
        if ($result = $this->pdo->query($sql)) {
            return $result->fetchAll(PDO::FETCH_COLUMN);
        }

        return -1;
    }

    public function getCategory($a_id)
    {
        $sql = "SELECT category FROM answers WHERE id = :a_id";
        if ($stmt = $this->pdo->prepare($sql)) {
            $stmt->bindParam(":a_id", $a_id);
            if ($stmt->execute()) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return $row['category'];
            }
        }
        return -1;
    }

    public function getPoints($a_id)
    {
        $sql = "SELECT points FROM answers WHERE id = :a_id";
        if ($stmt = $this->pdo->prepare($sql)) {
            $stmt->bindParam(":a_id", $a_id);
            if ($stmt->execute()) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return $row['points'];
            }
        }
        return -1;
    }

    public function getAnswerChoices($q_id)
    {
        $sql = "SELECT id FROM answers WHERE q_id = :q_id";
        if ($stmt = $this->pdo->prepare($sql)) {
            $stmt->bindParam(":q_id", $q_id);
            if ($stmt->execute()) {
                return $stmt->fetchAll(PDO::FETCH_COLUMN);
            }
        }
        return -1;
    }

    public function getResultPrc($nrp)
    {
        $sql = "SELECT kenyamanan, pengakuan, penerimaan, kontrol, kuasa, superioritas, kebebasan FROM results WHERE nrp = :nrp";
        if ($stmt = $this->pdo->prepare($sql)) {
            $stmt->bindParam(":nrp", $nrp);
            if ($stmt->execute()) {
                $row =  $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row && count($row) != 0) {
                    $result = [
                        'comfort' => $row['kenyamanan'],
                        'acknowledgement' => $row['pengakuan'],
                        'affirmation' => $row['penerimaan'],
                        'order' => $row['kontrol'],
                        'dominance' => $row['kuasa'],
                        'excellence' => $row['superioritas'],
                        'freedom' => $row['kebebasan']
                    ];

                    //  $sum_result = array_sum($result);

                    //     foreach ($result as $key => $value) {
                    //         $result[$key] = round(($value / 70) * 100, 1);
                    //     }
                    return $result;
                } else {
                    return -1;
                }
            }
        }
        return -1;
    }

    public function getTops($nrp){
        $sql = "SELECT tops FROM results WHERE nrp = :nrp";
        if ($stmt = $this->pdo->prepare($sql)) {
            $stmt->bindParam(":nrp", $nrp);
            if ($stmt->execute()) {
                $row =  $stmt->fetch(PDO::FETCH_ASSOC);
                if (count($row) != 0) {
                    return $row['tops'];
                } else {
                    return -1;
                }
            }
        }
        return -1;
    }

    //percentage of other users having category X in first position
    public function getSimilarity($nrp)
    {

        $angkatan = substr($nrp, 3, 2);
        $tops = $this->getTops($nrp);
        if ($tops == -1) return -1;
        $tops = explode(";", $tops);
        $tops = array_filter($tops);
        $top_1 = $tops[0];
        $top_count[$top_1] = -1;

        $sql = "SELECT tops FROM results WHERE nrp LIKE '___" . $angkatan . "%'";
        if ($stmt = $this->pdo->query($sql)) {
            if ($stmt->execute()) {
                $rows =  $stmt->fetchAll(PDO::FETCH_COLUMN);
                $n_rows = count($rows);
                for ($j = 0; $j < $n_rows; $j++) {
                    $other_tops = explode(";", $rows[$j]);
                    $other_tops = array_filter($other_tops);
                    $other_top_1 = $other_tops[0];
                    if ($top_1 == $other_top_1) {
                        $top_count[$top_1] += 1;
                    }
                }

                $top_count[$top_1] = round($top_count[$top_1]/$n_rows*100,  1);

                return $top_count;
            }
        }
        return -1;
    }

    //check if user has completed the quiz
    public function checkCompleted($nrp)
    {
        $sql = "SELECT * FROM results WHERE nrp = :nrp";
        if ($stmt = $this->pdo->prepare($sql)) {
            $stmt->bindParam(":nrp", $nrp);
            if ($stmt->execute()) {
                $rows =  $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($rows) != 0) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        return -1;
    }
}
