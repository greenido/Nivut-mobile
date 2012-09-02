/* Author: Ido Green
 * @greenido
 */

// util to open links from modal to a new page
function addBlankTargets(links) {
  //var links = $("#raceDetails a"); //document.getElementsByTagName('a');
  var len = links.length;
  for(var i=0; i<len; i++) {
    oldLink = links[i].href;
    oldLink = oldLink.substring(21);
    links[i].href = "http://nivut.org.il" + oldLink; 
    links[i].target = "_blank";
  }
}


//
// start
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
        addBlankTargets($(".modal-body a"));
        $("#raceDetails").modal('show');
      });
    }
    
  });
  
  
  
  
  
});







