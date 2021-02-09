<?php
include './dbConnect.php';

$pageid = $_POST['page-id'];
$userid = $_POST['basket-userid'];
$lecname = $_POST['lecname'];
$teacher = $_POST['teacher'];
$price = $_POST['price'];

$check = "SELECT * FROM basket WHERE userid='$userid' AND lecname='$lecname'";
$result = $conn->query($check);
if($result->num_rows >= 1){?>
<script>alert("이미 장바구니에 추가하셨습니다.");</script>
<script>history.back();</script>
<?php
exit();
}else{
    ?>
    <script>alert("장바구니에 추가했습니다.");</script>
    <?php
    $sql = "
    INSERT INTO basket(lecname, teacher, price, userid, pageid)
    VALUE('$lecname','$teacher','$price','$userid','$pageid')
    ";
    
    $result = mysqli_query($conn, $sql);
    header('Location: ../basket.php');
}

?>