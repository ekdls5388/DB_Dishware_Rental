<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "request_insert.php";

if (array_key_exists("요청서번호", $_GET)) {
    $요청서번호 = $_GET["요청서번호"];
    $query =  "select * from 요청서 where 요청서번호 = $요청서번호";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_array($result);
    if(!$product) {
        msg("요청서가 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "request_modify.php";
}

$customers = array();

$query = "select * from 고객사";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($result)) {
    $customers[$row['고객사번호']] = $row['고객사이름'];
}
?>
    <div class="container">
        <form name="request_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="요청서번호" value="<?=$product['요청서번호']?>"/>
            <h3>요청서 정보 <?=$mode?></h3>
            <p>
                <label for="고객사번호">고객사</label>
                <select name="고객사번호" id="고객사번호">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($customers as $id => $name) {
                            if($id == $product['고객사번호']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="수령일자">수령 희망 날짜</label>
                <input type="text" placeholder="수령 희망 날짜 입력(YYYY-MM-DD)" id="수령일자" name="수령일자" value="<?=$product['수령일자']?>"/>
            </p>
            <p>
                <label for="A세트신청수량">A 세트 신청 수량</label>
                <textarea placeholder="숫자만 입력" id="A세트신청수량" name="A세트신청수량" rows="10"><?=$product['A세트신청수량']?></textarea>
            </p>
            <p>
                <label for="B세트신청수량">B 세트 신청 수량</label>
                <textarea placeholder="숫자만 입력" id="B세트신청수량" name="B세트신청수량" rows="10"><?=$product['B세트신청수량']?></textarea>
            </p>
            <p>
                <label for="C세트신청수량">C 세트 신청 수량</label>
                <textarea placeholder="숫자만 입력" id="C세트신청수량" name="C세트신청수량" rows="10"><?=$product['C세트신청수량']?></textarea>
            </p>
            

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    var 수령일자 = document.getElementById("수령일자").value;
                    var datePattern = /^\d{4}-\d{2}-\d{2}$/;

                    if(document.getElementById("고객사번호").value == "-1") {
                        alert ("고객사를 선택해 주십시오"); return false;
                    }
                    else if (!datePattern.test(수령일자)) {
                        alert("올바른 날짜 형식(YYYY-MM-DD)으로 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("A세트신청수량").value == "") {
                        alert ("A 세트 신청 수량을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("B세트신청수량").value == "") {
                        alert ("B 세트 신청 수량을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("C세트신청수량").value == "") {
                        alert ("C 세트 신청 수량을 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>