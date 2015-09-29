<?php
    define('WP_USE_THEMES', false);
    require('blog/wp-blog-header.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <title> <?php bloginfo('name'); ?> </title>
        <meta charset="utf-8" />
        <meta name="robots" content="index, nofollow" />
        <meta name="description" content="<?php bloginfo('description'); ?>" />
        <link rel="stylesheet" type="text/css" href="css/main.css" />
        <script src="js/main.js"></script>
    </head>
    <body>
        <div id="main">
            <!-- header part -->
            <header id="header">
               <?php 
                    $the_post = get_post($id = 1);
                    $content = $the_post->post_content;
                    $content_text = preg_replace('/\[gallery ids="10,17,18,19"\]/', '', $content);
                    $content_media = get_post_gallery_images($post = 1);
                ?>
                <img src="<?php echo "$content_media[0]"; ?>" alt="Notify picture"/>
                <p> <?php echo "$content_text"; ?> </p>
                <ul>
                    <li> 
                        <a href="#" class="headerselect alert">
                            <div class="round">
                                <img src="<?php echo "$content_media[1]"; ?>" alt="Apple picture"/>
                            </div>
                        </a>    
                    </li>
                    <li>
                        <a href="#" class="headerselect alert">
                            <div class="round">
                                <img src="<?php echo "$content_media[2]"; ?>" alt="Android picture"/>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="headerselect alert">
                            <div class="round">
                                <img src="<?php echo "$content_media[3]"; ?>" alt="Windows picture"/>
                            </div>
                        </a>
                    </li>
                </ul>
            </header>
            <!-- features part -->
            <section id="features">
                <div class="container">
                   <?php
                        $the_post = get_post($id = 21);
                        $content = $the_post->post_content;
                        $content_media = get_post_gallery_images($post = 21);
                        $content_header = preg_replace(
                            $regexp = array("/<p ?.*>(.*)<\/p>/", '/\[gallery ids="28"\]/'),
                            $replace = array("",""),
                            $content);
                        $content_text = preg_replace(
                            $regexp = array("/<h3 ?.*>(.*)<\/h3>/", '/\[gallery ids="28"\]/'),
                            $replace = array("",""),
                            $content);
                    ?>
                    <a href="#" class="alert">
                        <div class="fround">
                            <img src="<?php echo "$content_media[0]"; ?>" alt="Enable theme picture"/>
                        </div>
                    </a>
                    <h3> <?php echo "$content_header"; ?> </h3>
                    <p> <?php echo "$content_text"; ?> </p>
                </div>
                <div class="container">
                   <?php
                        $the_post = get_post($id = 34);
                        $content = $the_post->post_content;
                        $content_media = get_post_gallery_images($post = 34);
                        $content_header = preg_replace(
                            $regexp = array("/<p ?.*>(.*)<\/p>/", '/\[gallery ids="35"\]/'),
                            $replace = array("",""),
                            $content);
                        $content_text = preg_replace(
                            $regexp = array("/<h3 ?.*>(.*)<\/h3>/", '/\[gallery ids="35"\]/'),
                            $replace = array("",""),
                            $content);
                    ?>
                    <a href="#" class="alert">
                        <div class="fround">
                            <img src="<?php echo "$content_media[0]"; ?>" alt="Flat design picture"/>
                        </div>
                    </a>
                    <h3> <?php echo "$content_header"; ?> </h3>
                    <p> <?php echo "$content_text"; ?> </p>
                </div>
                <div class="container">
                   <?php
                        $the_post = get_post($id = 39);
                        $content = $the_post->post_content;
                        $content_media = get_post_gallery_images($post = 39);
                        $content_header = preg_replace(
                            $regexp = array("/<p ?.*>(.*)<\/p>/", '/\[gallery ids="40"\]/'),
                            $replace = array("",""),
                            $content);
                        $content_text = preg_replace(
                            $regexp = array("/<h3 ?.*>(.*)<\/h3>/", '/\[gallery ids="40"\]/'),
                            $replace = array("",""),
                            $content);
                    ?>
                    <a href="#" class="alert">
                        <div class="fround">
                            <img src="<?php echo "$content_media[0]"; ?>" alt="Reach Your audience picture"/>
                        </div>
                    </a>
                    <h3> <?php echo "$content_header"; ?> </h3>
                    <p> <?php echo "$content_text"; ?> </p>
                </div>
            </section>
            <!-- Get notified part -->
            <section id="getnotified">
               <?php
                        $the_post = get_post($id = 42);
                        $content = $the_post->post_content;
                        $content_media = get_attached_media("video/mp4", $post = 42);
                        $video_url = wp_get_attachment_url(47);
                        $content_header = preg_replace(
                            $regexp = array("/<p ?.*>(.*)<\/p>/", '/\[playlist type="video" ids="47"\]/'),
                            $replace = array("",""),
                            $content);
                        $content_text = preg_replace(
                            $regexp = array("/<h3 ?.*>(.*)<\/h3>/", '/\[playlist type="video" ids="47"\]/'),
                            $replace = array("",""),
                            $content);
                    ?>
                <div id="gettext">
                    <h3> <?php echo "$content_header"; ?> </h3>
                    <p> <?php echo $content_media[0]; ?> </p>
                    <form action="#" name="emailform" >
                        <input type="email" placeholder="Email Address" name="email" id="email" />
                        <input type="submit" value="Notify" id="notify" name="notify" class="alert"/>
                    </form>
                </div>
                <div id="getfilm">
                    <video controls="controls" width="315">
                        <source src="<?php echo $video_url; ?>" type="video/mp4" />
                    </video>
                </div>
            </section>
            <!-- testimonials part -->
            <section id="testimonials">
               <?php 
                    $the_post = get_post($id = 50);
                    $content = $the_post->post_content;
                    $content_text = preg_replace("/<.*?>/","",$content);
                ?>
                <p> <em> &quot; <?php echo $content_text; ?> &quot; </em> </p>
                <p id="personname"> &nbsp; </p>
                <ul id="personrow">
                </ul>
            </section>
            <!-- get in touch part -->
            <section id="getintouch">
               <?php 
                    $the_post = get_post($id = 57);
                    $content = $the_post->post_content;
                    $content_header = preg_replace(
                        $regexp = array("/<p ?.*>(.*)<\/p>/", '/\[gallery ids="62,63,65,66,67,68"\]/', "/<.*?>/"),
                        $replace = array("", "", ""),
                        $content);
                    $content_text = preg_replace(
                        $regexp = array("/<h3 ?.*>(.*)<\/h3>/", '/\[gallery ids="62,63,65,66,67,68"\]/', "/<.*?>/"),
                        $replace = array("", "", ""),
                        $content);
                    $content_media = get_post_gallery_images($post = 57);
                ?>
                <h3> <?php echo $content_header; ?> </h3>
                <p> <?php echo $content_text; ?> </p>
                <ul>
                    <li> 
                        <a href="https://twitter.com/" class="getin" target="_blank">
                            <div>
                                <img src="<?php echo $content_media[0]; ?>" alt="Twitter picture"/>
                            </div>    
                        </a>
                    </li>
                    <li> 
                        <a href="https://www.facebook.com/" class="getin" target="_blank">
                            <div>
                                <img src="<?php echo $content_media[1]; ?>" alt="Facebook picture"/>
                            </div>    
                        </a>
                    </li>
                    <li> 
                        <a href="https://www.td.org" class="getin" target="_blank">
                            <div>
                                <img src="<?php echo $content_media[2]; ?>" alt="Atd picture"/>
                            </div>    
                        </a>
                    </li>
                    <li> 
                        <a href="https://plus.google.com/" class="getin" target="_blank">
                            <div>
                                <img src="<?php echo $content_media[3]; ?>" alt="Google plus picture"/>
                            </div>    
                        </a>
                    </li>
                    <li> 
                        <a href="https://www.linkedin.com/" class="getin" target="_blank">
                            <div>
                                <img src="<?php echo $content_media[4]; ?>" alt="LinkedIn picture"/>
                            </div>    
                        </a>
                    </li>
                    <li> 
                        <a href="http://www.youtube.com/" class="getin" target="_blank">
                            <div>
                                <img src="<?php echo $content_media[5]; ?>" alt="Youtube picture"/>
                            </div>    
                        </a>
                    </li>
                </ul>
            </section>
            <!-- footer part -->
            <footer id="footer">
                <ul>
                    <li>
                        <a href="#" class="alert">Contact</a>
                    </li>
                    <li>
                        <a href="#" class="alert">Download</a>
                    </li>
                    <li>
                        <a href="#" class="alert">Press</a>
                    </li>
                    <li>
                        <a href="#" class="alert">Email</a>
                    </li>
                    <li>
                        <a href="#"class="alert">Support</a>
                    </li>
                    <li>
                        <a href="#" class="alert">Privacy Policy</a>
                    </li>
                </ul>
            </footer>
        </div>
    </body>
</html>