// When the user scrolls down 20px from the top of the document, slide down the navbar
// When the user scrolls to the top of the page, slide up the navbar (50px out of the top view)
function loadDoc(file, id) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {


      document.getElementById(id).innerHTML = this.responseText

      var event = new Event('ajaxEvent');
      // Dispatch the event.
      document.getElementById('ajax').dispatchEvent(event);
    }
  }
  xhttp.open("GET", file, true)
  xhttp.send()
}
