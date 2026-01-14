<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

?>
<div class="container">
	<table class="table table-striped table-bordered">
        <tr>
            <th>No.</th>
            <th>고객사 번호</th>
            <th>고객사 이름</th>
            <th>고객사 지점 위치</th>
            <th>고객사 전화번호</th>
            <th>기능</th>

        </tr>
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from 고객사";
    $result = mysqli_query($conn, $query);
    $row_index = 1;
    while($row=mysqli_fetch_array($result)){
        echo "<td>{$row_index}</td>";
        echo "<td>$row[0]</td>";
        echo "<td>$row[1]</td>";
        echo "<td>$row[2]</td>";
        echo "<td>$row[3]</td>";
        echo "<td width='17%'>
                <a href='customer_form.php?고객사번호={$row['고객사번호']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['고객사번호']})' class='button danger small'>삭제</button>
                </td>";
        echo "<tr></tr>";
        $row_index++;
    }
    ?>
    </table>
    <script>
        function deleteConfirm(고객사번호) {
            if (confirm("정말 삭제하시겠습니까?") == true){    
                window.location = "customer_delete.php?고객사번호=" + 고객사번호;
            }else{   
                return;
            }
        }
    </script>
</div>
    
<?
include "footer.php"
?>
