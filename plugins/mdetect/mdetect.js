var MobileEsp={initCompleted:!1,isWebkit:!1,isMobilePhone:!1,isIphone:!1,isAndroid:!1,isAndroidPhone:!1,isTierTablet:!1,isTierIphone:!1,isTierRichCss:!1,isTierGenericMobile:!1,engineWebKit:"webkit",deviceIphone:"iphone",deviceIpod:"ipod",deviceIpad:"ipad",deviceMacPpc:"macintosh",deviceAndroid:"android",deviceGoogleTV:"googletv",deviceHtcFlyer:"htc_flyer",deviceWinPhone7:"windows phone os 7",deviceWinPhone8:"windows phone 8",deviceWinMob:"windows ce",deviceWindows:"windows",deviceIeMob:"iemobile",devicePpc:"ppc",enginePie:"wm5 pie",deviceBB:"blackberry",deviceBB10:"bb10",vndRIM:"vnd.rim",deviceBBStorm:"blackberry95",deviceBBBold:"blackberry97",deviceBBBoldTouch:"blackberry 99",deviceBBTour:"blackberry96",deviceBBCurve:"blackberry89",deviceBBCurveTouch:"blackberry 938",deviceBBTorch:"blackberry 98",deviceBBPlaybook:"playbook",deviceSymbian:"symbian",deviceSymbos:"symbos",deviceS60:"series60",deviceS70:"series70",deviceS80:"series80",deviceS90:"series90",devicePalm:"palm",deviceWebOS:"webos",deviceWebOShp:"hpwos",engineBlazer:"blazer",engineXiino:"xiino",deviceNuvifone:"nuvifone",deviceBada:"bada",deviceTizen:"tizen",deviceMeego:"meego",deviceKindle:"kindle",engineSilk:"silk-accelerated",vndwap:"vnd.wap",wml:"wml",deviceTablet:"tablet",deviceBrew:"brew",deviceDanger:"danger",deviceHiptop:"hiptop",devicePlaystation:"playstation",devicePlaystationVita:"vita",deviceNintendoDs:"nitro",deviceNintendo:"nintendo",deviceWii:"wii",deviceXbox:"xbox",deviceArchos:"archos",engineOpera:"opera",engineNetfront:"netfront",engineUpBrowser:"up.browser",engineOpenWeb:"openweb",deviceMidp:"midp",uplink:"up.link",engineTelecaQ:"teleca q",engineObigo:"obigo",devicePda:"pda",mini:"mini",mobile:"mobile",mobi:"mobi",maemo:"maemo",linux:"linux",mylocom2:"sony/com",manuSonyEricsson:"sonyericsson",manuericsson:"ericsson",manuSamsung1:"sec-sgh",manuSony:"sony",manuHtc:"htc",svcDocomo:"docomo",svcKddi:"kddi",svcVodafone:"vodafone",disUpdate:"update",uagent:"",InitDeviceScan:function(){this.initCompleted=!1,navigator&&navigator.userAgent&&(this.uagent=navigator.userAgent.toLowerCase()),this.isWebkit=this.DetectWebkit(),this.isIphone=this.DetectIphone(),this.isAndroid=this.DetectAndroid(),this.isAndroidPhone=this.DetectAndroidPhone(),this.isTierIphone=this.DetectTierIphone(),this.isTierTablet=this.DetectTierTablet(),this.isMobilePhone=this.DetectMobileQuick(),this.isTierRichCss=this.DetectTierRichCss(),this.isTierGenericMobile=this.DetectTierOtherPhones(),this.initCompleted=!0},DetectIphone:function(){return this.initCompleted||this.isIphone?this.isIphone:this.uagent.search(this.deviceIphone)>-1?!this.DetectIpad()&&!this.DetectIpod():!1},DetectIpod:function(){return this.uagent.search(this.deviceIpod)>-1},DetectIphoneOrIpod:function(){return!(!this.DetectIphone()&&!this.DetectIpod())},DetectIpad:function(){return!!(this.uagent.search(this.deviceIpad)>-1&&this.DetectWebkit())},DetectIos:function(){return!(!this.DetectIphoneOrIpod()&&!this.DetectIpad())},DetectAndroid:function(){return this.initCompleted||this.isAndroid?this.isAndroid:this.uagent.search(this.deviceAndroid)>-1||this.DetectGoogleTV()?!0:this.uagent.search(this.deviceHtcFlyer)>-1},DetectAndroidPhone:function(){return this.initCompleted||this.isAndroidPhone?this.isAndroidPhone:this.DetectAndroid()&&this.uagent.search(this.mobile)>-1?!0:this.DetectOperaAndroidPhone()?!0:this.uagent.search(this.deviceHtcFlyer)>-1},DetectAndroidTablet:function(){return this.DetectAndroid()?this.DetectOperaMobile()?!1:this.uagent.search(this.deviceHtcFlyer)>-1?!1:!(this.uagent.search(this.mobile)>-1):!1},DetectAndroidWebKit:function(){return!(!this.DetectAndroid()||!this.DetectWebkit())},DetectGoogleTV:function(){return this.uagent.search(this.deviceGoogleTV)>-1},DetectWebkit:function(){return this.initCompleted||this.isWebkit?this.isWebkit:this.uagent.search(this.engineWebKit)>-1},DetectWindowsPhone:function(){return!(!this.DetectWindowsPhone7()&&!this.DetectWindowsPhone8())},DetectWindowsPhone7:function(){return this.uagent.search(this.deviceWinPhone7)>-1},DetectWindowsPhone8:function(){return this.uagent.search(this.deviceWinPhone8)>-1},DetectWindowsMobile:function(){return this.DetectWindowsPhone()?!1:this.uagent.search(this.deviceWinMob)>-1||this.uagent.search(this.deviceIeMob)>-1||this.uagent.search(this.enginePie)>-1?!0:this.uagent.search(this.devicePpc)>-1&&!(this.uagent.search(this.deviceMacPpc)>-1)?!0:this.uagent.search(this.manuHtc)>-1&&this.uagent.search(this.deviceWindows)>-1},DetectBlackBerry:function(){return this.uagent.search(this.deviceBB)>-1||this.uagent.search(this.vndRIM)>-1?!0:!!this.DetectBlackBerry10Phone()},DetectBlackBerry10Phone:function(){return this.uagent.search(this.deviceBB10)>-1&&this.uagent.search(this.mobile)>-1},DetectBlackBerryTablet:function(){return this.uagent.search(this.deviceBBPlaybook)>-1},DetectBlackBerryWebKit:function(){return!!(this.DetectBlackBerry()&&this.uagent.search(this.engineWebKit)>-1)},DetectBlackBerryTouch:function(){return!(!this.DetectBlackBerry()||!(this.uagent.search(this.deviceBBStorm)>-1||this.uagent.search(this.deviceBBTorch)>-1||this.uagent.search(this.deviceBBBoldTouch)>-1||this.uagent.search(this.deviceBBCurveTouch)>-1))},DetectBlackBerryHigh:function(){return this.DetectBlackBerryWebKit()?!1:!(!this.DetectBlackBerry()||!(this.DetectBlackBerryTouch()||this.uagent.search(this.deviceBBBold)>-1||this.uagent.search(this.deviceBBTour)>-1||this.uagent.search(this.deviceBBCurve)>-1))},DetectBlackBerryLow:function(){return this.DetectBlackBerry()?!this.DetectBlackBerryHigh()&&!this.DetectBlackBerryWebKit():!1},DetectS60OssBrowser:function(){return this.DetectWebkit()?this.uagent.search(this.deviceS60)>-1||this.uagent.search(this.deviceSymbian)>-1:!1},DetectSymbianOS:function(){return!!(this.uagent.search(this.deviceSymbian)>-1||this.uagent.search(this.deviceS60)>-1||this.uagent.search(this.deviceSymbos)>-1&&this.DetectOperaMobile||this.uagent.search(this.deviceS70)>-1||this.uagent.search(this.deviceS80)>-1||this.uagent.search(this.deviceS90)>-1)},DetectPalmOS:function(){return this.DetectPalmWebOS()?!1:this.uagent.search(this.devicePalm)>-1||this.uagent.search(this.engineBlazer)>-1||this.uagent.search(this.engineXiino)>-1},DetectPalmWebOS:function(){return this.uagent.search(this.deviceWebOS)>-1},DetectWebOSTablet:function(){return this.uagent.search(this.deviceWebOShp)>-1&&this.uagent.search(this.deviceTablet)>-1},DetectOperaMobile:function(){return this.uagent.search(this.engineOpera)>-1&&(this.uagent.search(this.mini)>-1||this.uagent.search(this.mobi)>-1)},DetectOperaAndroidPhone:function(){return this.uagent.search(this.engineOpera)>-1&&this.uagent.search(this.deviceAndroid)>-1&&this.uagent.search(this.mobi)>-1},DetectOperaAndroidTablet:function(){return this.uagent.search(this.engineOpera)>-1&&this.uagent.search(this.deviceAndroid)>-1&&this.uagent.search(this.deviceTablet)>-1},DetectKindle:function(){return this.uagent.search(this.deviceKindle)>-1&&!this.DetectAndroid()},DetectAmazonSilk:function(){return this.uagent.search(this.engineSilk)>-1},DetectGarminNuvifone:function(){return this.uagent.search(this.deviceNuvifone)>-1},DetectBada:function(){return this.uagent.search(this.deviceBada)>-1},DetectTizen:function(){return this.uagent.search(this.deviceTizen)>-1},DetectMeego:function(){return this.uagent.search(this.deviceMeego)>-1},DetectDangerHiptop:function(){return this.uagent.search(this.deviceDanger)>-1||this.uagent.search(this.deviceHiptop)>-1},DetectSonyMylo:function(){return this.uagent.search(this.manuSony)>-1&&(this.uagent.search(this.qtembedded)>-1||this.uagent.search(this.mylocom2)>-1)},DetectMaemoTablet:function(){return this.uagent.search(this.maemo)>-1?!0:this.uagent.search(this.linux)>-1&&this.uagent.search(this.deviceTablet)>-1&&!this.DetectWebOSTablet()&&!this.DetectAndroid()},DetectArchos:function(){return this.uagent.search(this.deviceArchos)>-1},DetectGameConsole:function(){return!!(this.DetectSonyPlaystation()||this.DetectNintendo()||this.DetectXbox())},DetectSonyPlaystation:function(){return this.uagent.search(this.devicePlaystation)>-1},DetectGamingHandheld:function(){return this.uagent.search(this.devicePlaystation)>-1&&this.uagent.search(this.devicePlaystationVita)>-1},DetectNintendo:function(){return this.uagent.search(this.deviceNintendo)>-1||this.uagent.search(this.deviceWii)>-1||this.uagent.search(this.deviceNintendoDs)>-1},DetectXbox:function(){return this.uagent.search(this.deviceXbox)>-1},DetectBrewDevice:function(){return this.uagent.search(this.deviceBrew)>-1},DetectSmartphone:function(){return!!(this.DetectTierIphone()||this.DetectS60OssBrowser()||this.DetectSymbianOS()||this.DetectWindowsMobile()||this.DetectBlackBerry()||this.DetectPalmOS())},DetectMobileQuick:function(){return this.DetectTierTablet()?!1:this.initCompleted||this.isMobilePhone?this.isMobilePhone:this.DetectSmartphone()?!0:this.uagent.search(this.mobile)>-1?!0:this.DetectKindle()||this.DetectAmazonSilk()?!0:this.uagent.search(this.deviceMidp)>-1||this.DetectBrewDevice()?!0:this.DetectOperaMobile()||this.DetectArchos()?!0:this.uagent.search(this.engineObigo)>-1||this.uagent.search(this.engineNetfront)>-1||this.uagent.search(this.engineUpBrowser)>-1||this.uagent.search(this.engineOpenWeb)>-1},DetectMobileLong:function(){return this.DetectMobileQuick()?!0:this.DetectGameConsole()?!0:this.DetectDangerHiptop()||this.DetectMaemoTablet()||this.DetectSonyMylo()||this.DetectGarminNuvifone()?!0:this.uagent.search(this.devicePda)>-1&&!(this.uagent.search(this.disUpdate)>-1)?!0:this.uagent.search(this.manuSamsung1)>-1||this.uagent.search(this.manuSonyEricsson)>-1||this.uagent.search(this.manuericsson)>-1?!0:this.uagent.search(this.svcDocomo)>-1||this.uagent.search(this.svcKddi)>-1||this.uagent.search(this.svcVodafone)>-1},DetectTierTablet:function(){return this.initCompleted||this.isTierTablet?this.isTierTablet:!!(this.DetectIpad()||this.DetectAndroidTablet()||this.DetectBlackBerryTablet()||this.DetectWebOSTablet())},DetectTierIphone:function(){return this.initCompleted||this.isTierIphone?this.isTierIphone:this.DetectIphoneOrIpod()||this.DetectAndroidPhone()||this.DetectWindowsPhone()||this.DetectBlackBerry10Phone()||this.DetectPalmWebOS()||this.DetectBada()||this.DetectTizen()||this.DetectGamingHandheld()?!0:!(!this.DetectBlackBerryWebKit()||!this.DetectBlackBerryTouch())},DetectTierRichCss:function(){return this.initCompleted||this.isTierRichCss?this.isTierRichCss:this.DetectTierIphone()||this.DetectKindle()||this.DetectTierTablet()?!1:this.DetectMobileQuick()?this.DetectWebkit()?!0:!!(this.DetectS60OssBrowser()||this.DetectBlackBerryHigh()||this.DetectWindowsMobile()||this.uagent.search(this.engineTelecaQ)>-1):!1},DetectTierOtherPhones:function(){return this.initCompleted||this.isTierGenericMobile?this.isTierGenericMobile:this.DetectTierIphone()||this.DetectTierRichCss()||this.DetectTierTablet()?!1:!!this.DetectMobileLong()}};MobileEsp.InitDeviceScan();