<?php

// 基本設定
function mytheme_setup(){

  // ページのタイトルを出力
  add_theme_support( 'title-tag');

  // HTML5対応
  add_theme_support( 'html5', array( 'style', 'script'));

  // アイキャッチ画像
  add_theme_support( 'post_thumbnails');

  // ナビゲーションメニュー
  register_nav_menus( array(
    'primary' => 'メイン',
  ));

  // 編集画面用のCSS
  add_theme_support( 'editor-styles');
  add_editor_style( 'editor-style.css');

  // グーテンベルク由来のCSS( フロントブロック表示のための[theme.min.css])
  add_theme_support( 'wp-block-styles');

  // 埋め込みコンテンツのレスポンシブ化
  add_theme_support( 'responsive-embeds');

  // 色設定
  add_theme_support( 'editor-color-palette',array(
    array(
      'name' => '青色',
      'slug' => 'blue',
      'color' => '#1b5e92',
    ),
    array(
      'name' => '黄色',
      'slug' => 'yellow',
      'color' => '#f1f40e',
    ),
    array(
      'name' => 'グレー',
      'slug' => 'gray',
      'color' => '#dddddd',
    ),
  ));

  // 文字サイズ設定
  add_theme_support( 'editor-font-sizes',array(
    array(
      'name' => '小',
      'size' => 12.8,
      'slug' => 'small',
    ),
    array(
      'name' => '標準',
      'size' => 16,
      'slug' => 'normal',
    ),
    array(
      'name' => '大',
      'size' => 20,
      'slug' => 'large',
    ),
  ));

  // カスタムカラーをオフ
  add_theme_support( 'disable-custom-colors' );

  // カスタムフォントサイズをオフ
  add_theme_support( 'disable-custom-font-sizes' );

} 
 add_action( 'after_setup_theme','mytheme_setup');

// ウィジェット
function mytheme_widgets(){
  register_sidebar( array(
    'id' => 'sidebar-1',
    'name' => 'サイドメニュー',
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget' => '</section>',
  ));
}
 add_action( 'widgets_init','mytheme_widgets');

// CSS
function mytheme_enqueue(){

  // Font Awesome
  wp_enqueue_style( 'mytheme-fontawesome','https://use.fontawesome.com/releases/v5.12.0/css/all.css',array(),null);

  // Google Fonts
  wp_enqueue_style( 'mytheme_googlefonts','https://fonts.googleapis.com/css?family=Montserrat:400,800&display=swap',array(),null);

  // テーマのCSS
  wp_enqueue_style( 'mytheme-style',get_stylesheet_uri(),array(),
  filemtime( get_template_directory().'/style.css')); 
}
 add_action( 'wp_enqueue_scripts','mytheme_enqueue');

// Font Awesome の属性
function mytheme_sri( $html, $handle ) {
  if( $handle === 'mytheme-fontawesome'){
    return str_replace(
      '/>',
      'integrity="sha384-REHJTs1r2ErKBuJB0fCK99gCYsVjwxHrSU0N7I1zl9vZbggVJXRMsv/sLlOAGb4M" crossorigin="anonymous"'.'/>',
      $html
    );
  }
  return $html;
}
add_filter( 'style_loader_tag','mytheme_sri',10,2);

// グーテンベルク由来のCSS を削除
/*
function remove_css() {

  // style.min.css を削除
  wp_dequeue_style( 'wp-block-library');

  // theme.min.css を削除
  wp_dequeue_style( 'wp-block-library-theme');
}
add_action( 'wp_enqueue_scripts','remove_css');

// グーテンベルク由来のCSS をフロントとエディタの両方から削除する設定 
function remove_both_css() {

  // style.min.css の設定を削除
  wp_deregister_style( 'wp-block-library');
  wp_register_style( 'wp-block-library','');

  // theme.min.css の設定を削除
  wp_deregister_style( 'wp-block-library-theme');
  wp_register_style( 'wp-block-library-theme','');
}
 add_action( 'enqueue_block_assets','remove_both_css');
*/

/* 使用可能なブロック 
function mytheme_block() {

  return array(
    'core/paragraph', // 段落
    'core/image', // 画像
    'core-embed/youtube', // 段落
  );
}
 add_filter( 'allowed_block_types','mytheme_block');
*/

/* 以下の設定をすると、エラーが出る。原因が分からない */
// ブロックテンプレート
/*
function mytheme_temp() {

  // 投稿
  $obj = get_post_type_object('post');
    /* ブロックの操作をロックする場合 
  $obj->template_lock='all';
  */
  /*
  $obj->template = array (

    array(
      'core/heading',
      array(
        'level' => '2',
        'content'=>'基本情報',
      )
      ),

    array(
      'core/paragraph',
      array(
        'placeholder' => 'ここに基本情報を入力 ここに基本情報を入力ここに基本情報を入力ここに基本情報を入力ここに基本情報を入力',
      )
      ),

      array(
        'core/image'
      ),
    );
}
 add_aciton( 'init','mytheme_temp');
*/