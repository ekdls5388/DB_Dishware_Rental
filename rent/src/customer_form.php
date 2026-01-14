<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "customer_insert.php";

if (array_key_exists("고객사번호", $_GET)) {
    $고객사번호 = $_GET["고객사번호"];
    $query =  "select * from 고객사 where 고객사번호 = $고객사번호";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_array($result);
    if(!$product) {
        msg("고객사 정보가 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "customer_modify.php";
}


$query = "select * from 고객사";
$result = mysqli_query($conn, $query);

?>
    <div class="container">
        <form name="customer_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="고객사번호" value="<?=$product['고객사번호']?>"/>
            <h3>고객 정보 <?=$mode?></h3>
            <p>
                <label for="고객사이름">고객사 이름</label>
                <input type="text" placeholder="고객사 이름 입력" id="고객사이름" name="고객사이름" value="<?=$product['고객사이름']?>"/>
            </p>
            <p>
                <label for="고객사지점위치">지점주소</label>
                <textarea placeholder="고객사 지점 주소 입력" id="고객사지점위치" name="고객사지점위치" rows="10"><?=$product['고객사지점위치']?></textarea>
            </p>
            <p>
                <label for="고객사전화번호">전화번호</label>
                <input type="number" placeholder="-, 띄어쓰기 없이 입력" id="고객사전화번호" name="고객사전화번호" value="<?=$product['고객사전화번호']?>" />
            </p>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("고객사이름").value == "") {
                        alert ("고객사 이름을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("고객사지점위치").value == "") {
                        alert ("고객사지점위치를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("고객사전화번호").value == "") {
                        alert ("고객사전화번호를 정확히 입력해 주십시오. 숫자만 입력해주세요"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>