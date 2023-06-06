<!--workdelete.php는 쿠키를 통해 로그인한 member_name 사용자를 확인하고 user1 테이블에서 해당 사용자에 저장되어 있던 등급과 조언을 null 상태로 업데이트 시키고 쿠키를 삭제하여 ‘삭제하였습니다’ 라는 안내문이 뜨게 하고 로그인 한 메인 화면인 work3success.html로 이동하게 됩니다.-->
<?php
$host = 'localhost';
$user = 'khm263';
$pw = '1234';
$dbName = 'test';
$con = new mysqli($host, $user, $pw, $dbName);
if (isset($_COOKIE['member_name'])) {
    $member_name = $_COOKIE['member_name'];

    // user1의 member_name, grade, advice 업데이트
    $update_query = "UPDATE user1 SET grade = NULL, advice = NULL WHERE member_name = '$member_name'";
    if (mysqli_query($con, $update_query)) {
        echo "<script>alert('삭제하였습니다.');</script>";
        echo "<script> location.href = 'work3success.html?member_name=$member_name'; </script>";
    } else {
        echo "<script>alert('삭제 실패했습니다. 다시 하시오.');</script>";
    }

    // 쿠키 삭제
    setcookie('member_name', '', time() - (5 * 24 * 60 * 60)); // 쿠키 만료 시간을 현재 시간보다 이전으로 설정하여 삭제

} 
?>