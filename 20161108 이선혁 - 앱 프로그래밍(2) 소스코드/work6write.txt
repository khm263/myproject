<!--work6write.php가 실행되어 쿠키에서 'member_name' 값을 확인하고 만약 사용자의 member_name 쿠키가 존재한다면 'user1' 테이블에서 로그인을 한 사용자 의 등급과 조언 정보를 가져옵니다.-->
<?php
$host = 'localhost';
$user = 'khm263';
$pw = '1234';
$dbName = 'test';
$con = new mysqli($host, $user, $pw, $dbName);

if (isset($_COOKIE['member_name'])) {
    $member_name = $_COOKIE['member_name'];

    // user1 테이블에서 로그인한 계정의 정보 가져오기
    $query_user = "SELECT grade, advice FROM user1 WHERE member_name = '$member_name'";
    $result_user = mysqli_query($con, $query_user);
    $row_user = mysqli_fetch_array($result_user);

    $grade = $row_user['grade'];
    $advice = $row_user['advice'];

    // work6.html로 리디렉션하고 정보 전달
    header("Location: work6.html?member_name=$member_name&grade=$grade&advice=$advice");
    exit();
}
?>