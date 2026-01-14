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
            <th>고객사 이름</th>
            <th>세부내역</th>
            <th>담당 직원 확인</th>
        </tr>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td>{$row['요청서번호']}</td>";
            echo "<td>{$row['고객사이름']}</td>";
            echo "<td><a href='rent_view.php?요청서번호={$row['요청서번호']}'>세부내역</a></td>";
            echo "<td><a href='employee_view.php?요청서번호={$row['요청서번호']}'>담당직원확인</a></td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
    </table>
</div>
<? include("footer.php") ?>
