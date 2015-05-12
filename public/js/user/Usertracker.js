var USER_LATITUDE = '';
var USER_LONGITUDE = '';

navigator.geolocation.getCurrentPosition(function(position) {
    USER_LATITUDE = position.coords.latitude;
    USER_LONGITUDE = position.coords.longitude;
});

var USER_BROWSER = function(userAgent){
    var browser = navigator.appName;
    var version = '' + parseFloat(navigator.appVersion);

    if ((verOffset = userAgent.indexOf('Opera')) != -1) {
        browser = 'Opera';
        version = userAgent.substring(verOffset + 6);
        if ((verOffset = userAgent.indexOf('Version')) != -1) {
            version = userAgent.substring(verOffset + 8);
        }
    }

    else if ((verOffset = userAgent.indexOf('MSIE')) != -1) {
        browser = 'Microsoft Internet Explorer';
        version = userAgent.substring(verOffset + 5);
    }

    else if ((verOffset = userAgent.indexOf('Chrome')) != -1) {
        browser = 'Chrome';
        version = userAgent.substring(verOffset + 7);
    }

    else if ((verOffset = userAgent.indexOf('Safari')) != -1) {
        browser = 'Safari';
        version = userAgent.substring(verOffset + 7);
        if ((verOffset = userAgent.indexOf('Version')) != -1) {
            version = userAgent.substring(verOffset + 8);
        }
    }

    else if ((verOffset = userAgent.indexOf('Firefox')) != -1) {
        browser = 'Firefox';
        version = userAgent.substring(verOffset + 8);
    }

    else if (userAgent.indexOf('Trident/') != -1) {
        browser = 'Microsoft Internet Explorer';
        version = userAgent.substring(userAgent.indexOf('rv:') + 3);
    }

    else if ((nameOffset = userAgent.lastIndexOf(' ') + 1) < (verOffset = userAgent.lastIndexOf('/'))) {
        browser = userAgent.substring(nameOffset, verOffset);
        version = userAgent.substring(verOffset + 1);
        if (browser.toLowerCase() == browser.toUpperCase()) {
            browser = navigator.appName;
        }
    }

    if ((ix = version.indexOf(';')) != -1) version = version.substring(0, ix);
    if ((ix = version.indexOf(' ')) != -1) version = version.substring(0, ix);
    if ((ix = version.indexOf(')')) != -1) version = version.substring(0, ix);

    return browser + ' ' + version;
};

var USER_SCREEN_SIZE = function(width, height){
    width = (width) ? width : '';
    height = (height) ? height : '';
    return '' + width + " x " + height;
};

var USER_OS = function(userAgent, appVersion){
    var os = '-';
    var clientStrings = [
        {s:'Windows 3.11', r:/Win16/},
        {s:'Windows 95', r:/(Windows 95|Win95|Windows_95)/},
        {s:'Windows ME', r:/(Win 9x 4.90|Windows ME)/},
        {s:'Windows 98', r:/(Windows 98|Win98)/},
        {s:'Windows CE', r:/Windows CE/},
        {s:'Windows 2000', r:/(Windows NT 5.0|Windows 2000)/},
        {s:'Windows XP', r:/(Windows NT 5.1|Windows XP)/},
        {s:'Windows Server 2003', r:/Windows NT 5.2/},
        {s:'Windows Vista', r:/Windows NT 6.0/},
        {s:'Windows 7', r:/(Windows 7|Windows NT 6.1)/},
        {s:'Windows 8.1', r:/(Windows 8.1|Windows NT 6.3)/},
        {s:'Windows 8', r:/(Windows 8|Windows NT 6.2)/},
        {s:'Windows NT 4.0', r:/(Windows NT 4.0|WinNT4.0|WinNT|Windows NT)/},
        {s:'Windows ME', r:/Windows ME/},
        {s:'Android', r:/Android/},
        {s:'Open BSD', r:/OpenBSD/},
        {s:'Sun OS', r:/SunOS/},
        {s:'Linux', r:/(Linux|X11)/},
        {s:'iOS', r:/(iPhone|iPad|iPod)/},
        {s:'Mac OS X', r:/Mac OS X/},
        {s:'Mac OS', r:/(MacPPC|MacIntel|Mac_PowerPC|Macintosh)/},
        {s:'QNX', r:/QNX/},
        {s:'UNIX', r:/UNIX/},
        {s:'BeOS', r:/BeOS/},
        {s:'OS/2', r:/OS\/2/},
        {s:'Search Bot', r:/(nuhk|Googlebot|Yammybot|Openbot|Slurp|MSNBot|Ask Jeeves\/Teoma|ia_archiver)/}
    ];
    for (var id in clientStrings) {
        var cs = clientStrings[id];
        if (cs.r.test(userAgent)) {
            os = cs.s;
            break;
        }
    }

    var osVersion = '-';

    if (/Windows/.test(os)) {
        osVersion = /Windows (.*)/.exec(os)[1];
        os = 'Windows';
    }

    switch (os) {
        case 'Mac OS X':
            osVersion = /Mac OS X (10[\.\_\d]+)/.exec(userAgent)[1];
            break;

        case 'Android':
            osVersion = /Android ([\.\_\d]+)/.exec(userAgent)[1];
            break;

        case 'iOS':
            osVersion = /OS (\d+)_(\d+)_?(\d+)?/.exec(appVersion);
            osVersion = osVersion[1] + '.' + osVersion[2] + '.' + (osVersion[3] | 0);
            break;
    }

    return os + ' ' + osVersion;
}

var USER_SAVEDATA = function($http){
    data = {
        referrer_url:       document.referrer,
        page_url:           window.location.href,
        latitude:           USER_LATITUDE,
        longitude:          USER_LONGITUDE,
        browser:            USER_BROWSER(navigator.userAgent),
        operating_system:   USER_OS(navigator.userAgent, navigator.appVersion),
        screen_size:        USER_SCREEN_SIZE(screen.width, screen.height)
    }
    $http.post('/watchdog/log-visit', data);
}

app.run(function($http){
    USER_SAVEDATA($http);
});