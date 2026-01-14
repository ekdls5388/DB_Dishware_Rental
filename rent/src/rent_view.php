<?
include "config.php";    // 데이터베이스 연결 설정파일
include "util.php";      // 유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

$요청서번호 = $_GET['요청서번호'];

$result1 = mysqli_query($conn, "SELECT 식기세트번호 FROM 대여정보 WHERE 요청서번호 = $요청서번호");
while ($row = mysqli_fetch_array($result1)) {
    $식기세트번호 = $row['식기세트번호'];

    mysqli_query($conn, "UPDATE 식기세트정보 SET 대여가능여부 = 'Y' WHERE 식기세트번호 = '$식기세트번호'");
}

mysqli_query($conn, "DELETE FROM 대여정보 WHERE 요청서번호 = $요청서번호"); 

mysqli_query($conn, "DELETE FROM 배차정보 WHERE 요청서번호 = $요청서번호");

$result2 = mysqli_query($conn, "DELETE FROM 요청서 WHERE 요청서번호 = $요청서번호");

if (!$result2) {
    msg('Query Error: ' . mysqli_error($conn));
} else {
    s_msg('성공적으로 삭제되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=request_list.php'>";
}
?>


