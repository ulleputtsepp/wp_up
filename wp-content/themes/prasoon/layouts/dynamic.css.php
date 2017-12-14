<?php
/**
 * Prasoon: Dynamic CSS Stylesheet
 * 
 */

function prasoon_dynamic_css_stylesheet() { 
    $body_font_size= absint(get_theme_mod( 'body_font_size','14' ));
    $body_font_family= esc_attr(get_theme_mod( 'body_font_family' ));

    $heading_font_family= esc_attr(get_theme_mod( 'heading_font_family' )); 
    $h1_font_size= absint(get_theme_mod( 'h1_font_size','38' ));
    $h2_font_size= absint(get_theme_mod( 'h2_font_size','35' ));
    $h3_font_size= absint(get_theme_mod( 'h3_font_size','25' ));
    $h4_font_size= absint(get_theme_mod( 'h4_font_size','18' ));
    $h5_font_size= absint(get_theme_mod( 'h5_font_size','16' ));
    $h6_font_size= absint(get_theme_mod( 'h6_font_size','14' ));

    $link_color= sanitize_hex_color(get_theme_mod( 'link_color' ));
    $link_hover_color= sanitize_hex_color(get_theme_mod( 'link_hover_color' ));

    $trans_buttonhover_bg_color= sanitize_hex_color(get_theme_mod( 'trans_buttonhover_bg_color','#00bc16' ));
    $trans_buttonhover_text_color= sanitize_hex_color(get_theme_mod( 'trans_buttonhover_text_color' ));
    $blog_cat_text_color= sanitize_hex_color(get_theme_mod( 'blog_cat_text_color' ));
    $cf7_btn_bg_color= sanitize_hex_color(get_theme_mod( 'cf7_btn_bg_color','#00bc16' ));
    $cf7_btn_txt_color= sanitize_hex_color(get_theme_mod( 'cf7_btn_txt_color','#ffffff' ));
    $si_bg_color= sanitize_hex_color(get_theme_mod( 'si_bg_color' ));
    $si_hover_bg_color= sanitize_hex_color(get_theme_mod( 'si_hover_bg_color' ));
    $si_hover_color= sanitize_hex_color(get_theme_mod( 'si_hover_color' ));
    $footer_bg_color= sanitize_hex_color(get_theme_mod( 'footer_bg_color' ));
    $footer_txt_color= sanitize_hex_color(get_theme_mod( 'footer_txt_color' ));
    $blog_post_title_text_color= sanitize_hex_color(get_theme_mod( 'blog_post_title_text_color' ));
    $dd_menu_bg_hover_color= sanitize_hex_color(get_theme_mod( 'dd_menu_bg_hover_color','#00bc16' ));

    $preloader_image=esc_url(get_theme_mod( 'preloader_image' ));    
    $theme_logo=esc_url(get_theme_mod( 'theme_logo' ));    


    $css = '

        html, body {        
            font-size: ' . $body_font_size . 'px !important;
            font-family: ' . $body_font_family . ' !important;
        }

        h1,h2,h3,h4,h5,h6{
            font-family: ' . $heading_font_family . ' !important;
        }

        h1{
            font-size: ' . $h1_font_size . 'px !important;
            font-weight:900;
        }

        h2{
            font-size: ' . $h2_font_size . 'px !important;
            font-weight:900;
        }

        h3{
            font-size: ' . $h3_font_size . 'px !important;
        }

        h4{
            font-size: ' . $h4_font_size . 'px !important;
        }

        h5{
            font-size: ' . $h5_font_size . 'px !important;
        }

        h6{
            font-size: ' . $h6_font_size . 'px !important;
        }

        a{
           color: ' . $link_color . ' !important;
        }

        a:hover{
           color: ' . $link_hover_color . ' !important;
        }        

        #content-page .scroll-fix a#brand {
            background-image: url("' . $theme_logo . '");
            background-size: contain;
            background-repeat: no-repeat;
            width:100px;
            margin-left: 7px;
            position: absolute;
            top: 22px;
        }

        button.trans:hover, 
        button.trans:focus, 
        button.trans:active{
            background: ' . $trans_buttonhover_bg_color . ' !important;
            color: ' . $trans_buttonhover_text_color . ' !important;
        }

        #blog ul.post-categories li a{
            color: ' . $blog_cat_text_color . ' !important;
        }

        #contact form input[type="submit"]{    
            background: ' . $cf7_btn_bg_color . ';
            color: ' . $cf7_btn_txt_color . ';
        }

        #contact .social-icons i{
            border: 1px solid ' . $si_bg_color . ' !important;
        }

        #contact .social-icons .s-icon a{
            color: ' . $si_bg_color . ' !important;
        }

        #contact .social-icons i:hover{
            background: ' . $si_hover_bg_color . ' !important;
            border: 1px solid ' . $si_hover_bg_color . ' !important;
            color: ' . $si_hover_color . ' !important; 
        }

        .footer{
            background: ' . $footer_bg_color . ';
        }

        .footer p{
            color: ' . $footer_txt_color . ';
        }

        #portfolio .isotope #filter li a{
            color: #555 !important;
        }

        #portfolio .isotope #filter li.selected a, 
        #portfolio .isotope #filter li a:hover{
            color: ' . $link_hover_color . ' !important;   
        }

        .dropdown-menu > .active > a, 
        .dropdown-menu > .active > a:hover, 
        .dropdown-menu > .active > a:focus{
            background: ' . $link_color . ' !important; 
        }

        .dropdown-menu > li > a:hover, 
        .dropdown-menu > li > a:focus{
            background: ' . $dd_menu_bg_hover_color . ' !important; 
        }

        aside .widget li a:hover{
            color: ' . $link_hover_color . ' !important;   
        }

        #comments input[type="submit"]{
            background: ' . $link_color . ' !important; 
            border: 1px solid ' . $link_color . ' !important; 
        }

        .carousel-control, 
        .carousel-control:hover{
            color: #fff !important;
        }


    ';

if(!empty($preloader_image)) {
    $css .='        
        #pre-loader{
            background: url("' . $preloader_image . '") no-repeat !important;
        }
    ';  
}

if(!empty($blog_post_title_text_color)) {
    $css .='        
        #blog .heading h2 a{
            color: ' . $blog_post_title_text_color . ' !important; 
        }
           
        #blog .heading h4 a{
            color: ' . $blog_post_title_text_color . ' !important; 
        }        
    ';  
}

if(!empty($trans_buttonhover_bg_color)) {
    $css .='        
        button.trans:hover, 
        button.trans:focus, 
        button.trans:active{ 
            border: 1px solid ' . $trans_buttonhover_bg_color . ' !important;
        }
    ';  
}

if('no'=== esc_attr(get_theme_mod( 'pr_sticky_menu' ))) {
    $css .='        
        .scroll-fix{ 
            display:none !important;
        }           
    ';  
}

return apply_filters( 'prasoon_dynamic_css_stylesheet', $css);

}


?>