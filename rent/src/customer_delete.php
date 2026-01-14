<?
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

$고객사번호 = $_GET['고객사번호'];

$result = mysqli_query($conn, "SELECT * FROM 요청서 WHERE 고객사번호 = $고객사번호");
if (mysqli_num_rows($result) > 0) {
    msg('해당 고객사의 요청서가 존재합니다. 요청서를 먼저 삭제해주세요.');
    echo "<meta http-equiv='refresh' content='0;url=request_list.php'>";
    exit;
}

$result = mysqli_query($conn, "DELETE FROM 고객사 WHERE 고객사번호 = $고객사번호");
if (!$result) {
    msg('Query Error : ' . mysqli_error($conn));
} else {
    s_msg('성공적으로 삭제되었습니다.');
    echo "<meta http-equiv='refresh' content='0;url=customer_list.php'>";
}
?>
