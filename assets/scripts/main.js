// JavaScript source code

//Script de la modal
function override_mce_options($initArray) {
     $opts = '*[*]';
    $initArray['valid_elements'] = $opts;
    $initArray['extended_valid_elements'] = $opts;
    return $initArray;
}

add_filter('tiny_mce_before_init', 'override_mce_options');

	tinymce.init({
		selector: '#newPostContent',
		plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table paste"
	    ],
	    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
		toolbar_drawer: 'floating'
		/*tinycomments_mode: 'embedded',
		tinycomments_author: 'Author name',
		hidden_input: false,
	    forced_root_block : "", 
	    force_br_newlines : true,
	    force_p_newlines : false,*/
		/*inline: true, !!!!!! LIGNE BLOQUANTE POUR L'INITIALISATION  de tinyMCE !!!!!! */
	});


