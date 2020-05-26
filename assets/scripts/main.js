// JavaScript source code
//Tiny script
tinymce.init({
	selector: '.postContent',
	plugins: [
	"advlist link image lists"
	],
	toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	toolbar_drawer: 'floating',
	tinycomments_mode: 'embedded',
	tinycomments_author: 'Author name',
	hidden_input: false,
	forced_root_block : "", 
	force_br_newlines : true,
	force_p_newlines : true,
	/*inline: true, !!!!!! LIGNE BLOQUANTE POUR L'INITIALISATION  de tinyMCE !!!!!! */
});

/* ---------------------------------- */
/* Back to top
------------------------------------- */
jQuery(document).ready(function() {
  
  var btn = $('#backtotop');

  $(window).scroll(function() {
    if ($(window).scrollTop() > 300) {
      btn.addClass('visible');
    } else {
      btn.removeClass('visible');
    }
  });

  btn.on('click', function(e) {
    e.preventDefault();
    $('html, body').animate({scrollTop:0}, '300');
  });

});

