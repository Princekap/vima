var timeoutTimer;
var expireTime = 1000*60*60;
function expireSession(){
    clearTimeout(timeoutTimer);
    timeoutTimer = setTimeout("IdleTimeout()", expireTime);
}
function IdleTimeout() {
    localStorage.setItem("You've been logged out", true);
   window.location.href="logout.php')}}";
}
$(document).on('click mousemove scroll', function() {
    expireSession();
});
expireSession();