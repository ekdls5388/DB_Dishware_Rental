<?
include "config.php";    // 데이터베이스 연결 설정파일
include "util.php";      // 유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

// 입력받은 대로 저장하기!
$수령일자 = $_POST['수령일자'];
$A세트신청수량 = $_POST['A세트신청수량'];
$B세트신청수량 = $_POST['B세트신청수량'];
$C세트신청수량 = $_POST['C세트신청수량'];
$고객사번호 = $_POST['고객사번호'];
// Step1 : 식기세트정보에서 대여가능여부가 Y인 아이템만 가져오기. + 동시에 재고 파악해두기
$query4 = "SELECT 유형, COUNT(*) AS 재고수량 FROM 식기세트정보 WHERE 대여가능여부 = 'Y' GROUP BY 유형";
$result = mysqli_query($conn, $query4);
$재고수량 = array();
while ($row = mysqli_fetch_array($result)) {
    $재고수량[$row['유형']] = $row['재고수량'];
}
// Step2 : 재고수량이 하나라도 부족하면, 요청서 거부하기
if ($A세트신청수량 > $재고수량['A'] || $B세트신청수량 > $재고수량['B'] || $C세트신청수량 > $재고수량['C']) {
    msg('재고를 확인해주세요!');
    echo "<script>history.back();</script>";
} else { // Step3 : 요청서는 정상 등록됐음. 이제부턴 직원 랜덤으로 배정해주기.
    $query1 = "SELECT 직원번호 FROM 직원";
    $result = mysqli_query($conn, $query1);
    $직원번호모음 = array();
    while ($row = mysqli_fetch_array($result)) {
        $직원번호모음[] = $row['직원번호'];
    }

    $담당직원번호 = $직원번호모음[array_rand($직원번호모음)];
	// 요청서에 내용 저장하기!
    $result1 = mysqli_query($conn, "INSERT INTO 요청서 (수령일자, A세트신청수량, B세트신청수량, C세트신청수량, 직원번호, 고객사번호, 요청신청일자) VALUES ('$수령일자', '$A세트신청수량', '$B세트신청수량', '$C세트신청수량', '$담당직원번호', '$고객사번호', NOW())");

    if (!$result1) {
        msg('Query Error: ' . mysqli_error($conn));
    } else {
        $요청서번호 = mysqli_insert_id($conn); 
	// Step4 : 직원과 마찬가지로, 차량번호도 랜덤으로 배정하기!
        $query2 = "SELECT 차량번호 FROM 차량정보";
        $result = mysqli_query($conn, $query2);
        $차량번호모음 = array();
        while ($row = mysqli_fetch_array($result)) {
            $차량번호모음[] = $row['차량번호'];
        }

        $배차차량번호 = $차량번호모음[array_rand($차량번호모음)];
	// 배차정보에 내용 저장하기!
        $result2 = mysqli_query($conn, "INSERT INTO 배차정보 (차량번호, 요청서번호) VALUES ('$배차차량번호', '$요청서번호')");

        if (!$result2) {
            msg('Query Error: ' . mysqli_error($conn));
        } else {
            s_msg('성공적으로 입력되었습니다');
	// Step5 : 메시지 띄우고, 대여정보 저장하기.
            $setTypes = ['A', 'B', 'C']; 
            $setQuantities = [$A세트신청수량, $B세트신청수량, $C세트신청수량]; 

            for ($i = 0; $i < count($setTypes); $i++) {
                $setType = $setTypes[$i];
                $setQuantity = $setQuantities[$i];
	// 식기세트에서는 번호가 작은 순부터 배정되고(ASC 활용), 개수제한(setQuantity) 활용해서 정확히 개수만큼 활용.
                $query3 = "SELECT 식기세트번호 FROM 식기세트정보 WHERE 유형 = '$setType' AND 대여가능여부 = 'Y' ORDER BY 식기세트번호 ASC LIMIT $setQuantity";
                $result = mysqli_query($conn, $query3);
                $setNumbers = array();
                while ($row = mysqli_fetch_array($result)) {
                    $setNumbers[] = $row['식기세트번호'];
                }
	// 이제 정리된 정보 바탕으로 대여정보 생성하기!
                foreach ($setNumbers as $setNumber) {
                    $result3 = mysqli_query($conn, "INSERT INTO 대여정보 (식기세트번호, 요청서번호) VALUES ('$setNumber', '$요청서번호')");

                    if (!$result3) {
                        msg('Query Error: ' . mysqli_error($conn));
                    }
                }
	// Step6 : 마지막. 배정된 식기세트들은 대여가능여부를 N으로 바꿔줘야 함.
                $setNumberStr = implode("', '", $setNumbers);
                mysqli_query($conn, "UPDATE 식기세트정보 SET 대여가능여부 = 'N' WHERE 식기세트번호 IN ('$setNumberStr')");
            }

            echo "<script>location.replace('request_list.php');</script>";
        }
    }
}
?>

