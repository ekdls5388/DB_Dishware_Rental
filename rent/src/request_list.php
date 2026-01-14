<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from 요청서 natural join 고객사";

    $result = mysqli_query($conn, $query);
    if (!$result) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

    <table class="table table-striped table-bordered">
        <tr>
            <th>No.</th>
            <th>요청서 번호</th>
            <th>고객사 번호</th>
            <th>고객사 이름</th>
            <th>요청 신청 일자</th>
            <th>수령 일자</th>
            <th>A 세트 신청 수량</th>
            <th>B 세트 신청 수량</th>
            <th>C 세트 신청 수량</th>
            <th>기능</th>

        </tr>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td>{$row['요청서번호']}</td>";
            echo "<td>{$row['고객사번호']}</td>";
            echo "<td>{$row['고객사이름']}</td>";
            echo "<td>{$row['요청신청일자']}</td>";
            echo "<td>{$row['수령일자']}</td>";
            echo "<td>{$row['A세트신청수량']}</td>";
            echo "<td>{$row['B세트신청수량']}</td>";
            echo "<td>{$row['C세트신청수량']}</td>";
            echo "<td width='17%'>
                <a href='request_form.php?요청서번호={$row['요청서번호']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['요청서번호']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
    </table>
    <script>
        function deleteConfirm(요청서번호) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "request_delete.php?요청서번호=" + 요청서번호;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>
