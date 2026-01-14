<?
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$요청서번호 = $_POST['요청서번호'];
$수령일자 = $_POST['수령일자'];
$A세트신청수량 = $_POST['A세트신청수량'];
$B세트신청수량 = $_POST['B세트신청수량'];
$C세트신청수량 = $_POST['C세트신청수량'];
$고객사번호 = $_POST['고객사번호'];

$result = mysqli_query($conn, "update 요청서 set 수령일자 = '$수령일자', 고객사번호 = $고객사번호, A세트신청수량 = $A세트신청수량, B세트신청수량 = $B세트신청수량, C세트신청수량 = $C세트신청수량 where 요청서번호 = $요청서번호");

if(!$result)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    echo "<script>location.replace('request_list.php');</script>";
}

?>

