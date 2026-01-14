<?
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$고객사번호 = $_POST['고객사번호'];
$고객사이름 = $_POST['고객사이름'];
$고객사지점위치 = $_POST['고객사지점위치'];
$고객사전화번호 = $_POST['고객사전화번호'];

$result = mysqli_query($conn, "update 고객사 set 고객사이름 = '$고객사이름', 고객사지점위치 = '$고객사지점위치', 고객사전화번호 = $고객사전화번호 where 고객사번호 = $고객사번호");

if(!$result)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    echo "<script>location.replace('customer_list.php');</script>";
}

?>

