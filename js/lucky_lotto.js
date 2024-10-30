jQuery(document).ready(function(){
 jQuery('#lucky-lotto-btn').click(function(event){
  jQuery('#lotto-number-response').empty();
   event.preventDefault();
   var roof = jQuery("#lotto-numbers").val();
       roof = parseInt(roof);
   var rows = jQuery("#lotto-rows").val();
       rows = parseInt(rows);

  if (rows === 6) {
    for(var i = 0; i < rows; i++) {
      jQuery('#lotto-number-response').append('<li id="viking-lotto-numbers">' + (Math.floor(Math.random() * roof) + 1) + '</li>');
    }
  } else {
  for(var i = 0; i < rows; i++) {
    jQuery('#lotto-number-response').append('<li>' + (Math.floor(Math.random() * roof) + 1) + '</li>');
  }

  if (rows === 5) {
      for(var i = 0; i < 2; i++) {
        jQuery('#lotto-number-response').append('<li id="special-lotto-numbers">' + (Math.floor(Math.random() * 10) + 1) + '</li>');
    }
  }
}

 }); 
});
