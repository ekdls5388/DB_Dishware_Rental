<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
	$query = "SELECT 유형, count(식기세트번호) as '수량' FROM 식기세트정보 WHERE `대여가능여부` = 'Y' GROUP BY `유형`";
    if (array_key_exists("search_keyword", $_POST)) {  
        $search_keyword = $_POST["search_keyword"];
        $query .= " where product_name like '%$search_keyword%' or manufacturer_name like '%$search_keyword%'";
    }
    $result = mysqli_query($conn, $query);
    if (!$result) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

    <table class="table table-striped table-bordered">
        <tr>
            <th>No.</th>
            <th>식기 세트 유형</th>
            <th>남은 수량</th>
        </tr>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td>{$row['유형']}</td>";
            echo "<td>{$row['수량']}</td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
    </table>
</div>
<? include("footer.php") ?>
