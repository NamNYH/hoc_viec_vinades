<!DOCTYPE html>
    <html lang="{LANG.Content_Language}" xmlns="http://www.w3.org/1999/xhtml" prefix="og: http://ogp.me/ns#">
    <head>
        <title>{THEME_PAGE_TITLE}</title>
        <!-- BEGIN: metatags --><meta {THEME_META_TAGS.name}="{THEME_META_TAGS.value}" content="{THEME_META_TAGS.content}">
        <!-- END: metatags -->
        <link rel="shortcut icon" href="{SITE_FAVICON}">
         <!-- BEGIN: links -->
        <link<!-- BEGIN: attr --> {LINKS.key}<!-- BEGIN: val -->="{LINKS.value}"<!-- END: val --><!-- END: attr -->>
        <!-- END: links -->
        
        <!--============================================--> 
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!--============================================--> 
        <link rel="stylesheet" type="text/css" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/vendor/bootstrap/css/bootstrap.min.css">
        <!--============================================--> 
        <link rel="stylesheet" type="text/css" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/fonts/iconic/css/material-design-iconic-font.min.css">
        <!--============================================--> 
        <link rel="stylesheet" type="text/css" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/vendor/animate/animate.css">
        <!--============================================--> 
        <link rel="stylesheet" type="text/css" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/vendor/css-hamburgers/hamburgers.min.css">
        <!--============================================--> 
        <link rel="stylesheet" type="text/css" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/css/util.min.css">
        <!--============================================--> 
        <link rel="stylesheet" type="text/css" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/css/main.css">
        <!--============================================--> 
        <!-- BEGIN: js -->
        <script<!-- BEGIN: ext --> src="{JS_SRC}"<!-- END: ext -->><!-- BEGIN: int -->{JS_CONTENT}<!-- END: int --></script>
        <!-- END: js -->
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "url": "{NV_MY_DOMAIN}",
            "logo": "{NV_MY_DOMAIN}{LOGO_SRC}"
        }
        </script>

</head>
<body class="animsition">
