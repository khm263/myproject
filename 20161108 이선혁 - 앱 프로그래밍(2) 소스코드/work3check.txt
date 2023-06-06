<!---work3check.php에서 html으로부터 온 아이디와 비밀번호을 확인하여 user1 테이블에 있는 올바른 member_name과 member_pw_1인지 확인하고 만약 user1 테이블과 일치하면 '로그인 성공'이라는 안내문이 뜨며 로그인 한 상태의 메인 화면인  work3success.html으로 이동하게 되고 일치하지 않으면 '로그인 실패, 회원 가입 안하셨다면 회원가입하시오'이라는 안내문이 뜨면서 work3.html으로 돌아갑니다.--->
<?php

$host = 'localhost';
$user = 'khm263';
$pw = '1234';
$dbName = 'test';
$con = new mysqli($host, $user, $pw, $dbName);

$member_name = $_POST['member_name']; // 아이디
$member_pw_1 = $_POST['member_pw_1']; // 패스워드

$query = "select * from user1 where member_name='$member_name' and member_pw_1='$member_pw_1'";

$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

if($member_name==$row['member_name'] && $member_pw_1==$row['member_pw_1']){ // id와 pw가 맞다면 login
	setcookie('member_name', $member_name, time() + 3600, '/'); 

	echo "<script> alert('로그인 성공'); </script>";
	echo "<script> location.href = 'work3success.html?member_name=$member_name'; </script>";

}else{ // id 또는 pw가 다르다면 admin_login 폼으로

   echo "<script> alert('로그인 실패, 회원 가입 안하셨다면 회원가입하시오'); </script>";
   echo "<script> location.href = 'work3.html'; </script>";

}

?>