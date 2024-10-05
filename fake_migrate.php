<?php
//ini cuman file untuk isi fake data ke database soalnya aku males isi satu2
require_once("config.php");

$fake_question = file_get_contents('http://loripsum.net/api/short/1/plaintext');

$db = new Database();
$q_ids = ['Q1', 'Q2', 'Q3', 'Q4', 'Q5', 'Q6', 'Q7', 'Q8', 'Q9', 'Q10'];
$cat_ids = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];
$cats = ["kenyamanan", "pengakuan", "penerimaan", "kontrol", "kuasa", "superioritas", "kebebasan"];
$fake_points = [];

foreach($cat_ids as $idx=>$cat_id){
    for($i = 1; $i<=7; $i++){
        $id = $cat_id.$i;
        $sql = "INSERT INTO category_results (id, category, result_order) VALUES (:id, :category, :order)";
        $stmt = $db->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(':category',$cats[$idx] );
        $stmt->bindParam(':order',$i);
        $stmt->execute();
    }
}

// for($i = 0; $i <70; $i++){
//     array_push($fake_points, random_int(1,5)*10);
// }

// $sql = "DELETE FROM answers";
// $db->pdo->query($sql);

// $sql = "DELETE FROM questions";
// $db->pdo->query($sql);



// foreach($q_ids as $q_id){
//     $sql = "INSERT INTO questions (id, question) VALUES (:id, :question)";
//     $stmt = $db->pdo->prepare($sql);
//     $stmt->bindParam(":id", $q_id);
//     $stmt->bindParam(':question',$fake_question );
//     $stmt->execute();
// }


// foreach($q_ids as $q_id){
//     $i = 0;
//     foreach($cat_ids as $cat_id){
//         $a_id = $q_id.$cat_id;
//         $fake_answer = $cats[$i].". ".substr(file_get_contents('http://loripsum.net/api/short/1/plaintext'),0,20);
//         $sql = "INSERT INTO answers (id, answer, points, category, q_id) VALUES (:id, :answer, :points, :category, :q_id)";
//         $stmt = $db->pdo->prepare($sql);
//         $stmt->bindParam(":id", $a_id);
//         $stmt->bindParam(':answer',$fake_answer);
//         $stmt->bindParam(':points',$fake_points[$i]);
//         $stmt->bindParam(':category',$cats[$i]);
//         $stmt->bindParam(':q_id',$q_id);
//         $stmt->execute();
//         $i+=1;
//     }
// }

//
 ?>