<?php
include './dbConnect.php';

$userid = $_POST['review-userid'];
$title = $_POST['review-title'];
$description = $_POST['review-description'];
$pageid = $_POST['page-id'];

$check = "SELECT * FROM review WHERE userid='$userid' AND pageid='$pageid'";
$result = $conn->query($check);
if($result->num_rows >= 1){?>
<script>alert("이미 리뷰를 작성하셨습니다.");</script>
<script>history.back();</script>
<?php
exit();
}else{
    ?>
    <script>alert("리뷰를 작성을 완료했습니다.");</script>
    <?php
    $sql = "
    INSERT INTO review(userid, title, description, created, pageid)
    VALUE('$userid','$title', '$description', NOW(), '$pageid')
    ";
    
    $result = mysqli_query($conn, $sql);
    header('Location: /detailpage.php?id='.basename($pageid));
}

?>