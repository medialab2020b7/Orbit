$(function() {
    var container = document.getElementById( "globeArea" );
    var controller = new GIO.Controller( container );
    controller.addData( data );
    controller.init();
});  