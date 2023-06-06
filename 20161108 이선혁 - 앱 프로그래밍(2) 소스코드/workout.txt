<!--workout.php는 사용자의 쿠키에서 'member_name' 값을 확인하고 만약 'member_name'쿠키가 존재한다면, 페이지 리디렉션을 하여 work3success.html 페이지로 이동하고, URL에 쿼리 매개변수로 member_name 값을 추가하여 전달하여 로그인 상태로 나가게 됩니다.-->
<?php
$host = 'localhost';
$user = 'khm263';
$pw = '1234';
$dbName = 'test';
$con = new mysqli($host, $user, $pw, $dbName);

if (isset($_COOKIE['member_name'])) {
    $member_name = $_COOKIE['member_name'];

    echo "<script> location.href = 'work3success.html?member_name=$member_name'; </script>";
} 

?>