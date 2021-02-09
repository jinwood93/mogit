<?php
include './dbConnect.php';

$userid = $_POST['basket-userid'];

$check = "SELECT * FROM basket WHERE userid='$userid'";
$result = $conn->query($check);
if($result->num_rows >= 1){?>
<script>alert("장바구니를 비웠습니다.");</script>
<?php
$sql = "
    DELETE FROM basket WHERE userid='$userid'
";

$result = mysqli_query($conn, $sql);

header('Location: ../basket.php');

}else{
    ?>
    <script>alert("이미 장바구니가 비어있습니다.");</script>
    <script>history.back();</script>
    <?php
    exit();
}
?> 