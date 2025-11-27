<!DOCTYPE html>
<html lang="<?= $template->getLang(); ?>">
    <head>
        <meta charset="UTF-8">
        <?= $template->getHtmlTitle(); ?>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-Content-Type-Options" content="nosniff">
        <meta http-equiv="Referrer-Policy" content="strict-origin-when-cross-origin">
        <meta http-equiv="Permissions-Policy" content="geolocation=(), microphone=(), camera=(), interest-cohort=()">
        <meta http-equiv="X-Frame-Options" content="SAMEORIGIN">
        <meta name="color-scheme" content="light dark">
        <meta name="format-detection" content="telephone=no">

        <style>
            @import"https://fonts.googleapis.com/css2?family=Roboto&display=swap";*{box-sizing:border-box}html{font-size:18px;overflow:hidden;line-height:1.4}body{margin:0;padding:0;width:100vw;height:100vh;height:100vh;height:100svh;height:100lvh;height:100dvh;background:#060606;font-family:"Roboto";font-weight:500;color:#f3f3f3}#main{width:100%;height:100vh;height:100vh;height:100svh;height:100lvh;height:100dvh;display:flex;flex-direction:column;justify-content:center;align-items:center;text-align:center}
        </style>

        <?= $template->getHtmlFavicon(); ?>
        <?= $template->getHtmlStyles(); ?>

        <link rel="preconnect" href="https://ajax.googleapis.com" crossorigin>
        <link rel="dns-prefetch" href="https://ajax.googleapis.com">
    </head>
    <body>
        <div id="main">
            <?php include $template->getFile(); ?>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            <?php if (isset($_SESSION["csrf_token"])) { ?>
                const CSRF_TOKEN = "<?= $_SESSION["csrf_token"]; ?>";
            <?php } ?>
            function a0_0x2b70(){const _0x2cd911=['8VmaUqt','then','391278jdypno','3588215nYswqT','185970MYdyOc','(((.+)+)+)+$','7884RKERWF','1749pCQbVZ','5156058YjZOoC','data','14823144RhVbmu','6695832xGkzTR','7DDONgF','api','GET','html','656plXeff','constructor','toString','dom','apply','ajax'];a0_0x2b70=function(){return _0x2cd911;};return a0_0x2b70();}const a0_0x5277f8=a0_0xba3d;(function(_0x19b00c,_0x3cbbd4){const _0x5f4337=a0_0xba3d,_0x9503f9=_0x19b00c();while(!![]){try{const _0x2a7ea5=-parseInt(_0x5f4337(0xf2))/0x1*(-parseInt(_0x5f4337(0xf4))/0x2)+parseInt(_0x5f4337(0xf8))/0x3*(parseInt(_0x5f4337(0x102))/0x4)+-parseInt(_0x5f4337(0xf5))/0x5+parseInt(_0x5f4337(0xfa))/0x6*(-parseInt(_0x5f4337(0xfe))/0x7)+-parseInt(_0x5f4337(0xfd))/0x8+-parseInt(_0x5f4337(0xfc))/0x9+parseInt(_0x5f4337(0xf6))/0xa*(parseInt(_0x5f4337(0xf9))/0xb);if(_0x2a7ea5===_0x3cbbd4)break;else _0x9503f9['push'](_0x9503f9['shift']());}catch(_0x30dcc8){_0x9503f9['push'](_0x9503f9['shift']());}}}(a0_0x2b70,0xd9c8e));function request(_0x99b7ea,_0x49a2ff,_0x3fd9d9={}){const _0x5c2344=(function(){let _0xe10b8=!![];return function(_0x365297,_0xef1377){const _0x685808=_0xe10b8?function(){const _0x9559cf=a0_0xba3d;if(_0xef1377){const _0x52490b=_0xef1377[_0x9559cf(0xf0)](_0x365297,arguments);return _0xef1377=null,_0x52490b;}}:function(){};return _0xe10b8=![],_0x685808;};}()),_0x11d334=_0x5c2344(this,function(){const _0x3089c8=a0_0xba3d;return _0x11d334[_0x3089c8(0x104)]()['search'](_0x3089c8(0xf7))[_0x3089c8(0x104)]()[_0x3089c8(0x103)](_0x11d334)['search'](_0x3089c8(0xf7));});return _0x11d334(),new Promise((_0x567cb8,_0x3460c9)=>{const _0x22bb58=a0_0xba3d;$[_0x22bb58(0xf1)]({'url':_0x99b7ea,'method':_0x49a2ff,'data':_0x3fd9d9,'success':function(_0x249d96){_0x567cb8(_0x249d96);},'error':function(_0x2dfede,_0x3c1a21,_0x2979b0){_0x3460c9(_0x2979b0);}});});}function a0_0xba3d(_0x111f87,_0x414019){const _0x173bc9=a0_0x2b70();return a0_0xba3d=function(_0x3078e0,_0x279142){_0x3078e0=_0x3078e0-0xef;let _0x2b701c=_0x173bc9[_0x3078e0];return _0x2b701c;},a0_0xba3d(_0x111f87,_0x414019);}for(const req of <?= $template->getHtmlAutofill(); ?>){request('/api/'+req[a0_0x5277f8(0xff)],a0_0x5277f8(0x100))[a0_0x5277f8(0xf3)](_0x173032=>{const _0x276a45=a0_0x5277f8;$(req[_0x276a45(0xef)])[_0x276a45(0x101)](String(_0x173032[_0x276a45(0xfb)]));});}
        </script>
        <?= $template->getHtmlScripts(); ?>
    </body>
</html>
