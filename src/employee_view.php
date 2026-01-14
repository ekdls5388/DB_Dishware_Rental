<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("요청서번호", $_GET)) {
    $요청서번호 = $_GET["요청서번호"];
    $query = "select * from 직원 natural join 요청서 where 요청서번호 = $요청서번호";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);
    if (!$product) {
        msg("내역이 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>직원 정보 확인</h3>
        
		<div style="text-align: center; margin: 10px 0;">
    		선택하신 요청서 번호는 <span><?php echo $요청서번호; ?></span>입니다.
		</div>
		
        <p>
            <label for="직원이름">담당직원명</label>
            <input readonly type="text" id="직원이름" name="직원이름" value="<?= $product['직원이름'] ?>"/>
        </p>

        <p>
            <label for="직원전화번호">담당직원 연락처</label>
            <input readonly type="text" id="직원전화번호" name="직원전화번호" value="<?= $product['직원전화번호'] ?>"/>
        </p>

    </div>
<? include "footer.php" ?>