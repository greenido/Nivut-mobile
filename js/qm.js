/* Author: Ido Green
 * @greenido
 */

// util to open links from modal to a new page
function changeLinks(links) {
  var len = links.length;
  for(var i=0; i<len; i++) {
    oldLink = links[i].href;
    oldLink = oldLink.substring(21);
    links[i].href = "http://nivut.org.il" + oldLink; 
    links[i].setAttribute("data-rel","dialog");
  }
}

function addBlankTargets(links) {
  var len = links.length;
  for(var i=0; i<len; i++) {
    oldLink = links[i].href;
    oldLink = oldLink.substring(21);
    links[i].href = "http://nivut.org.il" + oldLink; 
    links[i].target = "_blank";
    links[i].setAttribute("data-icon", "forward");
    links[i].setAttribute("data-role", "button");
  }
}

//
// start of the party
//
$(document).on('pageinit','[data-role=page]', function(){

  console.log("--start the party--");
  changeLinks($("#main-events a"));
    
  $(".race-but").click(function(e) {
    e.preventDefault();  
    var href = $(e.target).attr('href');
    $.get("getEvent.php?event=" + href, function(data) {
      $("#event-details").html(data);
      addBlankTargets($("#event-details a"));
      $.mobile.changePage("#eventPage" , {transition: "slideup"} );
    });
 
  });
  
}); // end of the party







