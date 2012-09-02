/* Author: Ido Green
 * @greenido
 */

$(function() {
  $("#raceDetails").modal({
    keyboard: true,
    remote:   true,
    show:     false
  });
  
  // start the party
  $("a.race-but").click(function(e) {
    e.preventDefault();
    
    var href = $(e.target).attr('href');
    if (href.indexOf('#') == 0) {
      //$(href).modal('show');
      console.log("showing href" + href);
      $("#raceDetails").show();
    } else {
      //      url = "http://nivut.org.il/" + href;
      //      $('.modal-body').html('<iframe width="100%" height="100%" frameborder="0" scrolling="no" allowtransparency="true" src="' +
      //        url + '"></iframe>');
      //      $("#raceDetails").show();
      //      
      //      
      $.get("getEvent.php?event=" + href, function(data) {
        $(".modal-body").html(data);
        $("#raceDetails").modal('show');
      });
    }
    
  });
  
  
});







