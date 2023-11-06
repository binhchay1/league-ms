window.fbAsyncInit = function() {
    FB.init({
        appId: '633374587043765',
        version: 'v10.0',
        cookie: true,
        autoLogAppEvents: true,
        xfbml: true
    });
};
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    var htmlTag = d.getElementsByTagName('html')[0];
    var subdomain = htmlTag.getAttribute('lang');
    var lang = "vi_VN";
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    if (subdomain === "en") {
        lang = "en_US";
    }
    if (subdomain === "ru") {
        lang = "ru_RU";
    }
    if (subdomain === "jp") {
        lang = "ja_JP";
    }
    if (subdomain === "cn") {
        lang = "zh_HK";
    }
    if (subdomain === "es") {
        lang = "es_ES";
    }
    if (subdomain === "fr") {
        lang = "fr_FR";
    }
    if (subdomain === "ar") {
        lang = "ar_AR";
    }
    js.src = 'https://connect.facebook.net/' + lang + '/sdk/xfbml.customerchat.js'
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));