<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

$고객사이름 = $_POST['고객사이름'];
$고객사지점위치 = $_POST['고객사지점위치'];
$고객사전화번호 = $_POST['고객사전화번호'];

if (strlen($고객사지점위치) > 100) {
    msg('고객사지점위치는 한글기준 50자, 영어/숫자기준 100자까지 입력할 수 있습니다.');
} 
else if (strlen($고객사전화번호) > 30) {
    msg('고객사전화번호는 최대 30자까지 입력할 수 있습니다.');
} 
else {
    $result = mysqli_query($conn, "INSERT INTO 고객사 (고객사이름, 고객사지점위치, 고객사전화번호) VALUES ('$고객사이름', '$고객사지점위치', '$고객사전화번호')");
    if (!$result) {
        msg('Query Error: ' . mysqli_error($conn), 'error');
    } else {
        $고객사번호 = mysqli_insert_id($conn);
        s_msg('성공적으로 입력되었습니다.');
        echo "<script>location.replace('customer_form.php');</script>";
    }
}
?>
