<?php
    //$indexPage = false;
$_SERVER['SCRIPT_NAME'] = '/site/scripts/home_info.php';
$script = "home_info.php";

    #$_GET['homepageID'] = $homepage;

    # Common variables for both documents & homepages
$categoryItemArray = array();
$dirTree = array();
$includeMaps = false;
require_once 'utilities/JaduStatus.php';
require_once 'JaduStyles.php';
require_once 'JaduMetadata.php';
require_once 'JaduCategories.php';
require_once 'egov/JaduCL.php';
require_once 'websections/JaduHomepages.php';
    #require_once 'websections/JaduHomepageWidgetsToHomepages.php';
    #require_once 'websections/JaduHomepageWidgets.php';
    #require_once 'websections/JaduHomepageWidgetSettings.php';
require_once 'utilities/JaduAdministrators.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/site/includes/doctype.php';
    #require_once $_SERVER['DOCUMENT_ROOT'] . '/site/includes/stylesheets.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/site/includes/metadata.php';
?>



        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta charset="utf-8" />
        <meta name="robots" content="noindex, nofollow">

        <meta name="description" content="<?php print encodeHtml($entry_title); ?>">
        <meta name="keywords" content="<?php print encodeHtml($keywords); ?>">
        <meta name="dcterms.description" content="<?php print encodeHtml($entry_title); ?>">
        <meta name="dcterms.subject" content="<?php print encodeHtml($entry_title); ?>">
        <meta name="dcterms.title" content="<?php print encodeHtml($entry_title); ?>">
        <!-- link rel="stylesheet" type="text/css" href="//www.messiah.edu/a/grad-program-pages/grad-programs-pages.css" -->


        <link rel="stylesheet" href="https://use.typekit.net/ncr5yvh.css">
<style>
    .messiah-accordion { margin-top:0px !important; }
    .accordion-icon { margin-right:45px;}
    .pointer { cursor: pointer;}
</style>




<link rel="stylesheet" type="text/css" href="/site/custom_scripts/styles/ug-program-page/css/grad-program.css">
<link rel="stylesheet" type="text/css" href="/site/custom_scripts/styles/global.css">
<link rel="stylesheet" type="text/css" href="/site/custom_scripts/styles/ug-program-page/css/slick.css">
<link type="text/css" rel="stylesheet" href="/site/custom_scripts/styles/outcomes.css"/>
<!-- <link type="text/css" rel="stylesheet" href="/site/custom_scripts/styles/outcomes.css?v=3"/> -->

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/site/includes/opening_javascript.php';
?>
<script src="/site/custom_scripts/styles/ug-program-page/js/slick.js"></script>
<script src="/site/custom_scripts/styles/ug-program-page/js/grad-program.js"></script>
<script type="text/javascript" src="//fast.fonts.net/jsapi/72d06cb8-0c8f-4fd7-b671-80f4e1989ebc.js"></script>
<script type="text/javascript" src="/site/javascript/waypoints.min.js"></script>

    <title><?php print encodeHtml($entry_title); ?> | <?php print encodeHtml(METADATA_GENERIC_NAME); ?></title>

<?php

require_once 'opening.php';
