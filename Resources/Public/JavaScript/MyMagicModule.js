define([
    "jquery", 
    "TYPO3/CMS/Backend/Notification", 
    "TYPO3/CMS/Backend/Severity", 
    "TYPO3/CMS/Empadministration/bootstrap.min", // Its bundle.bootstrap.min file
    "TYPO3/CMS/Empadministration/bootstrap.navbar.min",
    "TYPO3/CMS/Empadministration/Functions",
], function(
    $,
    t3notification, 
    t3severity, 
    bs_main,
    bs_navbar,
    functions
) {
    functions.initAll();
    bs_navbar.bsNavbarInit();
    
    /*
	 *	#####   Default variable initialization   #####
	 */
	var t3ServerityMsg = {
		popupTimeout: 10000,
		statusError: t3severity.error,
		statusInfo: t3severity.info,
		statusNotice: t3severity.notice,
		statusOk: t3severity.ok,
		statusWarning: t3severity.warning
    };
    
    // functions.flashPopup("Error", "This is Error", t3ServerityMsg.statusError);
    // functions.flashPopup("Info", "This is info", t3ServerityMsg.statusInfo);
    // functions.flashPopup("Notice", "This is notice", t3ServerityMsg.statusNotice);
    // functions.flashPopup("Ok", "This is Oky", t3ServerityMsg.statusOk);
    // functions.flashPopup("Warning", "This is Warning", t3ServerityMsg.statusWarning);
    // console.log("Magic module called");
});