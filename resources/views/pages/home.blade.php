  @extends('templates.master' , ['pageId' => 'home'])
  @section('content')

  <div class="banner">
      <div class="container">
          <div class="intro-banner">
              <!-- Swiper -->
              <div class="swiper-container s1">
                  <div class="swiper-wrapper">
                      <div class="swiper-slide">
                          <a href=""><img src="{{asset('public/frontend/images/MainPage/Intro-Banner/Intro-Banner_1.png')}}" alt="" /></a>
                      </div>
                      <div class="swiper-slide">
                          <a href=""><img src="{{asset('public/frontend/images/MainPage/Intro-Banner/Intro-Banner_2.png')}}" alt="" /></a>
                      </div>
                      <div class="swiper-slide">
                          <a href=""><img src="{{asset('public/frontend/images/MainPage/Intro-Banner/Intro-Banner_1.png')}}" alt="" /></a>
                      </div>
                      <div class="swiper-slide">
                          <a href=""><img src="{{asset('public/frontend/images/MainPage/Intro-Banner/Intro-Banner_2.png')}}" alt="" /></a>
                      </div>
                      <div class="swiper-slide">
                          <a href=""><img src="{{asset('public/frontend/images/MainPage/Intro-Banner/Intro-Banner_1.png')}}" alt="" /></a>
                      </div>
                      <div class="swiper-slide">
                          <a href=""><img src="{{asset('public/frontend/images/MainPage/Intro-Banner/Intro-Banner_2.png')}}" alt="" /></a>
                      </div>
                  </div>
                  <!-- Add Pagination -->
                  <div class="swiper-pagination"></div>
                  <!-- Add Arrows -->
                  <div class="swiper-button-next"></div>
                  <div class="swiper-button-prev"></div>
              </div>
          </div>
          <div class="advertising-banner"></div>
      </div>
  </div>
  <div class="main-layout flash-sale-layout">
      <div class="container">
          <div class="shortcut">
              <div class="flash-sale-icon active-shortcut">
                  <a href="">
                      <img src="{{asset('public/frontend/images/MainPage/Main-Layout/Icon-Shortcut/ico-flashsale.png')}}" alt="Biểu Tượng Flash Sale" />
                  </a>
                  <p style="margin-left: 10px">Flash Sale</p>
              </div>
              <div class="old-bookshelf-icon">
                  <a href="">
                      <img src="{{asset('public/frontend/images/MainPage/Main-Layout/Icon-Shortcut/ico-old-bookshelf.png')}}" alt="Biểu Tượng Kệ Sách Cũ" />
                  </a>
                  <p>Kệ Sách Cũ</p>
              </div>
              <div class="hot-deal-icon">
                  <a href="">
                      <img src="{{asset('public/frontend/images/MainPage/Main-Layout/Icon-Shortcut/ico-dealhot.png')}}" alt="Biểu Tượng Hot Deal" />
                  </a>
                  <p>Hot Deal</p>
              </div>
              <div class="suggest-icon">
                  <a href="">
                      <img src="{{asset('public/frontend/images/MainPage/Main-Layout/Icon-Shortcut/ico-goiy.png')}}" alt="Biểu Tượng Gợi Ý" />
                  </a>
                  <p>Gợi Ý Cho Bạn</p>
              </div>
              <div class="discount-code-icon">
                  <a href="">
                      <img src="{{asset('public/frontend/images/MainPage/Main-Layout/Icon-Shortcut/ico-mgg.png')}}" alt="Biểu Tượng Mã Giảm Giá" />
                  </a>
                  <p>Mã Giảm Giá</p>
              </div>
              <div class="new-book-icon">
                  <a href="">
                      <img src="{{asset('public/frontend/images/MainPage/Main-Layout/Icon-Shortcut/ico-flashsale.png')}}" alt="Biểu Tượng Sách Mới" />
                  </a>
                  <p>Sách Mới</p>
              </div>
              <div class="book-rankings-icon">
                  <a href="">
                      <img src="{{asset('public/frontend/images/MainPage/Main-Layout/Icon-Shortcut/ico_dochoi.png')}}" alt="Biểu Tượng Đồ Chơi" />
                  </a>
                  <p>Đồ Chơi</p>
              </div>
              <div class="office-supplies-icon">
                  <a href="">
                      <img src="{{asset('public/frontend/images/MainPage/Main-Layout/Icon-Shortcut/ico-vpp-hot.png')}}" alt="Biểu Tượng Văn Phòng Phẩm" />
                  </a>
                  <p>Văn Phòng Phẩm</p>
              </div>
          </div>
          <div class="flash-sale-layout product-layout">
              <div class="tittle">
                  <a href="">Flash Sale | </a>
                  <div class="status">Kết Thúc Trong</div>
                  <div class="count-down">
                      <!-- <div id="days"></div> -->
                      <div id="hours"></div>
                      <span> : </span>
                      <div id="minutes"></div>
                      <span> : </span>
                      <div id="seconds"></div>
                  </div>
              </div>
              <div id="flash-sale-main">
                  <div id="flash-sale-slider" class="product-slider">
                      <div class="MS-content">
                          <div class="item">
                              <div class="product-container">
                                  <div class="new-label-pro-sale">
                                      <span>20%</span>
                                  </div>
                                  <div class="product-content">
                                      <div class="images-container">
                                          <a href="#">
                                              <div class="product-images">
                                                  <img src="{{asset('public/frontend/images/Product/Product-Partern.jpg')}}" alt="" />
                                              </div>
                                          </a>
                                      </div>
                                      <div class="product-name">
                                          <a href="">Ten San Phamaaaaaaaaaa aaaaaaaaaaaaa ss ss s
                                              aaaaaa</a>
                                      </div>
                                      <div class="product-price">
                                          <div class="product-price-special">50.000d</div>
                                          <div class="product-price-old">100.000d</div>
                                      </div>
                                      <div class="progress">
                                          <span class="progress-value">da ban 44</span>
                                          <div class="progress-bar"></div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="MS-controls">
                          <button class="MS-left">
                              <i class="fa fa-chevron-left" aria-hidden="true"></i>
                          </button>
                          <button class="MS-right">
                              <i class="fa fa-chevron-right" aria-hidden="true"></i>
                          </button>
                      </div>
                  </div>
              </div>

              <button class="btn-show-menu btn-flash-sale">Xem Tất Cả</button>
          </div>
      </div>
  </div>
  <div class="main-layout old-bookshelf-layout">
      <div class="container">
          <div class="shortcut">
              <div class="flash-sale-icon">
                  <a href="">
                      <img src="{{asset('public/frontend/images/MainPage/Main-Layout/Icon-Shortcut/ico-flashsale.png')}}" alt="Biểu Tượng Flash Sale" />
                  </a>
                  <p>Flash Sale</p>
              </div>
              <div class="old-bookshelf-icon active-shortcut">
                  <a href="">
                      <img src="{{asset('public/frontend/images/MainPage/Main-Layout/Icon-Shortcut/ico-old-bookshelf.png')}}" alt="Biểu Tượng Kệ Sách Cũ" />
                  </a>
                  <p style="margin-left: 15px">Kệ Sách Cũ</p>
              </div>
              <div class="hot-deal-icon">
                  <a href="">
                      <img src="{{asset('public/frontend/images/MainPage/Main-Layout/Icon-Shortcut/ico-dealhot.png')}}" alt="Biểu Tượng Hot Deal" />
                  </a>
                  <p>Hot Deal</p>
              </div>
              <div class="suggest-icon">
                  <a href="">
                      <img src="{{asset('public/frontend/images/MainPage/Main-Layout/Icon-Shortcut/ico-goiy.png')}}" alt="Biểu Tượng Gợi Ý" />
                  </a>
                  <p>Gợi Ý Cho Bạn</p>
              </div>
              <div class="discount-code-icon">
                  <a href="">
                      <img src="{{asset('public/frontend/images/MainPage/Main-Layout/Icon-Shortcut/ico-mgg.png')}}" alt="Biểu Tượng Mã Giảm Giá" />
                  </a>
                  <p>Mã Giảm Giá</p>
              </div>
              <div class="new-book-icon">
                  <a href="">
                      <img src="{{asset('public/frontend/images/MainPage/Main-Layout/Icon-Shortcut/ico-flashsale.png')}}" alt="Biểu Tượng Sách Mới" />
                  </a>
                  <p>Sách Mới</p>
              </div>
              <div class="book-rankings-icon">
                  <a href="">
                      <img src="{{asset('public/frontend/images/MainPage/Main-Layout/Icon-Shortcut/ico_dochoi.png')}}" alt="Biểu Tượng Đồ Chơi" />
                  </a>
                  <p>Đồ Chơi</p>
              </div>
              <div class="office-supplies-icon">
                  <a href="">
                      <img src="{{asset('public/frontend/images/MainPage/Main-Layout/Icon-Shortcut/ico-vpp-hot.png')}}" alt="Biểu Tượng Văn Phòng Phẩm" />
                  </a>
                  <p>Văn Phòng Phẩm</p>
              </div>
          </div>
          <div class="old-bookshelf-layout product-layout">
              <div class="tittle">
                  <a href="">Kệ Sách Cũ</a>
              </div>
              <div id="old-bookshelf-main">
                  <div id="old-bookshelf-slider" class="product-slider">
                      <div class="MS-content">
                          <div class="item">
                              <div class="product-container">
                                  <div class="new-label-pro-sale">
                                      <span>20%</span>
                                  </div>
                                  <div class="product-content">
                                      <div class="images-container">
                                          <a href="#">
                                              <div class="product-images">
                                                  <img src="{{asset('public/frontend/images/Product/Product-Partern.jpg')}}" alt="" />
                                              </div>
                                          </a>
                                      </div>
                                      <div class="product-name">
                                          <a href="">Ten San Phamaaaaaaaaaa aaaaaaaaaaaaa ss ss s
                                              aaaaaa</a>
                                      </div>
                                      <div class="product-price">
                                          <div class="product-price-special">50.000d</div>
                                          <div class="product-price-old">100.000d</div>
                                      </div>
                                      <div class="progress">
                                          <span class="progress-value">da ban 44</span>
                                          <div class="progress-bar"></div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="MS-controls">
                          <button class="MS-left">
                              <i class="fa fa-chevron-left" aria-hidden="true"></i>
                          </button>
                          <button class="MS-right">
                              <i class="fa fa-chevron-right" aria-hidden="true"></i>
                          </button>
                      </div>
                  </div>
              </div>

              <button class="btn-show-menu btn-old-bookshelf">Xem Tất Cả</button>
          </div>
      </div>
  </div>
  <div class="main-layout hot-sale-layout">
      <div class="container">
          <div class="shortcut">
              <div class="flash-sale-icon">
                  <a href="">
                      <img src="{{asset('public/frontend/images/MainPage/Main-Layout/Icon-Shortcut/ico-flashsale.png')}}" alt="Biểu Tượng Flash Sale" />
                  </a>
                  <p>Flash Sale</p>
              </div>
              <div class="old-bookshelf-icon">
                  <a href="">
                      <img src="{{asset('public/frontend/images/MainPage/Main-Layout/Icon-Shortcut/ico-old-bookshelf.png')}}" alt="Biểu Tượng Kệ Sách Cũ" />
                  </a>
                  <p style="margin-left: 15px">Kệ Sách Cũ</p>
              </div>
              <div class="hot-deal-icon active-shortcut">
                  <a href="">
                      <img src="{{asset('public/frontend/images/MainPage/Main-Layout/Icon-Shortcut/ico-dealhot.png')}}" alt="Biểu Tượng Hot Deal" />
                  </a>
                  <p>Hot Deal</p>
              </div>
              <div class="suggest-icon">
                  <a href="">
                      <img src="{{asset('public/frontend/images/MainPage/Main-Layout/Icon-Shortcut/ico-goiy.png')}}" alt="Biểu Tượng Gợi Ý" />
                  </a>
                  <p>Gợi Ý Cho Bạn</p>
              </div>
              <div class="discount-code-icon">
                  <a href="">
                      <img src="{{asset('public/frontend/images/MainPage/Main-Layout/Icon-Shortcut/ico-mgg.png')}}" alt="Biểu Tượng Mã Giảm Giá" />
                  </a>
                  <p>Mã Giảm Giá</p>
              </div>
              <div class="new-book-icon">
                  <a href="">
                      <img src="{{asset('public/frontend/images/MainPage/Main-Layout/Icon-Shortcut/ico-flashsale.png')}}" alt="Biểu Tượng Sách Mới" />
                  </a>
                  <p>Sách Mới</p>
              </div>
              <div class="book-rankings-icon">
                  <a href="">
                      <img src="{{asset('public/frontend/images/MainPage/Main-Layout/Icon-Shortcut/ico_dochoi.png')}}" alt="Biểu Tượng Đồ Chơi" />
                  </a>
                  <p>Đồ Chơi</p>
              </div>
              <div class="office-supplies-icon">
                  <a href="">
                      <img src="{{asset('public/frontend/images/MainPage/Main-Layout/Icon-Shortcut/ico-vpp-hot.png')}}" alt="Biểu Tượng Văn Phòng Phẩm" />
                  </a>
                  <p>Văn Phòng Phẩm</p>
              </div>
          </div>
          <div class="hot-sale-layout product-layout">
              <div class="tittle">
                  <a href="">Hot Deals</a>
              </div>
              <div class="hot-sale-tab tab-layout">
                  <button class="tab-layout-active" data-tab="tab1">
                      Deal Hot theo ngày
                  </button>
                  <button data-tab="tab2">Sách Hot</button>
                  <button data-tab="tab3">Sách Ngoại Văn</button>
              </div>
              <div id="tab1" class="tab hot-sale-item">
                  <div id="hot-sale-main">
                      <div id="hot-sale-slider" class="product-slider">
                          <div class="MS-content">
                              <div class="item">
                                  <div class="product-container">
                                      <div class="new-label-pro-sale">
                                          <span>20%</span>
                                      </div>
                                      <div class="product-content">
                                          <div class="images-container">
                                              <a href="#">
                                                  <div class="product-images">
                                                      <img src="{{asset('public/frontend/images/Product/Product-Partern.jpg')}}" alt="" />
                                                  </div>
                                              </a>
                                          </div>
                                          <div class="product-name">
                                              <a href="">Ten San Phamaaaaaaaaaa aaaaaaaaaaaaa ss ss s
                                                  aaaaaa</a>
                                          </div>
                                          <div class="product-price">
                                              <div class="product-price-special">50.000d</div>
                                              <div class="product-price-old">100.000d</div>
                                          </div>
                                          <div class="progress">
                                              <span class="progress-value">da ban 44</span>
                                              <div class="progress-bar"></div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="MS-controls">
                              <button class="MS-left">
                                  <i class="fa fa-chevron-left" aria-hidden="true"></i>
                              </button>
                              <button class="MS-right">
                                  <i class="fa fa-chevron-right" aria-hidden="true"></i>
                              </button>
                          </div>
                      </div>
                  </div>
              </div>
              <div id="tab2" class="tab hot-sale-item" style="display: none">
                  <div id="hot-sale-main">
                      <div id="hot-sale-slider" class="product-slider">
                          <div class="MS-content">
                              <div class="item">
                                  <div class="product-container">
                                      <div class="new-label-pro-sale">
                                          <span>20%</span>
                                      </div>
                                      <div class="product-content">
                                          <div class="images-container">
                                              <a href="#">
                                                  <div class="product-images">
                                                      <img src="{{asset('public/frontend/images/Product/Product-Partern.jpg')}}" alt="" />
                                                  </div>
                                              </a>
                                          </div>
                                          <div class="product-name">
                                              <a href="">Ten San Phamaaaaaaaaaa aaaaaaaaaaaaa ss ss s
                                                  aaaaaa</a>
                                          </div>
                                          <div class="product-price">
                                              <div class="product-price-special">50.000d</div>
                                              <div class="product-price-old">100.000d</div>
                                          </div>
                                          <div class="progress">
                                              <span class="progress-value">da ban 44</span>
                                              <div class="progress-bar"></div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="item">
                                  <div class="product-container">
                                      <div class="new-label-pro-sale">
                                          <span>20%</span>
                                      </div>
                                      <div class="product-content">
                                          <div class="images-container">
                                              <a href="#">
                                                  <div class="product-images">
                                                      <img src="{{asset('public/frontend/images/Product/Product-Partern.jpg')}}" alt="" />
                                                  </div>
                                              </a>
                                          </div>
                                          <div class="product-name">
                                              <a href="">Ten San Phamaaaaaaaaaa aaaaaaaaaaaaa ss ss s
                                                  aaaaaa</a>
                                          </div>
                                          <div class="product-price">
                                              <div class="product-price-special">50.000d</div>
                                              <div class="product-price-old">100.000d</div>
                                          </div>
                                          <div class="progress">
                                              <span class="progress-value">da ban 44</span>
                                              <div class="progress-bar"></div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="MS-controls">
                              <button class="MS-left">
                                  <i class="fa fa-chevron-left" aria-hidden="true"></i>
                              </button>
                              <button class="MS-right">
                                  <i class="fa fa-chevron-right" aria-hidden="true"></i>
                              </button>
                          </div>
                      </div>
                  </div>
              </div>
              <div id="tab3" class="tab hot-sale-item" style="display: none">
                  <div id="hot-sale-main">
                      <div id="hot-sale-slider" class="product-slider">
                          <div class="MS-content">
                              <div class="item">
                                  <div class="product-container">
                                      <div class="new-label-pro-sale">
                                          <span>20%</span>
                                      </div>
                                      <div class="product-content">
                                          <div class="images-container">
                                              <a href="#">
                                                  <div class="product-images">
                                                      <img src="{{asset('public/frontend/images/Product/Product-Partern.jpg')}}" alt="" />
                                                  </div>
                                              </a>
                                          </div>
                                          <div class="product-name">
                                              <a href="">Ten San Phamaaaaaaaaaa aaaaaaaaaaaaa ss ss s
                                                  aaaaaa</a>
                                          </div>
                                          <div class="product-price">
                                              <div class="product-price-special">50.000d</div>
                                              <div class="product-price-old">100.000d</div>
                                          </div>
                                          <div class="progress">
                                              <span class="progress-value">da ban 44</span>
                                              <div class="progress-bar"></div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="MS-controls">
                              <button class="MS-left">
                                  <i class="fa fa-chevron-left" aria-hidden="true"></i>
                              </button>
                              <button class="MS-right">
                                  <i class="fa fa-chevron-right" aria-hidden="true"></i>
                              </button>
                          </div>
                      </div>
                  </div>
              </div>
              <button class="btn-show-menu btn-hot-sale">Xem Tất Cả</button>
          </div>
      </div>
  </div>
  <div class="main-layout suggest-layout">
      <div class="container">
          <div class="shortcut">
              <div class="flash-sale-icon">
                  <a href="">
                      <img src="{{asset('public/frontend/images/MainPage/Main-Layout/Icon-Shortcut/ico-flashsale.png')}}" alt="Biểu Tượng Flash Sale" />
                  </a>
                  <p>Flash Sale</p>
              </div>
              <div class="old-bookshelf-icon">
                  <a href="">
                      <img src="{{asset('public/frontend/images/MainPage/Main-Layout/Icon-Shortcut/ico-old-bookshelf.png')}}" alt="Biểu Tượng Kệ Sách Cũ" />
                  </a>
                  <p style="margin-left: 15px">Kệ Sách Cũ</p>
              </div>
              <div class="hot-deal-icon">
                  <a href="">
                      <img src="{{asset('public/frontend/images/MainPage/Main-Layout/Icon-Shortcut/ico-dealhot.png')}}" alt="Biểu Tượng Hot Deal" />
                  </a>
                  <p>Hot Deal</p>
              </div>
              <div class="suggest-icon active-shortcut">
                  <a href="">
                      <img src="{{asset('public/frontend/images/MainPage/Main-Layout/Icon-Shortcut/ico-goiy.png')}}" alt="Biểu Tượng Gợi Ý" />
                  </a>
                  <p>Gợi Ý Cho Bạn</p>
              </div>
              <div class="discount-code-icon">
                  <a href="">
                      <img src="{{asset('public/frontend/images/MainPage/Main-Layout/Icon-Shortcut/ico-mgg.png')}}" alt="Biểu Tượng Mã Giảm Giá" />
                  </a>
                  <p>Mã Giảm Giá</p>
              </div>
              <div class="new-book-icon">
                  <a href="">
                      <img src="{{asset('public/frontend/images/MainPage/Main-Layout/Icon-Shortcut/ico-flashsale.png')}}" alt="Biểu Tượng Sách Mới" />
                  </a>
                  <p>Sách Mới</p>
              </div>
              <div class="book-rankings-icon">
                  <a href="">
                      <img src="{{asset('public/frontend/images/MainPage/Main-Layout/Icon-Shortcut/ico_dochoi.png')}}" alt="Biểu Tượng Đồ Chơi" />
                  </a>
                  <p>Đồ Chơi</p>
              </div>
              <div class="office-supplies-icon">
                  <a href="">
                      <img src="{{asset('public/frontend/images/MainPage/Main-Layout/Icon-Shortcut/ico-vpp-hot.png')}}" alt="Biểu Tượng Văn Phòng Phẩm" />
                  </a>
                  <p>Văn Phòng Phẩm</p>
              </div>
          </div>
          <div class="suggest-layout product-layout">
              <div class="tittle">
                  <a href="">Gợi Ý Cho Bạn</a>
              </div>
              <div class="suggest-tab tab-layout">
                  <button class="tab-layout-active" data-tab="tab4">Tất Cả</button>
                  <button data-tab="tab5">Văn Học</button>
                  <button data-tab="tab6">Manga - Light Novel</button>
                  <button data-tab="tab7">Công Nghệ - Lập Trình</button>
                  <button data-tab="tab8">Tâm Lý - Kỹ Năng Sống</button>
              </div>
              <div id="tab4" class="tab suggest-item">
                  <div class="suggest-main">
                      <div class="item">
                          <div class="product-container">
                              <div class="new-label-pro-sale">
                                  <span>20%</span>
                              </div>
                              <div class="product-content">
                                  <div class="images-container">
                                      <a href="#">
                                          <div class="product-images">
                                              <img src="{{asset('public/frontend/images/Product/Product-Partern.jpg')}}" alt="" />
                                          </div>
                                      </a>
                                  </div>
                                  <div class="product-name">
                                      <a href="">Ten San Phamaaaaaaaaaa aaaaaaaaaaaaa ss ss s
                                          aaaaaa</a>
                                  </div>
                                  <div class="product-price">
                                      <div class="product-price-special">50.000d</div>
                                      <!-- <div class="product-price-old">100.000d</div> -->
                                  </div>
                                  <!-- <div class="progress">
                        <span class="progress-value">da ban 44</span>
                        <div class="progress-bar"></div>
                      </div> -->
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div id="tab5" class="tab suggest-item" style="display: none">
                  <div class="suggest-main">
                      <div class="item">
                          <div class="product-container">
                              <div class="new-label-pro-sale">
                                  <span>20%</span>
                              </div>
                              <div class="product-content">
                                  <div class="images-container">
                                      <a href="#">
                                          <div class="product-images">
                                              <img src="{{asset('public/frontend/images/Product/Product-Partern.jpg')}}" alt="" />
                                          </div>
                                      </a>
                                  </div>
                                  <div class="product-name">
                                      <a href="">Ten San Phamaaaaaaaaaa aaaaaaaaaaaaa ss ss s
                                          aaaaaa</a>
                                  </div>
                                  <div class="product-price">
                                      <div class="product-price-special">50.000d</div>
                                      <!-- <div class="product-price-old">100.000d</div> -->
                                  </div>
                                  <!-- <div class="progress">
                        <span class="progress-value">da ban 44</span>
                        <div class="progress-bar"></div>
                      </div> -->
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div id="tab6" class="tab suggest-item" style="display: none">
                  <div class="suggest-main">
                      <div class="item">
                          <div class="product-container">
                              <div class="new-label-pro-sale">
                                  <span>20%</span>
                              </div>
                              <div class="product-content">
                                  <div class="images-container">
                                      <a href="#">
                                          <div class="product-images">
                                              <img src="{{asset('public/frontend/images/Product/Product-Partern.jpg')}}" alt="" />
                                          </div>
                                      </a>
                                  </div>
                                  <div class="product-name">
                                      <a href="">Ten San Phamaaaaaaaaaa aaaaaaaaaaaaa ss ss s
                                          aaaaaa</a>
                                  </div>
                                  <div class="product-price">
                                      <div class="product-price-special">50.000d</div>
                                      <!-- <div class="product-price-old">100.000d</div> -->
                                  </div>
                                  <!-- <div class="progress">
                        <span class="progress-value">da ban 44</span>
                        <div class="progress-bar"></div>
                      </div> -->
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div id="tab7" class="tab suggest-item" style="display: none">
                  <div class="suggest-main">
                      <div class="item">
                          <div class="product-container">
                              <div class="new-label-pro-sale">
                                  <span>20%</span>
                              </div>
                              <div class="product-content">
                                  <div class="images-container">
                                      <a href="#">
                                          <div class="product-images">
                                              <img src="{{asset('public/frontend/images/Product/Product-Partern.jpg')}}" alt="" />
                                          </div>
                                      </a>
                                  </div>
                                  <div class="product-name">
                                      <a href="">Ten San Phamaaaaaaaaaa aaaaaaaaaaaaa ss ss s
                                          aaaaaa</a>
                                  </div>
                                  <div class="product-price">
                                      <div class="product-price-special">50.000d</div>
                                      <!-- <div class="product-price-old">100.000d</div> -->
                                  </div>
                                  <!-- <div class="progress">
                        <span class="progress-value">da ban 44</span>
                        <div class="progress-bar"></div>
                      </div> -->
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div id="tab8" class="tab suggest-item" style="display: none">
                  <div class="suggest-main">
                      <div class="item">
                          <div class="product-container">
                              <div class="new-label-pro-sale">
                                  <span>20%</span>
                              </div>
                              <div class="product-content">
                                  <div class="images-container">
                                      <a href="#">
                                          <div class="product-images">
                                              <img src="{{asset('public/frontend/images/Product/Product-Partern.jpg')}}" alt="" />
                                          </div>
                                      </a>
                                  </div>
                                  <div class="product-name">
                                      <a href="">Ten San Phamaaaaaaaaaa aaaaaaaaaaaaa ss ss s
                                          aaaaaa</a>
                                  </div>
                                  <div class="product-price">
                                      <div class="product-price-special">50.000d</div>
                                      <!-- <div class="product-price-old">100.000d</div> -->
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <button class="btn-show-menu btn-suggest">Xem Tất Cả</button>
          </div>
      </div>
  </div>
  @endsection