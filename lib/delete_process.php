<?php
include './dbConnect.php';

$userid = $_POST['review-userid'];
$title = $_POST['review-title'];
$description = $_POST['review-description'];
$pageid = $_POST['page-id'];

$check = "SELECT * FROM review WHERE userid='$userid' AND pageid='$pageid'";
$result = $conn->query($check);
if($result->num_rows >= 1){?>
<script>alert("리뷰를 삭제했습니다.");</script>
<?php
$sql = "
    DELETE FROM review WHERE userid='$userid' AND pageid='$pageid'
";

$result = mysqli_query($conn, $sql);

header('Location: /detailpage.php?id='.basename($pageid));

}else{
    ?>
    <script>alert("삭제할 리뷰가 없습니다.");</script>
    <script>history.back();</script>
    <?php
    exit();
}
?> 