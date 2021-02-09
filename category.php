<?php
include "./lib/dbConnect.php";
session_start();
?>

<?php
include './lib/dbConnect.php';

$category = $_GET['category'];

$sql = "SELECT * FROM lecture WHERE category='$category'";
$result = mysqli_query($conn, $sql);
$list = '';
while ($row = mysqli_fetch_array($result)) {
    $pageid = $row['id'];
    $lecname = $row['lecname'];
    $teacher = $row['teacher'];
    $list = $list . '<div class="class-box"><img class="img-size" src="./images/thumb/cover-web'.$pageid.'.png"><h2 class="title-box"><a href="./detailpage.php?id='.$pageid.'"style="color: white;">'. $lecname .' Course</a></h2><p class="teacher-name">'. $teacher .'</p></div>';
}
?>



<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="./style/detailpage.css">
    <link rel="stylesheet" href="./style/mainpage.css">
    <link rel="stylesheet" href="./style/mbti.css">
</head>

<body>
    <!-- 헤더 메뉴 -->
   <header id="header" role="banner">
        <div id="header-inner">
            <div id="header-inner-logoimage">
                <a href="./mainpage.php">
                    <img src="./images/logoicon5.png">
                </a>
            </div>

            <div id="header-inner-bar">
                <div><a href="./mbti.php">
                        <p>설문조사</p>
                    </a></div>
                <div><a href="">
                    <p>카테고리</p></a>
                </div>
                <div>
                    <?php
                    if(!empty($_SESSION['email'])){
                        echo '<a href="./logout.php"><img src="./images/loginicon.png"><p>로그아웃</p></a>';
                    } else{
                        echo '<a href="./login.php"><img src="./images/loginicon.png"><p>로그인</p></a>';
                    };                    
                    ?>
                </div>
                <div>
                    <?php
                    if(!empty($_SESSION['email'])){
                        echo '<a href="./basket.php"><img src="./images/singinicon.png"><p>장바구니</p></a>';
                    } else{
                        echo '<a href="./register.html"><img src="./images/singinicon.png"><p>회원가입</p></a>';
                    };                    
                    ?>
                </div>
                <ul id="sub-menu">
                    <li><a href="./category.php?category=헤어">헤어</a></li>
                    <li><a href="./category.php?category=쿠킹">쿠킹</a></li>
                    <li><a href="./category.php?category=영상%20디자인">영상 디자인</a></li>
                    <li><a href="./category.php?category=일러스트">일러스트</a></li>
                    <li><a href="./category.php?category=스포츠">스포츠</a></li>
                    <li><a href="./category.php?category=라이프스타일">라이프스타일</a></li>
                </ul>
            </div>
        </div>
    </header>
    <!-- 햄버거 메뉴 아이콘 -->
    <input type="checkbox" id="menuicon">
    <label for="menuicon">
        <span></span>
        <span></span>
        <span></span>
    </label>
    <div id="sidebar">
        <div>
            <?php
            if (!empty($_SESSION['email'])) {
                echo '<a href="./logout.php"><img src="./images/loginicon.png"><p>' . $_SESSION['email'] . '로그아웃</p></a>';
            } else {
                echo '<a href="./login.php"><img src="./images/loginicon.png"><p>' . $_SESSION['email'] . '</p></a>';
            };
            ?>
        </div>
        <div>
            <?php
            if (!empty($_SESSION['email'])) {
                echo '<a href="./basket.php"><img src="./images/singinicon.png"><p>장바구니</p></a>';
            } else {
                echo '<a href="./register.html"><img src="./images/singinicon.png"><p>회원가입</p></a>';
            };
            ?>
        </div>
        <div><a href="./mbti.php">
                <p>설문조사</p>
            </a></div>
        <div>
        <ul id="sub-menu">
                <p>카테고리</p>
                <li><a href="./category.php?category=헤어">헤어</a></li>
                <li><a href="./category.php?category=쿠킹">쿠킹</a></li>
                <li><a href="./category.php?category=영상%20디자인">영상 디자인</a></li>
                <li><a href="./category.php?category=일러스트">일러스트</a></li>
                <li><a href="./category.php?category=스포츠">스포츠</a></li>
                <li><a href="./category.php?category=라이프스타일">라이프스타일</a></li>
            </ul>
        </div>
    </div>    
    <!-- 헤더 끝 -->


    <!-- wrapper 시작 -->
    <div id="wrapper">
        <div id="wrapper-inner">
            <div id="iconsection">
                <div class="iconsection-inner">
                    <div class="iconsection-inner-img">
                        <a href="./category.php?category=헤어"><img src="https://storage.googleapis.com/static.fastcampus.co.kr/prod/uploads/202012/154603-84/artboard-36.png"></a>
                    </div>
                    <div class="iconsection-inner-text">
                        <h2>헤어</h2>
                    </div>
                </div>
                <div class="iconsection-inner">
                    <div class="iconsection-inner-img">
                        <a href="./category.php?category=쿠킹"><img src="https://storage.googleapis.com/static.fastcampus.co.kr/prod/uploads/202012/154215-84/artboard-37.png"></a>
                    </div>
                    <div class="iconsection-inner-text">
                        <h2>쿠킹</h2>
                    </div>
                </div>
                <div class="iconsection-inner">
                    <div class="iconsection-inner-img">
                        <a href="./category.php?category=영상%20디자인"><img src="https://storage.googleapis.com/static.fastcampus.co.kr/prod/uploads/202012/154543-84/artboard-38.png"></a>
                    </div>
                    <div class="iconsection-inner-text">
                        <h2>영상 디자인</h2>
                    </div>
                </div>
                <div class="iconsection-inner">
                    <div class="iconsection-inner-img">
                        <a href="./category.php?category=일러스트"><img src="https://storage.googleapis.com/static.fastcampus.co.kr/prod/uploads/202012/154815-84/artboard-39.png"></a>
                    </div>
                    <div class="iconsection-inner-text">
                        <h2>일러스트</h2>
                    </div>
                </div>
                <div class="iconsection-inner">
                    <div class="iconsection-inner-img">
                        <a href="./category.php?category=스포츠"><img src="https://storage.googleapis.com/static.fastcampus.co.kr/prod/uploads/202012/154841-84/artboard-40.png"></a>
                    </div>
                    <div class="iconsection-inner-text">
                        <h2>스포츠</h2>
                    </div>
                </div>
                <div class="iconsection-inner">
                    <div class="iconsection-inner-img">
                        <a href="./category.php?category=라이프스타일"><img src="https://storage.googleapis.com/static.fastcampus.co.kr/prod/uploads/202012/155138-84/artboard-41.png"></a>
                    </div>
                    <div class="iconsection-inner-text">
                        <h2>라이프스타일</h2>
                    </div>
                </div>
            </div>

            <div id="lecturesection">
                <div id="lecturesection-inner">
                    <h4 id="lecturesection-inner-title"><?php $_GET['category']; ?> 카테고리</h4>
                    <?php echo $list; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- wrapper 끝 -->


  <!-- 푸터 시작 -->
  <footer id="footer">
        <div id="footer-inner">
            <div id="footer-inner-up">
                <div id="footer-inner-up-company">
                    <h4>COMPANY</h4>
                    <p>모두의강의(주)</p>
                    <p>대표이사 : 김진우</p>
                    <p>개인정보책임관리자 : 황준호</p>
                    <p>사업자번호 : 123-45-78910</p>
                    <p>통신판매업 신고번호 : 제2021-서울강동-01234호</p>
                    <a href="">정보조회</a>
                </div>
                <div id="footer-inner-up-etc">
                    <h4>ETC</h4>
                    <a href="">공지사항</a>
                    <a href="">이용약관</a>
                    <a href="">개인정보취급방법</a>
                    <a href="">FAQ</a>
                    <a href="">환불규정</a>
                </div>
                <div id="footer-inner-up-contact">
                    <h4>CONTACT</h4>
                    <a href="">환불문의 : refund@gmail.com</a>
                    <a href="">기타문의 : help@gmail.com</a>
                    <p>사무실 : 서울특별시 강동구 천호역 3번출구</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- 푸터 끝 -->

     <!--tawk plugin -->
     <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/601b749fc31c9117cb75a52c/1etljv3s5';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
        <div 
                id="kakao-talk-channel-chat-button"
                data-channel-public-id="_ZxeGNK"
                data-size="large"
                data-color="yellow"
                data-shape="pc"
                data-support-multiple-densities="true"
                data-title="consult"
                >
        </div>

    <script src="./lib/kakao.js"></script>

</body>
<script> //카카오 채널
    window.kakaoAsyncInit = function() {
      Kakao.Channel.createChatButton({
        container: '#kakao-talk-channel-chat-button',
      });
    };
  
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://developers.kakao.com/sdk/js/kakao.channel.min.js';
      fjs.parentNode.insertBefore(js, fjs);
    })(document, 'script', 'kakao-js-sdk');
  </script>

</html>
