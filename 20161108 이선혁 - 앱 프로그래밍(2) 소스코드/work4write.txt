<!-- work4write.php에 제출하면, work4write.php에서 user_id 테이블에 있는 member_name과 각 4개의 선택 항목에 대한 점수들을 저장하고 4개의 항목에서 선택된 점수들에 대한 총합 점수를 계산하고 'totalScore'이라는 합산 변수에 저장합니다. 이때 각각의 등급과 최소 점수, 최대 점수, 그리고 조언들이 저장되어 있는 grades1 테이블에서 합산 변수를 grades1 테이블의 최소 점수와 최대 점수의 사이에 비교하면 조회하고 기준이 되는 등급과 조언을 결정하고 survey_results이라는 테이블의  totalScore과 grade, advise에 넣습니다. 이떄 grades1 테이블의 최대와 최소 점수의 기준은 'A' 등급은 최대 점수 12점 ~ 최소 점수 11점에 나오며 '조언 : 상당히 매우 괜찮은 심리 상태를 가지고 있습니다.' 이라는 조언이 나옵니다. 'B'등급은 최대 점수 10점 ~ 최소 점수 9점에 나오며 '조언 : 여전히 괜찮은 심리 상태를 가지고 있습니다. 하지만 여가 생활이 필요합니다.'이라는 조언이 나옵니다. 'C' 등급은 최대 점수 8점 ~ 최소 점수 7점에 나오며 '조언 : 기분 전환이 필요합니다. 친구를 만나거나 취미 생활 하시길 바랍니다.'이라는 조언이 나옵니다. 마지막으로 'D'등급은 최대 점수 5점 ~ 최소 점수 4점에 나오며 '조언 : 심각한 심리 상태가 보입니다. 자세한 심리 검사가 요구됩니다.'이라는 조언이 나옵니다.
-->
<?php
// 데이터베이스 연결 설정
$host = 'localhost'; // 호스트 이름
$user = 'khm263'; // 데이터베이스 사용자 이름
$pw = '1234'; // 데이터베이스 비밀번호
$dbName = 'test'; // 데이터베이스 이름

// MySQL 데이터베이스 연결
$conn = new mysqli($host, $user, $pw, $dbName);
if ($conn->connect_error) {
    die("데이터베이스 연결 실패: " . $conn->connect_error);
}

// POST 데이터 가져오기
$radio1 = $_POST['flexRadioDefault1'];
$radio2 = $_POST['flexRadioDefault2'];
$radio3 = $_POST['flexRadioDefault3'];
$radio4 = $_POST['flexRadioDefault4'];

// 각 선택지에 대한 점수 부여
if ($radio1 === '괜찮아요.') {
    $score1 = 3;
} elseif ($radio1 === '보통입니다.') {
    $score1 = 2;
} elseif ($radio1 === '별로입니다.') {
    $score1 = 1;
} else {
    $score1 = 0;
}

if ($radio2 === '괜찮아요.') {
    $score2 = 3;
} elseif ($radio2 === '보통입니다.') {
    $score2 = 2;
} elseif ($radio2 === '별로입니다.') {
    $score2 = 1;
} else {
    $score2 = 0;
}

if ($radio3 === '괜찮아요.') {
    $score3 = 3;
} elseif ($radio3 === '보통입니다.') {
    $score3 = 2;
} elseif ($radio3 === '별로입니다.') {
    $score3 = 1;
} else {
    $score3 = 0;
}

if ($radio4 === '괜찮아요.') {
    $score4 = 3;
} elseif ($radio4 === '보통입니다.') {
    $score4 = 2;
} elseif ($radio4 === '별로입니다.') {
    $score4 = 1;
} else {
    $score4 = 0;
}

// 쿼리 생성
$query = "INSERT INTO survey1 (user_id, radio1, radio2, radio3, radio4) VALUES (1, $score1, $score2, $score3, $score4)";
$result = $conn->query($query);

if (!$result) {
    die("데이터 삽입 실패: " . $conn->error);
}

// 설문 결과 계산
$totalScore = $score1 + $score2 + $score3 + $score4;

// 등급 쿼리
$gradeQuery = "SELECT grade, advice FROM grades1 WHERE min_score <= $totalScore AND max_score >= $totalScore";
$gradeResult = $conn->query($gradeQuery);

if ($gradeResult->num_rows > 0) {
    $row = $gradeResult->fetch_assoc();
    $grade = $row['grade'];
    $advice = $row['advice'];
} else {
    $grade = "Unknown";
    $advice = "조언을 찾을 수 없습니다.";
}

// 결과를 테이블에 저장
$insertQuery = "INSERT INTO survey_results (total_score, grade, advice) VALUES ($totalScore, '$grade', '$advice')";
$conn->query($insertQuery);

// 연결 종료
$conn->close();

echo "<script>window.location.href = 'work5.html?totalScore=$totalScore&grade=$grade&advice=$advice';</script>";
?>

