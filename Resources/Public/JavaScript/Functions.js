define([
    'jquery', 
    "TYPO3/CMS/Backend/Notification", 
    "TYPO3/CMS/Backend/Severity",
    "TYPO3/CMS/Empadministration/BootstrapDatetimepickerMin"
], function (
    $, 
    t3notification, 
    t3severity,
    bs_datetime
) {
/*
 *	#####   Default variable initialization   #####
 */

/*
 *	#####   Default variable initialization   #####
 */
return {
    flashPopup: function (infoHead, infoMsg, infoType = t3severity.info, severityTimeout = 1) {
        t3notification.showMessage(infoHead, infoMsg, infoType)
    },
    initAll: function () {
        $(".datetimepicker").datetimepicker({
            format: 'dd-mm-yyyy hh:ii',
            autoclose: true,
            todayBtn: true,
        });

        $(".readonly").on('keydown paste', function(e){
            e.preventDefault();
        });
        
        console.log("function called");
    }
};
});