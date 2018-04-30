<html>
<body>
<?php
session_start();
require_once ('pdo.php');
$sqlGetUserinfo="select * from user_info a where a.username='{$_SESSION['username']}'";
$rs=$pdo->query($sqlGetUserinfo);
$result=$rs->fetch(PDO::FETCH_ASSOC);

$sqlGetDeptInfo="select * from dept_info";
$rsGetDeptInfo=$pdo->query($sqlGetDeptInfo);
$resultGetDeptInfo=$rsGetDeptInfo->fetchAll(PDO::FETCH_ASSOC);

$sqlGetNoteInfo="select * from note_info";
$rsGetNoteInfo=$pdo->query($sqlGetNoteInfo);
$resultGetNoteInfo=$rsGetNoteInfo->fetchAll(PDO::FETCH_ASSOC);
?>



<select id="first" onChange="change()">
    <?php
    foreach ($resultGetDeptInfo as $key => $value){
        echo "<option value='$value[dept_id]'>$value[dept_name]</option>";
    }
    ?>
</select>

<select id="second">
    <option>黄冈</option>
    <option selected="selected">武汉</option>
</select>



<script>
    function change()
    {
        var x = document.getElementById("first");
        var y = document.getElementById("second");
        y.options.length = 0; // 清除second下拉框的所有内容
        if(x.selectedIndex)
        {
            <?php
            foreach ($pdo->query($sqlGetUserinfo) as $key=>$resultGetUserinfo){
                ?>
            y.options.add(new Option($resultGetUserinfo[username], "0"));
            <?php
            }
            ?>
        }

        if(x.selectedIndex == 1)
        {
            y.options.add(new Option("深圳", "0"));
            y.options.add(new Option("广州", "1", false, true));  // 默认选中省会城市
            y.options.add(new Option("肇庆", "2"));
        }

    }
</script>

</body>
</html>