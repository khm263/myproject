<!--work5write.php에서는 최신 심리 결과 정보가 저장된 survey_results을 가져와서 쿠키를 이용하여 로그인한 member_name 사용자인지 확인하고 user1 테이블에서 로그인 했던 member_name 사용자의 null로 비어져 있었던 등급과 조언을 업데이트하고 저장하면서 ‘데이터 업데이트 성공’이라는 안내문이 뜨고 로그인 한 상태로 초기 화면에 돌아갑니다.
-->
<?php
$host = 'localhost';
$user = 'khm263';
$pw = '1234';
$dbName = 'test';
$con = new mysqli($host, $user, $pw, $dbName);

if (isset($_COOKIE['member_name'])) {
    $member_name = $_COOKIE['member_name'];

    // survey_results에서 최신 정보 가져오기
    $query_results = "SELECT grade, advice FROM survey_results ORDER BY id DESC LIMIT 1";
    $result_results = mysqli_query($con, $query_results);
    $row_results = mysqli_fetch_array($result_results);

    $grade = $row_results['grade'];
    $advice = $row_results['advice'];

    // user1의 member_name, grade, advice 업데이트
    $update_query = "UPDATE user1 SET grade = '$grade', advice = '$advice' WHERE member_name = '$member_name'";
    if (mysqli_query($con, $update_query)) {
        echo "<script>alert('데이터 업데이트 성공');</script>";
        echo "<script> location.href = 'work3success.html?member_name=$member_name'; </script>";
    } else {
        echo "<script>alert('데이터 업데이트 실패');</script>";
        echo "<script>location.href = 'work3.html';</script>";
    }
    // 업데이트된 정보 출력
    echo "로그인 사용자: " . $member_name . "<br>";
    echo "Grade: " . $grade . "<br>";
    echo "Advice: " . $advice . "<br>";
} else {
    // 쿠키가 없는 경우 로그인되지 않은 상태 처리
    echo "로그인되지 않은 상태입니다.";
}

?>