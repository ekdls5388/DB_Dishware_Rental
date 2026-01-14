<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("요청서번호", $_GET)) {
    $요청서번호 = $_GET["요청서번호"];
    $query = "select * from 배차정보 natural join 차량정보 where 요청서번호 = $요청서번호";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);
    if (!$product) {
        msg("내역이 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>차량 정보 상세 확인</h3>

        <p>
            <label for="배차번호">배차 구분 번호</label>
            <input readonly type="text" id="배차번호" name="배차번호" value="<?= $product['배차번호'] ?>"/>
        </p>

        <p>
            <label for="요청서번호">요청서 번호</label>
            <input readonly type="text" id="요청서번호" name="요청서번호" value="<?= $product['요청서번호'] ?>"/>
        </p>

        <p>
            <label for="차량번호">차량 번호</label>
            <input readonly type="text" id="차량번호" name="차량번호" value="<?= $product['차량번호'] ?>"/>
        </p>

        <p>
            <label for="차종">차종</label>
            <input readonly type="text" id="차종" name="차종" value="<?= $product['차종'] ?>"/>
        </p>
    </div>
<? include "footer.php" ?>