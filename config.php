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
            $this->pdo = new PDO('mysql: host=' . $this->db_server . '; dbname=' . $this->db_name, $this->db_username, $this->db_password);
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
    public function insertResult($nrp, $answers_id)
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

        //convert the result into percentages
        // $sum_result = array_sum($result);

        // foreach ($result as $key => $value) {
        //     $result[$key] = round(($value / $sum_result) * 100, 1);
        // }

        $nrp = $_SESSION['nrp'];
        $kenyamanan = $result['kenyamanan'];
        $pengakuan = $result['pengakuan'];
        $penerimaan = $result['penerimaan'];
        $kontrol = $result['kontrol'];
        $kuasa = $result['kuasa'];
        $superioritas = $result['superioritas'];
        $kebebasan = $result['kebebasan'];

        //convert assoc array result to string of sorted categories based on points descending
        arsort($result);
        $tops = "";
        foreach ($result as $key => $value) {
            $tops .= $key . ";";
        }

        $created_at = date('Y-m-d H:i:s');

        $sql = "INSERT INTO results (nrp, kenyamanan, pengakuan, penerimaan, kontrol, kuasa, superioritas, kebebasan, full_result, tops, created_at) VALUES (:nrp, :kenyamanan, :pengakuan, :penerimaan, :kontrol, :kuasa, :superioritas, :kebebasan, :full_result, :tops, :created_at)";
        if ($stmt = $this->pdo->prepare($sql)) {
            $stmt->bindParam(":nrp", $nrp);
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

        // $sql = "UPDATE category_results SET counts = counts+1, points =points+:points WHERE category = :category AND result_order = :result_order";
        // $i = 0;
        // foreach($result as $key =>$value){
        //     if ($stmt = $this->pdo->prepare($sql)) {
        //         $stmt->bindParam(":points", $value);
        //         $stmt->bindParam(":category", $key);
        //         $stmt->bindParam(":result_order", $i);
        //         $stmt->execute();
        //     }else{
        //         return -1;
        //     }
        //     $i++;
        // }
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
                        'kenyamanan' => $row['kenyamanan'],
                        'pengakuan' => $row['pengakuan'],
                        'penerimaan' => $row['penerimaan'],
                        'kontrol' => $row['kontrol'],
                        'kuasa' => $row['kuasa'],
                        'superioritas' => $row['superioritas'],
                        'kebebasan' => $row['kebebasan']
                    ];

                    //sort based on points percentage descending
                    arsort($result);
                     $sum_result = array_sum($result);

                        foreach ($result as $key => $value) {
                            $result[$key] = round(($value / $sum_result) * 100, 1);
                        }
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

    //percentage of other users having, for example, category A in first position, B in second position, etc...
    public function getSimilarity($nrp)
    {
        $tops = $this->getTops($nrp);
        if($tops==-1) return -1;
        $tops = explode(";", $tops);
        $tops = array_filter($tops);
        $tops_count = array_combine($tops, array_fill(0, count($tops), 0));

        $sql = "SELECT tops FROM results";
        if ($stmt = $this->pdo->query($sql)) {
            if ($stmt->execute()) {
                $rows =  $stmt->fetchAll(PDO::FETCH_COLUMN);
                $n_tops = count($tops);
                $n_rows = count($rows);
                for ($i = 0; $i < $n_tops; $i++) {
                    for ($j = 0; $j < $n_rows; $j++) {
                        $other_tops = explode(";", $rows[$j]);
                        $other_tops = array_filter($other_tops);
                        if ($tops[$i] == $other_tops[$i]) {
                            $tops_count[$tops[$i]] += 1;
                        }
                    }
                }

                foreach($tops_count as $key => $value){
                    $tops_count[$key] = round($value/$n_rows*100,1);
                }

                return $tops_count;
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
