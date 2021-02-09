<?php
header('Content-Type: text/html; charset=utf-8');
require('./lib/print.php');
session_start();
?>


<!-- 리뷰 출력 코드 -->
<?php
include './lib/dbConnect.php';
$filtered_id = mysqli_real_escape_string($conn, $_GET['id']); //sql 주입 공격을 막을 수 있어.
$sql = "SELECT * FROM review WHERE pageid=$filtered_id";
$result = mysqli_query($conn, $sql);
$list = '';
$uptitle = '';
$updesc = '';
while ($row = mysqli_fetch_array($result)) {
    $escaped_title = htmlspecialchars($row['title']); //cross scripting error를 막는 처리.
    $escaped_description = htmlspecialchars($row['description']);
    $list = $list . '<p>' . $row['userid'] . '<br>' . $escaped_title . '<br>' .  $escaped_description . '<br>' . $row['created'] . '</p>';
    if ($user_id == $row['userid']) {
        if ($uptitle == '') { //한개만 찾음.
            $uptitle = $uptitle . $escaped_title;
            $updesc = $updesc . $escaped_description;
        }
    }
}

?>


<!DOCTYPE html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        print_single("title");
        ?>
    </title>
    <link rel="stylesheet" href="./style/detailpage.css">
    <link rel=" shortcut icon" href="./images/fabicon.png">
    <link rel="icon" href="./images/fabicon.png">
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
        <div id="headline">
            <div id="headline-up" style="background-image: url('./data/sample<?php echo $_GET['id'] ?>/images/cover-web.png')">
                <div id="headline-up-title">
                    <h4>
                        <?php
                        print_single("title");
                        ?>
                    </h4>
                </div>
                <div id="headline-up-teacher">
                    <h4>
                        <?php
                        print_single("teacher");
                        ?>
                    </h4>
                </div>
                <div id="headline-up-genre">
                    <!-- 루프를 사용한 생산 숫자가 정해지지 않은 컨텐츠는 폴더에 -->
                    <?php
                    print_multi("contents");
                    ?>
                </div>
            </div>
            <div id="headline-down">
                <div id="headline-down-inner">
                    <div id="infoplay">
                        <img src="./images/playicon.png">
                        <h4>총 <?php print_single("playnumber"); ?>회 영상</h4>
                        <p><?php print_single("infoplay"); ?></p>
                    </div>
                    <div id="infohave">
                        <img src="./images/haveicon.png">
                        <h4>평생소장</h4>
                        <p><?php print_single("infohave"); ?></p>
                    </div>
                    <div id="infoprice">
                        <h4>평생소장</h4>
                        <p style="color: #ffffff;"><del><?php print_single("infoprice1"); ?>원</del> &nbsp;&nbsp;<?php print_single("infoprice2"); ?>원 &nbsp;&nbsp;<span style="color: rgb(255, 0, 98);"> <?php print_single("infoprice3"); ?>%할인</span></p>
                        <div id="infoprice-contents">
                            <div id="infoprice-contents-left">
                                <h4>월 <?php print_single("infoprice4"); ?></h4>
                                <p>*<?php print_single("infoprice5"); ?>개월 할부 시</p>
                            </div>
                            <div id="infoprice-contents-right">
                                <h4><?php print_single("infoprice6"); ?></h4>
                                <p>가격이 인상됩니다.</p>
                            </div>
                        </div>
                        <form action="./lib/basket_process.php" method="POST">
                            <p><input type="hidden" name="lecname" value="<?= print_single('title') ?>"></p>
                            <p><input type="hidden" name="teacher" value="<?= print_single('teacher') ?>"></p>
                            <p><input type="hidden" name="price" value="<?= print_single('infoprice2') ?>"></p>

                            <p><input type="hidden" name="page-id" value="<?= $_GET['id'] ?>"></p>
                            <p><input type="hidden" name="basket-userid" value="<?php echo $_SESSION['email']; ?>"></p>
                            <p><input type="submit" value="지금 최저가 구매하기"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="videosection">
            <div id="videosection-inner">
                <h6>소개영상</h6>
                <h2><?php print_single("video1"); ?></h2>
                <h2><?php print_single("video2"); ?></h2>
                <div id="videosection-inner-container">
                    <iframe width="700" height="393.75" src="<?php print_single("video3url"); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <p><?php print_single("video4"); ?></p>
            </div>
        </div>

        <div id="imagesection">
            <div id="imagesection-up">
                <div id="imagesection-up-left">
                    <h1><?php print_single("img1"); ?></h1>
                    <p><?php print_single("img2"); ?></p>
                    <p><?php print_single("img3"); ?></p>
                </div>
                <div id="imagesection-up-right">
                    <img src="./data/sample<?php echo $_GET['id'] ?>/images/imagesection01.png">
                </div>
            </div>
            <div id="imagesection-down">
                <div id="imagesection-down-left">
                    <h1><?php print_single("img4"); ?></h1>
                    <p><?php print_single("img5"); ?></p>
                    <p><?php print_single("img6"); ?></p>
                    <p><?php print_single("img7"); ?></p>
                    <p><?php print_single("img8"); ?></p>
                </div>
                <div id="imagesection-down-right">
                    <img src="./data/sample<?php echo $_GET['id'] ?>/images/imagesection02.png">
                </div>
            </div>
        </div>
        <!-- 여기까지 함수화 -->

        <div id="contentssection">
            <div id="contentssection-title">
                <h4>클래스 구성</h4>
                <p>이런 것을 배웁니다</p>
            </div>
            <div class="contentssection-inner">
                <div class="contents">
                    <div class="contents-img">
                        <img src="./images/contentssection01.png">
                    </div>
                    <div class="contents-text">
                        <h4>클래식 마들렌&피낭시에</h4>
                        <p>
                            프랑스의 정통적 가치를 한국인의 입맛에 맞도록 뤼벡의 마지팬을 사용해 더욱 깊은 맛을 내는 레시피를 배워보세요.
                        </p>
                    </div>
                </div>
                <div class="contents">
                    <div class="contents-img">
                        <img src="./images/contentssection02.png">
                    </div>
                    <div class="contents-text">
                        <h4>더티 마틸다</h4>
                        <p>단맛이 강하지 않고 적당한 다크초콜릿, 부드러운 초콜릿 가나슈와 카카오 글라세, 카카오 파우더가 어우러져 진한 맛과 깊은 밸런스를 내는 초콜릿 마들렌을 배워보세요.
                        </p>
                    </div>
                </div>
                <div class="contents">
                    <div class="contents-img">
                        <img src="./images/contentssection03.png">
                    </div>
                    <div class="contents-text">
                        <h4>블루치즈 마들렌</h4>
                        <p>고르곤졸라 피칸테, 그라나파다노 치즈를 사용하여 짭조름하면서도 고소한 치즈의 매력을 그대로 담아낸 가스트로노믹 마들렌 레시피를 알려드립니다.</p>
                    </div>
                </div>
            </div>
            <div class="contentssection-inner">
                <div class="contents">
                    <div class="contents-img">
                        <img src="./images/contentssection04.png">
                    </div>
                    <div class="contents-text">
                        <h4>피낭시에 나튀르</h4>
                        <p>버터 특유의 풍미가 살아있는 정통 프렌치 스타일의 피낭시에 레시피와 함께 제품의 맛과 식감을 결정짓는 버터의 활용법을 배웁니다.</p>
                    </div>
                </div>
                <div class="contents">
                    <div class="contents-img">
                        <img src="./images/contentssection05.png">
                    </div>
                    <div class="contents-text">
                        <h4>얼그레이 티 마들렌</h4>
                        <p>은은한 향이 가득한 얼그레이 티를 마들렌에 첨가하는 방법을 알려드립니다.</p>
                    </div>
                </div>
                <div class="contents">
                    <div class="contents-img">
                        <img src="./images/contentssection06.png">
                    </div>
                    <div class="contents-text">
                        <h4>피스타치오&자몽 피낭시에<br>
                            &#40;글루텐 프리&#41;</h4>
                        <p>피스타치오와 자몽을 활용해 달콤함과 고소함을 배가시키고, 쌀가루가 가진 식감은 촉촉하게 보완하는 글루텐 프리 레시피를 배워봅니다.</p>
                    </div>
                </div>
            </div>
            <div class="contentssection-inner">
                <div class="contents">
                    <div class="contents-img">
                        <img src="./images/contentssection07.png">
                    </div>
                    <div class="contents-text">
                        <h4>콰트로 포르마지 피낭시에<br>
                            &#40;글루텐 프리 &#47; 세이버리&#41;</h4>
                        <p>네 가지 치즈를 적절하게 사용해 단맛과 짠맛의 밸런스를 모두 잡은 세이버리 디저트 레시피를 알려드립니다.</p>
                    </div>
                </div>
                <div class="contents">
                    <div class="contents-img">
                        <img src="./images/contentssection08.png">
                    </div>
                    <div class="contents-text">
                        <h4>마들렌 &#39;거문도&#39;</h4>
                        <p>거문도 쑥을 활용하는 방법과 가나슈, 스트로이젤 등 마들렌 맛의 깊이를 더해줄 요소의 활용법까지 배워봅니다.</p>
                    </div>
                </div>
                <div class="contents">
                    <div class="contents-img">
                        <img src="./images/contentssection09.png">
                    </div>
                    <div class="contents-text">
                        <h4>쌀 피낭시에</h4>
                        <p>화학적 팽창을 기본으로 하는 피낭시에 제법을 정확히 이해하고, 뵈르노아젯&#40;태운 버터&#41;를 만들어 쌀의 부드럽고 자연스러운 단맛을 담은 레시피를 배워봅니다.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div id="teachersection">
            <div id="teachersection-title">
                <h4>강사 소개</h4>
                <p>지금 가장 사랑받는 맛을 한 곳에 모으다.</p>
            </div>
            <div class="teachersection-inner">
                <div class="teacher">
                    <div class="teacher-img">
                        <img src="./images/teacher1.png">
                    </div>
                    <div class="teacher-name">
                        <h2>백종원</h2>
                        <p>더본코리아 대표이사 및 오너 셰프</p>
                    </div>
                    <div class="teacher-career">
                        <h2>이력 및 경력</h2>
                        <p>
                            2007~2008, Patisserie Chocolaterie Francois GIMENEZ<br>
                            2009~2011, Patisserie Saveur et Plaisir Paris<br>
                            2011~2013, Hotel Royal Monceau Paris<br>
                            2013~2014, PIERRE HERME PARIS<br>
                            2014~2015, CAFE DIOR BY PIERRE HERME<br>
                            2016~2018, Cafe In Space<br>
                            2018~ 현재, Patisserie Cedrat<br>
                            2013, 파리 Ecoloe Bellouet Conseil 초콜릿 공예 과정<br>
                            2008~2009, 파리 EPMTTH, MC Patissier 과정<br>
                            2007, 루앙 INBP, CAP Patissier / Boulanger 과정<br>
                        </p>
                    </div>
                </div>
                <div class="teacher">
                    <div class="teacher-img">
                        <img src="./images/teacher2.png">
                    </div>
                    <div class="teacher-name">
                        <h2>이연복</h2>
                        <p>현 목란 오너 셰프</p>
                    </div>
                    <div class="teacher-career">
                        <h2>이력 및 경력</h2>
                        <p>
                            2016~2018, 비안어소시에이츠 디저트 R&D<br>
                            2015, ECOLE LENOTRE MASTER CLASS 디플롬 수석 수료<br>
                            2015, France Lenotre Stage<br>
                            2011~2015, 한국음식문화직업전문학교 제과교사<br>
                            2009, Japan Kyoto LAMI DU PAIN 블랑제<br>
                            2008, UK London Westminster Kingsway College 연수
                        </p>
                    </div>
                </div>
                <div class="teacher">
                    <div class="teacher-img">
                        <img src="./images/teacher3.png">
                    </div>
                    <div class="teacher-name">
                        <h2>황준호</h2>
                        <p>현 OG마카롱 오너 셰프</p>
                    </div>
                    <div class="teacher-career">
                        <h2>이력 및 경력</h2>
                        <p>
                            1996 동경제과학교 양과자 본과 졸업<br>
                            1998~2008 동경리가로열호텔 제과장(외국인 최초)<br>
                            2017~벨코라데 엠버서더<br>
                            2003, 2008, 2019 Coupe du Monde de la Patisserie 한국대표<br>
                            2002 '재팬 케이크 쇼' 초콜릿 대형 공예 부문 연합회장상(1위)<br>
                            2003 일본 TBS 'TV챔피언' 크리스마스 케이크 부문 우승(1위)<br>
                            오뗄두스의 클래식 구움과자(2018), 비앤씨월드<br>
                            시크릿 레시피 (2012), 비앤씨월드<br>
                            정홍연의 홈베이킹 시크릿(2009), 비앤씨월드
                        </p>
                    </div>
                </div>
                <div class="teacher">
                    <div class="teacher-img">
                        <img src="./images/teacher4.png">
                    </div>
                    <div class="teacher-name">
                        <h2>김진우</h2>
                        <p>현 WOOD 오너 셰프</p>
                    </div>
                    <div class="teacher-career">
                        <h2>이력 및 경력</h2>
                        <p>
                            Grand Intercontinental Hotel Seoul<br>
                            De Chocolate Coffee 상품개발<br>
                            해외출강: 스페인, 미국, 러시아, 멕시코, 호주 등(2014~)<br>
                            지방기능 경기대회 인천광역시 제빵직종 심사위원(2020)<br>
                            2011 SIBA. Bonbon Chocolate 1위 (2011)<br>
                            여성기술인대회 Marzipan 1위(2010)<br>
                            에클레어 바이 가루하루<br>
                            (ECLAIR by GARUHARU)(2020), 더테이블<br>
                            타르트 바이 가루하루<br>
                            (TARTE by GARUHARU)(2020), 더테이블<br>
                            타르트(Tart)-사계절을 담은 선물(2016), 비엔씨월드
                        </p>
                    </div>
                </div>
                <div class="teacher">
                    <div class="teacher-img">
                        <img src="./images/teacher5.png">
                    </div>
                    <div class="teacher-name">
                        <h2>백희준</h2>
                        <p>현 빽다방 오너 셰프</p>
                    </div>
                    <div class="teacher-career">
                        <h2>이력 및 경력</h2>
                        <p>
                            르꼬르동블루 제과 디플로마(2013)<br>
                            나카무라 아카데미 제과전문가 과정(2016)<br>
                            르꼬르동블루 제빵 디플로마(2018)<br>
                            마들렌_해피해피레시피시리즈(2018)<br>
                            스콘_해피해피레시피시리즈(2018)<br>
                            쿠키_해피해피레시피시리즈(2018)<br>
                            까눌레_해피해피레시피시리즈(2019)<br>
                            라퀴진 푸드스타일링전문가<br>
                            과정 제과 강의(2018,2019,2020)<br>
                            올리커 초청 세미나(2018,2019)<br>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div id="pricesection">
            <div id="pricesection-inner">
                <div id="pricesection-inner-left">
                    <div id="pricesection-inner-left-title">
                        <p>평생소장</p>
                        <p>최저가</p>
                    </div>
                    <h2>
                        한번 구매로, 평생 소장하세요.<br>
                        3월10일(금) 18시, 가격이 인상됩니다.
                    </h2>
                    <p>
                        조만간 가격이 인상될 예정입니다.<br>
                        지금 구매하세요!
                    </p>
                    <div id="pricesection-inner-left-price">
                        <div id="pricesection-inner-left-price-left">
                            <p>정상가</p>
                            <p>할인 금액</p>
                            <p>최종 금액</p>
                        </div>
                        <div id="pricesection-inner-left-price-right">
                            <p>400,000원</p>
                            <p>-300,000원</p>
                            <p>100,000원</p>
                        </div>
                    </div>
                    <div id="pricesection-inner-left-result">
                        <div id="pricesection-inner-left-result-left">
                            <h2>5개월 할부 시</h2>
                        </div>
                        <div id="pricesection-inner-left-result-right">
                            <h2>월 20,000원</h2>
                        </div>
                    </div>
                </div>
                <div id="pricesection-inner-right">
                    <div>
                        <span class="red" data-val='20'>
                            <div class="textbox">
                                <h4> 오늘이 최저가!</h4>
                            </div>
                        </span>
                        <span class="grey" data-val='40'>B</span>
                        <span class="grey" data-val='60'>C</span>
                        <span class="grey" data-val='80'>D</span>
                    </div>
                </div>
            </div>
        </div>

        <div id="curriculumsection">
            <div id="curriculumsection-title">
                <h4>커리큘럼</h4>
                <p>커리큘럼을 보여드려요</p>
            </div>
            <div id="curriculumsection-inner">
                <div class="curriculum">
                    <div class="curriculum-img">
                        <img src="https://storage.googleapis.com/static.fastcampus.co.kr/prod/uploads/202011/184527-288/curriculum-madeleinexfinancier-01.png">
                    </div>
                    <div class="curriculum-text">
                        <h4>01. 클래식 마들렌</h4>
                        <p>
                            -뤼벡의 마지팬을 사용해 깊은 맛을 내는 노하우<br>
                            <br>
                            -레몬의 내추럴한 향을 담는 방법<br>
                            <br>
                            by. 백희준 셰프
                        </p>
                    </div>
                </div>
                <div class="curriculum">
                    <div class="curriculum-img">
                        <img src="https://storage.googleapis.com/static.fastcampus.co.kr/prod/uploads/202011/184555-288/curriculum-madeleinexfinancier-02.png">
                    </div>
                    <div class="curriculum-text">
                        <h4>02. 클래식 피낭시에</h4>
                        <p>
                            -고소한 버터와 견과류의 풍미가 짙은 피낭시에<br>
                            <br>
                            -맛과 향이 장기간 유지되는 높은 보존성의 제품 만드는 법<br>
                            <br>
                            by. 백희준 셰프
                        </p>
                    </div>
                </div>
                <div class="curriculum">
                    <div class="curriculum-img">
                        <img src="https://storage.googleapis.com/static.fastcampus.co.kr/prod/uploads/202011/184635-288/curriculum-madeleinexfinancier-03.png">
                    </div>
                    <div class="curriculum-text">
                        <h4>03. 더티 마틸다</h4>
                        <p>
                            -진한 맛과 밸런스가 인상적인 초콜릿 마들렌<br>
                            <br>
                            -적당한 단맛의 다크초콜릿, 부드러운 가나슈와 카카오 클라세, 카카오 파우더 활용법<br>
                            <br>
                            by. 황준호 셰프
                        </p>
                    </div>
                </div>
                <div class="curriculum">
                    <div class="curriculum-img">
                        <img src="https://storage.googleapis.com/static.fastcampus.co.kr/prod/uploads/202011/184642-288/curriculum-madeleinexfinancier-04.png">
                    </div>
                    <div class="curriculum-text">
                        <h4>04. 블루치즈 마들렌</h4>
                        <p>
                            -고르곤졸라 피칸테를 사용하여 묘하고 강한 여운을 이끌어낸 마들렌<br>
                            <br>
                            -그라나파다노 지츠를 가나시로 사용하여 짭쪼름함녀서도 고소한 치즈의 매력을 그대로 담아낸 가스트로노믹 마들렌<br>
                            <br>
                            by. 황준호 셰프
                        </p>
                    </div>
                </div>
                <div class="curriculum">
                    <div class="curriculum-img">
                        <img src="https://storage.googleapis.com/static.fastcampus.co.kr/prod/uploads/202011/184704-288/curriculum-madeleinexfinancier-06.png">
                    </div>
                    <div class="curriculum-text">
                        <h4>05. 피낭시에 나튀르</h4>
                        <p>
                            -밀가루, 버터, 계란을 사용해 좋은 퀄리티의 피낭시에 반죽을 만드는 방법<br>
                            <br>
                            -묵직한 식감이 돋보이는 정통 프렌치 스타일의 피낭시에<br>
                            <br>
                            by. 김진우 셰프
                        </p>
                    </div>
                </div>
                <div class="curriculum">
                    <div class="curriculum-img">
                        <img src="https://storage.googleapis.com/static.fastcampus.co.kr/prod/uploads/202011/184712-288/curriculum-madeleinexfinancier-05.png">
                    </div>
                    <div class="curriculum-text">
                        <h4>06. 얼그레이 티 마들렌</h4>
                        <p>
                            -은은한 향의 얼그레이 티를 마들렌에 첨가하는 방법<br>
                            <br>
                            -기본 제품에서 다양한 플레이버를 표현하는 방법<br>
                            <br>
                            by. 김진우 셰프
                        </p>
                    </div>
                </div>
                <div class="curriculum">
                    <div class="curriculum-img">
                        <img src="https://storage.googleapis.com/static.fastcampus.co.kr/prod/uploads/202011/184722-288/curriculum-madeleinexfinancier-07.png">
                    </div>
                    <div class="curriculum-text">
                        <h4>07. 피스타치오&자몽 피낭시에</h4>
                        <p>
                            -쌀가루가 가진 식감을 촉촉하게 보완하는 노하우<br>
                            <br>
                            -피스타치오와 자몽으로 풍미를 더한 피낭시에<br>
                            <br>
                            -클래식의 변주, 가루하루 스타일의 피낭시에 표현 방법<br>
                            <br>
                            by. 백종원 셰프
                        </p>
                    </div>
                </div>
                <div class="curriculum">
                    <div class="curriculum-img">
                        <img src="https://storage.googleapis.com/static.fastcampus.co.kr/prod/uploads/202011/184731-288/curriculum-madeleinexfinancier-08.png">
                    </div>
                    <div class="curriculum-text">
                        <h4>08. 콰트로 포르마지 피낭시에</h4>
                        <p>
                            -요리에 사용하는 식재료를 활용한 세이버리 디저트<br>
                            <br>
                            -네 가지 치즈를 적절하게 사용해 단맛과 짠맛의 밸런스를 준 피낭시에<br>
                            <br>
                            by. 백종원 셰프
                        </p>
                    </div>
                </div>
                <div class="curriculum">
                    <div class="curriculum-img">
                        <img src="https://storage.googleapis.com/static.fastcampus.co.kr/prod/uploads/202011/184740-288/curriculum-madeleinexfinancier-09.png">
                    </div>
                    <div class="curriculum-text">
                        <h4>09. 마들렌 거문도</h4>
                        <p>
                            -거문도 쑥을 활용한 새로운 맛과 식감의 마들렌<br>
                            <br>
                            -가나슈, 스트로이젤 등 마들렌 맛의 깊이를 더해줄 요소의 활용 방법<br>
                            <br>
                            -마들렌 제법, 실패하지 않는 제조를 위한 팁<br>
                            <br>
                            by. 이연복 셰프
                        </p>
                    </div>
                </div>
                <div class="curriculum">
                    <div class="curriculum-img">
                        <img src="https://storage.googleapis.com/static.fastcampus.co.kr/prod/uploads/202011/184748-288/curriculum-madeleinexfinancier-10.png">
                    </div>
                    <div class="curriculum-text">
                        <h4>10. 쌀 피낭시에</h4>
                        <p>
                            -화학적 팽창을 기본으로 하는 피낭시에 제법의 정확한 이해<br>
                            <br>
                            -쌀의 부드럽고 자연스러운 단맛을 담은 피낭시에 레시피<br>
                            <br>
                            -뵈르노아젯(태운버터) 만들기<br>
                            <br>
                            by. 이연복 셰프
                        </p>
                    </div>
                </div>

            </div>
        </div>

        <!-- 리뷰 섹션 시작 -->
        <div id="review">
            <div id="review-button">
                <button onclick="onCreate()">리뷰 등록</button>
                <button onclick="onUpdate()">리뷰 수정</button>
                <button onclick="onDelete()">리뷰 삭제</button>
            </div>

            <div class="review-input" id="create" style="display: none;">
                <form action="./lib/create_process.php" method="POST">
                    <p><input type="hidden" name="page-id" value="<?= $_GET['id'] ?>"></p>
                    <p><input type="hidden" name="review-userid" placeholder="ID를 입력하세요." value="<?php echo $_SESSION['email']; ?>"></p>
                    <p><input type="text" name="review-title" placeholder="제목을 입력하세요."></p>
                    <p><textarea name="review-description" placeholder="내용을 입력하세요."></textarea></p>
                    <p><input type="submit" value="등록"></p>
                </form>
                <button onclick="offAll()">X</button>
            </div>

            <div class="review-input" id="update" style="display: none;">
                <form action="./lib/update_process.php" method="POST">
                    <p><input type="hidden" name="page-id" value="<?= $_GET['id'] ?>"></p>
                    <p><input type="hidden" name="review-userid" placeholder="ID를 입력하세요." value="<?php echo $_SESSION['email']; ?>"></p>
                    <p><input type="text" name="review-title" placeholder="수정할 제목을 입력하세요." value="<?php echo $uptitle ?>"></p>
                    <p><textarea name="review-description" placeholder="<?php echo $updesc; ?>"></textarea></p>
                    <p><input type="submit" value="수정"></p>
                </form>
                <button onclick="offAll()">X</button>
            </div>

            <div class="review-input" id="delete" style="display: none;">
                <form action="./lib/delete_process.php" method="POST">
                    <p><input type="hidden" name="page-id" value="<?= $_GET['id'] ?>"></p>
                    <p><input type="hidden" name="review-userid" placeholder="ID를 입력하세요." value="<?php echo $_SESSION['email']; ?>"></p>
                    <p><input type="hidden" name="review-title" placeholder="삭제할 제목을 입력하세요." value="<?php echo $uptitle ?>"></p>
                    <p><input type="submit" value="삭제"></p>
                </form>
                <button onclick="offAll()">X</button>
            </div>

            <div id="review-result">
                <?php echo $list; ?>
            </div>
        </div>
        <!-- 리뷰 섹션 끝 -->
        
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
            <div id="footer-inner-down">
                <div id="footer-inner-down-copyright">
                    <h5>Copyright &#169; Mogang. All rights reserved.</h5>
                </div>
                <div id="footer-inner-down-snslink">
                    <a href="" id="facebook">
                        <img src="./images/facebookicon.png">
                    </a>
                    <a href="" id="instar">
                        <img src="./images/instaricon.png">
                    </a>
                    <a href="" id="youtube">
                        <img src="./images/youtubeicon.png">
                    </a>
                </div>
            </div>
        </div>
    </footer>
    <!-- 푸터 끝 -->


    <!-- library -->
    <script src="https://d3js.org/d3.v6.min.js"></script>
    <script src="./lib/d3.js"></script>

    <!-- function -->
    <script src="./lib/display.js"></script>

    <!-- plugin -->
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
    <script src="./lib/kakao.js"></script>
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