<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
    require_once(MY_PATH_DB_LIB);

    require_once(MY_PATH_MODEL_INDEX);
?>

<!doctype html>
<html lang="ko">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/css/common.css" />
    <link rel="stylesheet" href="/css/index.css" />

    <title>우물 속의 페페🐸하우스</title>
  </head>
  <body>

    <?php require_once(MY_PATH_HEADER) ?>

    <!-- 중앙 컨테이너 DIV -->
    <div class="container">
        <!-- 배너 이미지 DIV-->
        <div class="pepe-banner"></div>
        <!-- 본문 영역 DIV-->
        <div class="content">
            <!-- 탑 버튼 영역 DIV -->
            <div class="content-top">
            <!-- 좌측 버튼 영역 DIV -->
            <div class="content-top-left">
                <!-- 전체굴 버튼 DIV -->
                <a href="./index.php" class="btn btn-sm btn-mr">
                <span class="btn-icons btn-icon-all-pages"></span>
                전체굴
                </a>

                <!-- ★즐겨찾기 버튼 DIV -->
                <a href="./index.php" class="btn btn-sm btn-mr">
                <span class="btn-icons btn-icon-bookmark"></span>
                즐겨찾기
                </a>

                <!-- 정렬 셀렉트폼 DIV -->
                <form action="./index.php" method="GET">
                <!-- onchange="this.form.submit()" -->
                <select class="btn-sm">
                    <option value="latest">최신순</option>
                    <option value="old">오래된순</option>
                    <option value="view">조회순</option>
                </select>
                </form>
            </div>

            <!-- 우측 버튼 영역 DIV -->
            <div class="content-top-right">
                <!-- 탭 편집 버튼 DIV-->
                <a href="./edit_tab.php" class="btn btn-sm btn-mr">
                <span class="btn-icons btn-icon-edit-tab"></span>
                탭편집
                </a>

                <!-- 굴파기 버튼 DIV-->
                <a href="./create.php" class="btn btn-sm">
                <span class="btn-icons btn-icon-dig"></span>
                굴파기
                </a>
            </div>
            </div>

            <!-- 탭 버튼 영역 DIV -->
            <div class="content-tab hide-scrollbar">
            <div class="btn-sm tab-enable">
                <a href="./index.php">전체</a>
            </div>
            <div class="btn-sm tab-disable">
                <a href="./index.php">Tab 1</a>
            </div>
            <div class="btn-sm tab-disable">
                <a href="./index.php">Tab 2</a>
            </div>
            <div class="btn-sm tab-disable">
                <a href="./index.php">Tab 3</a>
            </div>
            <div class="btn-sm tab-disable">
                <a href="./index.php">Tab 4</a>
            </div>
            <div class="btn-sm tab-disable">
                <a href="./index.php">· · ·</a>
            </div>
            </div>

            <!-- 메인 리스트 영역 DIV -->
            <div class="content-list">
                <!-- 리스트 헤드 영역 DIV -->
                <div class="item list-head">
                    <div>번호</div>
                    <div>제목</div>
                    <div>작성자</div>
                    <div>작성일</div>
                    <div>조회수</div>
                </div>

                <!-- 리스트 공지 영역 DIV -->
                <div class="item list-board list-notice">
                    <div>공지</div>
                    <div>이것은 공지입니다. 여튼 그런겁니다</div>
                    <div>
                    <span class="btn-icons list-icon-title-stamp"></span>
                    익명의 페페
                    </div>
                    <div>2024-10-02</div>
                    <div>30</div>
                </div>

                <!-- 리스트 일반 영역 DIV-->
                <a href="/detail.php" onmouseover="loadThumb(1, 'ttabong.webp')">
                    <div class="item list-board">
                    <div>
                        <span class="btn-icons btn-icon-bookmark"></span>
                    </div>
                    <div>
                        <span class="list-tab">Tab 1</span>
                        이것은 일반입니다. 여튼 그런겁니다
                    </div>
                    <div>
                        <span class="btn-icons list-icon-title-stamp"></span>
                        익명의 페페
                    </div>
                    <div>2024-10-02</div>
                    <div>30</div>
                    </div>
                    <div class="thumb-preview" id="thumb-1"></div>
                </a>
                <!-- ↑ a, 미리보기 JS -->

                
                <?php foreach($result as $item) { ?>
                    <a href="/detail.php?id=<?php $item['id'] ?>" onmouseover="loadThumb(1, 'ttabong.webp')">
                        <div class="item list-board">
                            <div>
                                <?php if((int)$item["bookmark"] !== 0) {?>
                                    <span class="btn-icons btn-icon-bookmark"></span>
                                <?php }else {
                                        echo $item["id"];
                                } ?>
                            </div>
                            <div>
                                <?php if($item["tab_id"] !== 0) {?>
                                    <span class="list-tab">Tab 1</span>
                                <?php } ?>
                                <?php echo $item["title"] ?>
                            </div>
                            <div>
                                <span class="btn-icons list-icon-title-stamp"></span>
                                익명의 페페
                            </div>
                            <div><?php echo date('Y-m-d', strtotime($item["created_at"])) ?></div>
                            <div><?php echo $item["view"] ?></div>
                        </div>
                        <?php if($item["pcon_id"] !== 0) { ?>
                            <div class="thumb-preview" id="thumb-1"></div>
                        <?php } ?>
                    </a>
                <?php } ?>
            </div>

            <!-- 하단 영역 DIV -->
            <div class="footer">
                <!-- 검색바 영역 DIV -->
                <div class="search-bar">
                    <form action="/index.php" method="GET">
                        <!-- 검색 선택바 셀렉트 DIV -->
                        <select class="btn-sm">
                            <option value="all">전체</option>
                            <option value="title">제목</option>
                            <option value="content">내용</option>
                        </select>

                        <!-- 검색 입력바 영역 INPUT -->
                        <input type="text" class="btn-sm" />

                        <!-- 돋보기 아이콘 버튼 -->
                        <button type="submit" class="btn-icons btn-sm"></button>
                    </form>
                </div>

                <!-- 페이지네이션 영역 -->
                <div class="pagination-bar">
                    <?php if($page !== 1) { ?>
                        <a href="/index.php?page=<?php echo $prev_page_btn_num?>">
                            <button class="btn btn-sm btn-page-bar">&lt;</button>
                        </a>
                    <?php } ?>
                    

                    <?php 
                        if(empty($result)) { ?>
                            <a href="/">
                                <button class="btn btn-sm btn-page-bar page-enable">
                                    1
                                </button>
                            </a>
                <?php   }else {
                            for($i = $start_page_btn_num; $i <= $end_page_btn_num; $i++) { ?>
                                <a href="/index.php?page=<?php echo $i ?>">
                                    <button 
                                        class="btn btn-sm btn-page-bar<?php echo $page === $i ? " page-enable" : "" ?>
                                    ">
                                        <?php echo $i ?>
                                    </button>
                                </a>
                    <?php   }
                        } ?>
                    
                    <?php if($max_page !== 0 && $page !== $max_page) { ?>
                        <a href="/index.php?page=<?php echo $next_page_btn_num ?>">
                            <button class="btn btn-sm btn-page-bar">&gt;</button>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    
    <?php require_once(MY_PATH_FOOTER) ?>
  </body>
</html>

<script src="/js/index.js"></script>