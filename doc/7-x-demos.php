<?php
require_once('inc/func.php');
echo do_header("Demo Magic", NULL, NULL, 'calbox');
?>

<h1>How the %^$%^ do the Demos Work?</h1>
<p>After some though, I decided to include the annotated demo magic function here.  I doubt it's useful outside of it's purpose, 
but it does show how to dynamically change datebox options.</p>

<h3>Main Part</h3>
<pre class="prettyprint">$(document).on('change', '.demopick', function(e){
  // Listen to all elements with the "demopick" class
  
  // Set some quick links.
  thisSel = $(e.currentTarget);        // The input that changed
  thisBox = '#'+thisSel.data('link');  // The datebox to change, from the data-link attribute
  
  // Grab the raw value.
  thisVal = thisSel.val();
  
  // Check to see if it's valid JSON.
  thisJSON = makeJSON(thisVal);
  
  if ( thisVal === "true" ) { thisVal = true; }    // Convert string "true" to bool true
  if ( thisVal === "false" ) { thisVal = false; }  // Convert string "false" to bool false
  
  // If it's a string of an integer, convert it to an integer.
  if ( thisVal == parseInt(thisVal,10) ) { thisVal = parseInt(thisVal,10); }
  
  // If it *was* valid JSON, use that instead. 
  if ( thisJSON !==false ) { thisVal = thisJSON; }
  
  // Create an empty opject.
  thisObj = {};
  
  // Set option to value - option name from data-opt attribute.
  thisObj[thisSel.data('opt')] = thisVal;

  // Finally update the datebox.
  $(thisBox).datebox(thisObj);
  $(thisBox).datebox('refresh');
})</pre>

<h3>JSON "maker"</h3>
<pre class="prettyprint">function makeJSON(str) {
  try {
    // Just return the JSON.  If it's invalid, it'll throw an error.
    return jQuery.parseJSON(str);
  } catch (e) {
    // In which case, the answer is false.
    return false;
  }
}</pre>

<?php
echo do_footer();
?>
