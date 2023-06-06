<!---work3.html에서 회원가입 버튼을 누르면, 회원 가입 페이지가 나타나서 아이디와 비밀번호를 등록시켜주는 php 페이지입니다. HTML에서 form 태그 안에 있는 입력 필드들을 아이디와 비밀번호을 입력받아 서버로 호출하고 php에서 mysql 데이터 베이스에 접속하여 html의 form을 통해 입력 받은 아이디와 비밀번호를 데이터 베이스에 삽입하여 성공하면 'success inserting'이라는 안내문이 뜨면서 work2.html로 돌아갑니다.--->
<html>
<!-- <meta charset="utf-8"> -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<?php

		$host = 'localhost';
		$user = 'khm263';
		$pw = '1234';
		$dbName = 'test';
		$mysqli = new mysqli($host, $user, $pw, $dbName);

		$member_name = $_POST['member_name'];
	    $member_pw_1 = $_POST['member_pw_1'];
	  

		$sql = "insert into user1 (
				member_name,
				member_pw_1
				
		)";
		
		$sql = $sql. "values (
				'$member_name',
				'$member_pw_1'
		)";

		if($mysqli->query($sql)){ 
		  echo '<script>alert("회원가입 완료하였습니다.")</script>'; 
		}else{ 
		  echo '<script>alert("fail to insert sql")</script>';
		}

		mysqli_close($mysqli);
	  
	?>

<script>
	location.href = "work2.html";
</script>

</html>